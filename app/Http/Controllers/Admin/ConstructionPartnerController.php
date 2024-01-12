<?php

namespace App\Http\Controllers\Admin;

use App\DTO\GetConstructionPartnerBySearchKeyRequestDTO;
use App\Http\Controllers\Controller;
use App\Services\ConstructionPartnerService;
use Illuminate\Http\Request;

class ConstructionPartnerController extends Controller
{

    public $constructionPartnerService;

    function __construct(ConstructionPartnerService $constructionPartnerService)
    {
        $this->constructionPartnerService = $constructionPartnerService;
    }

    public function getConstructionPartnerBySearchKey(GetConstructionPartnerBySearchKeyRequestDTO $getConstructionPartnerBySearchKeyRequestDTO)
    {
        return $this->constructionPartnerService->getConstructionPartnerBySearchKey($getConstructionPartnerBySearchKeyRequestDTO);
        // return response()->json($response, 200);
    }
}
