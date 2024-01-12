<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Tower;
use App\Models\AmenityOption;

class ConstructionStage extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $table = 'construction_stages';


    public function towers()
    {
        return $this->hasMany(Tower::class, 'construction_stage', 'id');
    }

}