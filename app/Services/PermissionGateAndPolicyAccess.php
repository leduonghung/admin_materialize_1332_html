<?php

namespace App\Services;

use App\Policies\MenuPolicy;
use App\Policies\PostCategoryPolicy;
use Illuminate\Support\Facades\Gate;

/**
 * Class UserService
 * @package App\Services
 */
class PermissionGateAndPolicyAccess
{

    public function setGateAndPolicyAccess(){
        $this->defineGatePostCategory();
        $this->defineGateMenu();
    }

    private function defineGatePostCategory(){
        Gate::define('tour-category-list', [PostCategoryPolicy::class,'viewAny']);
        Gate::define('tour-category-create', [PostCategoryPolicy::class,'create']);
        Gate::define('tour-category-edit', [PostCategoryPolicy::class,'update']);
        Gate::define('tour-category-delete', [PostCategoryPolicy::class,'delete']);
    }
    private function defineGateMenu(){
        Gate::define('menu-list', [MenuPolicy::class,'viewAny']);
        Gate::define('menu-create', [MenuPolicy::class,'create']);
        // Gate::define('menu-create', [MenuPolicy::class,'restore']);
        Gate::define('menu-edit', [MenuPolicy::class,'update']);
        Gate::define('menu-delete', [MenuPolicy::class,'delete']);
    }
}
