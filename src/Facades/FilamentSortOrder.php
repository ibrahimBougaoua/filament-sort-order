<?php

namespace IbrahimBougaoua\FilamentSortOrder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbrahimBougaoua\FilamentSortOrder\FilamentSortOrder
 */
class FilamentSortOrder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \IbrahimBougaoua\FilamentSortOrder\FilamentSortOrder::class;
    }
}
