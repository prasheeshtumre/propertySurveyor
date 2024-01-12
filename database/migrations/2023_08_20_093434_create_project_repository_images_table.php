<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRepositoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_repository_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repository_id');
            $table->string('file_type', 30);
            $table->string('file_path', 200);
            $table->string('file_name', 500);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            // $table->foreign('repository_id')->references('id')->on('project_repository');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_repository_images');
    }
}
