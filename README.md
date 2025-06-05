# Filament Sort Order

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-sort-order/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ibrahimbougaoua/filament-sort-order/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibrahimbougaoua/filament-sort-order.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-sort-order)

Transform the sorting order of any table effortlessly by installing this package. It provides seamless functionality without requiring any manual code writing. Simply install it, and you're good to go!

## Features

- **Easy Integration**: Add sorting functionality with just a trait and two actions
- **Automatic Initialization**: Existing records are automatically initialized with proper sort values
- **Laravel 12 Ready**: Full compatibility with Laravel 11.x and 12.x
- **FilamentPHP 3.x**: Built specifically for FilamentPHP 3.x
- **Configurable**: Customize column names and sort directions via configuration
- **Zero Dependencies**: No additional dependencies beyond Laravel and FilamentPHP

## Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x
- FilamentPHP 3.x

## Support us

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://buymeacoffee.com/ibrahimbougaoua)

<a href="https://www.youtube.com/watch?v=Uq7rSJSuWlw" target="_blank">Youtube Video</a>
<br /><br />
[<img src="https://raw.githubusercontent.com/ibrahimBougaoua/screenshot/main/images/sort.png" width="100%" class="filament-hidden">](https://www.youtube.com/watch?v=Uq7rSJSuWlw)

## Installation

### Step 1: Install the package

You can install the package via composer:

```bash
composer require ibrahimbougaoua/filament-sort-order
```

### Step 2: Publish the configuration file (Optional)

You can publish the config file to customize the package behavior:

```bash
php artisan vendor:publish --tag="filament-sort-order-config"
```

This will create a `config/filament-sort-order.php` file with the following default configuration:

```php
return [

    /** Add the tables to be migrated */
    'tables' => [
        'users',
    ],

    /* The column name to be used for sorting */
    'sort_column_name' => 'sort_order',

    /* Sort Order asc or desc */
    'sort' => 'asc',
];
```

### Step 3: Publish and run the migrations

Publish the migration stub and run the migrations to add the sort column to your specified tables:

```bash
php artisan vendor:publish --tag="filament-sort-order-migrations"
php artisan migrate
```

**Important**: Make sure to update the `tables` array in the configuration file with the actual table names you want to add sorting to before running the migrations.
## Usage

### Step 1: Add the SortOrder trait to your model

Add the `SortOrder` trait to any model you want to enable sorting for:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;

class User extends Model
{
    use SortOrder;
    
    // ... your model code
}
```

### Step 2: Configure your Filament Resource

In your Filament Resource, add the sorting actions to your table and set the default sort:

```php
<?php

namespace App\Filament\Resources;

use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Filament\Resources\Resource;
use Filament\Tables;

class UserResource extends Resource
{
    // ... your resource code
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ... your columns
            ])
            ->actions([
                DownStepAction::make(),
                UpStepAction::make(),
                // ... your other actions
            ])
            ->defaultSort('sort_order', 'asc');
    }
}
```

### Step 3: Migration

After publishing the migrations, ensure your database table has the `sort_order` column. The migration will add:

- A `sort_order` column (NOT NULL, default: 0)
- Proper indexes for performance

### Configuration Options

You can customize the package behavior by modifying the published config file:

- **tables**: Array of table names to add the sort column to
- **sort_column_name**: The column name for sorting (default: 'sort_order')
- **sort**: Default sort direction ('asc' or 'desc')

## Available Methods

The `SortOrder` trait provides several useful methods:

- `switchSortOrder($targetModel)`: Switch the sort order between two models
- `changeSortOrder($newPosition)`: Change the sort order to a specific position
- `setSortColumn($column)`: Set the sort column name (automatically called from config)

## Available Actions

- `UpStepAction`: Move the record up in the sort order
- `DownStepAction`: Move the record down in the sort order

Both actions automatically handle edge cases and maintain data integrity.

## Important Notes

- The database column created is named `sort_order` (NOT NULL, default: 0)
- Existing records will be automatically initialized with `sort_order = 0` when first accessed
- The package handles sort order management automatically when using the Up/Down actions
- Make sure to set `->defaultSort('sort_order', 'asc')` on your table for proper initial ordering

## Troubleshooting

### Common Issues

1. **Column not found error**: Ensure you've run the migrations after publishing them
2. **Sort actions not appearing**: Make sure you've added both `DownStepAction::make()` and `UpStepAction::make()` to your table actions
3. **Records not sorting**: Verify that you've set the default sort on your table: `->defaultSort('sort_order', 'asc')`

### Laravel 12 Compatibility

This package is fully compatible with Laravel 12.x. If you encounter any issues, please check:

- PHP version is 8.2 or higher
- FilamentPHP version is 3.x
- All dependencies are up to date

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
