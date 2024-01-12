<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyAmenity;

class AmenityOption extends Model
{
    protected $guarded = [];
    public function propertyAmenities()
    {
        return $this->belongsToMany(PropertyAmenity::class, 'property_amenity_amenity_option', 'amenity_option_id', 'property_amenity_id')->withPivot('id', 'property_id');
    }

    public function amenity()
    {
        return $this->belongsTo(PropertyAmenity::class);
    }
}
