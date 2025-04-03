<?php

namespace IbrahimBougaoua\FilamentSortOrder\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait SortOrder
{
    protected string $sortColumn;

    public function __construct()
    {
        $this->sortColumn = config('filament-sort-order.sort_column_name', 'sort_order');
    }

    public static function bootSortOrder(): void
    {
        static::created(function ($model) {
            $model->setSortColumn();
            $model->{$model->sortColumn} = $model->getKey();
            $model->save();
        });

        static::addGlobalScope('sort_order', function (Builder $builder) {
            $model = new static;
            $builder->orderBy($model->sortColumn, config('filament-sort-order.sort', 'asc'));
        });
    }

    public function switchSortOrder($action, Model $model, $sort_order, $value): int
    {
        if ($action === 'next') {
            $model_id = ! $this->getNextModelId($model,
                $sort_order) ? $this->isFirstRecord($model) : $this->getNextModelId($model, $sort_order);
        } else {
            $model_id = ! $this->getPreviousModelId($model,
                $sort_order) ? $this->isLastRecord($model) : $this->getPreviousModelId($model, $sort_order);
        }

        return $this->changeSortOrder($model_id, $value);
    }

    public function changeSortOrder($sort_order, $value): int
    {
        $model = Model::where($this->sortColumn, $sort_order)->first();

        if ($model) {
            $old_sort_order = $model->{$this->sortColumn};
            $model->{$this->sortColumn} = $value;
            $model->save();

            return $old_sort_order;
        }

        return 0;
    }

    public function getNextModelId(Model $model, $sort_order): int
    {
        return $model->where($this->sortColumn, '>', $sort_order)->min($this->sortColumn) ?? 0;
    }

    public function getPreviousModelId(Model $model, $sort_order): int
    {
        return $model->where($this->sortColumn, '<', $sort_order)->max($this->sortColumn) ?? 0;
    }

    public function isFirstRecord(Model $model): int
    {
        $record = $model->orderBy($this->sortColumn, 'asc')->first();

        return $record ? $record->{$this->sortColumn} : 0;
    }

    public function isLastRecord(Model $model): int
    {
        $record = $model->orderBy($this->sortColumn, 'desc')->first();

        return $record ? $record->{$this->sortColumn} : 0;
    }
}
