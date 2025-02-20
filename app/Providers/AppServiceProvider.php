<?php

namespace App\Providers;

use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryInterface;
use App\Repositories\MonthRepository;
use App\Repositories\MonthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ItemRepositoryInterface::class,
            ItemRepository::class,
        );
        $this->app->bind(
            MonthRepositoryInterface::class,
            MonthRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
