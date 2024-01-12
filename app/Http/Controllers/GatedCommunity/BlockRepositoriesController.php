<?php

namespace App\Http\Controllers\GatedCommunity;

use App\DTO\GatedCommunity\BlockRepositories\{AddBlockRepositoryRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, ThreeDimentionalViewVideoRequestDTO, TowerVideoRequestDTO};
use App\Http\Controllers\Controller;
use App\Models\{BlockTowerRepository, Tower};
use App\Services\GatedCommunity\BlockRepositoryFilesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlockRepositoriesController extends Controller
{
    public $blockRepositoryFilesService;
    public function __construct(BlockRepositoryFilesService $blockRepositoryFilesService)
    {
        $this->blockRepositoryFilesService = $blockRepositoryFilesService;
    }

    public function floor_plan_files(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        try {
            $floorFile = $this->blockRepositoryFilesService->floorPlanFile($floorPlanFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $floorFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/block-repository/destroy/' . $floorFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function image_files(ImageFileRequestDTO $imageFileRequestDTO)
    {
        try {
            $imageFile = $this->blockRepositoryFilesService->imageFiles($imageFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $imageFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/block-repository/destroy/' . $imageFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function three_dimentional_view_video(ThreeDimentionalViewVideoRequestDTO $threeDimentionalViewVideoRequestDTO)
    {
        try {
            $threeDimentionalViewVideo = $this->blockRepositoryFilesService->threeDimentionalViewVideo($threeDimentionalViewVideoRequestDTO);
            return response()->json(['status' => true, 'file_id' => $threeDimentionalViewVideo['id'], 'remove_url' => url('/surveyor/property/gated-community-details/block-repository/destroy/' . $threeDimentionalViewVideo['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function tower_video(TowerVideoRequestDTO $towerVideoRequestDTO)
    {
        try {
            $towerVideo = $this->blockRepositoryFilesService->towerVideo($towerVideoRequestDTO);
            return response()->json(['status' => true, 'file_id' => $towerVideo['id'], 'remove_url' => url('/surveyor/property/gated-community-details/block-repository/destroy/' . $towerVideo['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function other_files(OtherFileRequestDTO $otherFileRequestDTO)
    {
        try {
            $otherFile = $this->blockRepositoryFilesService->otherMediaFiles($otherFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $otherFile['id'], 'remove_url' => url('/surveyor/property/gated-community-details/block-repository/destroy-other-files/' . $otherFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function destroy($id)
    {
        try {
            $deleteFile = $this->blockRepositoryFilesService->deleteFile($id);
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
            $deleteOtherFile = $this->blockRepositoryFilesService->deleteOtherFile($id);
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
    public function add_block_repository(AddBlockRepositoryRequestDTO $addBlockRepositoryRequestDTO)
    {
        try {
            $addBlockRepository = $this->blockRepositoryFilesService->addBlockRepositoryLink($addBlockRepositoryRequestDTO);
            return response()->json(['message' => 'Block\Tower repository data saved successfully', 'comp_id' => $addBlockRepository->id], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
}
