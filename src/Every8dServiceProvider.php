<?php

namespace Every8d\Laravel;

use Every8d\Client;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class Every8dServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application service
     *
     * @return void
     */
    public function boot()
    {
        $dist = __DIR__ . '/../config/every8d.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$dist => config_path('every8d.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('every8d');
        }

        $this->mergeConfigFrom($dist, 'every8d');
    }

    /**
     * Register bindings in the container
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return $this->createEvery8dClient($app['config']);
        });
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }

    /**
     * @param Config $config
     *
     * @return Client
     */
    protected function createEvery8dClient(Config $config)
    {
        $options = $config->get('every8d');

        return new Client([
            'username' => $options['username'],
            'password' => $options['password'],
        ]);
    }
}
