<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!$this->app->runningInConsole())
        {

            if(!Schema::hasTable('settings')){
                Log::error("Settings table does not exist");
                die();
            }


            $settigns = Cache::rememberForever('app_settings', function () {
                $data = Setting::first();
                return $data ? $data->toArray() : [];
            });


            foreach ($settigns as $key => $value) {
                Config::set("settings.{$key}", $value);
            }

        }

    }
}
