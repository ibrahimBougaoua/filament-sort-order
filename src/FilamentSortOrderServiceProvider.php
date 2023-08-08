<?php

namespace IbrahimBougaoua\FilamentSortOrder;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSortOrderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-sort-order')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_sort_order_table');
    }
}
