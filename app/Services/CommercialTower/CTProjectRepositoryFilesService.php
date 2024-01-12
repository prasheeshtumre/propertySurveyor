<?php

namespace App\Services\CommercialTower;

use App\DTO\CommercialTower\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Repositories\CommercialTower\ICTProjectRepositoryFilesRepository;
use Illuminate\Http\Request;

class CTProjectRepositoryFilesService
{
    private $ctProjectRepositoryFilesRepository;

    public function __construct(ICTProjectRepositoryFilesRepository $ctProjectRepositoryFilesRepository)
    {
        $this->ctProjectRepositoryFilesRepository = $ctProjectRepositoryFilesRepository;
    }

    public function projectBroucher(BrochureFileRequestDTO $brochureFileRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->projectBroucher($brochureFileRequestDTO);
    }

    public function projectPromotionalVideo(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->projectPromotionalVideo($promotionalVideoFileRequestDTO);
    }

    public function projectImageFile(ImageFileRequestDTO $imageFileRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->projectImageFile($imageFileRequestDTO);
    }

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->threeDimentionalViewVideo($threeDimentionalViewVideoDTO);
    }

    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->floorPlanFile($floorPlanFileRequestDTO);
    }

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->otherMediaFiles($otherFileRequestDTO);
    }
    public function addProjectRepositoryLink(AddProjectRepositoryRequestDTO $addProjectRepositoryRequestDTO)
    {
        return $this->ctProjectRepositoryFilesRepository->addProjectRepositoryLink($addProjectRepositoryRequestDTO);
    }

    public function deleteFile($id)
    {
        return $this->ctProjectRepositoryFilesRepository->deleteFile($id);
    }
    public function deleteOtherFile($id)
    {
        return $this->ctProjectRepositoryFilesRepository->deleteOtherFile($id);
    }
}
