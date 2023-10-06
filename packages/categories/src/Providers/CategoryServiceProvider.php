<?php

namespace Package\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Package\Category\Repositories\CategoryRepository;
use Package\Category\Repositories\CategoryRepositoryEloquent;

class CategoryServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register()
    {
        $this->app->singleton(CategoryRepository::class, CategoryRepositoryEloquent::class);
    }
}
