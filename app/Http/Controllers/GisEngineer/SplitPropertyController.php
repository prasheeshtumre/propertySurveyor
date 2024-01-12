<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DTO\SplitGISIDRequestDTO;
use App\Services\SplitGISIDService;
use Illuminate\Http\JsonResponse;

class SplitGISIDController extends Controller
{
    private $splitGISIDService;

    public function __construct(SplitGISIDService $splitGISIDService)
    {
        $this->splitGISIDService = $splitGISIDService;
    }

    public function create(SplitGISIDRequestDTO $splitGISIDRequestDTO): JsonResponse
    {
        $notification = $this->splitGISIDService->createSplitGISID($splitGISIDRequestDTO);
        return response()->json($notification);
    }

}
