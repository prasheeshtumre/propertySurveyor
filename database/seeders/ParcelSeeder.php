<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ParcelSeeder extends Seeder
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
                'id' => 4124,
                'geom' => DB::raw("ST_Transform(ST_AsBinary(E'\\x0106000020847F00000100000001030000000100000005000000401CEBE2BBBA0941D812F2E135783D41C09F1AAF20BA09418073461431783D410086C95405BA094108C58F513F783D4120B7D100A1BA0941302AA9F343783D41401CEBE2BBBA0941D812F2E135783D41'), 4326)"),
                'objectid' => 158885,
                'h_no' => null,
                'plot_no' => null,
                'colony_nam' => null,
                'street' => null,
                'remarks_1' => '8',
                'owner' => null,
                'contact' => null,
                'uniq_id' => 17248,
                'pincode' => '500019',
            ],
            // Add more data rows as needed
        ];

        // Insert data into the database table
        DB::table('parcel')->insert($data);
    }
}
