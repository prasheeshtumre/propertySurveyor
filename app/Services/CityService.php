<?php

namespace App\Services;

use App\DTO\FetchCityRequestDTO;
use App\Repositories\ICityRepository;

class CityService
{
    private $cityRepository;

    public function __construct(ICityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function fetchCity(FetchCityRequestDTO $fetchCityRequestDTO)
    {
        return $this->cityRepository->fetchCity($fetchCityRequestDTO);
    }
}
