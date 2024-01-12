<?php

namespace App\Repositories\CommercialTower;

use App\DTO\CommercialTower\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Models\PushNotification;
use Illuminate\Http\Request;

interface ICTProjectRepositoryFilesRepository
{
    public function projectBroucher(BrochureFileRequestDTO $brochureFileRequestDTO);

    public function projectPromotionalVideo(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO);

    public function projectImageFile(ImageFileRequestDTO $imageFileRequestDTO);

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO);

    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO);

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO);

    public function addProjectRepositoryLink(AddProjectRepositoryRequestDTO $addProjectRepositoryRequestDTO);

    public function deleteFile($id);

    public function deleteOtherFile($id);
}
