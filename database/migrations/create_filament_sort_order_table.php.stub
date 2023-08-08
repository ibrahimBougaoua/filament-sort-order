<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table(config('filament-sort-order.table'), function (Blueprint $table) {
            $table->integer('sort_order')->unsigned()->default(0);
        });

        DB::table(config('filament-sort-order.table'))->update(['sort_order' => DB::raw('id')]);
    }
};
