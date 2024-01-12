<?php

namespace App\Services\GatedCommunity;

use App\DTO\GatedCommunity\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Repositories\GatedCommunity\IProjectRepositoryFilesRepository;
use Illuminate\Http\Request;

class ProjectRepositoryFilesService
{
    private $projectRepositoryFilesRepository;

    public function __construct(IProjectRepositoryFilesRepository $projectRepositoryFilesRepository)
    {
        $this->projectRepositoryFilesRepository = $projectRepositoryFilesRepository;
    }

    public function projectBroucher(BrochureFileRequestDTO $brochureFileRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->projectBroucher($brochureFileRequestDTO);
    }

    public function projectPromotionalVideo(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->projectPromotionalVideo($promotionalVideoFileRequestDTO);
    }

    public function projectImageFile(ImageFileRequestDTO $imageFileRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->projectImageFile($imageFileRequestDTO);
    }

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO)
    {
        return $this->projectRepositoryFilesRepository->threeDimentionalViewVideo($threeDimentionalViewVideoDTO);
    }

    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->floorPlanFile($floorPlanFileRequestDTO);
    }

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->otherMediaFiles($otherFileRequestDTO);
    }
    public function addProjectRepositoryLink(AddProjectRepositoryRequestDTO $addProjectRepositoryRequestDTO)
    {
        return $this->projectRepositoryFilesRepository->addProjectRepositoryLink($addProjectRepositoryRequestDTO);
    }

    public function deleteFile($id)
    {
        return $this->projectRepositoryFilesRepository->deleteFile($id);
    }
    public function deleteOtherFile($id)
    {
        return $this->projectRepositoryFilesRepository->deleteOtherFile($id);
    }
}
