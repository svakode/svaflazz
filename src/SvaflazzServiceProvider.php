<?php

namespace Svakode\Svaflazz;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class SvaflazzServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/svaflazz.php' => config_path('svaflazz.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/svaflazz.php', 'svaflazz');

        $this->app->bind(SvaflazzClient::class, function () {
            $client = new Client();
            return new SvaflazzClient($client);
        });

        $this->app->bind(SvaflazzWrapper::class, function () {
            $client = app(SvaflazzClient::class);
            return new SvaflazzWrapper($client);
        });

        $this->app->alias(SvaflazzWrapper::class, 'svaflazz');
    }
}
