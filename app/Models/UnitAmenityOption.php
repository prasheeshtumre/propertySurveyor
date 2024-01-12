<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;


class UnitAmenityOption extends Model
{
   
    protected $fillable = ['name', 'status','prent_id'];  


    public function furnished_type_options()
    {
        return $this->hasMany(FurnishingTypeOption::class,'furnishing_id','id');
    }
    
}
