<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GisIDMapping extends Model
{
    use HasFactory;

    protected $table = 'gis_id_mappings';
    protected $fillable = [
       'gis_id',
       'merge_id',
       'created_by'
    ];
    // protected $primaryKey = 'gis_id';

    public function property()
    {
        return $this->belongsTo(Property::class, 'gis_id', 'gis_id');
    }
}
