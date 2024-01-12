<?php
// app/Services/PropertyService.php

namespace App\Services;

use App\Repositories\PropertyRepository;

class PropertyService
{
    protected $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function searchProperties($request)
    {
        return $this->propertyRepository->searchProperties($request);
    }

    public function getProperty($request)
    {
        return $this->propertyRepository->getProperty($request);
    }
}
