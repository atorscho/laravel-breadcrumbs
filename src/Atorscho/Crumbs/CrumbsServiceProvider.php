<?php namespace Atorscho\Crumbs;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CrumbsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('atorscho/crumbs');

		require __DIR__ . '/../../helpers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register new Facade
		$this->app->bind('crumbs', function ()
		{
			return new Crumbs;
		});

		// Register alias. No need to add in /app/config/app.php
		$this->app->booting(function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Crumbs', 'Atorscho\Crumbs\Facades\Crumbs');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
