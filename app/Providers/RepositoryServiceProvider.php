<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\Interfaces\UserServiceInterface::class, \App\Services\UserService::class);
        $this->app->bind(\App\Services\Interfaces\DomainExtensionServiceInterface::class, \App\Services\DomainExtensionService::class);
        $this->app->bind(\App\Services\Interfaces\DomainServiceInterface::class, \App\Services\DomainService::class);
        // $this->app->bind(\App\Services\Interfaces\TouristDestinationServiceInterface::class, \App\Services\TouristDestinationService::class);
        
        // $this->app->bind(\App\Services\Interfaces\PermissionServiceInterface::class, \App\Services\PermissionService::class);
        // $this->app->bind(\App\Services\Interfaces\RoleServiceInterface::class, \App\Services\RoleService::class);
        // $this->app->bind(\App\Services\Interfaces\SystemServiceInterface::class, \App\Services\SystemService::class);
        // $this->app->bind(\App\Services\Interfaces\MenuServiceInterface::class, \App\Services\MenuService::class);
        // $this->app->bind(\App\Services\Interfaces\MenuCatalogueServiceInterface::class, \App\Services\MenuCatalogueService::class);

        $this->app->bind(\App\Repositories\Interfaces\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\RoleRepositoryInterface::class, \App\Repositories\RoleRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\PermissionRepositoryInterface::class, \App\Repositories\PermissionRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\ProvinceRepositoryInterface::class, \App\Repositories\ProvinceRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\DistrictRepositoryInterface::class, \App\Repositories\DistrictRepository::class);

        $this->app->bind(\App\Repositories\Interfaces\LanguageRepositoryInterface::class, \App\Repositories\LanguageRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\DomainExtensionRepositoryInterface::class, \App\Repositories\DomainExtensionRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\DomainRepositoryInterface::class, \App\Repositories\DomainRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\TouristDestinationRepositoryInterface::class, \App\Repositories\TouristDestinationRepository::class);

        // $this->app->bind(\App\Repositories\Interfaces\RouterRepositoryInterface::class, \App\Repositories\RouterRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\SystemRepositoryInterface::class, \App\Repositories\SystemRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\MenuRepositoryInterface::class, \App\Repositories\MenuRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\MenuLanguageRepositoryInterface::class, \App\Repositories\MenuLanguageRepository::class);
        // $this->app->bind(\App\Repositories\Interfaces\MenuCatalogueRepositoryInterface::class, \App\Repositories\MenuCatalogueRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
