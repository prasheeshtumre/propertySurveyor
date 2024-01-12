<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('sort_by')->default(1);
            $table->string('icon_path', 255)->nullable();
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
        Schema::dropIfExists('floor_types');
    }
}
