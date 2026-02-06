<?php

namespace App\Providers;

use App\Models\SettingConfig;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        Paginator::useBootstrapFour();

        // Guard DB queries during app bootstrap (prevents errors during migration)
        if (Schema::hasTable((new SettingConfig)->getTable())) {
            View::share('shared_config', SettingConfig::all()->keyBy('key'));
        } else {
            View::share('shared_config', collect());
        }
    }
}
