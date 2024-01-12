<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Tower;

class Block extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'blocks';

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }

    public function towers()
    {
        return $this->hasMany(Tower::class);
    }
}
