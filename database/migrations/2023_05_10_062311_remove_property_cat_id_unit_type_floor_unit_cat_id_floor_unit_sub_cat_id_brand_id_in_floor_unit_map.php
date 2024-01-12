<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePropertyCatIdUnitTypeFloorUnitCatIdFloorUnitSubCatIdBrandIdInFloorUnitMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            // $table->dropColumn(['property_cat_id','unit_type','floor_unit_cat_id','floor_unit_sub_cat_id','brand_id']);
            $table->dropColumn(['person_name','mobile','merge_parent_unit_id']);
        });
        // Schema::table('property_floor_map', function($table) {
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            //
        });
    }
}
