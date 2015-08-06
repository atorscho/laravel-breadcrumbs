# Crumbs

![Latest Stable Version](https://img.shields.io/github/release/atorscho/crumbs.svg)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Simple and functional breadcrumbs package for Laravel 5.

> [v1 branch](https://github.com/atorscho/crumbs/tree/v1) is for Laravel 4.

## Installation

### Composer

To install Crumbs, you must add a new dependency to your root `composer.json` file:

```json
"atorscho/crumbs": "^2.1"
```

`"^2.0"` for Laravel 5.0, `"^1.0"` for Laravel 4.2.

### Service Provider

Now add new Service Provider to your `providers` array in `/config/app.php`:

```php
Atorscho\Crumbs\CrumbsServiceProvider::class,
```

### Configurations

In order to copy Crumbs' configuration file `crumbs.php` to your `/config` directory, you must run artisan command:

```
php artisan vendor:publish --provider="Atorscho\Crumbs\CrumbsServiceProvider" --tag="config"
```

I advice you to view the configuration file in order to modify the breadcrumbs if needed. Every config is nicely commented.

## How to Use

Let's assume we have a simple Controller method:

```php
public function show(User $user)
{
    return view('users.show', compact('user'));
}
```

We want now to have a breadcrumb list like this:

```
Home > Users > {username}'s Profile
```

To achieve this result we call to `add( $url, $title, $parameters = [] )` method.

```php
public function show(User $user)
{
	Crumbs::add('/users', 'Users');
	Crumbs::add('/users/{username}', "{$user->username}'s Profile", $user->username);

    return view('users.show', compact('user'));
}
```

If you prefer route names, you may replace the links with respective names:

```php
public function show(User $user)
{
	Crumbs::add('users.index', 'Users');
	Crumbs::add('users.show', "{$user->username}'s Profile", $user->username);

    return view('users.show', compact('user'));
}
```

You may also simplify the last (active) breadcrumb section with `addCurrent( $title )`:

```php
public function show(User $user)
{
	Crumbs::add('users.index', 'Users');
	Crumbs::addCurrent("{$user->username}'s Profile");

    return view('users.show', compact('user'));
}
```

To output generated breadcrumbs into your blade template, simply use new custom Blade `crumbs` directive:

```html
@crumbs

<h1>Welcome!</h1>
```

## API

Documentation for most improtant methods.

### `Crumbs` Class
---

Add new item to the breadcrumbs.

As first parameter you may pass a relative (`/users/create`) or absolute (`http://example`) link, or a route name (`users.edit`).

```php
public function add( $url, $title, $parameters = [ ] );
```

---

Add current page to the breadcrumbs using an active class (see config file) by specifying only its title.

```php
public function addCurrent( $title );
```

---

Manually add home and/or admin pages to the breadcrumbs.

```php
public function addHomePage();

public function addAdminPage();
```

---

Output resulted breadcrumbs HTML.

```php
public function render();
```

---

Get first and last items of the breadcrumbs array.

```php

public function getFirstItem();

public function getLastItem();
```

### `CrumbsItem` Class
---

If $attr is true, it will return `class="active"` (the `active` class may be modified in config file).

If $attr is false, it will simply return the `currentItemClass` config value.

```php
public function active($attr = true);
```

---

Returns true if an item is the current page.

```php
public function isActive();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email `contact@alextorscho.com` instead of using the issue tracker.

## Credits

- [Alex Torscho][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/atorscho/crumbs.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/atorscho/crumbs.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/atorscho/crumbs
[link-travis]: https://travis-ci.org/thephpleague/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/:package_name
[link-downloads]: https://packagist.org/packages/atorscho/crumbs
[link-author]: https://github.com/atorscho
[link-contributors]: ../../contributors
