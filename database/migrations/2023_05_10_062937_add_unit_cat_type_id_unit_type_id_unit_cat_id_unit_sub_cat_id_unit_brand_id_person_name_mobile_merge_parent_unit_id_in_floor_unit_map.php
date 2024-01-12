<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitCatTypeIdUnitTypeIdUnitCatIdUnitSubCatIdUnitBrandIdPersonNameMobileMergeParentUnitIdInFloorUnitMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_cat_type_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_type_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_cat_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_sub_cat_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_brand_id')->nullable()->default(0);
            $table->unsignedBigInteger('floor_unit_sub_cat_id')->nullable()->default(0);
            $table->string('person_name')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('merge_parent_unit_id')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_cat_type_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_type_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_cat_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_sub_cat_id')->nullable()->default(0);
            $table->unsignedBigInteger('unit_brand_id')->nullable()->default(0);
            $table->unsignedBigInteger('floor_unit_sub_cat_id')->nullable()->default(0);
            $table->string('person_name')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('merge_parent_unit_id')->nullable()->default(0);
        });
    }
}
