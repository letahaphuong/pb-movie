<?php

namespace Package\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register(): void
    {
    }
}
