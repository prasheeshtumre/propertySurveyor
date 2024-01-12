<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowerStatusLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tower_status_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_status_log_id')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('tower_id')->nullable();
            $table->unsignedBigInteger('tower_status')->nullable();
            $table->date('tower_expected_date_of_start')->nullable();
            $table->date('tower_expected_date_of_completion')->nullable();
            $table->date('tower_date_of_completion')->nullable();
            $table->unsignedBigInteger('construction_stage')->nullable();
            $table->unsignedBigInteger('floor_range')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('tower_status_log');
    }
}
