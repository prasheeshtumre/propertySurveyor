<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyBuilderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_builder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('builder_id');
            $table->unsignedBigInteger('property_id');
            $table->timestamps();

            $table->foreign('builder_id')->references('id')->on('builders')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_builder');
    }
}
