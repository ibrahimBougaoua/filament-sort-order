# Filament Sort Order

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-sort-order/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ibrahimbougaoua/filament-sort-order/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-sort-order/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ibrahimbougaoua/filament-sort-order/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require ibrahimbougaoua/filament-sort-order
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-sort-order-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-sort-order-config"
```

This is the contents of the published config file:

```php
return [
	'table' => 'users',
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-sort-order-views"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ibrahim](https://github.com/ibrahimBougaoua)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
