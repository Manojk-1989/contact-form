<?php

namespace ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        $this->publishes([
            __DIR__.'/config/contactform.php' => config_path('contactform.php'),
        ], 'contactform-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/contactform.php',
            'contactform'
        );
    }
}
