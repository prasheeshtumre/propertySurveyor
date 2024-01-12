<?php

namespace App\Services\GatedCommunity;

use App\DTO\GatedCommunity\BlockRepositories\{AddBlockRepositoryRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, ThreeDimentionalViewVideoRequestDTO, TowerVideoRequestDTO};
use App\Repositories\GatedCommunity\IBlockRepositoryFilesRepository;
use Illuminate\Http\Request;

class BlockRepositoryFilesService
{
    private $blockRepositoryFilesRepository;

    public function __construct(IBlockRepositoryFilesRepository $blockRepositoryFilesRepository)
    {
        $this->blockRepositoryFilesRepository = $blockRepositoryFilesRepository;
    }

    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->floorPlanFile($floorPlanFileRequestDTO);
    }

    public function imageFiles(ImageFileRequestDTO $imageFileRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->imageFiles($imageFileRequestDTO);
    }

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoRequestDTO $threeDimentionalViewVideoRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->threeDimentionalViewVideo($threeDimentionalViewVideoRequestDTO);
    }

    public function towerVideo(TowerVideoRequestDTO $towerVideoRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->towerVideo($towerVideoRequestDTO);
    }

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->otherMediaFiles($otherFileRequestDTO);
    }

    public function addBlockRepositoryLink(AddBlockRepositoryRequestDTO $addBlockRepositoryRequestDTO)
    {
        return $this->blockRepositoryFilesRepository->addBlockRepositoryLink($addBlockRepositoryRequestDTO);
    }
    public function deleteFile($id)
    {
        return $this->blockRepositoryFilesRepository->deleteFile($id);
    }
    public function deleteOtherFile($id)
    {
        return $this->blockRepositoryFilesRepository->deleteOtherFile($id);
    }
}
