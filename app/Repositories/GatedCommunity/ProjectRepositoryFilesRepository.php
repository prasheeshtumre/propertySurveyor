<?php

namespace App\Repositories\GatedCommunity;

use App\DTO\GatedCommunity\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Models\{OtherCompliances, ProjectRepository, ProjectRepositoryImages};
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Auth;

class ProjectRepositoryFilesRepository implements IProjectRepositoryFilesRepository
{
    public function projectBroucher(BrochureFileRequestDTO $brochureFileRequestDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($brochureFileRequestDTO);
            $image = $brochureFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/project_repository/brochure/';
            $image->move(public_path() . $path, $file_name);
            $ProjectRepositoryImages = new ProjectRepositoryImages();
            $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
            $ProjectRepositoryImages->file_type = 'brochure';
            $ProjectRepositoryImages->file_path = $path;
            $ProjectRepositoryImages->file_name = $path . $file_name;
            $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
            $ProjectRepositoryImages->created_by = Auth::user()->id;
            $ProjectRepositoryImages->save();
            return $ProjectRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function projectPromotionalVideo(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($promotionalVideoFileRequestDTO);
            $image = $promotionalVideoFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/project_repository/video_files/';
            $image->move(public_path() . $path, $file_name);
            $ProjectRepositoryImages = new ProjectRepositoryImages();
            $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
            $ProjectRepositoryImages->file_type = 'video_files';
            $ProjectRepositoryImages->file_path = $path;
            $ProjectRepositoryImages->file_name = $path . $file_name;
            $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
            $ProjectRepositoryImages->created_by = Auth::user()->id;
            $ProjectRepositoryImages->save();
            return $ProjectRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function projectImageFile(ImageFileRequestDTO $imageFileRequestDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($imageFileRequestDTO);
            $image = $imageFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/project_repository/image_files/';
            $image->move(public_path() . $path, $file_name);
            $ProjectRepositoryImages = new ProjectRepositoryImages();
            $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
            $ProjectRepositoryImages->file_type = 'image_files';
            $ProjectRepositoryImages->file_path = $path;
            $ProjectRepositoryImages->file_name = $path . $file_name;
            $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
            $ProjectRepositoryImages->created_by = Auth::user()->id;
            $ProjectRepositoryImages->save();
            return $ProjectRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($threeDimentionalViewVideoDTO);
            $image = $threeDimentionalViewVideoDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/project_repository/3dvideo_files/';
            $image->move(public_path() . $path, $file_name);
            $ProjectRepositoryImages = new ProjectRepositoryImages();
            $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
            $ProjectRepositoryImages->file_type = '3dvideo_files';
            $ProjectRepositoryImages->file_path = $path;
            $ProjectRepositoryImages->file_name = $path . $file_name;
            $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
            $ProjectRepositoryImages->created_by = Auth::user()->id;
            $ProjectRepositoryImages->save();
            return $ProjectRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($floorPlanFileRequestDTO);
            $image = $floorPlanFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/project_repository/floor_file/';
            $image->move(public_path() . $path, $file_name);
            $ProjectRepositoryImages = new ProjectRepositoryImages();
            $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
            $ProjectRepositoryImages->file_type = 'floor_file';
            $ProjectRepositoryImages->file_path = $path;
            $ProjectRepositoryImages->file_name = $path . $file_name;
            $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
            $ProjectRepositoryImages->created_by = Auth::user()->id;
            $ProjectRepositoryImages->save();
            return $ProjectRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO)
    {
        try {
            $ProjectRepository = $this->addProjectRepository($otherFileRequestDTO);
            $image = $otherFileRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/others/';
            $image->move(public_path() . '/' . $path, $file_name);
            $imagePath = $path . $file_name;

            $otherRepositoryImage = new OtherCompliances();
            $otherRepositoryImage->form_id = 1;
            $otherRepositoryImage->repository_id = $ProjectRepository->id;
            $otherRepositoryImage->name = $otherFileRequestDTO->name;
            $otherRepositoryImage->image = $imagePath;
            $otherRepositoryImage->created_at = date('Y-m-d H:i:s');
            $otherRepositoryImage->updated_at = date('Y-m-d H:i:s');
            $otherRepositoryImage->created_by = Auth::user()->id;
            $otherRepositoryImage->save();
            return $otherRepositoryImage;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function addProjectRepositoryLink(AddProjectRepositoryRequestDTO $addProjectRepositoryRequestDTO)
    {
        $occurance = ProjectRepository::where('id', '!=', 0)
            ->where('property_id', $addProjectRepositoryRequestDTO->property_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $ProjectRepository = ProjectRepository::create([
                'gis_id' => $addProjectRepositoryRequestDTO->gis_id,
                'cat_id' => $addProjectRepositoryRequestDTO->cat_id,
                'property_id' => $addProjectRepositoryRequestDTO->property_id,
                'residential_type' => $addProjectRepositoryRequestDTO->residential_type,
                'residential_sub_type' => $addProjectRepositoryRequestDTO->residential_sub_type,
                // 'website_link' => $addProjectRepositoryRequestDTO->website,
                'youtube_link' => $addProjectRepositoryRequestDTO->youtube_link,
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $ProjectRepository = ProjectRepository::updateOrCreate(
                ['id' => $repo_id],
                [
                    'gis_id' => $addProjectRepositoryRequestDTO->gis_id,
                    'cat_id' => $addProjectRepositoryRequestDTO->cat_id,
                    'property_id' => $addProjectRepositoryRequestDTO->property_id,
                    'residential_type' => $addProjectRepositoryRequestDTO->residential_type,
                    'residential_sub_type' => $addProjectRepositoryRequestDTO->residential_sub_type,
                    // 'website_link' => $addProjectRepositoryRequestDTO->website,
                    'youtube_link' => $addProjectRepositoryRequestDTO->youtube_link,
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        return $ProjectRepository;
    }

    public function addProjectRepository($inputRequest)
    {
        $occurance = ProjectRepository::where('id', '!=', 0)
            ->where('property_id', $inputRequest->property_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $ProjectRepository = ProjectRepository::create([
                'gis_id' => $inputRequest->gis_id,
                'cat_id' => $inputRequest->cat_id,
                'property_id' => $inputRequest->property_id,
                'residential_type' => $inputRequest->residential_type,
                'residential_sub_type' => $inputRequest->residential_sub_type,
                // 'website_link' => $inputRequest->website,
                // 'youtube_link' => $inputRequest->youtube_link,
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $ProjectRepository = ProjectRepository::updateOrCreate(
                ['id' => $repo_id],
                [
                    'gis_id' => $inputRequest->gis_id,
                    'cat_id' => $inputRequest->cat_id,
                    'property_id' => $inputRequest->property_id,
                    'residential_type' => $inputRequest->residential_type,
                    'residential_sub_type' => $inputRequest->residential_sub_type,
                    // 'website_link' => $inputRequest->website,
                    // 'youtube_link' => $inputRequest->youtube_link,
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        return $ProjectRepository;
    }

    public function deleteFile($id)
    {
        $property_img = ProjectRepositoryImages::find($id);
        if ($property_img) {
            $fileToDelete = public_path($property_img->file_name);

            if (file_exists($fileToDelete)) {
                if (unlink($fileToDelete)) {
                    // echo 'File deleted successfully.';
                } else {
                    // echo 'Unable to delete the file.';
                }
            } else {
                // echo 'File not found.';
            }
            $delete = ProjectRepositoryImages::destroy($id);
            return $delete;
        }
    }
    public function deleteOtherFile($id)
    {
        $property_img = OtherCompliances::find($id);
        if ($property_img) {
            $fileToDelete = public_path($property_img->image);

            if (file_exists($fileToDelete)) {
                if (unlink($fileToDelete)) {
                    // echo 'File deleted successfully.';
                } else {
                    // echo 'Unable to delete the file.';
                }
            } else {
                // echo 'File not found.';
            }
            $delete = OtherCompliances::destroy($id);
            return $delete;
        }
    }
}
