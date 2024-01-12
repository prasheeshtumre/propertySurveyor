<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGeoIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('geo_ids', function (Blueprint $table) {
            // Make sure you have 'use Illuminate\Support\Facades\Schema;' at the top

            $table->bigIncrements('id')->change();
        });
    }

    public function down()
    {
        Schema::table('geo_ids', function (Blueprint $table) {
            $table->bigInteger('id')->change();
        });
    }
}
