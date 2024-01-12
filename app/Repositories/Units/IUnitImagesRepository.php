<?php

namespace App\Repositories\Units;

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

interface IUnitImagesRepository
{

    public function imageGallery(ImageGalleryRequestDTO $imageGalleryRequestDTO);

    public function amenityImages(AmenityImageRequestDTO $amenityImageRequestDTO);

    public function interiorImages(InteriorImageRequestDTO $interiorImageRequestDTO);

    public function floorPlanImages(FloorPlanImageRequestDTO $floorPlanImageRequestDTO);

    public function plotLandImages(PlotLandImageRequestDTO $plotLandImageRequestDTO);

    public function unitVideos(UnitVideoRequestDTO $unitVideoRequestDTO);

    public function deleteFile($id);
}
