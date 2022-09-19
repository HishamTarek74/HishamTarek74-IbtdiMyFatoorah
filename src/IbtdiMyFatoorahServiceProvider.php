<?php

namespace HishamTarek\IbtdiMyFatoorah;

use Illuminate\Support\ServiceProvider;

class IbtdiMyFatoorahServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([__DIR__ . '/config/ibtdimyfatoorah.php' => config_path('ibtdimyfatoorah.php')]);

        $this->mergeConfigFrom(__DIR__ . '/config/ibtdimyfatoorah.php', 'ibtdimyfatoorah');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ibtdimyfatoorah' , function() {

            return new IbtdiMyFatoorah();
        });
    }
}