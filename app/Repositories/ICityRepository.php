<?php

namespace App\Repositories;

use App\DTO\FetchCityRequestDTO;

interface ICityRepository
{
    public function fetchCity(FetchCityRequestDTO $fetchCityRequestDTO);
}
