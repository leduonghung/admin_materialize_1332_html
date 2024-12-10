<?php
namespace App\Repositories\Interfaces;


interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function insertOrUpdate($data =[]);
    public function getWhere(array $collectWhere, array $relation = [], array $columns = ['*']);
    public function getCount();
}