<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentedSoldColumnsToFloorUnitMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            $table->tinyInteger('rented')->after('up_for_rent')->default(0);
            $table->tinyInteger('sold')->after('rented')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            //
        });
    }
}
