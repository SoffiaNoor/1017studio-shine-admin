<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Information;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $information = Information::first();
        view()->share('information', $information);
    }
}
