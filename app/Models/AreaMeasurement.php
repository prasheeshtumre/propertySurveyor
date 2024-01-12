<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class AreaMeasurement extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'area_measurements';
    protected $fillable = ['amount', 'unit'];

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }
}
