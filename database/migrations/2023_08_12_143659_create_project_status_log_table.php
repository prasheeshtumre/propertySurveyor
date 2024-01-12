<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_status_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('project_status');
            $table->date('project_expected_date_of_start')->nullable();
            $table->date('project_expected_date_of_completion')->nullable();
            $table->date('project_date_of_completion')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->index('property_id');
            $table->index('project_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_status_log');
    }
}
