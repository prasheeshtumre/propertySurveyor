<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    
    public function children()
    {
        return $this->hasMany(SubCategory::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(SubCategory::class, 'parent_id');
    }
    
    // $sub_category->children; // sub-categories collection
    
    // $sub_category->parent; // parent instance
}

