<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tower;
use App\Models\PriceTrend;
use App\Models\ProjectStatus;

class ProjectStatusLog extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'project_status_log';

    public function tower()
    {
        return $this->hasMany(Tower::class);
    }

    public function price_trends()
    {
        return $this->hasManyThrough(PriceTrend::class, Tower::class);
    }
    
    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status', 'id');
    }

    // public function towers()
    // {
    //     return $this->hasMany(Tower::class, 'tower_status', 'id');
    // }
}
