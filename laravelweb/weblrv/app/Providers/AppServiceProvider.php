<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Users;
use Illuminate\Support\Facades\Gate;
use App\Http\Middleware\CustomCheckRole;


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
        // Gate::define('admin', [CustomCheckRole::class, 'admin']);

    }
}
