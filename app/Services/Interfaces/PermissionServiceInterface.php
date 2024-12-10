<?php

namespace App\Services\Interfaces;

/**
 * Interface PermissionServiceInterface
 * @package App\Services\Interfaces
 */
interface PermissionServiceInterface
{
    public function paginate($request,$softDeletes=false);
    public function getAll(array $columns = ['*']);
}
