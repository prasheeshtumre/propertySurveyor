<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\DTO\CommercialTower\ProjectRepositories\{AddProjectRepositoryRequestDTO, BrochureFileRequestDTO, FloorPlanFileRequestDTO, ImageFileRequestDTO, OtherFileRequestDTO, PromotionalVideoFileRequestDTO, ThreeDimentionalViewVideoDTO};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Block, BlockTowerRepository, BlockTowerRepositoryImages, OtherCompliances, ProjectRepository, ProjectRepositoryImages, Property, Tower};
use App\Services\CommercialTower\CTProjectRepositoryFilesService;
use File;
use Validator;
use Auth;

class CTRepositoriesController extends Controller
{
    public $ctProjectRepositoryFilesService;

    function __construct(CTProjectRepositoryFilesService $ctProjectRepositoryFilesService)
    {
        $this->ctProjectRepositoryFilesService = $ctProjectRepositoryFilesService;
    }
    public function repositories(Request $request)
    {
        // return $request->all();
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        $block_tower = Block::select('id', 'block_name as name')
            ->where('property_id', $request->property_id)
            ->where('no_of_blocks', '>', 0)
            ->get();
        if (count($block_tower) == 0) {
            $block_tower = Tower::select('id', 'tower_name as name')
                ->where('property_id', $request->property_id)
                ->where('no_of_towers', '>', 0)
                ->get();
        }
        $project_repository = ProjectRepository::where('property_id', $request->property_id)->first();
        if (isset($request->block_tower_id)) {
            $block_tower_repository = BlockTowerRepository::where('property_id', $request->property_id)
                ->where('block_tower_id', $request->block_tower_id)
                ->first();
        } else {
            $block_tower_repository = BlockTowerRepository::where('property_id', $request->property_id)->first();
        }

        $block_id = $request->block_id;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($project_repository->media_files)) {
            foreach ($project_repository->media_files as $key => $image) {
                $project_repository_files[$image->file_type][$key] = asset($image->file_name);
            }
        }

        if (isset($project_repository->other_files)) {
            foreach ($project_repository->other_files->where('form_id', 1) as $key => $image) {
                if (!empty($image->image)) {
                    $project_repository_other_files[$key] = asset($image->image);
                    $project_repository_other_file_name[$key] = $image->name;
                }
            }
        }

        if (isset($block_tower_repository->media_files)) {
            foreach ($block_tower_repository->media_files as $key => $image) {
                $block_tower_repository_files[$image->file_type][$key] = asset($image->file_name);
            }
        }

        if (isset($block_tower_repository->other_files)) {
            foreach ($block_tower_repository->other_files->where('form_id', 2) as $key => $image) {
                $block_tower_repository_other_files[$key] = asset($image->image);
                $block_tower_repository_other_file_name[$key] = $image->name;
            }
        }

