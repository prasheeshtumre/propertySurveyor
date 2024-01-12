<?php

namespace App\Services;

use App\DTO\SplitGISIDRequestDTO;
use App\DTO\SplitGISIDResponseDTO;
use App\Repositories\ISplitGISIDRepository;

class SplitGISIDService
{
    private $splitGISIDRepository;

    public function __construct(ISplitGISIDRepository $splitGISIDRepository)
    {
        $this->splitGISIDRepository = $splitGISIDRepository;
    }

    public function createSplitGISID(SplitGISIDRequestDTO $splitGISIDRequestDTO): SplitGISIDResponseDTO
    {
        return $this->splitGISIDRepository->create($splitGISIDRequestDTO);
    }

    public function updateSplitGISID(int $id, SplitGISIDRequestDTO $SplitGISIDRequestDTO): SplitGISIDResponseDTO
    {
        return $this->splitGISIDRepository->update($id, $SplitGISIDRequestDTO);
    }   
   
}
