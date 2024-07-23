<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

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
        try {
            $settings = Setting::where('key', 'timezone')->first();
            
            if ($settings) {
                Config::set('app.timezone', $settings->value ? $settings->value : config('app.timezone'));
            }
        } catch (\Illuminate\Database\QueryException $e) {
          
            Config::set('app.timezone', 'UTC');
        }
    }
}
