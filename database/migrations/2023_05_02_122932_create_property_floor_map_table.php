<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyFloorMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_floor_map', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('property_id')->nullable();
                $table->unsignedBigInteger('floor_no')->nullable();
                $table->string('floor_name')->nullable();
                $table->unsignedBigInteger('units')->default(0);
                $table->unsignedBigInteger('merge_parent_floor_id')->nullable();
                $table->unsignedInteger('tower_id')->default(0);
                $table->string('merge_parent_floor_status')->default('0');
                
                // $table->foreign('property_id')
                //       ->references('id')->on('properties')
                //       ->onDelete('cascade');
                      
                $table->index('property_id');
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
        
        Schema::dropIfExists('property_floor_map');
    }
}
