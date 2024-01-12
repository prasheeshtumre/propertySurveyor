<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Tower;

use App\Models\ProjectStatus;

use App\Models\AmenityOption;



class PriceTrend extends Model

{

    use HasFactory;

    protected $guarded = [];   

    protected $table = 'price_trends';



    public function tower()

    {

        return $this->belongsTo(Tower::class);

    }
    public function towerStatus()
    {

        return $this->belongsTo(ProjectStatus::class, 'tower_status', 'id');

    }
    public function projectStatus()
    {

        return $this->belongsTo(ProjectStatus::class, 'project_status', 'id');

    }




}