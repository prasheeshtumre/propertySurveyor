<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('gis_id', 255);
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('residential_type');
            $table->unsignedBigInteger('residential_sub_type');
            $table->enum('ghmc_radio', ['1', '0']);
            $table->enum('comm_certifi_radio', ['1', '0']);
            $table->string('rear_number', 100)->nullable();
            $table->string('hdma_number', 100)->nullable();
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
        Schema::dropIfExists('compliances');
    }
}
