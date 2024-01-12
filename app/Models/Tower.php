<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Block;
use App\Models\PriceTrend;
use App\Models\ProjectStatus;
use App\Models\ConstructionStage;


class Tower extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $table = 'towers';

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function towerStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'tower_status', 'id');
    }
    
    public function constructionStage()
    {
        return $this->belongsTo(ConstructionStage::class, 'construction_stage', 'id');
    }

    public function unit_amenities()
    {
        return $this->hasMany(UnitAmenityOptionValue::class, 'unit_id', 'id')->with('amenity');
    }

}
