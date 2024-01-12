<?php

namespace App\Services\Units;

use App\DTO\Units\{
    AmenityImageRequestDTO,
    FloorPlanImageRequestDTO,
    ImageGalleryRequestDTO,
    InteriorImageRequestDTO,
    PlotLandImageRequestDTO,
    UnitVideoRequestDTO
};
use App\Models\UnitImage;
use App\Repositories\Units\IUnitImagesRepository;
use File;
use Illuminate\Http\Request;

class UnitImagesService
{
    private $unitImagesRepository;

    public function __construct(IUnitImagesRepository $unitImagesRepository)
    {
        $this->unitImagesRepository = $unitImagesRepository;
    }

    public function imageGallery(ImageGalleryRequestDTO $imageGalleryRequestDTO)
    {

        // $old_files = UnitImage::where('unit_id', $imageGalleryRequestDTO->unit_id)
        //     ->where('file_type', 'gallery_images')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->imageGallery($imageGalleryRequestDTO);
    }

    public function amenityImages(AmenityImageRequestDTO $amenityImageRequestDTO)
    {
        // $old_files = UnitImage::where('unit_id', $amenityImageRequestDTO->unit_id)
        //     ->where('file_type', 'amenity_images')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->amenityImages($amenityImageRequestDTO);
    }

    public function interiorImages(InteriorImageRequestDTO $interiorImageRequestDTO)
    {
        // $old_files = UnitImage::where('unit_id', $interiorImageRequestDTO->unit_id)
        //     ->where('file_type', 'interior_images')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->interiorImages($interiorImageRequestDTO);
    }

    public function floorPlanImages(FloorPlanImageRequestDTO $floorPlanImageRequestDTO)
    {
        // $old_files = UnitImage::where('unit_id', $floorPlanImageRequestDTO->unit_id)
        //     ->where('file_type', 'interior_images')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->floorPlanImages($floorPlanImageRequestDTO);
    }

    public function plotLandImages(PlotLandImageRequestDTO $plotLandImageRequestDTO)
    {
        // $old_files = UnitImage::where('unit_id', $plotLandImageRequestDTO->unit_id)
        //     ->where('file_type', 'gallery_images')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->plotLandImages($plotLandImageRequestDTO);
    }

    public function unitVideos(UnitVideoRequestDTO $unitVideoRequestDTO)
    {
        // $old_files = UnitImage::where('unit_id', $unitVideoRequestDTO->unit_id)
        //     ->where('file_type', 'unit_videos')
        //     ->get();

        // foreach ($old_files as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/unit_videos/' . $img_unlink->file_name))) {
        //         File::delete(public_path('/uploads/property/unit/unit_videos/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        return $this->unitImagesRepository->unitVideos($unitVideoRequestDTO);
    }
    public function deleteFile($id)
    {
        return $this->unitImagesRepository->deleteFile($id);
    }
}
