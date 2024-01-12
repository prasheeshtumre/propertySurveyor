<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'ward_id';
    protected $table = 'ward_mst';
}
