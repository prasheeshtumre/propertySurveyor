<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_pincodes');
    }

    public function pincodeCity()
    {
        return $this->belongsTo(CityPincode::class, 'id', 'pincode_id');
    }
}
