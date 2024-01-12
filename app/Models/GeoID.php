<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class GeoID extends Model
{
    use HasFactory;

    protected $table = 'geo_ids';
    protected $fillable = [
        'gis_id',
        'pincode_id'
    ];

    public function property()
    {
        return $this->hasOne(Property::class, 'gis_id', 'gis_id');
    }

    public function pincode()
    {
        return $this->hasOne(Pincode::class, 'pincode', 'pincode_id');
    }
}
