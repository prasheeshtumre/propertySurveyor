<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyBuilderSubGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_builder_sub_group', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('builder_id')->nullable()->default(0);
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('builder_sub_group_id');
            $table->timestamps();

            // $table->foreign('builder_id')->references('id')->on('builders')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('builder_sub_group_id')->references('id')->on('builder_sub_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_builder_sub_group');
    }
}
