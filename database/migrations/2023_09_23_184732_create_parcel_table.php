<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel', function (Blueprint $table) {
            $table->id();
            $table->geometry('geom'); // Use the 'geometry' data type for the 'geom' column
            $table->bigInteger('objectid');
            $table->string('h_no', 5)->nullable();
            $table->string('plot_no', 5)->nullable();
            $table->string('colony_nam', 5)->nullable();
            $table->string('street', 5)->nullable();
            $table->string('remarks_1', 50)->nullable();
            $table->string('owner', 50)->nullable();
            $table->string('contact', 50)->nullable();
            $table->string('uniq_id', 10)->nullable();
            $table->string('pincode', 50)->nullable();
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
        Schema::dropIfExists('parcel');
    }
}