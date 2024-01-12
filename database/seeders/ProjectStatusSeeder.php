<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProjectStatusSeeder extends Seeder
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
                'name' => 'Grounded',
                'status' => 1,
                'sort_by' => 1,
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'id' => 2,
                'name' => 'Under Construction',
                'status' => 1,
                'sort_by' => 1,
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'id' => 3,
                'name' => 'Completed',
                'status' => 1,
                'sort_by' => 1,
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'id' => 4,
                'name' => 'Exterior works under progress',
                'status' => 1,
                'sort_by' => 3,
                'created_at' => '2023-05-24 17:46:08',
                'updated_at' => '2023-05-24 17:46:08',
            ],
        ];

        DB::table('project_status')->insert($data);
        
    }
}
