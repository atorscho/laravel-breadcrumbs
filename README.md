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
> `crumbs()`: A function that replaces use of `Crumbs::render()` to print Crumbs HTML to the view.

## How to?
This is a sample Controller function.

	public function show( User $user )
	{
		Crumbs::add(route('users.index'), 'Users');
		Crumbs::add(route('users.show', $user->id), 'Field Groups');
		
		return View::make('users.show', compact('user'));
	}

