<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_logo',
        'address',
        'website',
        'contact_no',
        'mail',
        'linked_in',
        'facebook',
        'twitter',
        'youtube',
        'created_by',
    ];

    public function sub_groups()
    {
        return $this->hasMany(BuilderSubGroup::class, 'builder_id', 'id');
    }

    public function getBuilderName()
    {
        return $this->belongsTo('App\Models\Property', 'builder_id', 'id');
    }

    public function builderName()
    {
        return $this->hasMany('App\Models\Property', 'builder_id', 'id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_builder', 'builder_id', 'property_id');
    }
}
