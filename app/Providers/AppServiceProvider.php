<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('FORCE_HTTPS')) {
            \URL::forceScheme('https');
        }
        \Schema::defaultStringLength(191);
        \Validator::extend(
          'recaptcha',
          'App\\Recaptcha@validate'
   );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }
}
