<?php

namespace Package\Movie\Providers;

use Illuminate\Support\ServiceProvider;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Package\Movie\Repositories\MovieEpisodeRepositoryEloquent;
use Package\Movie\Repositories\MovieRepository;
use Package\Movie\Repositories\MovieRepositoryEloquent;
use Package\Movie\Repositories\ViewRepository;
use Package\Movie\Repositories\ViewRepositoryEloquent;

class MovieServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register(): void
    {
        $this->app->singleton(MovieRepository::class, MovieRepositoryEloquent::class);
        $this->app->singleton(MovieEpisodeRepository::class, MovieEpisodeRepositoryEloquent::class);
        $this->app->singleton(ViewRepository::class, ViewRepositoryEloquent::class);
    }
}
