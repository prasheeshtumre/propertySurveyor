<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyAmenity;

class UnitAmenityCategory extends Model
{
    protected $table = "unit_amenity_category";

    public function parent()
    {
        return $this->belongsTo(UnitAmenityCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(UnitAmenityCategory::class, 'parent_id');
    }
}
