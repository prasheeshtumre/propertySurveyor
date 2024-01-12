<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSqftAreaTypeToUnitPriceLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unit_price_logs', function (Blueprint $table) {
           $table->unsignedBigInteger('sqft')->default(0);
           $table->tinyInteger('area_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_price_logs', function (Blueprint $table) {
            //
        });
    }
}
