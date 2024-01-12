<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('gis_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->string('house_no')->nullable();
            $table->string('plot_no')->nullable();
            $table->string('street_details')->nullable();
            $table->string('locality_name')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('no_of_floors')->nullable();
            $table->unsignedBigInteger('residential_type')->nullable();
            $table->unsignedBigInteger('residential_sub_type')->nullable();
            $table->string('project_name')->nullable();
            $table->unsignedBigInteger('builder_id')->nullable();
            $table->string('plot_land_type')->nullable();
            $table->string('plot_name')->nullable();
            $table->string('boundary_wall_availability')->nullable();
            $table->string('any_legal_litigation_board')->nullable();
            $table->string('ownership_claim_board')->nullable();
            $table->string('bank_auction_board')->nullable();
            $table->string('for_sale_board')->nullable();
            $table->unsignedBigInteger('under_construction_type')->nullable();
            $table->unsignedBigInteger('up_for_sale')->default(0);
            $table->unsignedBigInteger('up_for_rent')->default(0);
            $table->string('building_name')->nullable();
            $table->unsignedBigInteger('status_level')->default(0);
            $table->unsignedBigInteger('cat_gc')->default(0);
            $table->unsignedBigInteger('year_of_construction')->nullable();
            $table->unsignedBigInteger('project_status')->default(0);
            $table->unsignedBigInteger('under_construction')->default(0);
            $table->date('slab_completed')->nullable();
            $table->date('project_expected_date_of_start')->nullable();
            $table->date('project_expected_date_of_completion')->nullable();
            $table->date('project_date_of_completion')->nullable();
            $table->string('website_address')->nullable();
            $table->string('club_house_details')->nullable();
            $table->unsignedBigInteger('floors_merge_status')->default(0);
            $table->unsignedBigInteger('units_merge_status')->default(0);
            $table->string('pincode', 10)->nullable();
            $table->string('price', 200)->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('splits')->default(0);
            $table->string('parent_split_id')->nullable();
            $table->unsignedBigInteger('merges')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
