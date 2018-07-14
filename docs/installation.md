# Installation

## Composer

To install "Crumbs", you must add a new dependency to your root `composer.json` file:

```json
"atorscho/crumbs": "^2.5"
```

`"^2.1"` for Laravel 5.1, `"^2.0"` for Laravel 5.0, `"^1.0"` for Laravel 4.2.

## Service Provider

> From v2.5 we are supporting Laravels Auto-Discovery feature. You can skip this step.

Now add new Service Provider to your `providers` array in `/config/app.php`:

```php
Atorscho\Crumbs\CrumbsServiceProvider::class,
```

## Configurations

In order to copy Crumbs' configuration file `crumbs.php` to your `/config` directory, you must run artisan command:

```
php artisan vendor:publish --provider="Atorscho\Crumbs\CrumbsServiceProvider" --tag="config"
```