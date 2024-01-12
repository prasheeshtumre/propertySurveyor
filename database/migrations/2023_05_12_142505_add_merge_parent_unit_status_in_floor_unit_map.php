<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMergeParentUnitStatusInFloorUnitMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('floor_unit_map', function (Blueprint $table) {
            $table->string('merge_parent_unit_status')->nullable()->default(0);
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
            $table->string('merge_parent_unit_status')->nullable()->default(0);
        });
    }
}
