<?php

namespace App\Repositories;

use App\DTO\FetchCityRequestDTO;
use App\DTO\GetConstructionPartnerBySearchKeyRequestDTO;
use App\Models\ConstructionPartner;
use App\Models\GeoID;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConstructionPartnerRepository implements IConstructionPartnerRepository
{

    public function getConstructionPartnerBySearchKey(GetConstructionPartnerBySearchKeyRequestDTO $getConstructionPartnerBySearchKeyRequestDTO)
    {
        try {
            $serachKey = $getConstructionPartnerBySearchKeyRequestDTO->searchKey;
            $suggestions = ConstructionPartner::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($serachKey) . '%'])->paginate(5);
            return $suggestions;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
    }
}
