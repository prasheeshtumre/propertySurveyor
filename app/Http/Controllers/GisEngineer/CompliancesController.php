<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PropertiesExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FloorType;
use App\Models\ProjectStatus;
use App\Models\Property;
use App\Models\SecondaryFeatures;
use App\Models\SecondaryFeaturesOptions;
use App\Models\UnderConstruction;
use App\Models\Compliances;
use App\Models\ProjectRepository;
use App\Models\CompliancesImages;
use App\Models\ProjectRepositoryImages;
use App\Models\OtherCompliances;
use App\Models\BlockTowerRepositoryImages;
use App\Models\BlockTowerRepository;
use App\Models\Unit;

use Auth;
use Carbon\Carbon;
use DataTables;
use DateTime;
use DB;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Stevebauman\Location\Facades\Location;
use File;
use Validator;

class CompliancesController extends Controller
{
    public function store_compliances(Request $request)
    {
        // dd($request->all());
        // Validate the form data

        $add_validation_rules = [
            'ghmc_radio' => 'required|in:1,0',
            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            'comm_radio' => 'required|in:1,0',
            'commenc_file' => 'required_if:comm_radio,1',
            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
            //'rear_number' => 'required',
            //'rear_file' => 'required',
            //'rear_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
            //'hmda_number' => 'required',
            //'hmda_file' => 'required',
            //'hmda_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
            //'legal_files' => 'required',
            //'legal_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,qt,pdf|max:5000',
        ];
        $add_messages = [
            'ghmc_radio.required' => 'The GHMC Approval field is required.',
            'comm_radio.required' => 'The Commencement Certificate field is required.',
            'ghmc_approval_file.required_if' => 'The GHMC Approval Copy file is required.',
            'commenc_file.required_if' => 'The Commencement Certificate file field is required.',
            'ghmc_approval_file.*.mimes' => 'The GHMC Approval Copy must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            'commenc_file.*.mimes' => 'The Commencement Certificate must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
        ];

        $occurance = Compliances::where('id', '!=', 0)
            ->where('property_id', $request->property_id)
            ->first();
        if ($occurance) {
            if ($request->ghmc_radio == 1) {
                $ghmc_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'ghmc')
                    ->count();
                $commec_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'commenc')
                    ->count();
                if ($request->comm_radio == 1) {
                    if ($ghmc_files == 0 && $commec_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'commenc_file' => 'required_if:comm_radio,1',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } elseif ($commec_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'commenc_file' => 'required_if:comm_radio,1',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } elseif ($ghmc_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } else {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    }
                } else {
                    if ($ghmc_files == 0) {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'ghmc_approval_file' => 'required_if:ghmc_radio,1',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    } else {
                        $update_validation_rules = [
                            'ghmc_radio' => 'required|in:1,0',
                            'comm_radio' => 'required|in:1,0',
                            'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                            'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        ];
                    }
                }
            } elseif ($request->comm_radio == 1) {
                $commec_files = CompliancesImages::where('comp_id', $occurance->id)
                    ->where('file_type', 'commenc')
                    ->count();

                if ($commec_files == 0) {
                    $update_validation_rules = [
                        'ghmc_radio' => 'required|in:1,0',
                        'comm_radio' => 'required|in:1,0',
                        'commenc_file' => 'required_if:comm_radio,1',
                        'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    ];
                } else {
                    $update_validation_rules = [
                        'ghmc_radio' => 'required|in:1,0',
                        'comm_radio' => 'required|in:1,0',
                        'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                        'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    ];
                }
            } else {
                $update_validation_rules = [
                    'ghmc_radio' => 'required|in:1,0',
                    'comm_radio' => 'required|in:1,0',
                    'ghmc_approval_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                    'commenc_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                ];
            }
        }
        $compliance_id = $occurance ? $occurance->id : 0;

