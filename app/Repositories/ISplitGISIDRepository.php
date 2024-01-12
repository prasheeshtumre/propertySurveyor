<?php

namespace App\Repositories;

use App\DTO\SplitGISIDRequestDTO;
use App\DTO\SplitGISIDResponseDTO;
// use App\Models\GeoID;

interface ISplitGISIDRepository
{
    public function create(SplitGISIDRequestDTO $splitGISIDRequestDTO): SplitGISIDResponseDTO;
    
    public function update(int $id, SplitGISIDRequestDTO $splitGISIDRequestDTO): SplitGISIDResponseDTO;
    
}


