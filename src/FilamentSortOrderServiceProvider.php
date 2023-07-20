<?php

namespace IbrahimBougaoua\FilamentSortOrder;

use Filament\PluginServiceProvider;
use IbrahimBougaoua\FilamentSortOrder\Commands\FilamentSortOrderCommand;
use Spatie\LaravelPackageTools\Package;

class FilamentSortOrderServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-sort-order')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_sort_order_table')
            ->hasCommand(FilamentSortOrderCommand::class);
    }
}
