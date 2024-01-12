<?php
namespace App\Repositories\GatedCommunity;

use App\DTO\GatedCommunity\BlockRepositories\{AddBlockRepositoryRequestDTO, ThreeDimentionalViewVideoRequestDTO, ImageFileRequestDTO, FloorPlanFileRequestDTO, OtherFileRequestDTO, TowerVideoRequestDTO};
use App\Models\{BlockTowerRepository, BlockTowerRepositoryImages, OtherCompliances};
use Illuminate\Support\Facades\Auth;

class BlockRepositoryFilesRepository implements IBlockRepositoryFilesRepository
{
    public function floorPlanFile(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        try {
            $blockTowerRepository = $this->addBlockRepository($floorPlanFileRequestDTO);
            $image = $floorPlanFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/block_towers_repository/floor_plan/';
            $image->move(public_path() . $path, $file_name);
            $blockTowerRepositoryImages = new BlockTowerRepositoryImages();
            $blockTowerRepositoryImages->block_tower_id = $blockTowerRepository->id;
            $blockTowerRepositoryImages->file_type = 'floor_plan';
            $blockTowerRepositoryImages->file_path = $path;
            $blockTowerRepositoryImages->file_name = $path . $file_name;
            $blockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
            $blockTowerRepositoryImages->created_by = Auth::user()->id;
            $blockTowerRepositoryImages->save();
            return $blockTowerRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function imageFiles(ImageFileRequestDTO $imageFileRequestDTO)
    {
        try {
            $blockTowerRepository = $this->addBlockRepository($imageFileRequestDTO);
            $image = $imageFileRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/block_towers_repository/image_files/';
            $image->move(public_path() . $path, $file_name);
            $blockTowerRepositoryImages = new BlockTowerRepositoryImages();
            $blockTowerRepositoryImages->block_tower_id = $blockTowerRepository->id;
            $blockTowerRepositoryImages->file_type = 'image_files';
            $blockTowerRepositoryImages->file_path = $path;
            $blockTowerRepositoryImages->file_name = $path . $file_name;
            $blockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
            $blockTowerRepositoryImages->created_by = Auth::user()->id;
            $blockTowerRepositoryImages->save();
            return $blockTowerRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function threeDimentionalViewVideo(ThreeDimentionalViewVideoRequestDTO $threeDimentionalViewVideoRequestDTO)
    {
        try {
            $blockTowerRepository = $this->addBlockRepository($threeDimentionalViewVideoRequestDTO);
            $image = $threeDimentionalViewVideoRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/block_towers_repository/3dvideo/';
            $image->move(public_path() . $path, $file_name);
            $blockTowerRepositoryImages = new BlockTowerRepositoryImages();
            $blockTowerRepositoryImages->block_tower_id = $blockTowerRepository->id;
            $blockTowerRepositoryImages->file_type = '3dvideo';
            $blockTowerRepositoryImages->file_path = $path;
            $blockTowerRepositoryImages->file_name = $path . $file_name;
            $blockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
            $blockTowerRepositoryImages->created_by = Auth::user()->id;
            $blockTowerRepositoryImages->save();
            return $blockTowerRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function towerVideo(TowerVideoRequestDTO $towerVideoRequestDTO)
    {
        try {
            $blockTowerRepository = $this->addBlockRepository($towerVideoRequestDTO);
            $image = $towerVideoRequestDTO->file;
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = '/uploads/block_towers_repository/tower_video/';
            $image->move(public_path() . $path, $file_name);
            $blockTowerRepositoryImages = new BlockTowerRepositoryImages();
            $blockTowerRepositoryImages->block_tower_id = $blockTowerRepository->id;
            $blockTowerRepositoryImages->file_type = 'tower_video';
            $blockTowerRepositoryImages->file_path = $path;
            $blockTowerRepositoryImages->file_name = $path . $file_name;
            $blockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
            $blockTowerRepositoryImages->created_by = Auth::user()->id;
            $blockTowerRepositoryImages->save();
            return $blockTowerRepositoryImages;
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function otherMediaFiles(OtherFileRequestDTO $otherFileRequestDTO)
    {
        try {
            $blockTowerRepository = $this->addBlockRepository($otherFileRequestDTO);
            $image = $otherFileRequestDTO->file;
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/others/';
            $image->move(public_path() . '/' . $path, $file_name);
            $imagePath = $path . $file_name;

            $otherRepositoryImage = new OtherCompliances();
            $otherRepositoryImage->form_id = 2;
            $otherRepositoryImage->repository_id = $blockTowerRepository->id;
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

    public function addBlockRepositoryLink(AddBlockRepositoryRequestDTO $addBlockRepositoryRequestDTO)
    {
        $occurance = BlockTowerRepository::where('id', '!=', 0)
            ->where('property_id', $addBlockRepositoryRequestDTO->property_id)
            ->where('block_tower_id', $addBlockRepositoryRequestDTO->block_tower_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $blockTowerRepository = BlockTowerRepository::create([
                'gis_id' => $addBlockRepositoryRequestDTO->gis_id,
                'cat_id' => $addBlockRepositoryRequestDTO->cat_id,
                'property_id' => $addBlockRepositoryRequestDTO->property_id,
                'residential_type' => $addBlockRepositoryRequestDTO->residential_type,
                'residential_sub_type' => $addBlockRepositoryRequestDTO->residential_sub_type,
                'block_tower_id' => $addBlockRepositoryRequestDTO->block_tower_id,
                // 'website_link' => $addBlockRepositoryRequestDTO->website,
                'youtube_link' => $addBlockRepositoryRequestDTO->youtube_link,
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $blockTowerRepository = BlockTowerRepository::updateOrCreate(
                ['id' => $repo_id],
                [
                    'gis_id' => $addBlockRepositoryRequestDTO->gis_id,
                    'cat_id' => $addBlockRepositoryRequestDTO->cat_id,
                    'property_id' => $addBlockRepositoryRequestDTO->property_id,
                    'residential_type' => $addBlockRepositoryRequestDTO->residential_type,
                    'residential_sub_type' => $addBlockRepositoryRequestDTO->residential_sub_type,
                    'block_tower_id' => $addBlockRepositoryRequestDTO->block_tower_id,
                    // 'website_link' => $addBlockRepositoryRequestDTO->website,
                    'youtube_link' => $addBlockRepositoryRequestDTO->youtube_link,
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        return $blockTowerRepository;
    }

    public function deleteFile($id)
    {
        $property_img = BlockTowerRepositoryImages::find($id);
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
            $delete = BlockTowerRepositoryImages::destroy($id);
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

    public function addBlockRepository($inputRequest)
    {
        $occurance = BlockTowerRepository::where('property_id', $inputRequest->property_id)
            ->where('block_tower_id', $inputRequest->block_tower_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $blockTowerRepository = new BlockTowerRepository();
            $blockTowerRepository->gis_id = $inputRequest->gis_id;
            $blockTowerRepository->cat_id = $inputRequest->cat_id;
            $blockTowerRepository->property_id = $inputRequest->property_id;
            $blockTowerRepository->residential_type = $inputRequest->residential_type;
            $blockTowerRepository->residential_sub_type = $inputRequest->residential_sub_type;
            $blockTowerRepository->block_tower_id = $inputRequest->block_tower_id;
            // $blockTowerRepository->youtube_link = $inputRequest->youtube_link;
            $blockTowerRepository->created_by = Auth::user()->id;

            $blockTowerRepository->save();
        } else {
            $blockTowerRepository = BlockTowerRepository::find($repo_id);
            $blockTowerRepository->gis_id = $inputRequest->gis_id;
            $blockTowerRepository->cat_id = $inputRequest->cat_id;
            $blockTowerRepository->property_id = $inputRequest->property_id;
            $blockTowerRepository->residential_type = $inputRequest->residential_type;
            $blockTowerRepository->residential_sub_type = $inputRequest->residential_sub_type;
            $blockTowerRepository->block_tower_id = $inputRequest->block_tower_id;
            // $blockTowerRepository->youtube_link = $inputRequest->youtube_link;
            $blockTowerRepository->created_by = Auth::user()->id;
            $blockTowerRepository->save();
        }
        return $blockTowerRepository;
    }
}
