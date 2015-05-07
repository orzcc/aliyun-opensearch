<?php namespace Orzcc\Opensearch;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class OpensearchServiceProvider extends ServiceProvider {
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/opensearch.php');
        $this->publishes([$source => config_path('opensearch.php')]);
        $this->mergeConfigFrom($source, 'opensearch');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }
    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('opensearch.factory', function ($app) {
            return new Factories\OpensearchFactory();
        });
        $app->alias('opensearch.factory', 'Orzcc\Opensearch\Factories\OpensearchFactory');
    }
    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('opensearch', function ($app) {
            $config = $app['config'];
            $factory = $app['opensearch.factory'];
            return new OpensearchManager($config, $factory);
        });
        $app->alias('opensearch', 'Orzcc\Opensearch\OpensearchManager');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'opensearch',
            'opensearch.factory',
        ];
    }
}