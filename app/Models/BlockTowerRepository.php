<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlockTowerRepositoryImages;
use App\Models\OtherCompliances;
use App\Models\Block;
use App\Models\Tower;

class BlockTowerRepository extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'block_tower_repository';

    public function media_files()
    {
        return $this->hasMany(BlockTowerRepositoryImages::class, 'block_tower_id', 'id');
    }

    public function other_files()
    {
        return $this->hasMany(OtherCompliances::class, 'repository_id', 'id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_tower_id', 'id');
    }
    public function towers()
    {
        return $this->belongsTo(Tower::class, 'block_tower_id', 'id');
    }
}
