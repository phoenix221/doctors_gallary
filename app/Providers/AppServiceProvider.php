<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DoctorProviderInterfaces;
use App\ApiClient\DoctorApiProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            DoctorProviderInterfaces::class,
            DoctorApiProvider::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
