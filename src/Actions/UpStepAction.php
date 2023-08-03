<?php

namespace IbrahimBougaoua\FilamentSortOrder\Actions;

use Closure;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class UpStepAction extends Action
{
    protected string|Closure|null $icon = 'heroicon-o-arrow-up';

    public static function make(?string $name = 'up'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        $this->requiresConfirmation();
        $this->modalWidth = 'sm';
        $this->action($this->handle(...));
    }

    protected function handle(Model $record, array $data)
    {
        $sort_order = $record->switchSortOrder('previous', $record, $record->sort_order, $record->sort_order);
        $record->sort_order = $sort_order;
        $record->save();
    }
}
