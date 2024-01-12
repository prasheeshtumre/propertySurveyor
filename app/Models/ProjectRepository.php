<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectRepositoryImages;

class ProjectRepository extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'project_repository';

    public function media_files()
    {
        return $this->hasMany(ProjectRepositoryImages::class, 'repository_id', 'id');
    }

    public function other_files()
    {
        return $this->hasMany(OtherCompliances::class, 'repository_id', 'id');
    }
}
