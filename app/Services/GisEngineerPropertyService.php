<?php

namespace App\Services;

use App\DTO\SplitGISIDRequestDTO;
use App\DTO\SplitGISIDResponseDTO;
use App\Repositories\GisEngineer\IPropertyRepository;

class GisEngineerPropertyService
{
    protected $propertyRepository;

    public function __construct(IPropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index($request, $type = null)
    {
        return  "test";
    }

    
   
}
