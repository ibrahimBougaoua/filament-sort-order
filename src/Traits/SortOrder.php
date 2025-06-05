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

    public function setSortColumn(): void
    {
        $this->sortColumn = config('filament-sort-order.sort_column_name', 'sort_order');
    }

    public static function bootSortOrder(): void
    {
        static::created(function ($model) {
            $model->setSortColumn();
            $sortColumn = $model->sortColumn;
            $model->{$sortColumn} = $model->getKey();
            $model->save();
        });

        static::addGlobalScope('sort_order', function (Builder $builder) {
            $model = new static;
            $model->setSortColumn();
            $builder->orderBy($model->sortColumn, config('filament-sort-order.sort', 'asc'));
        });
    }

        public function getPreviousModelId($model, $sortValue)
    {
        return static::where($this->sortColumn, '<', $sortValue)
            ->orderBy($this->sortColumn, 'desc')
            ->first();
    }

    public function getNextModelId($model, $sortValue)
    {
        return static::where($this->sortColumn, '>', $sortValue)
            ->orderBy($this->sortColumn, 'asc')
            ->first();
    }

    public function switchSortOrder(string $direction, $model, $sortColumnName = null, $sortValue = null)
    {
        // Ensure sort column is set
        if (!isset($this->sortColumn)) {
            $this->setSortColumn();
        }
        
        $sortColumnName = $sortColumnName ?? $this->sortColumn;
        $sortValue = $sortValue ?? $model->{$sortColumnName} ?? 0;

        if ($direction === 'previous') {
            $previousModel = $this->getPreviousModelId($model, $sortValue);
            if ($previousModel) {
                $this->swapSortValues($model, $previousModel, $sortColumnName);
            }
        } else {
            $nextModel = $this->getNextModelId($model, $sortValue);
            if ($nextModel) {
                $this->swapSortValues($model, $nextModel, $sortColumnName);
            }
        }
    }

    private function swapSortValues($model1, $model2, $sortColumnName)
    {
        $tempValue = $model1->{$sortColumnName};
        $model1->{$sortColumnName} = $model2->{$sortColumnName};
        $model2->{$sortColumnName} = $tempValue;

        $model1->save();
        $model2->save();
    }



    public function changeSortOrder($sort_order, $value): int
    {
        $model = static::where($this->sortColumn, $sort_order)->first();

        if ($model) {
            $old_sort_order = $model->{$this->sortColumn};
            $model->{$this->sortColumn} = $value;
            $model->save();

            return $old_sort_order;
        }

        return 0;
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

    /**
     * Initialize sort order for existing records that have sort_order = 0
     */
    public function initializeSortOrder(): void
    {
        if (!isset($this->sortColumn)) {
            $this->setSortColumn();
        }

        // Find all records with sort_order = 0 (uninitialized)
        $uninitializedRecords = static::where($this->sortColumn, 0)->orderBy('id', 'asc')->get();
        
        if ($uninitializedRecords->count() > 0) {
            foreach ($uninitializedRecords as $index => $record) {
                $newSortValue = $record->id;
                $record->{$this->sortColumn} = $newSortValue;
                $record->save();
            }
        }
    }

    /**
     * Initialize sort order for all records in the model
     */
    public static function initializeAllSortOrders(): void
    {
        $instance = new static();
        $instance->initializeSortOrder();
    }
}
