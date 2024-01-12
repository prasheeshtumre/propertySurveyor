<?php

namespace App\Http\Controllers;

use App\DTO\GetAreaBySearchKeyRequestDTO;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Area;
use App\Services\AreaService;

class AreaController extends Controller
{
    public $areaService;

    function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    public function getAreaBySearchKey(GetAreaBySearchKeyRequestDTO $getAreaBySearchKeyRequestDTO)
    {
        return $this->areaService->getAreaBySearchKey($getAreaBySearchKeyRequestDTO);
        // return response()->json($response, 200);
    }
}
