<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockTowerRepositoryImages extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'block_tower_repository_images';
}
