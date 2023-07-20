<?php

namespace IbrahimBougaoua\FilamentSortOrder\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait SortOrder {

    public static function bootSortOrder() : void
    {
        static::creating(function ($model) {
            $model->sort_order = $model->count() + 1;
        });

        static::addGlobalScope('sort_order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function switchSortOrder($action = "next",Model $model,$sort_order,$value) : int
    {
        if($action === "next")
            $model_id = ! $this->getNextModelId($model,$sort_order) ? $this->isFirstRecord($model) : $this->getNextModelId($model,$sort_order);
        else
            $model_id = ! $this->getPreviousModelId($model,$sort_order) ? $this->isLastRecord($model) : $this->getPreviousModelId($model,$sort_order);

        return $this->changeSortOrder($model_id,$value);
    }

    public function changeSortOrder($sort_order,$value) : int
    {
        $model = Model::where('sort_order', $sort_order)->first();

        $old_sort_order = $model->sort_order;

        if( $model )
        {
            $model->sort_order = $value;
            $model->save();
        }

        return $old_sort_order;
    }

    public function getNextModelId(Model $model,$sort_order) : int
    {
        return $model->where('sort_order', '>', $sort_order)->min('sort_order') ?? 0;
    }

    public function getPreviousModelId(Model $model,$sort_order) : int
    {
        return $model->where('sort_order', '<', $sort_order)->max('sort_order') ?? 0;
    }

    public function isFirstRecord(Model $model) : int
    {
        $model = $model->orderBy('sort_order', 'asc')->first();

        return $model ? $model->sort_order : 0;
    }

    public function isLastRecord(Model $model) : int
    {
        $model = $model->orderBy('sort_order', 'desc')->first();

        return $model ? $model->sort_order : 0;
    }
}