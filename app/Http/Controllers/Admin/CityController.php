<?php

namespace App\Http\Controllers\Admin;

use App\DTO\FetchCityRequestDTO;
use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $cityService;

    function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function fetchCity(FetchCityRequestDTO $fetchCityRequestDTO)
    {
        $response = $this->cityService->fetchCity($fetchCityRequestDTO);
        return response()->json($response, 200);
    }
}
