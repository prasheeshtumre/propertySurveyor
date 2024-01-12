<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array(
                "id" => "7",
                "cat_name" => "Apartment",
                "parent_id" => "2",
                "blade_slug" => NULL,
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-05-10 00:18:50",
                "updated_at" => "2023-05-10 00:18:50"
            ),
            array(
                "id" => "8",
                "cat_name" => "Independent House/Villa",
                "parent_id" => "2",
                "blade_slug" => NULL,
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-05-10 00:19:33",
                "updated_at" => "2023-05-10 00:19:33"
            ),
            array(
                "id" => "9",
                "cat_name" => "Stand-alone Apartment",
                "parent_id" => "7",
                "blade_slug" => "primary_data.residential_apartment_stand_alone",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-05-10 00:20:03",
                "updated_at" => "2023-05-10 00:20:03"
            ),
            array(
                "id" => "11",
                "cat_name" => "Individual House",
                "parent_id" => "8",
                "blade_slug" => "primary_data.residential_independent_house_individual_house",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-05-10 00:20:46",
                "updated_at" => "2023-05-10 00:20:46"
            ),
            array(
                "id" => "2",
                "cat_name" => "Residential",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.residential",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "1",
                "cat_name" => "Commercial",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.commercial",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "3",
                "cat_name" => "Multi Unit",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.multi_unit",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "5",
                "cat_name" => "Under Construction",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.under_construction",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "6",
                "cat_name" => "Demolished",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.demolished",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "4",
                "cat_name" => "Plot/Land",
                "parent_id" => NULL,
                "blade_slug" => "primary_data.plot_land",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-03-18 06:36:57",
                "updated_at" => "2023-03-18 06:36:57"
            ),
            array(
                "id" => "13",
                "cat_name" => "Open Plot/Land",
                "parent_id" => "4",
                "blade_slug" => "primary_data.plot_land_open_plot",
                "secondary_blade_slug" => NULL,
                "created_at" => "2023-05-10 00:30:22",
                "updated_at" => "2023-05-10 00:30:22"
            ),
            array(
                "id" => "10",
                "cat_name" => "Gated Community",
                "parent_id" => "7",
                "blade_slug" => "primary_data.residential_apartment_gated_community",
                "secondary_blade_slug" => "secondary_data.residential_apartment_gated_community",
                "created_at" => "2023-05-10 00:20:24",
                "updated_at" => "2023-05-10 00:20:24"
            ),
            array(
                "id" => "12",
                "cat_name" => "Gated Community",
                "parent_id" => "8",
                "blade_slug" => "primary_data.residential_independent_house_gated_community",
                "secondary_blade_slug" => "secondary_data.residential_apartment_gated_community",
                "created_at" => "2023-05-10 00:22:04",
                "updated_at" => "2023-05-10 00:22:04"
            ),
            array(
                "id" => "14",
                "cat_name" => "Gated Community",
                "parent_id" => "4",
                "blade_slug" => "primary_data.plot_land_gated_community",
                "secondary_blade_slug" => "secondary_data.residential_apartment_gated_community",
                "created_at" => "2023-05-10 00:30:41",
                "updated_at" => "2023-05-10 00:30:41"
            ),
            array(
                "id" => "15",
                "cat_name" => "Commercial Building",
                "parent_id" => "1",
                "blade_slug" => "primary_data.commercial_building",
                "secondary_blade_slug" => NULL,
                "created_at" => NULL,
                "updated_at" => NULL
            ),
            array(
                "id" => "16",
                "cat_name" => "Commercial Tower",
                "parent_id" => "1",
                "blade_slug" => "primary_data.commercial_tower",
                "secondary_blade_slug" => "commercial_tower_gated_community.commercial_tower_gated_community",
                "created_at" => NULL,
                "updated_at" => "2023-10-31 11:24:51"
            ),
            array(
                "id" => "17",
                "cat_name" => "Semi-Gated Community",
                "parent_id" => "7",
                "blade_slug" => "primary_data.residential_apartment_semi_gated_community",
                "secondary_blade_slug" => "",
                "created_at" => "2023-12-29 12:36:01",
                "updated_at" => "2023-12-29 12:36:01"
            )
        );

        foreach ($categories as $category) {
            $country = new Category;
            $country->id = $category['id'];
            $country->cat_name = $category['cat_name'];
            $country->parent_id = $category['parent_id'];
            $country->blade_slug = $category['blade_slug'];
            $country->secondary_blade_slug = $category['secondary_blade_slug'];
            $country->save();
        }
    }
}
