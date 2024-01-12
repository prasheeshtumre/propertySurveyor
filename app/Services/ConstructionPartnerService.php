<?php

namespace App\Services;

use App\DTO\FetchCityRequestDTO;
use App\DTO\GetConstructionPartnerBySearchKeyRequestDTO;
use App\Repositories\ICityRepository;
use App\Repositories\IConstructionPartnerRepository;

class ConstructionPartnerService
{
    private $constructionPartnerRepository;

    public function __construct(IConstructionPartnerRepository $constructionPartnerRepository)
    {
        $this->constructionPartnerRepository = $constructionPartnerRepository;
    }

    public function getConstructionPartnerBySearchKey(GetConstructionPartnerBySearchKeyRequestDTO $getConstructionPartnerBySearchKeyRequestDTO)
    {
        $suggestions = $this->constructionPartnerRepository->getConstructionPartnerBySearchKey($getConstructionPartnerBySearchKeyRequestDTO);
        return view('admin.pages.dropdown.partials.suggestions', ['suggestions' => $suggestions, 'fieldName' => $getConstructionPartnerBySearchKeyRequestDTO->fieldName]);
    }
}
