<?php

declare(strict_types=1);

namespace App\Providers;

use Override;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register() : void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {

        if (Schema::hasTable('settings'))
        {

            $settings = Cache::remember('site_settings', now()->addHours(10), function () {
                return Setting::all()->pluck('value', 'key')->toArray();
            });

            config([ 'setting' => $settings ]);
        }

    }
}
