<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
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
        bool $softDeletes= false
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
            //     $data['users'] = $query->whereNull('deleted_at')->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);
            //     $data['softDeletes'] = $query->whereNotNull('deleted_at')->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);
            // return $data;
                // ->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function findSoftDelete(int $id){
        return $this->model->whereNotNull('deleted_at')->find($id);
    }
}
