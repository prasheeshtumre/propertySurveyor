<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSqftBasedOnColumnToSecondaryLevelUnitData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secondary_level_unit_data', function (Blueprint $table) {
            $table->tinyInteger('sqft_based_on')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secondary_level_unit_data', function (Blueprint $table) {
            //
        });
    }
}
