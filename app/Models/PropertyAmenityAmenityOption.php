<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\AmenityOption;

class PropertyAmenityAmenityOption extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'property_amenity_amenity_option';

    public function options()
    {
        return $this->belongsToMany(AmenityOption::class, 'property_amenity_amenity_option', 'property_amenity_id', 'amenity_option_id')
            ->withPivot('id', 'property_id');
    }
    
}
