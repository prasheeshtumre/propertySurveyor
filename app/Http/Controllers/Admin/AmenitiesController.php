<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProjectStatus;
use App\Models\UnderConstruction;
use App\Models\SecondaryFeatures;
use App\Models\SecondaryFeaturesOptions;
use App\Models\FloorType;
use App\Models\Unit;
use App\Models\Property;
use App\Models\Ammenitity;
use App\Models\Category;
use App\Models\PropertyAmenityAmenityOption;
use Validator;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Str;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Auth;

class AmenitiesController extends Controller
{
    public function serach_by_gis()
    {
        $project_status = ProjectStatus::where('status','1')->orderBy('sort_by','ASC')->get();
        $under_construction = UnderConstruction::where('status','1')->orderBy('sort_by','ASC')->get();
        // Amenties
        $amenities = SecondaryFeatures::where('id','1')->where('status','1')->first();
        $amenities_options = SecondaryFeaturesOptions::where('secondary_features_id','1')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Property Features
        $property_features = SecondaryFeatures::where('id','2')->where('status','1')->first();
        $property_features_options = SecondaryFeaturesOptions::where('secondary_features_id','2')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Society/Building features
        $society_building_features = SecondaryFeatures::where('id','9')->where('status','1')->first();
        $society_building_features_options = SecondaryFeaturesOptions::where('secondary_features_id','9')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Additional Features
        $additonal_features = SecondaryFeatures::where('id','3')->where('status','1')->first();
        $additional_features_options = SecondaryFeaturesOptions::where('secondary_features_id','3')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Water Source
        $water_source = SecondaryFeatures::where('id','4')->where('status','1')->first();
        $water_source_options = SecondaryFeaturesOptions::where('secondary_features_id','4')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Overlooking
        $overlooking = SecondaryFeatures::where('id','5')->where('status','1')->first();
        $overlooking_options = SecondaryFeaturesOptions::where('secondary_features_id','5')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Other Features
        $other_features = SecondaryFeatures::where('id','6')->where('status','1')->first();
        $other_features_options = SecondaryFeaturesOptions::where('secondary_features_id','6')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Power Back up
        $power_backup = SecondaryFeatures::where('id','7')->where('status','1')->first();
        $power_backup_options = SecondaryFeaturesOptions::where('secondary_features_id','7')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Location Advantages
        $location_advantages = SecondaryFeatures::where('id','8')->where('status','1')->first();
        $location_advantages_options = SecondaryFeaturesOptions::where('secondary_features_id','8')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // FloorType
        $floor_type = FloorType::where('status','1')->orderBy('sort_by','ASC')->get();
        
        // units
        $units = Unit::where('status','1')->orderBy('sort_by','ASC')->get();
        
        return view('admin.pages.property.secondary_data.amenities.search_by_gis', get_defined_vars());
    }
    public function serach_by_gis_post(Request $request)
    {
        $request->validate([
            'gis_id' => 'required|numeric',
        ]);
        
        $property = Property::where('gis_id', $request->gis_id)->first();
        if($property)
        {
            return redirect()->route('add_amminities', $property->id)->with('success', 'Successfully Data Found');  
            
        }
        else
        {
            return redirect()->back()->with('error','Data not Found');       
        }
    }
    public function add_amminities($id){
        
        $ametiesdata = Ammenitity::where('property_id', $id)->get();
        $property_details = Property::where('id', $id)->first();
        $secondary_features = SecondaryFeatures::all();
        
        $project_status = ProjectStatus::where('status','1')->orderBy('sort_by','ASC')->get();
        $under_construction = UnderConstruction::where('status','1')->orderBy('sort_by','ASC')->get();
        // Amenties
        $amenities = SecondaryFeatures::where('id','1')->where('status','1')->first();
        $amenities_options = SecondaryFeaturesOptions::where('secondary_features_id','1')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Property Features
        $property_features = SecondaryFeatures::where('id','2')->where('status','1')->first();
        $property_features_options = SecondaryFeaturesOptions::where('secondary_features_id','2')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Society/Building features
        $society_building_features = SecondaryFeatures::where('id','9')->where('status','1')->first();
        $society_building_features_options = SecondaryFeaturesOptions::where('secondary_features_id','9')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Additional Features
        $additonal_features = SecondaryFeatures::where('id','3')->where('status','1')->first();
        $additional_features_options = SecondaryFeaturesOptions::where('secondary_features_id','3')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Water Source
        $water_source = SecondaryFeatures::where('id','4')->where('status','1')->first();
        $water_source_options = SecondaryFeaturesOptions::where('secondary_features_id','4')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Overlooking
        $overlooking = SecondaryFeatures::where('id','5')->where('status','1')->first();
        $overlooking_options = SecondaryFeaturesOptions::where('secondary_features_id','5')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Other Features
        $other_features = SecondaryFeatures::where('id','6')->where('status','1')->first();
        $other_features_options = SecondaryFeaturesOptions::where('secondary_features_id','6')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Power Back up
        $power_backup = SecondaryFeatures::where('id','7')->where('status','1')->first();
        $power_backup_options = SecondaryFeaturesOptions::where('secondary_features_id','7')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // Location Advantages
        $location_advantages = SecondaryFeatures::where('id','8')->where('status','1')->first();
        $location_advantages_options = SecondaryFeaturesOptions::where('secondary_features_id','8')->where('status','1')->orderBy('sort_by','ASC')->get();
        
        // FloorType
        $floor_type = FloorType::where('status','1')->orderBy('sort_by','ASC')->get();
        
        // units
        $units = Unit::where('status','1')->orderBy('sort_by','ASC')->get();
        
        return view('admin.pages.property.secondary_data.amenities.index', get_defined_vars());
    }


     public function get_secondary_defined_block(Request $request){
        $gis_id = $request->gis_id;
        $get_property = Property::where('gis_id',$gis_id)->where('cat_id','2')->first();
        if($get_property){
            if($get_property->residential_sub_type == 10){
                $secondary_blade_slug = Category::where('id', $get_property->residential_sub_type)->value('secondary_blade_slug');
                return view('admin.pages.property.'.$secondary_blade_slug, get_defined_vars());
            }else{
                return ['status'=>false,'message'=>'Please enter Gated Community GIS ID'];
            }
        }else{
            return ['status'=>false,'message'=>'GIS ID Not Found'];
        }
    }
    public function blocks(){
        return view('admin.pages.property.secondary_data.blocks.index');
    }
    
    public function get_blocks(Request $request){
        $count = $request->count;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;
        return view('admin.pages.property.secondary_data.blocks.get_blocks', get_defined_vars());
    }
    
}