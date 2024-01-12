<?php

namespace App\Repositories;

use App\DTO\MergeGISIDRequestDTO;
use App\DTO\MergeGISIDResponseDTO;
use App\Models\GisIDMapping;
use Illuminate\Http\JsonResponse;

interface IGenerateGISIDRepository
{
    public function generate($lat, $long);
}
