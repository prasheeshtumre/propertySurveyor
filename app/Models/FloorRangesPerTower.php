<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\AmenityOption;

class FloorRangesPerTower extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $table = 'floor_ranges_per_tower';
}