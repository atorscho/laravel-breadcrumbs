<?php namespace Atorscho\Crumbs;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Blade;

class CrumbsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Load Views
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'crumbs');
		$this->publishes([
			__DIR__ . '/../resources/views' => base_path('resources/views/atorscho/crumbs')
		]);

		// Load Configs
		$this->publishes([
			__DIR__ . '/../config/crumbs.php' => config_path('crumbs.php')
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerFacades();

		$this->registerAliases();

		$this->registerBladeExtensions();
	}

	/**
	 * Register New Custom Facades.
	 *
	 * @return void
	 */
	protected function registerFacades()
	{
		$this->app->bind('crumbs', function ( $app )
		{
			return $app->make('Atorscho\Crumbs\Crumbs');
		});
	}

	/**
	 * Register New Custom Aliases.
	 *
	 * @return void
	 */
	protected function registerAliases()
	{
		$this->app->booting(function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Crumbs', 'Atorscho\Crumbs\CrumbsFacade');
		});
	}

	/**
	 * Extending Blade with new 'crumbs' directive.
	 */
	protected function registerBladeExtensions()
	{
		Blade::extend(function($view, $compiler)
		{
			$pattern = $compiler->createPlainMatcher('crumbs');

			return preg_replace($pattern, "$1<?php echo Crumbs::render(); ?>$2", $view);
		});
	}

}
