<?php

namespace App\Http\Controllers\GatedCommunity;

use App\DTO\GatedCommunity\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Http\Controllers\Controller;
use App\Models\OtherCompliances;
use App\Models\ProjectRepositoryImages;
use App\Services\GatedCommunity\ProjectRepositoryFilesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;

class RepositoriesController extends Controller
{
    public $projectRepositoryFilesService;

    function __construct(ProjectRepositoryFilesService $projectRepositoryFilesService)
    {
        $this->projectRepositoryFilesService = $projectRepositoryFilesService;
    }
    public function brochure_files(BrochureFileRequestDTO $brochureFileRequestDTO)
    {
        try {
            $brochureFile = $this->projectRepositoryFilesService->projectBroucher($brochureFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $brochureFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy/' . $brochureFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function promotional_video_files(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO)
    {
        try {
            $promotionalVideoFile = $this->projectRepositoryFilesService->projectPromotionalVideo($promotionalVideoFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $promotionalVideoFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy/' . $promotionalVideoFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function image_files(ImageFileRequestDTO $imageFileRequestDTO)
    {
        try {
            $imageFile = $this->projectRepositoryFilesService->projectImageFile($imageFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $imageFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy/' . $imageFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function view_video_files(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO)
    {
        try {
            $threeDimentionalViewVideo = $this->projectRepositoryFilesService->threeDimentionalViewVideo($threeDimentionalViewVideoDTO);
            return response()->json(['status' => true, 'file_id' => $threeDimentionalViewVideo['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy/' . $threeDimentionalViewVideo['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }
    public function floor_files(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        try {
            $floorPlanFile = $this->projectRepositoryFilesService->floorPlanFile($floorPlanFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $floorPlanFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy/' . $floorPlanFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function other_files(OtherFileRequestDTO $otherFileRequestDTO)
    {
        try {
            $otherFile = $this->projectRepositoryFilesService->otherMediaFiles($otherFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $otherFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/repository/destroy-other-files/' . $otherFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function destroy($id)
    {
        try {
            $deleteFile = $this->projectRepositoryFilesService->deleteFile($id);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Repository image Deleted Successfully',
                ],
                200,
            );
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function destroy_other_files($id)
    {
        try {
            $deleteOtherFile = $this->projectRepositoryFilesService->deleteOtherFile($id);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Repository image Deleted Successfully',
                ],
                200,
            );
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function add_project_repository(AddProjectRepositoryRequestDTO $addProjectRepositoryRequestDTO)
    {
        try {
            $ProjectRepository = $this->projectRepositoryFilesService->addProjectRepositoryLink($addProjectRepositoryRequestDTO);
            return response()->json(['message' => 'Project repository data saved successfully', 'comp_id' => $ProjectRepository->id], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }
}
