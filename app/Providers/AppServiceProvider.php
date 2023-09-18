<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\UserRoleRepository;
use App\Repositories\UserRoleRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->singleton(UserRoleRepository::class, UserRoleRepositoryEloquent::class);
        $this->app->singleton(RoleRepository::class, RoleRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
