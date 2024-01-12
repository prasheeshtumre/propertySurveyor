<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('properties', function (Blueprint $table) {
            $table->string('no_of_floors')->nullable();
            $table->unsignedBigInteger('residential_type')->nullable() ;
            $table->unsignedBigInteger('residential_sub_type')->nullable() ;
            $table->string('project_name')->nullable();
            $table->unsignedBigInteger('builder_id')->nullable();
            $table->string('plot_land_type')->nullable();
            $table->string('plot_name')->nullable();
            $table->string('boundary_wall_availability')->nullable();
            $table->string('any_legal_litigation_board')->nullable();
            $table->string('ownership_claim_board')->nullable();
            $table->string('bank_auction_board')->nullable();
            $table->string('for_sale_board')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('no_of_floors');
            $table->unsignedBigInteger('residential_type') ;
            $table->unsignedBigInteger('residential_sub_type') ;
            $table->string('project_name');
            $table->unsignedBigInteger('builder_id');
            $table->string('plot_land_type');
            $table->string('plot_name');
            $table->string('boundary_wall_availability');
            $table->string('any_legal_litigation_board');
            $table->string('ownership_claim_board');
            $table->string('bank_auction_board');
            $table->string('for_sale_board');
        });
    }
}
