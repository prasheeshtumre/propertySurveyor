<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class UnitAmenityOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Private',
                'parent_id' => 1,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 2,
                'name' => 'Shared',
                'parent_id' => 1,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 3,
                'name' => 'Not Available',
                'parent_id' => 1,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 4,
                'name' => 'Available',
                'parent_id' => 2,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 5,
                'name' => 'Not Available',
                'parent_id' => 2,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 6,
                'name' => 'Available',
                'parent_id' => 3,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 7,
                'name' => 'Not Available',
                'parent_id' => 3,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 8,
                'name' => 'Available',
                'parent_id' => 4,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 9,
                'name' => 'Not Available',
                'parent_id' => 4,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 10,
                'name' => 'Available',
                'parent_id' => 5,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 11,
                'name' => 'Not Available',
                'parent_id' => 5,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 12,
                'name' => 'Available',
                'parent_id' => 6,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 13,
                'name' => 'Not Available',
                'parent_id' => 6,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 14,
                'name' => 'Available',
                'parent_id' => 7,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
            [
                'id' => 15,
                'name' => 'Not Available',
                'parent_id' => 7,
                'image_name' => 'NULL',
                'icon_path' => '',
                'status' => 1,
                'created_at' => '2023-07-26 11:58:09',
                'updated_at' => '2023-07-26 11:58:09',
            ],
        ];

        DB::table('unit_amenity_options')->insert($data);
    }
}
