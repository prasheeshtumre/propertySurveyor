<?php

namespace App\Repositories;

use App\DTO\MergeGISIDRequestDTO;
use App\DTO\MergeGISIDResponseDTO;
use App\Models\GisIDMapping;

class MergeGISIDRepository implements IMergeGISIDRepository
{
    public function create(MergeGISIDRequestDTO $mergeGISIDRequestDTO): MergeGISIDResponseDTO
    {
        $GisIDMapping = GisIDMapping::create($mergeGISIDRequestDTO->toArray());
        return new MergeGISIDResponseDTO($GisIDMapping);
    }
    
    public function update(int $id, MergeGISIDRequestDTO $mergeGISIDRequestDTO): MergeGISIDResponseDTO
    {
        $GisIDMapping = GisIDMapping::findOrFail($id);
        $GisIDMapping->update($mergeGISIDRequestDTO->toArray());
        return new MergeGISIDResponseDTO($GisIDMapping);
    }
    
}
