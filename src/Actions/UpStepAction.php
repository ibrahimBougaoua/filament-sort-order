<?php

namespace IbrahimBougaoua\FilamentSortOrder\Actions;

use Closure;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class UpStepAction extends Action
{
    public static function make(?string $name = 'up'): static
    {
        $instance = parent::make($name);
        $instance->icon('heroicon-o-arrow-up');
        return $instance;
    }

    protected function setUp(): void
    {
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