        return view('admin.pages.property.commercial_tower_gated_community.repositories.index', get_defined_vars());
    }

    // public function project_repository(Request $request)
    // {
    //     // dd($request->all());
    //     // Validate the form data
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             // 'website' => 'required',
    //             // 'brochure_file' => 'required',
    //             'brochure_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
    //             // 'video_files' => 'required',
    //             'video_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
    //             // 'image_files' => 'required',
    //             'image_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
    //             // '3dvideo_files' => 'required',
    //             '3dvideo_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
    //             // 'floor_file' => 'required',
    //             'floor_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',

    //             'addFloor.*' => 'file|mimes:jpeg,jpg,png,mp4,pdf',
    //         ],
    //         [
    //             'brochure_file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //             'video_files.*.mimes' => 'The Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //             'image_files.*.mimes' => 'The Image must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //             '3dvideo_files.*.mimes' => 'The 3D Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //             'floor_file.*.mimes' => 'The Floor file must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //             'addFloor.*.mimes' => 'The Other File must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
    //         ],
    //     );

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }
    //     //exit;

    //     $occurance = ProjectRepository::where('id', '!=', 0)
    //         ->where('property_id', $request->property_id)
    //         ->first();
    //     $repo_id = $occurance ? $occurance->id : 0;

    //     // Process and store the form data
    //     if ($repo_id == 0) {
    //         $ProjectRepository = ProjectRepository::create([
    //             'gis_id' => $request->input('gis_id'),
    //             'cat_id' => $request->input('cat_id'),
    //             'property_id' => $request->input('property_id'),
    //             'residential_type' => $request->input('residential_type'),
    //             'residential_sub_type' => $request->input('residential_sub_type'),
    //             'website_link' => $request->input('website'),
    //             'youtube_link' => $request->input('youtube_link'),
    //             'created_by' => Auth::user()->id,
    //         ]);
    //     } else {
    //         $ProjectRepository = ProjectRepository::updateOrCreate(
    //             ['id' => $repo_id],
    //             [
    //                 'gis_id' => $request->input('gis_id'),
    //                 'cat_id' => $request->input('cat_id'),
    //                 'property_id' => $request->input('property_id'),
    //                 'residential_type' => $request->input('residential_type'),
    //                 'residential_sub_type' => $request->input('residential_sub_type'),
    //                 'website_link' => $request->input('website'),
    //                 'youtube_link' => $request->input('youtube_link'),
    //                 'created_by' => Auth::user()->id,
    //             ],
    //         );
    //     }

    //     // exit;
    //     // // Process and store the form data
    //     // $ProjectRepository = new ProjectRepository();

    //     // $ProjectRepository->save();

    //     // Store GHMC approval files
    //     if ($request->hasFile('brochure_file')) {
    //         foreach ($request->file('brochure_file') as $image) {
    //             $name = $image->getClientOriginalName();
    //             $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
    //             $path = '/uploads/project_repository/brochure/';
    //             $image->move(public_path() . $path, $file_name);
    //             $ProjectRepositoryImages = new ProjectRepositoryImages();
    //             $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
    //             $ProjectRepositoryImages->file_type = 'brochure';
    //             $ProjectRepositoryImages->file_path = $path;
    //             $ProjectRepositoryImages->file_name = $path . $file_name;
    //             $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
    //             $ProjectRepositoryImages->created_by = Auth::user()->id;
    //             $ProjectRepositoryImages->save();
    //         }
    //     }

    //     // Store Commencement Certificate files
    //     if ($request->hasFile('video_files')) {
    //         foreach ($request->file('video_files') as $image) {
    //             $name = $image->getClientOriginalName();
    //             $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
    //             $path = '/uploads/project_repository/video_files/';
    //             $image->move(public_path() . $path, $file_name);
    //             $ProjectRepositoryImages = new ProjectRepositoryImages();
    //             $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
    //             $ProjectRepositoryImages->file_type = 'video_files';
    //             $ProjectRepositoryImages->file_path = $path;
    //             $ProjectRepositoryImages->file_name = $path . $file_name;
    //             $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
    //             $ProjectRepositoryImages->created_by = Auth::user()->id;
    //             $ProjectRepositoryImages->save();
    //         }
    //     }

    //     // Store RERA Approval files
    //     if ($request->hasFile('image_files')) {
    //         foreach ($request->file('image_files') as $image) {
    //             $name = $image->getClientOriginalName();
    //             $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
    //             $path = '/uploads/project_repository/image_files/';
    //             $image->move(public_path() . $path, $file_name);
    //             $ProjectRepositoryImages = new ProjectRepositoryImages();
    //             $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
    //             $ProjectRepositoryImages->file_type = 'image_files';
    //             $ProjectRepositoryImages->file_path = $path;
    //             $ProjectRepositoryImages->file_name = $path . $file_name;
    //             $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
    //             $ProjectRepositoryImages->created_by = Auth::user()->id;
    //             $ProjectRepositoryImages->save();
    //         }
    //     }

    //     // Store DTCP/HMDA Approval files
    //     if ($request->hasFile('3dvideo_files')) {
    //         foreach ($request->file('3dvideo_files') as $image) {
    //             $name = $image->getClientOriginalName();
    //             $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
    //             $path = '/uploads/project_repository/3dvideo_files/';
    //             $image->move(public_path() . $path, $file_name);
    //             $ProjectRepositoryImages = new ProjectRepositoryImages();
    //             $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
    //             $ProjectRepositoryImages->file_type = '3dvideo_files';
    //             $ProjectRepositoryImages->file_path = $path;
    //             $ProjectRepositoryImages->file_name = $path . $file_name;
    //             $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
    //             $ProjectRepositoryImages->created_by = Auth::user()->id;
    //             $ProjectRepositoryImages->save();
    //         }
    //     }

    //     // Store Legal Document files
    //     if ($request->hasFile('floor_file')) {
    //         foreach ($request->file('floor_file') as $image) {
    //             $name = $image->getClientOriginalName();
    //             $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
    //             $path = '/uploads/project_repository/floor_file/';
    //             $image->move(public_path() . $path, $file_name);

    //             $ProjectRepositoryImages = new ProjectRepositoryImages();
    //             $ProjectRepositoryImages->repository_id = $ProjectRepository->id;
    //             $ProjectRepositoryImages->file_type = 'floor_file';
    //             $ProjectRepositoryImages->file_path = $path;
    //             $ProjectRepositoryImages->file_name = $path . $file_name;
    //             $ProjectRepositoryImages->created_at = date('Y-m-d H:i:s');
    //             $ProjectRepositoryImages->created_by = Auth::user()->id;
    //             $ProjectRepositoryImages->save();
    //         }
    //     }

    //     $names = $request->input('name', []);
    //     $count_images = count($names);
    //     $images = $request->file('addFloor');
    //     if (!empty($request->input('name'))) {
    //         foreach ($names as $key => $name) {
    //             if ($name != null) {
    //                 $imagePath = ''; // Placeholder for image path
    //                 if ($images && isset($images[$count_images + $key])) {
    //                     $image = $images[$count_images + $key];
    //                     $extension = $image->getClientOriginalExtension();
    //                     $fileName = uniqid() . '.' . $extension;
    //                     $path = 'uploads/others/';
    //                     $image->move(public_path($path), $fileName);
    //                     $imagePath = $path . $fileName;
    //                 }

    //                 OtherCompliances::create([
    //                     'form_id' => '1',
    //                     'repository_id' => $ProjectRepository->id,
    //                     'name' => $name,
    //                     'image' => $imagePath,
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'updated_at' => date('Y-m-d H:i:s'),
    //                     'created_by' => Auth::user()->id,
    //                 ]);
    //             }
    //         }
    //     }

    //     return response()->json(['message' => 'Project repository data saved successfully', 'comp_id' => $ProjectRepository->id], 200);
    // }


    public function brochure_files(BrochureFileRequestDTO $brochureFileRequestDTO)
    {
        try {
            $brochureFile = $this->ctProjectRepositoryFilesService->projectBroucher($brochureFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $brochureFile['id'], 'remove_url' => route('commercial-tower.repositories.destroy', $brochureFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }

    public function promotional_video_files(PromotionalVideoFileRequestDTO $promotionalVideoFileRequestDTO)
    {
        try {
            $promotionalVideoFile = $this->ctProjectRepositoryFilesService->projectPromotionalVideo($promotionalVideoFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $promotionalVideoFile['id'], 'remove_url' => route('commercial-tower.repositories.destroy', $promotionalVideoFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                // exception_logging($e);
            }
        }
    }
    public function image_files(ImageFileRequestDTO $imageFileRequestDTO)
    {
        try {
            $imageFile = $this->ctProjectRepositoryFilesService->projectImageFile($imageFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $imageFile['id'], 'remove_url' => route('commercial-tower.repositories.destroy', $imageFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function view_video_files(ThreeDimentionalViewVideoDTO $threeDimentionalViewVideoDTO)
    {
        try {
            $threeDimentionalViewVideo = $this->ctProjectRepositoryFilesService->threeDimentionalViewVideo($threeDimentionalViewVideoDTO);
            return response()->json(['status' => true, 'file_id' => $threeDimentionalViewVideo['id'], 'remove_url' => route('commercial-tower.repositories.destroy', $threeDimentionalViewVideo['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }
    public function floor_files(FloorPlanFileRequestDTO $floorPlanFileRequestDTO)
    {
        try {
            $floorPlanFile = $this->ctProjectRepositoryFilesService->floorPlanFile($floorPlanFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $floorPlanFile['id'], 'remove_url' => route('commercial-tower.repositories.destroy', $floorPlanFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function other_files(OtherFileRequestDTO $otherFileRequestDTO)
    {
        try {
            $otherFile = $this->ctProjectRepositoryFilesService->otherMediaFiles($otherFileRequestDTO);
            return response()->json(['status' => true, 'file_id' => $otherFile['id'], 'remove_url' => route('commercial-tower.repositories.destroy-other-files', $otherFile['id'])], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }

    public function destroy($id)
    {
        try {
            $deleteFile = $this->ctProjectRepositoryFilesService->deleteFile($id);
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
            $deleteOtherFile = $this->ctProjectRepositoryFilesService->deleteOtherFile($id);
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
            $ProjectRepository = $this->ctProjectRepositoryFilesService->addProjectRepositoryLink($addProjectRepositoryRequestDTO);
            return response()->json(['message' => 'Project repository data saved successfully', 'comp_id' => $ProjectRepository->id], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
            }
        }
    }
}
