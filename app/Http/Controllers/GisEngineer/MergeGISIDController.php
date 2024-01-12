<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DTO\MergeGISIDRequestDTO;
use App\Services\MergeGISIDService;
use Illuminate\Http\JsonResponse;

class MergeGISIDController extends Controller
{
    private $mergeGISIDService;

    public function __construct(MergeGISIDService $mergeGISIDService)
    {
        $this->mergeGISIDService = $mergeGISIDService;
    }

    public function create(MergeGISIDRequestDTO $mergeGISIDRequestDTO): JsonResponse
    {
        $notification = $this->mergeGISIDService->createMergeGISID($mergeGISIDRequestDTO);
        return response()->json($notification);
    }
}
