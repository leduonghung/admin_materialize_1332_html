<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    //model muốn tương tác
    protected $model;

   //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function pagination(
        array $columns = ['*'],
        array $condition = [],
        int $perPages = 15,
        array $extend =[],
        array $orderBy =[['id','DESC']],
        array $join = [],
        array $relations =[],
        array $rawQuery = []
        ) {
            $query =  $this->model->select($columns);
            // dd($extend);
            return $query
                ->keyword($condition['keyword'] ?? null)
                ->publish($condition['publish'] ?? null)
                ->customWhere($condition['where'] ?? null)
                ->customWhereRaw($rawQuery['whereRaw'] ?? null)
                // ->wtrashed($condition['trashed'] ?? null)
                ->relationCount($relations?? null)
                ->relation($relations?? null)
                ->customjoin($join ?? null)
                ->customGroupBy($extend['groupBy'] ?? null)
                ->customOrderBy($orderBy)
                ->paginate($perPages)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getAllPaginate($perPages = 5)
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPages);
    }

    public function getAll(array $columns = ['*'])
    {
        return $this->model->select($columns)->get();
    }


    public function find($id)
    {
        return $result = $this->model->find($id);
// dd($result);
    }

    public function findMyCondition(array $columns = ['*'],array $conditions = [], array $relations = [], array $joins = [], array $orderBy = [], bool $flag = false)
    {
        $query = $this->model->select($columns)->newQuery();
        if(!empty($conditions)){
            // $query->whereIn($condition['whereIn'] ?? null);
            foreach ($conditions as $key => $val) {
                switch ($key) {
                    case 'whereIn':
                        $query->customWhereIn($conditions['whereIn'] ?? null);
                        break;
                    case 'whereNull':
                        $query->whereNull($conditions['whereNull'] ?? null);
                        break;
                    
                    default:
                    $query->where($val[0],$val[1],$val[2]);
                        break;
                }
                // if ($key === 'whereIn') {
                //     $query->customWhereIn($conditions['whereIn'] ?? null);
                // } else {
                //     $query->where($val[0],$val[1],$val[2]);
                // }
                // $query->where($val[0],$val[1],$val[2]);

                // ->whereNull('deleted_at')
            }
        }
        if(!empty($joins)){
            foreach ($joins as $value) {
                $query->join($value[0],$value[1],$value[2],$value[3]);
            }
        }

        if(!empty($relations)){
            foreach ($relations as $value) {
                $query->with($value);
            }
        }
        if(count($orderBy)){
            foreach ($orderBy as $val) {
                $query->orderBy($val[0],$val[1]);
            }
        }
        // dd($query->toSql());
        return $flag ? $query->get() : $query->first();
    }

    public function findByCondition(array $condition = [], array $relation = [], bool $flag = false, array $orderBy = [])
    {
        $query = $this->model->newQuery();
        
        if(count($condition)){
            foreach ($condition as $key => $val) {
                $query->where($val[0],$val[1],$val[2]);
            }
        }
        if(count($orderBy)){
            foreach ($orderBy as $val) {
                $query->orderBy($val[0],$val[1]);
            }
        }
        $query->with($relation);
        return $flag ? $query->get() : $query->first();
    }
    public function findById(int $id, array $columns = ['*'], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($id);
    }

    public function findWhere(array $collectWhere, array $columns = ['*'], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->where($collectWhere)->first();
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateByWhereIn(array $whereIn = [], $attributes = [])
    {
        $result = $this->model->whereIn('id',$whereIn)->update($attributes);
        if ($result) {
            return $this->find($whereIn);
        }

        return false;
    }


    public function updateByWhere(array $conditions = [], $payload = [])
    {
        $query = $this->model->newQuery();
        if(count($conditions)){
            foreach ($conditions as $key => $val) {
                $query->where($val[0],$val[1],$val[2]);
            }
        }
        return $query->each(function ($record, $key) use ($payload) {
            $record->update($payload);
        });
    }


    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    public function forceDelete(int $id = 0)
    {
        $result = $this->findById($id);
        $result->forceDelete();
        return $result;
    }

    public function destroy(array $ids =[])
    {
        try {
            return $this->model->whereIn('id',$ids)->delete(); 
        }
        catch(\Exception $e) {
            dd($e);
        }
    }

    public function forceDeleteByCondition(array $conditions =[],array $joins =[], $forceDelete = true)
    {
        $query = $this->model->newQuery();
        if(count($conditions)){
            foreach ($conditions as $val) {
                $query->where($val[0],$val[1],$val[2]);
            }
        }

        if(!empty($joins)){
            foreach ($joins as $value) {
                $query->join($value[0],$value[1],$value[2],$value[3]);
            }
        }
        
        return $forceDelete ? $query->forceDelete() : $query->delete();
            
    }
    public function forceDeleteByWhere(array $conditions =[])
    {
        try {
            $query = $this->model->newQuery();
            if(count($conditions)){
                foreach ($conditions as $val) {
                    $query->where($val[0],$val[1],$val[2]);
                }
            }
            return $query->each(function ($record, $key) {
                $record->forceDelete();
            });
            //  $query->forceDelete(); 
        }
        catch(\Exception $e) {
            dd($e);
        }
    }

    public function createPivot($model, array $attributes =[], string $relation ='') {
        return $model->{$relation}()->attach($model->id,$attributes);
    }
    public function updateExistingPivot($model, array $attributes =[], string $relation ='') {
        return $model->{$relation}()->updateExistingPivot($model->id,$attributes);
    }
}
