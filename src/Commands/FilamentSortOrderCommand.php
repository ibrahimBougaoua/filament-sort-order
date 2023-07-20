<?php

namespace IbrahimBougaoua\FilamentSortOrder\Commands;

use Illuminate\Console\Command;

class FilamentSortOrderCommand extends Command
{
    public $signature = 'filament-sort-order';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
