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
        $sort_order = $record->switchSortOrder('next', $record, $record->sort_order, $record->sort_order);
        $record->sort_order = $sort_order;
        $record->save();
    }
}
