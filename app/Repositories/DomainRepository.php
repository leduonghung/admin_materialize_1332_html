<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\DomainRepositoryInterface;

class DomainRepository extends BaseRepository implements DomainRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Domain::class;
    }
}
