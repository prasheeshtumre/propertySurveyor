<?php

namespace App\Repositories;

use App\DTO\BuilderSearchRequestDTO;
use App\DTO\Units\{
    AmenityImageRequestDTO,
    FloorPlanImageRequestDTO,
    ImageGalleryRequestDTO,
    InteriorImageRequestDTO,
    PlotLandImageRequestDTO,
    UnitVideoRequestDTO
};
use App\Models\PushNotification;
use Illuminate\Http\Request;

interface IBuilderRepository
{
    public function getSuggestions(BuilderSearchRequestDTO $builderSearchRequestDTO);

    public function createPropertyBuilder($builderId, $propertyId);
    public function updatePropertyBuilder($builderId, $propertyId);
}
