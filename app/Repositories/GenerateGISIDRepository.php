<?php

namespace App\Repositories;

use App\DTO\GenerateGISIDRequestDTO;
use App\DTO\GenerateGISIDResponseDTO;
use App\Models\GeoID;
use App\Models\TemporaryGisId ;
use Illuminate\Http\JsonResponse;
use Auth;
use App\Repositories\IGeoCodeRepository;

class GenerateGISIDRepository implements IGenerateGISIDRepository
{
    protected $geoCodeRepository;

    public function __construct(IGeoCodeRepository $geoCodeRepository)
    {
        $this->geoCodeRepository = $geoCodeRepository;
    }

    public function generate($lat, $long)
    {
        $firstSequence = 'P' . date('d') . date('m') . date('y');
        $currentDate = now()->toDateString();
        // Query to count records created today
        $secondSequence = TemporaryGisId::whereDate('created_at', $currentDate)->count();

        $temporary_gis_id = $firstSequence . '-' . ($secondSequence + 1);

            $tempGisId = new TemporaryGisId;
            $tempGisId->gis_id_temp = $temporary_gis_id ;
            $tempGisId->lat = $lat;
            $tempGisId->long = $long;
            $tempGisId->created_by = Auth::user()->id;
            $tempGisId->save();

        // return $pincode = $this->geoCodeRepository->getPincode($lat, $long);
       
        return $temporary_gis_id;
    }
    
}

