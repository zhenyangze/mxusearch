<?php
namespace Antsfree\Mxusearch;

use Illuminate\Support\ServiceProvider;

class MxusearchProvider extends ServiceProvider
{
    protected $config = 'mxusearch';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish a config file
        $this->publishes([
            __DIR__ . '/../config/mxusearch.php' => config_path('mxusearch.php'),
        ], 'config');

        // add commonds
        $this->app->bindShared('mxusearch.index.add', function () {
            return new Console\AddIndex();
        });

        $this->commands(['mxusearch.index.add']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mxusearch', function () {
            return new MxusearchService();
        });
    }
}