<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SecondaryFeaturesOptions;
use App\Models\Ammenitity;

class SecondaryFeatures extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'secondary_features';
    
    // public function options()
    // {
    //     return $this->hasMany(SecondaryFeaturesOptions::class, 'id', 'secondary_features_id');
    // }
    
    public function options()
    {
        return $this->hasMany(SecondaryFeaturesOptions::class);
    }

    public function get_options()
    {
        return $this->hasMany(Ammenitity::class);
    }


}
