<?php

namespace App\Repositories;

use App\DTO\SplitGISIDRequestDTO;
use App\DTO\SplitGISIDResponseDTO;
use App\Models\GeoID;

class SplitGISIDRepository implements ISplitGISIDRepository
{
    public function create(SplitGISIDRequestDTO $splitGISIDRequestDTO): SplitGISIDResponseDTO
    {
        $geo_id = GeoID::create($splitGISIDRequestDTO->toArray());
        return new SplitGISIDResponseDTO($geo_id);
    }
    
    public function update(int $id, SplitGISIDRequestDTO $splitGISIDRequestDTO): SplitGISIDResponseDTO
    {
        $geo_id = GeoID::findOrFail($id);
        $geo_id->update($splitGISIDRequestDTO->toArray());
        return new SplitGISIDResponseDTO($geo_id);
    }
    
}
