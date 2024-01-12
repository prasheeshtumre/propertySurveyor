<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRepositoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_repository', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gis_id', 255);
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('residential_type');
            $table->unsignedBigInteger('residential_sub_type');
            $table->string('website_link', 200)->nullable();
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
        Schema::dropIfExists('project_repository');
    }
}
