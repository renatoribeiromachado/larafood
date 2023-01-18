<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Repositories\TenantRepository;
use Illuminate\Repositories\Contracts\TenantRepositoryInterface;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(TenantRepositoryInterface::class,
                        TenantRepository::class
               );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Paginator::useBootstrap();
    }
}
