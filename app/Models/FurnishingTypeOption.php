<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;


class FurnishingTypeOption extends Model
{
   
    protected $fillable = ['name', 'furnishing_id','input_type','status','sort_by'];


    
}
