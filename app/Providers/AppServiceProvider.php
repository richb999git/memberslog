<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;  // I added this in to fix error: 1071 Specified key was too long; max key length is 767 bytes

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        // I added this in to fix error: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);

        if(env('APP_ENV') !== 'local')
        {
            $url->forceScheme('https');
        }
    }
}
