<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\Models\GeoID;

class GISIDsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function collection(Collection $rows)
    {
        $index = 0; // Initialize the index or increment as needed

        $data = $rows->toArray();
        $gisIds = array_column($data, 'gis_id');
        
        Validator::make($rows->toArray(), [
            '*.gis_id' => [
                'required',
                function ($attribute, $value, $fail) use (&$index) {
                    $existingCount = count(GeoID::where('gis_id', $value)->get());
        
                    if ($existingCount > 0) {
                        $index++; // Increment the index
                        $fail("The GIS-ID $value already exits at row $index.");
                    }
                },
            ],
            '*.pincode' => 'required|numeric|digits:6',
        ],
        [
            '*.pincode.required' => 'At row :attribute field must not be empty.',
            '*.pincode.digits' => 'At row :attribute must be 6 digit number.',
        ])->validate();
    }
  
}
