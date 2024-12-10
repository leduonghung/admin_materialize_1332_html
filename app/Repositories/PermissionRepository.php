<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use PhpParser\Node\Expr\Cast\Object_;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Permission::class;
    }
    public function pagination(
        array $columns = ['*'],
        array $condition = [],
        int $perPages = 15,
        array $extend =[],
        array $orderBy =[['id','DESC']],
        array $join = [],
        array $relations =[],
        array $rawQuery = [],
        $softDeletes= false
        ) {
            $query =  $this->model->select($columns);
             $query
                ->keyword($condition['keyword'] ?? null)
                ->publish($condition['publish'] ?? null)
                ->customWhere($condition['where'] ?? null)
                ->customWhereRaw($rawQuery['whereRaw'] ?? null)
                ->relationCount($relations?? null)
                ->relation($relations?? null)
                ->customjoin($join ?? null)
                ->customGroupBy($extend['groupBy'] ?? null)
                ->customOrderBy($orderBy);
                if ($softDeletes) {
                    $query->whereNotNull('deleted_at');
                } else {
                    $query->whereNull('deleted_at');
                }
                return $query->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);

        }

    public function getWhere(array $collectWhere, array $relation = [], array $columns = ['*'])
    {
        return $this->model->select($columns)->where($collectWhere)->with($relation)->get();
    }
    public function insertOrUpdate($data = [])
    {
        // dd($data);
        foreach ($data['table_module'] as $keym => $module) {
            $payload['parent_id'] = null;
            $payload['key_code'] = null;
            $payload['display_name'] = $payload['name'] = 'Quản lý '.$module;
            $item = $this->model->updateOrCreate($payload);
            $payload['parent_id'] = $item->id;
            foreach ($data['module_childrents'] as $key => $child) {
                $payload['key_code'] = $keym.'_'.$key;
                $payload['display_name'] = $payload['name'] = $child .' '.$module;
                $fields = [
                    'name'=>$payload['name'],
                    'key_code'=>$payload['key_code'],
                ];
                // dd($fields);

                // dd($payload);
                $aaa = $this->model->updateOrCreate($fields,$payload);
                // dd($aaa);
                // $payload['parent_id'] = null;
            }
        }
    }

    public function getCount()
    {
        return $this->model->count();
    }
}
