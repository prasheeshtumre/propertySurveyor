<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class UnitAmenityOptionValue extends Model
{
    protected $fillable = ['unit_id', 'amenity_id', 'amenity_option_id', 'amenity_option_value_id', 'value'];

    public function amenity()
    {
        return $this->belongsTo(UnitAmenity::class, 'amenity_id', 'id');
    }

    public function unit_amenity_option()
    {
        return $this->belongsTo(UnitAmenityOption::class, 'amenity_option_id', 'id');
    }

}
