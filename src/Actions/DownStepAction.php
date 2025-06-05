<?php

namespace IbrahimBougaoua\FilamentSortOrder\Actions;

use Closure;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class DownStepAction extends Action
{
    protected string|Htmlable|Closure|null $icon = 'heroicon-o-arrow-down';

    public static function make(?string $name = 'down'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        $this->modalWidth = 'sm';
        $this->action($this->handle(...));
    }

    protected function handle(Model $record, array $data)
    {
        // Ensure the sort column is set
        if (method_exists($record, 'setSortColumn')) {
            $record->setSortColumn();
        }
        
        // Initialize sort order if needed
        if (method_exists($record, 'initializeSortOrder')) {
            $record->initializeSortOrder();
        }
        
        $record->switchSortOrder('next', $record);
    }
}
