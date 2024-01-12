<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others_compliances', function (Blueprint $table) {
            $table->id();
            $table->enum('form_id', ['1', '2'])->comment('1-Project Repository,2-Block/Tower Repository');
            $table->unsignedBigInteger('repository_id');
            $table->string('name', 200);
            $table->string('image', 500);
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
        Schema::dropIfExists('others_compliances');
    }
}
