<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gis_id');
            $table->integer('cat_id');
            $table->integer('residential_type');
            $table->integer('residential_sub_type');
            $table->unsignedBigInteger('block_id');
            $table->enum('type', ['1', '2'])->comment('1->Towers, 2->Units');
            $table->integer('no_of_towers');
            $table->string('tower_name')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0->Inactive, 1->Active');
            $table->integer('tower_status')->nullable();
            $table->date('tower_expected_date_of_start')->nullable();
            $table->date('tower_expected_date_of_completion')->nullable();
            $table->date('tower_date_of_completion')->nullable();
            $table->integer('construction_stage')->nullable();
            $table->integer('floor_range')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('towers');
    }
}
