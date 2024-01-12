<?php

namespace App\Repositories;

use App\DTO\MergeGISIDRequestDTO;
use App\DTO\MergeGISIDResponseDTO;
// use App\Models\GeoID;

interface IMergeGISIDRepository
{
    public function create(MergeGISIDRequestDTO $mergeGISIDRequestDTO): MergeGISIDResponseDTO;
    
    public function update(int $id, MergeGISIDRequestDTO $mergeGISIDRequestDTO): MergeGISIDResponseDTO;
    
}