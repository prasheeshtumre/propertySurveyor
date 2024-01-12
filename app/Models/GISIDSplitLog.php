<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GISIDSplitLog extends Model
{
    use HasFactory;

    protected $table = 'gis_id_split_logs';

    protected $fillable = ['gis_id', 'split_gis_id', 'created_by'];

}
