<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService implements UserServiceInterface 
{
    protected $userRepository;
    // protected $language;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        // $this->language = $this->currentLanguage();
    }

    public function paginate($request,$softDeletes=false) {
        $condition['keyword'] = $request->keyword ? addslashes($request->keyword): null;
        $condition['publish'] = addslashes($request->publish);
        if($condition['publish'] ===''){
            unset($condition['publish']);
        }
        
        $perPages = $request->integer('perPages') ;
        
        return $this->userRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPages,
            ['path'=>'user'],
            [['id','DESC']],
            [],
            [],
            [],
            $softDeletes
        );
    }
    public function getAll() {
        return $this->userRepository->getAll();
    }
    private function paginateSelect() {
        return ['id', 'name', 'email', 'phone', 'address', 'publish','deleted_at','updated_at'];
    }

    public function create($request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token','send','re_password']);
            
            $password = Hash::make($payload['password']);
            $payload['password'] = $password;
            $role_id = $request->only(['role_id']);
           
            $user = $this->userRepository->create($payload);
            $user->roles()->attach($role_id['role_id']);

            
            DB::commit();
            return $user;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request){
        DB::beginTransaction();
        try {
            // $user = $this->userRepository->findById($id);
            $payload = $request->except(['_token','send','roles']);
            $role_id = $request->only(['role_id']);
            // dd($role_id);
            $user = $this->userRepository->update($id, $payload);
            $user->roles()->sync($role_id['role_id']);
            DB::commit();
            return $user;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            dd($e);
            die;
            return false;
        }
    }

    public function find($id)
    {
        try {
            return $this->userRepository->find($id);
        }  catch (QueryException $e) {
            echo $e->getMessage();
            die;
            return false;
        }
    }

    public function findSoftDelete($id)
    {
        try {
            return $this->userRepository->findSoftDelete($id);
        }  catch (QueryException $e) {
            echo $e->getMessage();
            die;
            return false;
        }

    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload['userUpdated'] = \Auth::id();
            $payload[$post['field']] = ($post['value'] == 1 )? 0 : 1;
            $user = $this->userRepository->update($post['id'],$payload);
            
            // dd($user);
            DB::commit();
            return $user;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return false;
        }
    }
    public function updateStatusAll($post = []){
        DB::beginTransaction();
        try {
            $payload['userUpdated'] = \Auth::id();
            $payload['publish'] = (int) $post['value'];
            $user = $this->userRepository->updateByWhereIn($post['id'],$payload);
            // dd($user);
            DB::commit();
            return $user;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $user = $this->find($id);
            if ($user) {
                // dd($user->roles());
                $data = [
                    'name' => $user->name,
                    'message' => 'Bạn xóa thành công user: '.$user->name
                ];
                $user->roles()->detach();
                $user->delete();
    
            }
            DB::commit();
            return $data;

        } catch (QueryException $e) {
            DB::rollBack();
            log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Không có User nào',
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }
       

        return false;
    }
}
