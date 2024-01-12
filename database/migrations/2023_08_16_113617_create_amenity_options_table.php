<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_amenity_id')->unsigned();
            $table->string('name', 100);
            $table->enum('status', ['0', '1'])->default('1')->comment('0->Inactive, 1->Active');
            $table->integer('sort_by')->default(1);
            $table->timestamps();

            $table->foreign('property_amenity_id')
                  ->references('id')
                  ->on('property_amenities')
                  ->onDelete('cascade')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenity_options');
    }
}
