<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePropertyFloorMapAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_floor_map', function($table) {
            $table->dropColumn(['property_cat_id','unit_type','floor_unit_cat_id','floor_unit_sub_cat_id','brand_id','person_name', 'mobile']);
        });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_floor_map', function($table) {
            $table->unsignedBigInteger('property_cat_id');
            $table->unsignedBigInteger('unit_type');
            $table->unsignedBigInteger('floor_unit_cat_id');
            $table->unsignedBigInteger('floor_unit_sub_cat_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('person_name');
            $table->unsignedBigInteger('mobile');
        });
    }
}
