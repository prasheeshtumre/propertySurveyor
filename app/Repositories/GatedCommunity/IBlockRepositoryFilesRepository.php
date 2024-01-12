<?php

namespace App\Repositories\GatedCommunity;

use App\DTO\GatedCommunity\BlockRepositories\{AddBlockRepositoryRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, ThreeDimentionalViewVideoRequestDTO, TowerVideoRequestDTO};
use App\Models\PushNotification;
use Illuminate\Http\Request;

interface IBlockRepositoryFilesRepository
{
    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO);

    public function imageFiles(ImageFileRequestDTO $imageFileRequestDTO);

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoRequestDTO $threeDimentionalViewVideoRequestDTO);

    public function towerVideo(TowerVideoRequestDTO $towerVideoRequestDTO);

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO);

    public function addBlockRepositoryLink(AddBlockRepositoryRequestDTO $addBlockRepositoryRequestDTO);

    public function deleteFile($id);

    public function deleteOtherFile($id);
}
