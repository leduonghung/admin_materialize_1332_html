<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    
    public function getModel()
    {
        return \App\Models\Role::class;
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
                // dd($query->toSql());
                // $data['softDeletes'] = $query->whereNotNull('deleted_at')->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);
                // $string_query->clearOrdersBy();
                // $string_query->clearWhereNotNull();
        }
        // ->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);

        public function getWhere(array $collectWhere, array $columns = ['*'])
        {
            return $this->model->select($columns)->where($collectWhere)->get();
        }
}
