<?php

namespace App\Providers;

use App\Classes\TMDBManager;

use Illuminate\Support\ServiceProvider;

class TMDBManagerProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tmdb', function($app) {
            return new TMDBManager($app);
        });
    }
}
