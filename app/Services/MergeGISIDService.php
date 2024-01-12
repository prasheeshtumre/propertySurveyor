<?php

namespace App\Services;

use App\DTO\MergeGISIDRequestDTO;
use App\DTO\MergeGISIDResponseDTO;
use App\Repositories\IMergeGISIDRepository;

class MergeGISIDService
{
    private $mergeGISIDRepository;

    public function __construct(IMergeGISIDRepository $mergeGISIDRepository)
    {
        $this->mergeGISIDRepository = $mergeGISIDRepository;
    }

    public function createMergeGISID(MergeGISIDRequestDTO $mergeGISIDRequestDTO): MergeGISIDResponseDTO
    {
        return $this->mergeGISIDRepository->create($mergeGISIDRequestDTO);
    }

   
}
