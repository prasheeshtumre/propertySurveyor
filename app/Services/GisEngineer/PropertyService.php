<?php

namespace App\Services\GisEngineer;

use App\Repositories\GisEngineer\IPropertyRepository;
use Illuminate\Http\Request;

class PropertyService
{
    private $propertyRepository;

    public function __construct(IPropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function getProperties(Request $request, $type)
    {
        // You can use $this->propertyRepository to interact with the database
        $properties = $this->propertyRepository->properties($request, $type);

        // Return the desired properties
        return ['properties' => $properties];
    }

    public function getProperty(Request $request, $id)
    {
        return $this->propertyRepository->getProperty($request, $id);
        
    }

    public function editProperty($id)
    {
        return $this->propertyRepository->editProperty($id);
    }

    public function updateSplitProperty(Request $request, $id)
    {
        return $this->propertyRepository->editProperty($id);
    }

    public function updateMergeProperty(Request $request, $id)
    {
        return $this->propertyRepository->updateMergeProperty($id);
    }

    public function updateTempGISProperty(Request $request, $id)
    {
        return $this->propertyRepository->updateTempGISProperty($id);
    }
}
