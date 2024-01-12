<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('measurement'); // The numeric measurement value
            $table->unsignedInteger('unit'); // The unit of measurement (e.g., sq.ft)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_measurements');
    }
}
