<?php
// app/Services/PropertyService.php

namespace App\Services;

use App\Repositories\GenerateGISIDRepository;

class GenerateGISIDService
{
    protected $generateGISIDRepository;

    public function __construct(GenerateGISIDRepository $generateGISIDRepository)
    {
        $this->generateGISIDRepository = $generateGISIDRepository;
    }

    public function generate($lat, $long)
    {
        // Implement the property search logic here
        return $this->generateGISIDRepository->generate($lat, $long);
    }
}
