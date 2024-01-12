<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tower;
use App\Models\PriceTrend;

class ProjectStatus extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'project_status';

    public function tower()
    {
        return $this->hasMany(Tower::class);
    }

    public function price_trends()
    {
        return $this->hasManyThrough(PriceTrend::class, Tower::class);
    }

    // public function towers()
    // {
    //     return $this->hasMany(Tower::class, 'tower_status', 'id');
    // }
}
