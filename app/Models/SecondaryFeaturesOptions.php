<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SecondaryFeatures;

class SecondaryFeaturesOptions extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'secondary_features_options';
    
    public function secondary_feature()
    {
        return $this->belongsTo(SecondaryFeatures::class, 'secondary_features_id', 'id');
    }
    
}
