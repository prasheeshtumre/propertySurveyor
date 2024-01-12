<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\AmenityOption;

class ProjectStatusFilterField extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $table = 'project_status_filter_fields';
}