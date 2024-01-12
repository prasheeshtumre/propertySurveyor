<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnderConstructionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('under_construction', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->enum('status', ['0', '1'])->default('1')->comment('0->Inactive, 1->Active');
            $table->unsignedInteger('sort_by')->default(1);
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
        Schema::dropIfExists('under_construction');
    }
}
