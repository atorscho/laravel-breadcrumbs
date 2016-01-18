<?php

namespace Atorscho\Crumbs;

use Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CrumbsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/helpers.php';

        $this->registerViews();

        $this->registerConfigs();

        $this->registerBladeExtension();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Crumbs
        $this->app->bind('crumbs', function (Application $app) {
            return $app->make(Crumbs::class);
        });

        // Register an Alias
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Crumbs', CrumbsFacade::class);
        });
    }

    /**
     * Extending Blade with new 'crumbs' directive.
     */
    protected function registerBladeExtension()
    {
        Blade::directive('crumbs', function ($view = '') {
            return "<?php echo Crumbs::render({$view}); ?>";
        });
    }

    /**
     * Setup views.
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'crumbs');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/crumbs')
        ], 'views');
    }

    /**
     * Register configuration file.
     */
    protected function registerConfigs()
    {
        $this->publishes([
            __DIR__ . '/../config/crumbs.php' => config_path('crumbs.php')
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config/crumbs.php', 'crumbs');
    }
}
