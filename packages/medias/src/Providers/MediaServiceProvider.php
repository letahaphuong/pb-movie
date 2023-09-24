<?php

namespace Package\Media\Providers;

use Illuminate\Support\ServiceProvider;
use Package\Media\Repositories\MediaRepository;
use Package\Media\Repositories\MediaRepositoryEloquent;

class MediaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register(): void
    {
        $this->app->singleton(MediaRepository::class, MediaRepositoryEloquent::class);
    }
}
