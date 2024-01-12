<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compliances;

class CompliancesImages extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'compliances_images';

    public function compliance()
    {
        return $this->belongsTo(Compliances::class, 'comp_id', 'id');
    }
}
