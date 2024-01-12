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
use App\DTO\AreaRequestDTO;
use App\Models\{Area, City, Pincode, PropertyImage, UnitImage};
use Illuminate\Http\Request;
use DB;
use File;
use FFMpeg\Format\Video\X264;
use FFMpeg;

class UnitImagesRepository implements IUnitImagesRepository
{

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function imageGallery(ImageGalleryRequestDTO $imageGalleryRequestDTO)
    {

        try {

            $image = $imageGalleryRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);

            $property_img = new UnitImage();
            $property_img->property_id = $imageGalleryRequestDTO->property_id;
            $property_img->unit_id = $imageGalleryRequestDTO->unit_id;
            $property_img->file_type = 'gallery_images';
            $property_img->file_path = '/uploads/property/unit/gallery_images';
            $property_img->file_name = $file_name;
            $property_img->created_by = auth()->user()->id;
            $property_img->save();

            return $property_img;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function amenityImages(AmenityImageRequestDTO $amenityImageRequestDTO)
    {
        // dd($request->all());
        try {
            $image = $amenityImageRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);

            $property_img = new UnitImage();
            $property_img->property_id = $amenityImageRequestDTO->property_id;
            $property_img->unit_id = $amenityImageRequestDTO->unit_id;
            $property_img->file_type = 'amenity_images';
            $property_img->file_path = '/uploads/property/unit/amenity_images';
            $property_img->file_name = $file_name;
            $property_img->created_by = auth()->user()->id;
            $property_img->save();
            return $property_img;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function interiorImages(InteriorImageRequestDTO $interiorImageRequestDTO)
    {

        try {
            $image = $interiorImageRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/interior_images', $file_name);

            $property_img = new UnitImage();
            $property_img->property_id = $interiorImageRequestDTO->property_id;
            $property_img->unit_id = $interiorImageRequestDTO->unit_id;
            $property_img->file_type = 'interior_images';
            $property_img->file_path = '/uploads/property/unit/interior_images';
            $property_img->file_name = $file_name;
            $property_img->created_by = auth()->user()->id;
            $property_img->save();
            return $property_img;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function floorPlanImages(FloorPlanImageRequestDTO $floorPlanImageRequestDTO)
    {
        try {
            $image = $floorPlanImageRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/floor_plan_images', $file_name);

            $property_img = new UnitImage();
            $property_img->property_id = $floorPlanImageRequestDTO->property_id;
            $property_img->unit_id = $floorPlanImageRequestDTO->unit_id;
            $property_img->file_type = 'floor_plan_images';
            $property_img->file_path = '/uploads/property/unit/floor_plan_images';
            $property_img->file_name = $file_name;
            $property_img->created_by = auth()->user()->id;
            $property_img->save();
            return $property_img;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function plotLandImages(PlotLandImageRequestDTO $plotLandImageRequestDTO)
    {
        try {
            $image = $plotLandImageRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);

            $property_img = new UnitImage();
            $property_img->property_id = $plotLandImageRequestDTO->property_id;
            $property_img->unit_id = $plotLandImageRequestDTO->property_id;
            $property_img->file_type = 'gallery_images';
            $property_img->file_path = '/uploads/property/unit/gallery_images';
            $property_img->file_name = $file_name;
            $property_img->created_by = auth()->user()->id;
            $property_img->save();
            return $property_img;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function unitVideos(UnitVideoRequestDTO $unitVideoRequestDTO)
    {
        try {
            $image = $unitVideoRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/uploads/property/unit/unit_videos', $file_name);

            $unitVideo = new UnitImage();
            $unitVideo->property_id = $unitVideoRequestDTO->property_id;
            $unitVideo->unit_id = $unitVideoRequestDTO->unit_id;
            $unitVideo->file_type = 'unit_videos';
            $unitVideo->file_path = '/uploads/property/unit/unit_videos';
            $unitVideo->file_name = $file_name;
            $unitVideo->created_by = auth()->user()->id;
            $unitVideo->save();
            return $unitVideo;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function deleteFile($id)
    {
        try {
            $unitFile = UnitImage::where('id', $id)->first();

            if (File::exists(public_path($unitFile->file_path . '/' . $unitFile->file_name))) {
                File::delete(public_path($unitFile->file_path . '/' . $unitFile->file_name));

                $delete = UnitImage::where('id', $id)->delete();
            }
            return $unitFile;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
