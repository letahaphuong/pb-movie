<?php

namespace Package\Comment\Providers;
use Illuminate\Support\ServiceProvider;
use Package\Comment\Repositories\CommentRepository;
use Package\Comment\Repositories\CommentRepositoryEloquent;

class CommentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");
    }

    public function register(): void
    {
        $this->app->singleton(CommentRepository::class, CommentRepositoryEloquent::class);
    }
}
