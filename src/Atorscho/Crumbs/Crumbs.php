<?php namespace Atorscho\Crumbs;

use \View;
use \Str;

class Crumbs {

	protected $crumbs = [ ];

	protected $view = 'crumbs';

	/**
	 * Add new item to the breadcrumbs list.
	 *
	 * @param      $uri
	 * @param null $title
	 */
	public function add( $uri, $title = null )
	{
		if ( is_null($title) )
			$title = Str::title($uri);

		$this->crumbs[] = [
			'title' => $title,
			'uri'   => $uri
		];
	}

	/**
	 * Return an HTML view for the breadcrumbs.
	 *
	 * @return mixed
	 */
	public function render()
	{
		$crumbs = toObjects($this->crumbs);

		return View::make('crumbs::crumbs', compact('crumbs'))->render();
	}

} 
