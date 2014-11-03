<?php namespace Atorscho\Crumbs;

use \View;
use \Str;
use \URL;

class Crumbs {

	protected $crumbs = [ ];

	protected $view = 'crumbs';

	public function add( $uri, $title = null )
	{
		if ( is_null($title) )
			$title = Str::title($uri);

		$this->crumbs[] = [
			'title' => $title,
			'uri'   => $uri
		];
	}

	public function render()
	{
		$crumbs = toObjects($this->crumbs);

		return View::make('crumbs::crumbs', compact('crumbs'))->render();
	}

} 
