<?php

namespace App\Http\Controllers\Unit;

use App\DTO\Units\{
    AmenityImageRequestDTO,
    FloorPlanImageRequestDTO,
    ImageGalleryRequestDTO,
    InteriorImageRequestDTO,
    PlotLandImageRequestDTO,
    UnitVideoRequestDTO
};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Units\UnitImagesService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ImageUploadController extends Controller
{
    public $unitImagesService;

    function __construct(UnitImagesService $unitImagesService)
    {
        $this->unitImagesService = $unitImagesService;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $request Description
     * @return Request
     * @throws conditon
     **/
    public function imageGallery(ImageGalleryRequestDTO $imageGalleryRequestDTO)
    {
        try {
            $imageFile = $this->unitImagesService->imageGallery($imageGalleryRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' => $imageFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function amenityImages(AmenityImageRequestDTO $amenityImageRequestDTO)
    {
        // dd($request->all());
        try {
            $imageFile = $this->unitImagesService->amenityImages($amenityImageRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' =>  $imageFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function interiorImages(InteriorImageRequestDTO $interiorImageRequestDTO)
    {
        try {
            $imageFile = $this->unitImagesService->interiorImages($interiorImageRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' => $imageFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function floorPlanImages(FloorPlanImageRequestDTO $floorPlanImageRequestDTO)
    {
        try {
            $imageFile = $this->unitImagesService->floorPlanImages($floorPlanImageRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' => $imageFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function plotLandImages(PlotLandImageRequestDTO $plotLandImageRequestDTO)
    {
        try {
            $imageFile = $plotLandImage = $this->unitImagesService->plotLandImages($plotLandImageRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' => $imageFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function unitVideos(UnitVideoRequestDTO $unitVideoRequestDTO)
    {
        try {
            $videoFile = $this->unitImagesService->unitVideos($unitVideoRequestDTO);
            return response()->json(['status' => 'ok', 'file_id' => $videoFile['id']], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function deleteUnitFile(int $id)
    {
        try {
            $unitFile = $this->unitImagesService->deleteFile($id);
            return response()->json(['status' => 'ok', 'message' => 'File removed Successfully.'], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
            return response()->json(['status' => 'Fail', 'message' => 'Internal Server Error.'], 500);
        }
    }
}
