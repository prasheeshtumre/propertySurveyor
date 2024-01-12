<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitals extends Model
{
    use HasFactory;
    protected $guarded = [];   
   // protected $primaryKey = 'app_id';
    protected $table = 'hospitals';
}
