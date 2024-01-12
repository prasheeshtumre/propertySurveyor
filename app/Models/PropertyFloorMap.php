<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class PropertyFloorMap extends Model

{

    use HasFactory;

    

    protected $table = "property_floor_map";

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [		
                            'id',
                            'property_id',	
                            'floor_no',	
                            'units',	
                            'merge_parent_floor_id',	
                            'merge_parent_floor_status',	
                            'floor_name',	
                            'tower_id'
    ];
    
    public function units()
    {
        return $this->hasMany(FloorUnitMap::class, 'floor_id', 'id');
    }
}