<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        $sortColumn = config( 'filament-sort-order.sort_column_name', 'sort_order' );

        foreach ( config( 'filament-sort-order.tables' ) as $key => $table ) {

            Schema::table( $table, function ( Blueprint $table ) use ( $sortColumn ) {
                $table->integer( $sortColumn )->unsigned()->default( 0 );
            } );

            DB::table( $table )
                ->update( [ $sortColumn => DB::raw( 'id' ) ] );

        }
    }
    
};
