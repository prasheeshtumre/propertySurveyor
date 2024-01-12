<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockTowerRepositoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_tower_repository', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gis_id', 255);
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('residential_type');
            $table->unsignedBigInteger('residential_sub_type');
            $table->unsignedBigInteger('block_tower_id')->nullable();
            $table->string('youtube_link', 500)->nullable();
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
        Schema::dropIfExists('block_tower_repository');
    }
}
