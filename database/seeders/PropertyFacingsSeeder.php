<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PropertyFacingsSeeder extends Seeder
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
                'name' => 'North',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 2,
                'name' => 'South',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 3,
                'name' => 'East',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 4,
                'name' => 'West',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 5,
                'name' => 'North-East',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 6,
                'name' => 'North-West',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 7,
                'name' => 'South-East',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
            [
                'id' => 8,
                'name' => 'South-West',
                'status' => 1,
                'created_at' => '2023-07-19 15:04:33',
                'updated_at' => '2023-07-19 15:04:33',
            ],
        ];

        DB::table('property_facings')->insert($data);
    }
}
