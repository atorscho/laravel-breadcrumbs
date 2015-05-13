<?php namespace Atorscho\Crumbs;

use Illuminate\Support\Facades\Facade;

class CrumbsFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'crumbs';
	}

}
