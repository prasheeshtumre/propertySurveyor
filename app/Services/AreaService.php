<?php

namespace App\Services;

use App\DTO\GetAreaBySearchKeyRequestDTO;
use App\Repositories\IAreaRepository;

class AreaService
{
    private $areaRepository;

    public function __construct(IAreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAreaBySearchKey(GetAreaBySearchKeyRequestDTO $getAreaBySearchKeyRequestDTO)
    {
        $suggestions = $this->areaRepository->getAreaBySearchKey($getAreaBySearchKeyRequestDTO);
        return view('admin.pages.dropdown.partials.suggestions', ['suggestions' => $suggestions, 'fieldName' => $getAreaBySearchKeyRequestDTO->fieldName]);
    }
}
