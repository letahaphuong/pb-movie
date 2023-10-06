<?php

namespace Package\Country\Providers;

use Illuminate\Support\ServiceProvider;
use Package\Country\Repositories\CountryRepository;
use Package\Country\Repositories\CountryRepositoryEloquent;

class CountryServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . "/../../migrations");

    }

    public function register()
    {
        $this->app->singleton(CountryRepository::class, CountryRepositoryEloquent::class);
    }
}
