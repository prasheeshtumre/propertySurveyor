<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyBuilder extends Model
{
    use HasFactory;

    protected $table = 'property_builders';

    // protected $guarded = [];
    protected $fillable = ['builder_id', 'property_id'];
}
