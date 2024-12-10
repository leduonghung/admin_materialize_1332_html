<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Services\Interfaces\PermissionServiceInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;

/**
 * Class PermissionService
 * @package App\Services
 */
class PermissionService extends BaseService implements PermissionServiceInterface
{
    protected $permissionRepository;
    // protected $language;

    public function __construct(
        PermissionRepository $permissionRepository,
        ){
        $this->permissionRepository = $permissionRepository;
        // $this->language = $this->currentLanguage();
    }

    public function getAll(array $columns = ['*'])
    {
        return $this->permissionRepository->getAll($columns);
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
            ['permissions.id', 'DESC'],
            ['permissions.created_at','DESC']
        ];

        return $this->permissionRepository->pagination(
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
            $payload =$request->only(['permissions'])['permissions'];
            // $payload['name'] = ucfirst($payload['name']);
            // $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            // $payload['user_id'] = \Auth::id();
            // dd(count($payload));
            // dd(($payload));
            foreach ($payload as $keyp => $route) {
                // dd(($route));
                $parent_id = null;
                foreach ($route as $key => $val) {
                    $permission['parent_id'] = $parent_id;
                    $permission['name'] = $val;
                    $permission['display_name'] = $val;
                    $permission['key_code'] = $key;
                    if ($key==0) {
                        $permission['key_code'] = $keyp;
                    }
                    $permiss = $this->permissionRepository->findWhere($permission);
                    if(!$permiss){
                        $permiss = $this->permissionRepository->create($permission);
                        // dd($permiss);

                    }else continue;
                    // dd($permission);
                    if ($key==0) {
                        $parent_id = $permiss->id;
                    }

                    // dd($parent_id);
                }
            }
            DB::commit();
            return true;
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
            $payload =$request->except(['_token']);
            $payload['name'] = ucfirst($payload['name']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['userUpdated'] = Auth::id();
            // dd($payload);
            $permission = $this->permissionRepository->update($id, $payload);
            DB::commit();
            return $permission;
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
            return $this->permissionRepository->find($id);
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
            $language = $this->permissionRepository->update($post['id'],$payload);

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
            $language = $this->permissionRepository->updateByWhereIn($post['id'],$payload);
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
            $permission = $this->find($id);
            $data=null;
            if ($permission) {
                $data = [
                    'name' => $permission->name,
                    'message' => 'Bạn xóa thành công language: '.$permission->name
                ];
                $permission->delete();

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

    public function insertOrUpdate($data){
        try {
            DB::beginTransaction();
            // dd($data);
            $this->permissionRepository->insertOrUpdate($data);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage().' IN ' .$e->getLine();
            dd($e);
        }
    }
}
