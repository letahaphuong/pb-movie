<?php

namespace Package\MovieType\Providers;

use Illuminate\Support\ServiceProvider;
use Package\MovieType\Repositories\MovieTypeRepository;
use Package\MovieType\Repositories\MovieTypeRepositoryEloquent;

class MovieTypeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register()
    {
        $this->app->singleton(MovieTypeRepository::class, MovieTypeRepositoryEloquent::class);
    }
}
