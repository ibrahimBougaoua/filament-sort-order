# Filament Sort Order

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-sort-order/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ibrahimbougaoua/filament-sort-order/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)

Transform the sorting order of any table effortlessly by installing this package. It provides seamless functionality without requiring any manual code writing. Simply install it, and you're good to go !

<a href="https://www.youtube.com/watch?v=Uq7rSJSuWlw" target="_blank">Youtube Video</a>
<br /><br />
[<img src="https://raw.githubusercontent.com/ibrahimBougaoua/screenshot/main/images/sort.png" width="100%" class="filament-hidden">](https://www.youtube.com/watch?v=Uq7rSJSuWlw)

## Installation

You can install the package via composer:

```bash
composer require ibrahimbougaoua/filament-sort-order
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-sort-order-config"
```

This is the contents of the published config file:

// You can incorporate additional tables by appending "table{number}" as an illustration.
// 'table1' =>'users',
// 'table2' =>'posts',
// 'table3' =>'products',
//And so on...

```php
return [
    'table1' => 'users', // Specify the table to be affected.
    // You can incorporate additional tables by appending "table{number}" as an illustration.
    // 'table2' => 'posts',
    // 'table3' => 'products',
    // And so on...
    'sort' => 'asc', // Default sorting order.
];
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-sort-order-migrations"
php artisan migrate
```
<b>Usage :</b>

Add <b>SortOrder</b> to model.

```bash
class User extends Model
{
    use SortOrder;
    .....
}
```

In User Resource

```bash
->actions([
	DownStepAction::make(),
	UpStepAction::make(),
])
->defaultSort('sort_order', 'asc');
```

## Note :  
The name of the field that is created in the table after installation is <b>sort_order</b>.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ibrahim](https://github.com/ibrahimBougaoua)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
