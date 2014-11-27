# Crumbs
![Latest Stable Version](https://img.shields.io/github/release/atorscho/crumbs.svg)

This is a simple breadcrumbs package for Laravel Framework.

#### Installation
To install, just add new dependency to your `composer.json` file in root of your project:

	"atorscho/crumbs": "1.0.*"

And of course do not forget to add new Service Provider to `/app/config/app.php`:

	'Atorscho\Crumbs\CrumbsServiceProvider`,

#### Configurations
The package contains only one configuration for now: the home link (by default: Dashboard).

If you want to change it, just run `php artisan config:publish atorscho/crumbs` and go to `/app/config/packages/atorscho/crumbs/config.php`.

#### Helper Functions
In `src` folder you may find a `helpers.php` file which has two helper functions: `toObjects()` and `crumbs()`.

> `toObjects()`: A function I often use. It simply converts all nested arrays to `stdClass` objects.

> `crumbs()`: A function that replaces `Crumbs::render()` to print Crumbs HTML to the view.

## How to?
This is a sample Controller function.

	// file: controllers/UserController.php

	public function show( User $user )
	{
		Crumbs::add(route('users.index'), 'Users');					// Crumbs::add($uri, $title)
		Crumbs::addRoute('users.show', 'Field Groups', $user->id);	// Crumbs::add(route, $title, $parameters = array())
		
		return View::make('users.show', compact('user'));
	}

Now the only thing you need to do is put `crumbs()` where you want the breadcrumbs to render.

I do this:

	// file: views/users/show.blade.php
	
	@if( function_exists('crumbs') )
		{{ crumbs() }}
	@endif
	
	<h1>About {{{ $user->username }}}</h1>

I use `function_exists()` in case I do not have Crumbs installed, just to be sure that nothing will be broken.

That's all!
