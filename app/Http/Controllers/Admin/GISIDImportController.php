<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\GISIDsImport; 
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GeoID;
use DB;
use App\Models\{ProjectStatus, UnderConstruction, SecondaryFeatures, SecondaryFeaturesOptions, FloorType, Unit, Property, Category, FloorUnitCategory, Block, Tower, PropertyFloorMap, FloorUnitMap, Ammenitity, PropertyAmenity, Compliances, ProjectRepository, BlockTowerRepository, PropertyAmenityAmenityOption, PriceTrend, ProjectStatusLog, TowerLog};
class GISIDImportController extends Controller
{
    // public function index()
    // {
    //     return view('admin.pages.property.geo_id_import');
    // }

    public function index(Request $request)
    {
        $results = DB::table('DUMMY_FOR_BHANU AS dummy')
        ->select('uniq_id')
        ->get();


        return $results;
        // $id = 88;
        // $property = Property::find($id);
        // // $propertyAmenities = PropertyAmenity::where('property_category_id', $property->cat_gc)->get();
        // $blocks = Block::where('property_id', $property->id)
        //     ->where('no_of_blocks', '>', 0)
        //     ->get();

        // $block_towers = Tower::where('property_id', $property->id)
        //     ->where('tower_status', '!=', null)
        //     ->where('no_of_towers', '>', 0)
        //     ->get();

        // $propertyAmenities = PropertyAmenity::where('property_category_id', 10)->get();

        // $project_status = ProjectStatus::where('status', '1')
        //     ->orderBy('sort_by', 'ASC')
        //     ->get();
        // $under_construction = UnderConstruction::where('status', '1')
        //     ->orderBy('sort_by', 'ASC')
        //     ->get();
        // $floor_type = FloorType::where('status', '1')
        //     ->orderBy('sort_by', 'ASC')
        //     ->get();
        // $units = Unit::where('status', '1')
        //     ->orderBy('sort_by', 'ASC')
        //     ->get();
        // $gis_id = $property->gis_id;
        // $get_property = Property::where('gis_id', $gis_id)
        //     ->where('cat_id', '2')
        //     ->first();
        // // $get_property->residential_sub_type
        // $secondary_blade_slug = Category::where('id', 10)->value('secondary_blade_slug');
        // $towers = Tower::where('property_id', $property->id)
        //     // ->where('tower_status', '!=', null)
        //     ->where('no_of_towers', '>', 0)
        //     ->get();
            

        // $tower_log = TowerLog::where('property_id', $property->id)
        //     ->orderBy('id', 'DESC')
        //     ->get();
        // $project_status_log = ProjectStatusLog::where('property_id', $property->id)
        //     ->orderBy('id', 'DESC')
        //     ->get();

        // $compliances = Compliances::where('property_id', $property->id)->first();
        // $files = null;
        // $file_name = null;
        // $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        // if (isset($compliances->images)) {
        //     foreach ($compliances->images as $key => $image) {
        //         $files[$image->file_type][$key] = asset($image->file_path . $image->file_name);
        //         $file_name[$image->file_type][$key] = $image->file_type;
        //     }
        // }

        // $project_repository = ProjectRepository::where('property_id', $property->id)->first();
        // $block_tower_repositories = BlockTowerRepository::with('block')
        //     ->where('property_id', $property->id)
        //     ->get();
        // // $block_id = $request->block_id;
        // $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        // if (isset($project_repository->media_files)) {
        //     foreach ($project_repository->media_files as $key => $image) {
        //         $project_repository_files[$image->file_type][$key] = asset($image->file_name);
        //         $project_repository_file_name[$image->file_type][$key] = $image->file_type;
        //     }
        // }

        // if (isset($project_repository->other_files)) {
        //     foreach ($project_repository->other_files->where('form_id', 1) as $key => $image) {
        //         $project_repository_other_files[$key] = asset($image->image);
        //         $project_repository_other_file_name[$key] = $image->name;
        //     }
        // }

        // foreach ($block_tower_repositories as $id => $block_tower_repository) {
        //     if (isset($block_tower_repository->media_files)) {
        //         foreach ($block_tower_repository->media_files as $key => $image) {
        //             $block_tower_repository_files_array[$id][$image->file_type][$key] = asset($image->file_name);
        //             $block_tower_repository_file_name[$id][$image->file_type][$key] = $image->file_type;
        //         }
        //     }

        //     if (isset($block_tower_repository->other_files)) {
        //         foreach ($block_tower_repository->other_files->where('form_id', 2) as $key => $image) {
        //             $block_tower_repository_other_files[$id][$key] = asset($image->image);
        //             $block_tower_repository_other_file_name[$id][$key] = $image->name;
        //         }
        //     }
        // }

        // // dd($block_tower_repository->media_files);

        // $price_trends = PriceTrend::where('property_id', $property->id)->paginate(10);
        // // dd($block_tower_repository_files);
        // return view('admin.pages.property.secondary_data.gated_community_details_dve', get_defined_vars());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        // $chunkSize = 1000; // Adjust the chunk size as needed
        // Excel::filter('chunk')->load($file)->chunk($chunkSize, function ($results) {
        //     $data =  Excel::toCollection(new GISIDsImport, $results);
        // });
        $data = Excel::toCollection(new GISIDsImport, request()->file('file'));
        $uniqueIds = [];
        $duplicateIds = [];

        foreach ($data as  $rows) {
            // echo "<pre>";
            foreach ($rows as $key => $row){
                if($key > 0){
                    $geo_id_status = GeoID::where('gis_id',$row[0])->first();
                    if(!$geo_id_status){
                        // echo $key.'-'.($row[0]).",<br>"; // Change this to match your data structure
                          GeoID::create([
                            'gis_id' => $row[0],
                            'pincode_id' => $row[1],
                        ]);
                    }
                }
                
                
            }
            // if (isset($uniqueIds[$uniqueId])) {
            //     $duplicateIds[$uniqueId][] = $lineNumber;
            // } else {
            //     $uniqueIds[$uniqueId] = [$lineNumber];
            // }
        }
        // Excel::import(new GISIDsImport, request()->file('file'));
        // return back()->with('success', "geo-id's Imported Successfully.");
    }
}
