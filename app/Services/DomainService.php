<?php

namespace App\Services;

use DB,Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Services\Interfaces\DomainServiceInterface;
use App\Repositories\Interfaces\DomainRepositoryInterface as DomainRepository;

class DomainService extends BaseService implements DomainServiceInterface
{
    protected $domainRepository;

    public function __construct(DomainRepository $domainRepository) {
        $this->domainRepository = $domainRepository;
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
        return $this->domainRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPages,
            ['path' => 'Domain.index'],
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

            // $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['date_of_registration'] = $payload['registration_date'];
            // $end = date($payload['registration_date'], strtotime('+5 years'));
            $date = new Carbon($payload['registration_date']);
            // dd($date->addYears((int)$payload['year_of_extended'])->toDateString());

            $payload['expiry_date'] = $date->addYears((int)$payload['year_of_extended'])->toDateString();
            $payload['order'] = $payload['order'] ?? 0;
            $payload['userCreated'] = \Auth::id();
            
            $domain = $this->domainRepository->create($payload);
            // $domain['counts'] = $this->domainRepository->getAll()->count();
            DB::commit();
            return $domain;
        } catch (QueryException $e) {
            DB::rollback();
            echo $e->getMessage();
            return $e;
        }
    }
    
    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload =$request->except(['_token']);
            $payload['publish'] = (array_key_exists('publish',$payload) && $payload['publish']=='on') ? true : false;
            $payload['userUpdated'] = \Auth::id();
            $payload['order'] = $payload['order'] ?? 0;
            $data = $this->domainRepository->update($id, $payload);
            // dd($data);
            DB::commit();
            return $data;
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
            return $this->domainRepository->find($id);
        }  catch (QueryException $e) {
            echo $e->getMessage();
            die;
            return false;
        }

    }

    public function findWhere(array $collectWhere, array $columns = ['*'], array $relation = [])
    {
        return $this->domainRepository->findWhere($collectWhere,$columns,$relation);
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload['userUpdated'] = \Auth::id();
            $payload[$post['field']] = ($post['value'] == 1 )? 0 : 1;
            $Domain = $this->domainRepository->update($post['id'],$payload);

            // dd($Domain);
            DB::commit();
            return $Domain;
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
            $Domain = $this->domainRepository->updateByWhereIn($post['id'],$payload);
            // dd($Domain);

            // dd($Domain);
            DB::commit();
            return $Domain;
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
                $data = (object) [
                    'title' => ' Bạn đã xóa thành công !',
                    'message' => 'Domain : '.$result->name .' đã bị xóa !'
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
                'message' => 'Không có Domain nào',
            ], 500);
            // echo $e->getMessage().' IN ' .$e->getLine();
        }


        return false;
    }

    public function switch($id){
        try {
            DB::beginTransaction();
            $this->domainRepository->updateDomain($id);
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
