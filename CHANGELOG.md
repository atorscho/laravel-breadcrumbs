# Changelog

All Notable changes to `crumbs` will be documented in this file.

## NEXT - 2.1.6

### Added
- New helper function `crumbs()`:

``` php
crumbs('/home', 'Home Page')->add('/categories', 'Categories')->add('Main Category');
```

### Modified
- `Crumbs::add()` now adds current page (its alias `Crumbs::addCurrent()`) if only {$url} specified.

## 2.1.5 [2015-09-04]

### Added
- `CrumbsItem`: disabled state.
- Foundation Framework template views.

### Modified
- `Crumbs::render` and `@crumbs`: now take an optional `$view` parameter.
- Semantic UI views have a new separator.
- Template views now unescape titles so you may pass an icon with/instead of the string.

### Fixed
- Semantic UI views.

### Removed
- `Crumbs::parseConfigLocalization()` removed from the class.

## 2.1.4 [2015-08-27]

### Added
- Semantic UI and Twitter Bootstrap views with microdatas.

### Modified
- `CrumbsItem::active()` got a new parameter `className` to change the active item class name.


## 2.1.3 [2015-08-06]

### Added
- PhpSpec tests.

### Replaced
- Calls to `config()` helper function replaced with relevant class method call for better unit testing.


## 2.1.2 [2015-08-06]

### Added
- Support for configuration localizations.
- StyleCI support.

### Fixed
- Problem with localized strings in config file.
- Bug detecting admin pages if URL has some prefixes (for example `'/en/admin'`).


## 2.0.0 - 2.1.1 [2015-05-13 - 2015-06-15]

### Added
- Support for Laravel 5.1
- Automatic breadcrumbs items
- More config options
- Blade extension: `@crumbs`
- Other minor features
- PSR-2 Code Style
