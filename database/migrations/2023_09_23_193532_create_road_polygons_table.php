<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadPolygonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_polygons', function (Blueprint $table) {
            $table->id();
            $table->geometry('geom')->nullable();
            $table->bigInteger('objectid');
            $table->string('wkb_geomet', 50)->nullable();
            $table->bigInteger('ascii_id');
            $table->double('i_area', 15, 8);
            $table->double('i_perim', 15, 8);
            $table->string('data_sourc', 20)->nullable();
            $table->string('sub_class', 50)->nullable();
            $table->string('road_name', 100)->nullable();
            $table->string('gisid', 20)->nullable();
            $table->string('remarks', 50)->nullable();
            $table->double('shape_leng', 15, 8);
            $table->double('shape_area', 15, 8);
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
        Schema::dropIfExists('road_polygons');
    }
}
