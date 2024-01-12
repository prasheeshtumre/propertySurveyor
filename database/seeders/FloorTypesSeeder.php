<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FloorTypesSeeder extends Seeder
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
                'name' => 'Cement',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => NULL,
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Marble',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Marble.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Concrete',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Concrete.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Polished Concrete',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1PolihedConcrete.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Granite',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Granite.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Ceramic',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Ceramic.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Mosaic',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Mosaic.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Stone',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Stone.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Vinyl',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Vinyl.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Wood',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Wood.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Vitrified',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/GroupVitrified.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Spartex',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/GroupSpartex.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'IPS Finish',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/IPS Finish.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
            [
                'name' => 'Others',	
                'status' => 1,	
                'sort_by' => 1,	
                'icon_path' => 'images/Layer_1Others.svg',
                'created_at' => '2023-05-24 17:46:00',
                'updated_at' => '2023-05-24 17:46:00',
            ],
        ];
        
        DB::table('floor_types')->insert($data);
    }
}
