<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyAmenity;

class propertyAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_amenity = PropertyAmenity::create([
            'id' => 10,
            'property_category_id' => 16,
            'name' => 'Amenities',
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
