<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusFilterFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_status_filter_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['project', 'tower', 'floor'])->nullable();
            $table->enum('tower_type', ['1', '2'])->nullable()->comment('1->Towers, 2->Units');
            $table->unsignedBigInteger('construction_stage_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->enum('field_type', ['text', 'number', 'date', 'dropdown'])->nullable();
            $table->string('field_title', 255)->nullable();
            $table->string('model', 60)->nullable();
            $table->enum('data_attr_type', ['project', 'tower', 'floor'])->nullable()->comment('html element data attribute');
            $table->string('class_name', 60)->nullable();
            $table->string('name_attribute', 60)->nullable();
            $table->unsignedBigInteger('level')->nullable();
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
        Schema::dropIfExists('project_status_filter_fields');
    }
}
