<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gis_id');
            $table->integer('cat_id');
            $table->integer('residential_type');
            $table->integer('residential_sub_type');
            $table->integer('no_of_blocks');
            $table->string('block_name')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0->Inactive, 1->active');
            $table->integer('status_level')->default(0)->comment('1->towers added, 2->no towers added');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->index(['gis_id', 'cat_id', 'residential_type', 'residential_sub_type']);
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
