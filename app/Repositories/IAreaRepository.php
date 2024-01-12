<?php

namespace App\Repositories;

use App\DTO\GetAreaBySearchKeyRequestDTO;

interface IAreaRepository
{
    public function getAreaBySearchKey(GetAreaBySearchKeyRequestDTO $getAreaBySearchKeyRequestDTO);
}
