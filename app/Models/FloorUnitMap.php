<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Property;
use App\Models\SecondaryUnitLevelData;

class FloorUnitMap extends Model
{
    use HasFactory;

    protected $table = 'floor_unit_map';
    protected $guarded = [];

    public function GetCategoryName()
    {
        return $this->belongsTo('App\Models\Category', 'foreign_key', 'other_key');
    }

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }

    public function secondary_unit_data()
    {
        return $this->hasOne(SecondaryUnitLevelData::class, 'unit_id', 'id');
    }

    public function scopeFilteredUnits($query)
    {
        return $query->where('up_for_sale', 1)->whereDate('updated_at', '>=', now()->subDays(30));
    }

    public function property_floor_map()
    {
        return $this->belongsTo(PropertyFloorMap::class, 'floor_id', 'id');
    }

    public function unit_amenities()
    {
        return $this->hasMany(UnitAmenityOptionValue::class, 'unit_id', 'id')
            ->with('amenity')
            ->with('unit_amenity_option');
    }

    // public function amenities()
    // {
    //     return $this->hasMany(UnitAmenityOptionValue::class, 'unit_id', 'id')
    //         ->with('amenity');
    // }

    public function categoryName()
    {
        return $this->belongsTo(FloorUnitCategory::class, 'unit_cat_id', 'id');
    }
}
