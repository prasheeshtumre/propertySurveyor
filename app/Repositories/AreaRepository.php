<?php

namespace App\Repositories;

use App\DTO\GetAreaBySearchKeyRequestDTO;
use App\Models\Area;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AreaRepository implements IAreaRepository
{

    public function getAreaBySearchKey(GetAreaBySearchKeyRequestDTO $getAreaBySearchKeyRequestDTO)
    {
        try {
            $serachKey = $getAreaBySearchKeyRequestDTO->searchKey;
            $cityId = $getAreaBySearchKeyRequestDTO->cityId;
            $suggestions = Area::where('city_id', $cityId)->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($serachKey) . '%'])->paginate(5);

            return $suggestions;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
    }
}
