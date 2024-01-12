<?php

namespace App\Repositories;

use App\DTO\GetConstructionPartnerBySearchKeyRequestDTO;

interface IConstructionPartnerRepository
{
    public function getConstructionPartnerBySearchKey(GetConstructionPartnerBySearchKeyRequestDTO $getConstructionPartnerBySearchKeyRequestDTO);
}
