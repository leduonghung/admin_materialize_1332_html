<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Services\Interfaces\RoleServiceInterface;

/**
 * Class RoleService
 * @package App\Services
 */
class RoleService extends BaseService implements RoleServiceInterface
{
    protected $roleRepository;
    protected $language;

    public function __construct(
        RoleRepository $roleRepository,
        ){
        $this->roleRepository = $roleRepository;
        $this->language = $this->currentLanguage();
    }

    public function paginate($request,$softDeletes=false) {

        $columns = $this->paginateSelect(); 
        $condition['keyword'] = $request->keyword ? addslashes($request->keyword): null;
        if ($request->has('publish') && !is_null($request->publish)) {
            $condition['publish'] =  $request->integer('publish');
        } else {
            unset($condition['publish']);
        }
        
        // $condition['where'] = [
        //     ['tb2.language_id','=',$this->language]
        // ];
        $perPages = $request->integer('perPages');
        $extend =['path'=>'post.index'];
        $orderBy =[
            ['roles.id', 'DESC'],
            ['roles.created_at','DESC']
        ];

        return $this->roleRepository->pagination(
            $columns,
            $condition,
            $perPages,
            $extend,
            $orderBy,
            $join = [], 
            [],
            [],
            $softDeletes
        );
    }

    private function paginateSelect() {
        return ['id', 'name', 'display_name','publish','userCreated', 'userUpdated', 'deleted_at'];

    }

    public function create($request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token','permissions']);
            $payload['name'] = ucfirst($payload['name']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['user_id'] = \Auth::id();
            // dd($payload);
            $role = $this->roleRepository->create($payload);

            $permissions = $request->only(['permissions']);
            $role->permissions()->attach($permissions['permissions']);
            
            DB::commit();
            return $role;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage().' IN ' .$e->getLine();
            dd($e);
            return false;
        }
    }

    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token','permissions']);
            $payload['name'] = ucfirst($payload['name']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['userUpdated'] = Auth::id();
            // dd($payload);
            $permissions = $request->only(['permissions']);
            // dd($permissions);
            $role = $this->roleRepository->update($id, $payload);
            $role->permissions()->sync($permissions['permissions']);
            
            DB::commit();
            return $role;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            die;
            return false;
        }
    }

    public function find($id)
    {
        try {
            return $this->roleRepository->find($id);
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
            $language = $this->roleRepository->update($post['id'],$payload);
            
            // dd($language);
            DB::commit();
            return $language;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return false;
        }
    }
    public function updateStatusAll($post = []){
        DB::beginTransaction();
        try {
            // $field = ['status','userUpdated'];
            $payload['userUpdated'] = \Auth::id();
            $payload['publish'] = (int) $post['value'];
            // if ((int) $post['value'] === 1) {
            // } else {
            //     $payload['publish'] = 1;
            // }
            $language = $this->roleRepository->updateByWhereIn($post['id'],$payload);
            // dd($language);
            
            // dd($language);
            DB::commit();
            return $language;
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
            $role = $this->find($id);
            $data=null;
            if ($role) {
                $data = [
                    'name' => $role->name,
                    'message' => 'Bạn xóa thành công language: '.$role->name
                ];
                $role->delete();
    
            }
            DB::commit();
            return $data;
            // return redirect()->route('motorcycles.show', ['id' => $motorcycles->id]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Không có language nào',
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }
       

        return false;
    }

}
