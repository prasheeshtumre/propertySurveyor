<?php

namespace App\Http\Controllers\GatedCommunity;

use App\Http\Controllers\Controller;
use App\Models\OtherCompliances;
use App\Models\ProjectRepository;
use App\Models\ProjectRepositoryImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RepositoriesController extends Controller
{
    public function brochure_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ProjectRepository = $this->addProjectRepository($request);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
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
        }
        if ($ProjectRepositoryImages) {
            return response()->json(['success' => $file_name, 'id' => $ProjectRepositoryImages->id], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }
    public function promotional_video_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ProjectRepository = $this->addProjectRepository($request);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
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
        }
        if ($ProjectRepositoryImages) {
            return response()->json(['success' => $file_name, 'id' => $ProjectRepositoryImages->id], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }
    public function image_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ProjectRepository = $this->addProjectRepository($request);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
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
        }
        if ($ProjectRepositoryImages) {
            return response()->json(['success' => $file_name, 'id' => $ProjectRepositoryImages->id], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }

    public function view_video_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ProjectRepository = $this->addProjectRepository($request);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
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
        }
        if ($ProjectRepositoryImages) {
            return response()->json(['success' => $file_name, 'id' => $ProjectRepositoryImages->id], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }

    public function floor_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ProjectRepository = $this->addProjectRepository($request);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
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
        }
        if ($ProjectRepositoryImages) {
            return response()->json(['success' => $file_name, 'id' => $ProjectRepositoryImages->id], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }

    public function other_files(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            ],
            [
                'file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $ProjectRepository = $this->addProjectRepository($request);

        $images = $request->file('file');
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/others/';
            $image->move(public_path() . '/' . $path, $file_name);
            $imagePath = $path . $file_name;

            $otherRepositoryImage = OtherCompliances::create([
                'form_id' => '1',
                'repository_id' => $ProjectRepository->id,
                'name' => $request->input('name'),
                'image' => $imagePath,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
            ]);
        }

        if ($otherRepositoryImage) {
            return response()->json(['success' => $file_name, 'id' => $otherRepositoryImage->id, 'other_files' => true], 200);
        } else {
            return response()->json(['message' => 'Upload Failed'], 422);
        }
    }

    public function destroy(Request $request, $id)
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
                echo 'File not found.';
            }
            ProjectRepositoryImages::destroy($id);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Repository image Deleted Successfully',
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Please Try Again Later',
                ],
                400,
            );
        }

        // return $id;
    }
    public function destroy_other_files(Request $request, $id)
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
                echo 'File not found.';
            }
            OtherCompliances::destroy($id);
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Repository image Deleted Successfully',
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Please Try Again Later',
                ],
                400,
            );
        }

        // return $id;
    }

    public function addProjectRepository(Request $request)
    {
        $occurance = ProjectRepository::where('id', '!=', 0)
            ->where('property_id', $request->property_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $ProjectRepository = ProjectRepository::create([
                'gis_id' => $request->input('gis_id'),
                'cat_id' => $request->input('cat_id'),
                'property_id' => $request->input('property_id'),
                'residential_type' => $request->input('residential_type'),
                'residential_sub_type' => $request->input('residential_sub_type'),
                // 'website_link' => $request->input('website'),
                // 'youtube_link' => $request->input('youtube_link'),
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $ProjectRepository = ProjectRepository::updateOrCreate(
                ['id' => $repo_id],
                [
                    'gis_id' => $request->input('gis_id'),
                    'cat_id' => $request->input('cat_id'),
                    'property_id' => $request->input('property_id'),
                    'residential_type' => $request->input('residential_type'),
                    'residential_sub_type' => $request->input('residential_sub_type'),
                    // 'website_link' => $request->input('website'),
                    // 'youtube_link' => $request->input('youtube_link'),
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        return $ProjectRepository;
    }

    public function add_project_repository(Request $request)
    {
        $validator = Validator::make($request->all(), ['youtube_link' => 'nullable|url']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $occurance = ProjectRepository::where('id', '!=', 0)
        ->where('property_id', $request->property_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $ProjectRepository = ProjectRepository::create([
                'gis_id' => $request->input('gis_id'),
                'cat_id' => $request->input('cat_id'),
                'property_id' => $request->input('property_id'),
                'residential_type' => $request->input('residential_type'),
                'residential_sub_type' => $request->input('residential_sub_type'),
                // 'website_link' => $request->input('website'),
                'youtube_link' => $request->input('youtube_link'),
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $ProjectRepository = ProjectRepository::updateOrCreate(
                ['id' => $repo_id],
                [
                    'gis_id' => $request->input('gis_id'),
                    'cat_id' => $request->input('cat_id'),
                    'property_id' => $request->input('property_id'),
                    'residential_type' => $request->input('residential_type'),
                    'residential_sub_type' => $request->input('residential_sub_type'),
                    // 'website_link' => $request->input('website'),
                    'youtube_link' => $request->input('youtube_link'),
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        if ($ProjectRepository) {
            return response()->json(['message' => 'Project repository data saved successfully', 'comp_id' => $ProjectRepository->id], 200);
        } else {
            return response()->json(['message' => 'Something went wrong'], 502);
        }
    }
}
