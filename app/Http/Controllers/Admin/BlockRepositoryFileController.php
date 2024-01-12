<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GatedCommunity\BlockRepositoryFilesService;

class BlockRepositoryFileController extends Controller
{
    public $blockRepositoryFilesService;

    function __construct(BlockRepositoryFilesService $blockRepositoryFilesService){
        $this->blockRepositoryFilesService = $blockRepositoryFilesService;
    }

    public function projectBroucher(Request $request){
        return $this->projectRepositoryFilesService->projectBroucher($request);
    }

    public function projectPromotionalVideo(Request $request){
        return $this->projectRepositoryFilesService->projectPromotionalVideo($request);
    }

    public function imageGallery(Request $request){
        return $this->projectRepositoryFilesService->imageGallery($request);
    }

    public function threeDimentionalViewVideo(Request $request){
        return $this->projectRepositoryFilesService->threeDimentionalViewVideo($request);
    }

    public function floorPlan(Request $request){
        return $this->projectRepositoryFilesService->floorPlan($request);
    }

    public function otherMediaFiles(Request $request){
        return $this->projectRepositoryFilesService->otherMediaFiles($request);
    }
}
