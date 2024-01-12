<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\AmenityOption;

class PropertyAmenity extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'property_amenities';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->belongsToMany(AmenityOption::class, 'property_amenity_amenity_option', 'property_amenity_id', 'amenity_option_id')
            ->withPivot('id', 'property_id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_amenity_amenity_option', 'property_amenity_id', 'property_id')
            ->withPivot('id');
    }


    public function children()
    {
        return $this->hasMany(AmenityOption::class);
    }
}
