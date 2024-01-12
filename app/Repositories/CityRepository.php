<?php

namespace App\Repositories;

use App\DTO\FetchCityRequestDTO;
use App\Models\GeoID;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CityRepository implements ICityRepository
{

    public function fetchCity(FetchCityRequestDTO $fetchCityRequestDTO)
    {
        try {

            $q = GeoID::where('gis_id', $fetchCityRequestDTO->gisId)->with('pincode', function ($q) {
                $q->with('pincodeCity', function ($q) {
                    $q->with('city');
                });
            })->first();
            if ($q) {
                if (!empty($q->pincode->pincodeCity->city)) {
                    $city = ['id' => $q->pincode->pincodeCity->city->id, 'city' => $q->pincode->pincodeCity->city->name ?? '', 'pincode' => $q->pincode_id ?? 0, 'status' => true];
                } else {
                    $city = ['status' => false, 'message' => 'City Not Available.'];
                }
            } else {
                $city = ['status' => false, 'message' => 'City Not Available.'];
            }

            return $city;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
    }
}
