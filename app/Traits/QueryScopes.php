<?php

namespace App\Traits;


trait QueryScopes
{
    public function __construct() {
    }

    public function scopeKeyword($query, $keyword) {
        if(!empty($keyword)){
            $query->where('name','LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
    public function scopePublish($query, $publish) {
        if(!empty($publish) ){
            $query->where('publish', '=', $publish);
        }
        return $query;
    }
    public function scopeCustomWhere($query, $where = []) {
        if(!empty($where)){
            foreach($where as $key => $val){
                $query->where($val[0], $val[1], $val[2]);
            }
        }
        return $query;
    }

    public function scopeCustomWhereRaw($query, $rawQuery) {
        if(is_array($rawQuery) && !empty($rawQuery)){
            foreach($rawQuery as $key => $val){
                $query->whereRaw($val[0], $val[1]);
            }
        }
        return $query;
    }
    /////////////
    public function scopeCustomWhereIn($query, $whereIn =[]) {
        if(is_array($whereIn) && !empty($whereIn)){
            foreach($whereIn as $key => $val){
                // echo ($key);
                // dd($val);
                $query->whereIn($key, $val);
            }
        }
        // dd($query->toSql());
        return $query;
    }
    /* ===========================*******************============= */
    public function scopeRelationCount($query, $relation) {
        if(!empty($relation)){
            foreach ($relation as $item) {
                $query->withCount($item);
            }
        }
        return $query;
    }
    public function scopeRelation($query, $relation) {
        if(!empty($relation)){
            foreach ($relation as $item) {
                $query->with($item);
            }
        }
        return $query;
    }
    public function scopeCustomJoin($query, $join) {
        if(!empty($join)){
            foreach ($join as $value) {
                $query->join($value[0],$value[1],$value[2],$value[3]);
            }
        }
        return $query;
    }
    public function scopeCustomGroupBy($query, $groupBy) {
        if(isset($groupBy) && !empty($groupBy)){
            $query->groupBy($groupBy);
        }
        return $query;
    }
    public function scopeCustomOrderBy($query, $orderBy) {
        if(isset($orderBy) && !empty($orderBy)){
            foreach ($orderBy as $order) {
                $query->orderBy($order[0], $order[1]);
            }
        }
        return $query;
    }
}
