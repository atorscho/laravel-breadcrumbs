<?php namespace Atorscho\Crumbs;

use View;

class Crumbs {

	/**
	 * Breadcrumbs list.
	 *
	 * @var array
	 */
	protected $crumbs = [ ];

	/**
	 * Add new link to the breadcrumbs list.
	 *
	 * @param string $uri
	 * @param null $title
	 */
	public function add( $uri, $title )
	{
		$this->crumbs[] = [
			'title' => $title,
			'uri'   => $uri
		];
	}

	/**
	 * Add new route link to the breadcrumbs list.
	 *
	 * @param string $route
	 * @param string $title
	 * @param array  $parameters
	 */
	public function addRoute( $route, $title, $parameters = array() )
	{
		$this->add(route($route, $parameters), $title);
	}

	/**
	 * Return an HTML for breadcrumbs to insert to a view.
	 *
	 * @return mixed
	 */
	public function render()
	{
		$crumbs = toObjects($this->crumbs);

		return View::make('crumbs::crumbs', compact('crumbs'))->render();
	}

} 