        if ($compliance_id == 0) {
            $validator = Validator::make($request->all(), $add_validation_rules, $add_messages);
        } else {
            $validator = Validator::make($request->all(), $update_validation_rules, $add_messages);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // exit();

        // Process and store the form data

        // dd($compliance_id);
        if ($compliance_id == 0) {
            $compliance = Compliances::create([
                'gis_id' => $request->input('gis_id'),
                'cat_id' => $request->input('cat_id'),
                'property_id' => $request->input('property_id'),
                'residential_type' => $request->input('residential_type'),
                'residential_sub_type' => $request->input('residential_sub_type'),
                'ghmc_radio' => $request->input('ghmc_radio'),
                'comm_certifi_radio' => $request->input('comm_radio'),
                'rear_number' => isset($request->rear_number) ? $request->rear_number : null,
                'hdma_number' => $request->input('hmda_number'),
                'created_by' => Auth::user()->id,
            ]);
        } else {
            $compliance = Compliances::updateOrCreate(
                ['id' => $compliance_id],
                [
                    'gis_id' => $request->input('gis_id'),
                    'cat_id' => $request->input('cat_id'),
                    'property_id' => $request->input('property_id'),
                    'residential_type' => $request->input('residential_type'),
                    'residential_sub_type' => $request->input('residential_sub_type'),
                    'ghmc_radio' => $request->input('ghmc_radio'),
                    'comm_certifi_radio' => $request->input('comm_radio'),
                    'rear_number' => isset($request->rear_number) ? $request->rear_number : null,
                    'hdma_number' => $request->input('hmda_number'),
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        // Store GHMC approval files
        if ($request->hasFile('ghmc_approval_file')) {
            foreach ($request->file('ghmc_approval_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/ghmc/';
                // $image->move(public_path() .$path, $file_name);
                $image->move(public_path() . '/uploads/compliances/ghmc/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'ghmc';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        if (isset($request->ghmc_file_id)) {
            if ($request->ghmc_radio == 0) {
                foreach ($request->ghmc_file_id as $key => $id) {
                    // return public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]);
                    if (File::exists(public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]))) {
                        File::delete(public_path('/uploads/compliances/ghmc/' . $request->ghmc_old_file[$key]));
                        $delete = CompliancesImages::where('id', $id)->delete();
                    }
                }
            }
        }

        // Store Commencement Certificate files
        if ($request->hasFile('commenc_file')) {
            foreach ($request->file('commenc_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/commenc/';
                $image->move(public_path() . '/uploads/compliances/commenc/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'commenc';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        if (isset($request->commenc_file_id)) {
            if ($request->comm_radio == 0) {
                foreach ($request->commenc_file_id as $key => $id) {
                    if (File::exists(public_path('/uploads/compliances/commenc/' . $request->commenc_old_file[$key]))) {
                        File::delete(public_path('/uploads/compliances/commenc/' . $request->commenc_old_file[$key]));
                        $delete = CompliancesImages::where('id', $id)->delete();
                    }
                }
            }
        }

        // Store RERA Approval files
        if ($request->hasFile('rear_file')) {
            foreach ($request->file('rear_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/rear/';
                $image->move(public_path() . '/uploads/compliances/rear/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'rear';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        // Store DTCP/HMDA Approval files
        if ($request->hasFile('hmda_file')) {
            foreach ($request->file('hmda_file') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/hmda/';
                $image->move(public_path() . '/uploads/compliances/hmda/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'hmda';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        // Store Legal Document files
        if ($request->hasFile('legal_files')) {
            foreach ($request->file('legal_files') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/compliances/legal/';
                $image->move(public_path() . '/uploads/compliances/legal/', $file_name);
                $CompliancesImages = new CompliancesImages();
                $CompliancesImages->comp_id = $compliance->id;
                $CompliancesImages->file_type = 'legal';
                $CompliancesImages->file_path = $path;
                $CompliancesImages->file_name = $file_name;
                $CompliancesImages->created_at = date('Y-m-d H:i:s');
                $CompliancesImages->created_by = Auth::user()->id;
                $CompliancesImages->save();
            }
        }

        return response()->json(['message' => 'Compliance data saved successfully', 'comp_id' => $compliance->id], 200);
    }

    public function project_repository(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        $validator = Validator::make(
            $request->all(),
            [
                // 'website' => 'required',
                // 'brochure_file' => 'required',
                'brochure_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                // 'video_files' => 'required',
                'video_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                // 'image_files' => 'required',
                'image_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                // '3dvideo_files' => 'required',
                '3dvideo_files.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                // 'floor_file' => 'required',
                'floor_file.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',

                'addFloor.*' => 'file|mimes:jpeg,jpg,png,mp4,pdf',
            ],
            [
                'brochure_file.*.mimes' => 'The Brochure must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'video_files.*.mimes' => 'The Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'image_files.*.mimes' => 'The Image must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                '3dvideo_files.*.mimes' => 'The 3D Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'floor_file.*.mimes' => 'The Floor file must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'addFloor.*.mimes' => 'The Other File must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        //exit;

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
                'website_link' => $request->input('website'),
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
                    'website_link' => $request->input('website'),
                    'youtube_link' => $request->input('youtube_link'),
                    'created_by' => Auth::user()->id,
                ],
            );
        }

        // exit;
        // // Process and store the form data
        // $ProjectRepository = new ProjectRepository();

        // $ProjectRepository->save();

        // Store GHMC approval files
        if ($request->hasFile('brochure_file')) {
            foreach ($request->file('brochure_file') as $image) {
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
        }

        // Store Commencement Certificate files
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $image) {
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
        }

        // Store RERA Approval files
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $image) {
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
        }

        // Store DTCP/HMDA Approval files
        if ($request->hasFile('3dvideo_files')) {
            foreach ($request->file('3dvideo_files') as $image) {
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
        }

        // Store Legal Document files
        if ($request->hasFile('floor_file')) {
            foreach ($request->file('floor_file') as $image) {
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
        }

        $names = $request->input('name', []);
        $count_images = count($names);
        $images = $request->file('addFloor');
        if (!empty($request->input('name'))) {
            foreach ($names as $key => $name) {
                if ($name != null) {
                    $imagePath = ''; // Placeholder for image path
                    if ($images && isset($images[$count_images + $key])) {
                        $image = $images[$count_images + $key];
                        $extension = $image->getClientOriginalExtension();
                        $fileName = uniqid() . '.' . $extension;
                        $path = 'uploads/others/';
                        $image->move(public_path($path), $fileName);
                        $imagePath = $path . $fileName;
                    }

                    OtherCompliances::create([
                        'form_id' => '1',
                        'repository_id' => $ProjectRepository->id,
                        'name' => $name,
                        'image' => $imagePath,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Project repository data saved successfully', 'comp_id' => $ProjectRepository->id], 200);
    }

    public function block_tower_repository(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        $validator = Validator::make(
            $request->all(),
            [
                'block_tower_id' => 'required',

                // 'floor_plan_n' => 'required',
                'floor_plan_n.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',

                // 'image_files_n' => 'required',
                'image_files_n.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',

                // '3dvideo_n' => 'required',
                '3dvideo_n.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',

                // 'tower_video_n' => 'required',
                'tower_video_n.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,pdf',
                'addFloor_n.*' => 'file|mimes:jpeg,jpg,png,mp4,pdf',
            ],
            [
                'tower_video_n.*.mimes' => 'The Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'image_files_n.*.mimes' => 'The Image must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                '3dvideo_n.*.mimes' => 'The 3D Video must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'floor_plan_n.*.mimes' => 'The Floor file must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
                'addFloor_n.*.mimes' => 'The Other File must be a file of type: jpeg, jpg, png, gif, mp4, pdf.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        //exit;
        // Process and store the form data

        $occurance = BlockTowerRepository::where('property_id', $request->property_id)
            ->where('block_tower_id', $request->block_tower_id)
            ->first();
        $repo_id = $occurance ? $occurance->id : 0;

        // Process and store the form data
        if ($repo_id == 0) {
            $BlockTowerRepository = new BlockTowerRepository();
            $BlockTowerRepository->gis_id = $request->input('gis_id');
            $BlockTowerRepository->cat_id = $request->input('cat_id');
            $BlockTowerRepository->property_id = $request->input('property_id');
            $BlockTowerRepository->residential_type = $request->input('residential_type');
            $BlockTowerRepository->residential_sub_type = $request->input('residential_sub_type');

            $BlockTowerRepository->block_tower_id = $request->input('block_tower_id');
            $BlockTowerRepository->youtube_link = $request->input('youtube_link');
            $BlockTowerRepository->created_by = Auth::user()->id;

            $BlockTowerRepository->save();
        } else {
            $BlockTowerRepository = BlockTowerRepository::find($repo_id);
            $BlockTowerRepository->gis_id = $request->input('gis_id');
            $BlockTowerRepository->cat_id = $request->input('cat_id');
            $BlockTowerRepository->property_id = $request->input('property_id');
            $BlockTowerRepository->residential_type = $request->input('residential_type');
            $BlockTowerRepository->residential_sub_type = $request->input('residential_sub_type');
            $BlockTowerRepository->block_tower_id = $request->input('block_tower_id');
            $BlockTowerRepository->youtube_link = $request->input('youtube_link');
            $BlockTowerRepository->created_by = Auth::user()->id;
            $BlockTowerRepository->save();
        }

        // Store GHMC approval files
        if ($request->hasFile('floor_plan_n')) {
            foreach ($request->file('floor_plan_n') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = '/uploads/block_towers_repository/floor_plan/';
                $image->move(public_path() . $path, $file_name);
                $BlockTowerRepositoryImages = new BlockTowerRepositoryImages();
                $BlockTowerRepositoryImages->block_tower_id = $BlockTowerRepository->id;
                $BlockTowerRepositoryImages->file_type = 'floor_plan';
                $BlockTowerRepositoryImages->file_path = $path;
                $BlockTowerRepositoryImages->file_name = $path . $file_name;
                $BlockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
                $BlockTowerRepositoryImages->created_by = Auth::user()->id;
                $BlockTowerRepositoryImages->save();
            }
        }

        // Store Commencement Certificate files
        if ($request->hasFile('image_files_n')) {
            foreach ($request->file('image_files_n') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = '/uploads/project_repository/image_files/';
                $image->move(public_path() . $path, $file_name);
                $BlockTowerRepositoryImages = new BlockTowerRepositoryImages();
                $BlockTowerRepositoryImages->block_tower_id = $BlockTowerRepository->id;
                $BlockTowerRepositoryImages->file_type = 'image_files';
                $BlockTowerRepositoryImages->file_path = $path;
                $BlockTowerRepositoryImages->file_name = $path . $file_name;
                $BlockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
                $BlockTowerRepositoryImages->created_by = Auth::user()->id;
                $BlockTowerRepositoryImages->save();
            }
        }

        // Store RERA Approval files
        if ($request->hasFile('3dvideo_n')) {
            foreach ($request->file('3dvideo_n') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = '/uploads/project_repository/3dvideo/';
                $image->move(public_path() . $path, $file_name);
                $BlockTowerRepositoryImages = new BlockTowerRepositoryImages();
                $BlockTowerRepositoryImages->block_tower_id = $BlockTowerRepository->id;
                $BlockTowerRepositoryImages->file_type = '3dvideo';
                $BlockTowerRepositoryImages->file_path = $path;
                $BlockTowerRepositoryImages->file_name = $path . $file_name;
                $BlockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
                $BlockTowerRepositoryImages->created_by = Auth::user()->id;
                $BlockTowerRepositoryImages->save();
            }
        }

        // Store DTCP/HMDA Approval files
        if ($request->hasFile('tower_video_n')) {
            foreach ($request->file('tower_video_n') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $path = '/uploads/project_repository/tower_video/';
                $image->move(public_path() . $path, $file_name);
                $BlockTowerRepositoryImages = new BlockTowerRepositoryImages();
                $BlockTowerRepositoryImages->block_tower_id = $BlockTowerRepository->id;
                $BlockTowerRepositoryImages->file_type = 'tower_video';
                $BlockTowerRepositoryImages->file_path = $path;
                $BlockTowerRepositoryImages->file_name = $path . $file_name;
                $BlockTowerRepositoryImages->created_at = date('Y-m-d H:i:s');
                $BlockTowerRepositoryImages->created_by = Auth::user()->id;
                $BlockTowerRepositoryImages->save();
            }
        }

        $names = $request->input('name_n', []);
        $count_images = count($names);
        $images = $request->file('addFloor_n');
        if (!empty($request->input('name_n'))) {
            foreach ($names as $key => $name) {
                if ($name != null) {
                    $imagePath = ''; // Placeholder for image path
                    if ($images && isset($images[$count_images + $key])) {
                        $image = $images[$count_images + $key];
                        $extension = $image->getClientOriginalExtension();
                        $fileName = uniqid() . '.' . $extension;
                        $path = 'uploads/others/';
                        $image->move(public_path($path), $fileName);
                        $imagePath = $path . $fileName;
                    }

                    OtherCompliances::create([
                        'form_id' => '2',
                        'repository_id' => $BlockTowerRepository->id,
                        'name' => $name,
                        'image' => $imagePath,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => Auth::user()->id,
                    ]);
                }
                // if ($name != null) {
                //     $imagePath = ''; // Placeholder for image path

                //     // $name = $images[$key]->getClientOriginalName();
                //     $file_name = uniqid() . '.' . $images[$key]->getClientOriginalExtension();
                //     $path = 'uploads/others/';
                //     $fileName = $path . $file_name;
                //     $images[$key]->move(public_path() . $path, $file_name);

                //     OtherCompliances::create([
                //         'form_id' => '2',
                //         'repository_id' => $BlockTowerRepository->id,
                //         'name' => $name,
                //         'image' => $fileName,
                //         'created_at' => date('Y-m-d H:i:s'),
                //         'updated_at' => date('Y-m-d H:i:s'),
                //         'created_by' => Auth::user()->id,
                //     ]);
                // }
            }
        }

        return response()->json(['message' => 'Block\Tower repository data saved successfully', 'comp_id' => $BlockTowerRepository->id], 200);
    }
}
