<?php

namespace App\Services;

use DB,Log;
use Illuminate\Database\QueryException;
use App\Services\Interfaces\DomainExtensionServiceInterface;
use App\Repositories\Interfaces\DomainExtensionRepositoryInterface as DomainExtensionRepository;

class DomainExtensionService extends BaseService implements DomainExtensionServiceInterface
{
    protected $domainExtensionRepository;

    public function __construct(DomainExtensionRepository $domainExtensionRepository) {
        $this->domainExtensionRepository = $domainExtensionRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = $request->keyword ? addslashes($request->keyword): null;
        if ($request->has('publish') && !is_null($request->publish)) {
            $condition['publish'] =  $request->integer('publish');
        } else {
            unset($condition['publish']);
        }
        $perPages = $request->integer('perPages');
        $orderBy =[
            ['id', 'DESC'],
            ['created_at','DESC']
        ];
        return $this->domainExtensionRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPages,
            ['path' => 'DomainExtension.index'],
            $orderBy
        );
    }

    private function paginateSelect() {
        return ['id', 'name', 'image','publish'];
    }

    public function create($request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            // $payload['order'] = ($payload['order']=='on') ? true : false;
            $payload['userCreated'] = \Auth::id();
            $payload['name'] = $payload['domain_extension_name'] ;
            
            // dd($payload);
            $DomainExtension = $this->domainExtensionRepository->create($payload);
            DB::commit();
            return $DomainExtension;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return false;
        }
    }
    
    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['userUpdated'] = \Auth::id();

            $DomainExtension = $this->domainExtensionRepository->update($id, $payload);
            DB::commit();
            return $DomainExtension;
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
            return $this->domainExtensionRepository->find($id);
        }  catch (QueryException $e) {
            echo $e->getMessage();
            die;
            return false;
        }

    }

    public function findWhere(array $collectWhere, array $columns = ['*'], array $relation = [])
    {
        return $this->domainExtensionRepository->findWhere($collectWhere,$columns,$relation);
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload['userUpdated'] = \Auth::id();
            $payload[$post['field']] = ($post['value'] == 1 )? 0 : 1;
            $DomainExtension = $this->domainExtensionRepository->update($post['id'],$payload);

            // dd($DomainExtension);
            DB::commit();
            return $DomainExtension;
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
            $DomainExtension = $this->domainExtensionRepository->updateByWhereIn($post['id'],$payload);
            // dd($DomainExtension);

            // dd($DomainExtension);
            DB::commit();
            return $DomainExtension;
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
            $result = $this->find($id);
            if ($result) {
                $data = [
                    'name' => $result->name,
                    'message' => 'Bạn xóa thành công DomainExtension: '.$result->name
                ];
                $result->delete();

            }
            DB::commit();
            return $data;

            // return redirect()->route('motorcycles.show', ['id' => $motorcycles->id]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Message : ' . $e->getMessage() . 'Line  : ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Không có DomainExtension nào',
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }


        return false;
    }

    public function switch($id){
        try {
            DB::beginTransaction();
            $this->domainExtensionRepository->updateDomainExtension($id);
            DB::commit();
            return true;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage().' IN ' .$e->getLine();
            dd($e);
            return false;
        }
    }
}
