<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;


class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_by', 'parent_id', 'blade_slug', 'secondary_blade_slug'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function posts()
    {
        return $this->hasMany(Property::class);
    }

    public function propert()
    {
        return $this->hasMany(Property::class, 'id', 'cat_id');
    }
    public function GetPropertyName()
    {
        return $this->belongsTo('App\Models\Property', 'plot_land_type', 'id');
    }
    
    // public function children()
    // {
    //     return $this->hasMany(self::class, 'parent_id');
    // }
     public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }
    
}
