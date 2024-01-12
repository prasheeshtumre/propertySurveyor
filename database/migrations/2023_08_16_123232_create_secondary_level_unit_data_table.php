<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryLevelUnitDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_level_unit_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('property_cat_id');
            $table->unsignedBigInteger('unit_type_id')->nullable();
            $table->unsignedBigInteger('unit_cat_id')->nullable();
            $table->unsignedBigInteger('unit_sub_cat_id')->nullable();
            $table->tinyInteger('office_type')->nullable();
            $table->bigInteger('rooms')->nullable();
            $table->bigInteger('washrooms')->nullable();
            $table->bigInteger('balconies')->nullable();
            $table->bigInteger('carpet_area')->nullable();
            $table->string('carpet_area_unit')->nullable();
            $table->bigInteger('buildup_area')->nullable();
            $table->string('buildup_area_unit')->nullable();
            $table->bigInteger('super_buildup_area')->nullable();
            $table->string('super_buildup_area_unit')->nullable();
            $table->bigInteger('min_no_of_seats')->nullable();
            $table->bigInteger('max_no_of_seats')->nullable();
            $table->bigInteger('no_of_cabins')->nullable();
            $table->bigInteger('no_of_meeting_rooms')->nullable();
            $table->bigInteger('staircase')->nullable();
            $table->bigInteger('pantry')->nullable();
            $table->bigInteger('property_facing')->nullable();
            $table->bigInteger('conference_room')->nullable();
            $table->bigInteger('reception_area')->nullable();
            $table->bigInteger('furnishing')->nullable();
            $table->bigInteger('furnishing_option')->nullable();
            $table->bigInteger('central_air_conditions')->nullable();
            $table->bigInteger('oxygen_dust')->nullable();
            $table->bigInteger('ups')->nullable();
            $table->bigInteger('lifts')->nullable();
            $table->bigInteger('availability_status')->nullable();
            $table->bigInteger('age_of_property')->nullable();
            $table->date('possesion_by')->nullable();
            $table->string('owners_preference')->nullable();
            $table->tinyInteger('pricing_details_for')->nullable()->comment('1 for sale, 2 for rent');
            $table->bigInteger('ownership')->nullable();
            $table->bigInteger('expected_price')->nullable();
            $table->bigInteger('price_per_sq_ft')->nullable();
            $table->bigInteger('mainteinance')->nullable();
            $table->bigInteger('maintenance_period')->nullable();
            $table->bigInteger('expected_rental')->nullable();
            $table->bigInteger('booking_amount')->nullable();
            $table->bigInteger('annual_due_pay')->nullable();
            $table->bigInteger('membership_charge')->nullable();
            $table->string('remark')->nullable();
            $table->bigInteger('agreement_type')->nullable();
            $table->bigInteger('expected_rent')->nullable();
            $table->string('facility')->nullable();
            $table->bigInteger('maintenance_rent')->nullable();
            $table->bigInteger('booking_amount_rent')->nullable();
            $table->bigInteger('annual_dues_rent')->nullable();
            $table->string('membership_charge_rent')->nullable();
            $table->bigInteger('security_deposit')->nullable();
            $table->bigInteger('agreement_duration')->nullable();
            $table->bigInteger('notice_period')->nullable();
            $table->text('property_feature_suggestion')->nullable();
            $table->bigInteger('enterance_width')->nullable();
            $table->tinyInteger('enterance_width_unit')->nullable();
            $table->bigInteger('ceiling_height')->nullable();
            $table->tinyInteger('ceiling_height_unit')->nullable();
            $table->bigInteger('priavate_washrooms')->nullable();
            $table->bigInteger('shared_washrooms')->nullable();
            $table->tinyInteger('located_near')->nullable();
            $table->tinyInteger('parking_type')->nullable();
            $table->bigInteger('no_of_bathrooms')->nullable();
            $table->bigInteger('plot_area_unit')->nullable();
            $table->text('property_description')->nullable();
            $table->string('previous_use')->nullable();
            $table->string('current_use')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('property_history')->nullable();
            $table->string('development_potential')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->bigInteger('plot_area')->nullable();
            $table->bigInteger('plot_area_units')->nullable();
            $table->bigInteger('plot_length')->nullable();
            $table->bigInteger('plot_breadth')->nullable();
            $table->bigInteger('floors_allowed')->nullable();
            $table->bigInteger('no_of_open_side')->nullable();
            $table->bigInteger('covered_parking')->nullable();
            $table->bigInteger('open_parking')->nullable();
            $table->bigInteger('floor_type')->nullable();
            $table->bigInteger('facing_road_width')->nullable();
            $table->bigInteger('facing_road_width_unit')->nullable();
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
        Schema::dropIfExists('secondary_level_unit_data');
    }
}
