<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockTowerRepositoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_tower_repository_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_tower_id');
            $table->string('file_type', 30);
            $table->string('file_path', 200);
            $table->string('file_name', 500);
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
        Schema::dropIfExists('block_tower_repository_images');
    }
}
