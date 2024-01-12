<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorUnitCategory extends Model
{
    use HasFactory;
    
    public function children()
    {
        return $this->hasMany(FloorUnitCategory::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(FloorUnitCategory::class, 'parent_id');
    }
}
