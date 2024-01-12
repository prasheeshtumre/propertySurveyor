<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompliancesImages;

class Compliances extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'compliances';

    public function images()
    {
        return $this->hasMany(CompliancesImages::class, 'comp_id', 'id');
    }
}
