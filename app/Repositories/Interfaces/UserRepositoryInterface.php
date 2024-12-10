<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    // public function getUser();

    public function findSoftDelete(int $id);
}