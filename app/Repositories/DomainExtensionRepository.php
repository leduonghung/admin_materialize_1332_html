<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\DomainExtensionRepositoryInterface;

class DomainExtensionRepository extends BaseRepository implements DomainExtensionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\DomainExtension::class;
    }
}
