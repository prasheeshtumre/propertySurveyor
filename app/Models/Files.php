<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $guarded = [];   
    protected $primaryKey = 'id';
    protected $table = 'files_mst';
    
    // public function enquiry()
    // {
    //     return $this->belongsTo(birthCertificate::class);

    // }
}
