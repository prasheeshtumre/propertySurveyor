<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Block;
use App\Models\PriceTrend;
use App\Models\ProjectStatus;
use App\Models\ConstructionStage;
use App\Models\Tower;
use App\Models\FloorRangesPerTower;

class TowerLog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tower_status_log';

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }
    public function towerName()
    {
        return $this->belongsTo(Tower::class, 'tower_id', 'id');
    }

    public function towerStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'tower_status', 'id');
    }

    public function constructionStage()
    {
        return $this->belongsTo(ConstructionStage::class, 'construction_stage', 'id');
    }

    public function FloorRangesPerTower()
    {
        return $this->belongsTo(FloorRangesPerTower::class, 'floor_range', 'id');
    }
}
