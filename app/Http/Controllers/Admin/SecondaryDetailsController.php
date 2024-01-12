<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    ProjectStatus, 
    UnderConstruction, 
    SecondaryFeatures,
    SecondaryFeaturesOptions,
    FloorType,
    Unit,
    Property,
    Category,
    FloorUnitCategory,
    Block,
    Tower,
    PropertyFloorMap,
    FloorUnitMap,
    Ammenitity,
    PropertyAmenity,
    Compliances,
    ProjectRepository,
    BlockTowerRepository
};
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

class SecondaryDetailsController extends Controller
{

    public function add_gated_comunity(){
        return view('admin.pages.property.add_gated_comunity', get_defined_vars());
    }

    public function gated_community_details(Request $request, $id){
        $property = Property::find($id);
        // $propertyAmenities = PropertyAmenity::where('property_category_id', $property->cat_gc)->get();
        $propertyAmenities = PropertyAmenity::where('property_category_id', 10)->get();
        $project_status = ProjectStatus::where('status','1')->orderBy('sort_by','ASC')->get();
        $under_construction = UnderConstruction::where('status','1')->orderBy('sort_by','ASC')->get();
        $floor_type = FloorType::where('status','1')->orderBy('sort_by','ASC')->get();
        $units = Unit::where('status','1')->orderBy('sort_by','ASC')->get();
        $gis_id = $property->gis_id;
        $get_property = Property::where('gis_id',$gis_id)->where('cat_id','2')->first();
        $secondary_blade_slug = Category::where('id', $get_property->residential_sub_type)->value('secondary_blade_slug');
        $compliances = Compliances::where('property_id', $property->id)->first();
        $project_repository = ProjectRepository::where('property_id', $property->id)->first();
        $block_tower_repository = BlockTowerRepository::where('property_id', $property->id)->first();
        return view('admin.pages.property.secondary_data.gated_community_details', get_defined_vars());
    }

    public function amenities(Request $request){
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        $propertyAmenities = PropertyAmenity::with('children')->get();
       return view('admin.pages.property.secondary_data.amenities.index', get_defined_vars());
   }
   
    public function compliances(){
        return view('admin.pages.property.secondary_data.compliances.index');
    }

    public function repositories(Request $request){
        $block_id = $request->block_id;
        return view('admin.pages.property.secondary_data.repositories.index', get_defined_vars());
    }

   public function floors(Request $request){
    // return $request->gis_id;
        $blocks = Block::where('gis_id', $request->gis_id)->get();
        $towers = Tower::where('gis_id', $request->gis_id)->get();
        $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 3)->orderBy('id', 'ASC')->get();
        $property_id = $request->property_id;
        $floor_view =  view('admin.pages.property.secondary_data.floors.index', get_defined_vars())->render();    
        return response()->json(array(
            'success' => true,
            'blocks' => $blocks,
            'towers' => $towers,
            'floor_view' => $floor_view

        ), 200);
      
   }

    public function search_gis(Request $request){
        $property = Property::where('gis_id', $request->gis_id)->first();
        if($property){
            $blocks = Block::where('gis_id', $request->gis_id)->get();
            $towers = Tower::where('gis_id', $request->gis_id)->get();
            return response()->json(array(
                'success' => true,
                'blocks' => $blocks,
                'towers' => $towers,
                'property_id' =>  $property->id
            ), 200);
        }
        else{
            return response()->json(array(
                'success' => false,
            ), 422);
        }
    }
    public function get_gcd_tab_content_header(Request $request){
        $property_id = $request->property_id;
         $property = Property::find($property_id);
       return view('admin.pages.property.secondary_data.tab_content_header', get_defined_vars());
    }

    public function save_floor_merge(Request $request){
      
        $merge_parent_floor_id = 0;  
        $child_floor_arr = [];
        
        // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
        $merge_parent_unit_id = NULL;  
        // $merge_unit_parent_floor_id = 0;  
        // $child_unit_arr = [];
        $checked_floors = isset($request->floor) ? $request->floor : [] ;
         for($f = 0; $f < (int)$request->no_of_floors; $f++){
            if(! isset($request->floor_id[$f]) ){
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0 ;
                $floor->units = $request->nth_unit[$f] ?? 0 ;
                $floor->merge_parent_floor_id =  NULL ;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if($request->merge_parent_floor_id == $f){
                   $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
                if(isset($request->nth_unit[$f])){
                    if((int)$request->nth_unit[$f] < 2){
                       
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id= 0;

                        // $unit->brand_name           = isset($request->floor_brand_name[$f]) ? $request->floor_brand_name[$f] : '';
                        $unit->save();
                    
                    }
                }
            }
            elseif($request->floor_id[$f] != 0){
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->floor_name = $request->floor_name[$f] ?? 0 ;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                $unit = FloorUnitMap::where('floor_id', $floor->id)->first();
                $unit->property_id          = $request->property_id;
                $unit->floor_id             = $floor->id;
                $unit->unit_name            = '';
                $unit->save();
                if($request->merge_parent_floor_id == $request->floor_id[$f]){
                    $merge_parent_floor_id = $floor->id;
                }
                
            }
            
            if(isset($request->nth_unit[$f])){
                if((int)$request->nth_unit[$f] > 1){
                    for($u = 0; $u < (int)$request->nth_unit[$f]; $u++){
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name'.$f;
                        $uprop_category_key             = 'uprop_category'.$f;
                        $uu_type_key                    = 'uu_type'.$f;
                        $unit_category_key              = 'unit_category'.$f;
                        $unit_sub_category_key          = 'unit_sub_category'.$f;
                        $unit_brand_key                 = 'unit_brand'.$f;
                        $person_name_key                = 'person_name'.$f;
                        $mobile_key                     = 'mobile'.$f;
                        $floor_unit_sub_cat_id_status   = 'unit_check'.$f;
                        $unit_id_key                    = 'unit_id'.$f;
                        $unit_brand_name                = 'unit_brand_name'.$f;
                        $unit_up_for_sale               = 'unit_up_for_sale'.$f;
                        $unit_up_for_rent               = 'unit_up_for_rent'.$f;
                        
                        if(! isset($request->$unit_id_key[$u])){
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                      
                            $unit->save();
                        }
                    }
                }
            }
            
           
            
        }
        
        $floors = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
         $parent_floor = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        foreach($floors as $floor){
            if($merge_parent_floor_id != $floor->id){
                $floor = PropertyFloorMap::find($floor->id);
                $floor->units                   = 0;
                $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                $floor->merge_parent_floor_status = 0;
                $floor->save();
                
                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->unit_cat_type_id     = $parent_floor->unit_cat_type_id;
                $child_floor->unit_type_id         = $parent_floor->unit_type_id;
                $child_floor->unit_cat_id          = $parent_floor->unit_cat_id;
                $child_floor->unit_sub_cat_id      = $parent_floor->unit_sub_cat_id;
                $child_floor->unit_brand_id        = $parent_floor->unit_brand_id;
                $child_floor->person_name          = $parent_floor->person_name;
                $child_floor->mobile               = $parent_floor->mobile;
                $child_floor->up_for_sale          = $parent_floor->up_for_sale;
                $child_floor->up_for_rent          = $parent_floor->up_for_rent;
                $child_floor->brand_name           = $parent_floor->brand_name;
                $child_floor->save();
            }
        }

       if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                                'id' => $request->property_id,
                                'action_url' => url('surveyor/property/update_details/'.$request->property_id),
                            ],
            ), 200);
        }
    }
    
    public function save_unit_merge(Request $request){
        $input_data = $request->all();
        // echo "<pre>";
        // print_r($input_data);
        // return;
        $merge_parent_floor_id = 0;  
        $child_floor_arr = [];
        $current_floor_id = 0;
        // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
        $merge_parent_unit_id = NULL;  
        // $merge_unit_parent_floor_id = 0;  
        // $child_unit_arr = [];
        $checked_floors = isset($request->floor) ? $request->floor : [] ;
         for($f = 0; $f < (int)$request->no_of_floors; $f++){
            if(! isset($request->floor_id[$f])){
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0 ;
                $floor->units = $request->nth_unit[$f] ?? 0 ;
                $floor->merge_parent_floor_id =  NULL ;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if($request->merge_parent_floor_id == $f){
                   $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
            }
            elseif($request->floor_id[$f] != 0){
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->units = $request->nth_unit[$f] ?? 0 ;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                $current_floor_id = $floor->id;
                if($request->merge_parent_floor_id == $request->floor_id[$f]){
                    $merge_parent_floor_id = $floor->id;
                }
                
            }
            
            if(isset($request->nth_unit[$f])){
                if((int)$request->nth_unit[$f] > 1){
                    for($u = 0; $u < (int)$request->nth_unit[$f]; $u++){
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name'.$f;
                        $uprop_category_key             = 'uprop_category'.$f;
                        $uu_type_key                    = 'uu_type'.$f;
                        $unit_category_key              = 'unit_category'.$f;
                        $unit_sub_category_key          = 'unit_sub_category'.$f;
                        $unit_brand_key                 = 'unit_brand'.$f;
                        $person_name_key                = 'person_name'.$f;
                        $mobile_key                     = 'mobile'.$f;
                        $floor_unit_sub_cat_id_status   = 'unit_check'.$f;
                        $unit_id_key                    = 'unit_id'.$f;
                        $unit_brand_name                = 'unit_brand_name'.$f;
                        $unit_up_for_sale               = 'unit_up_for_sale'.$f;
                        $unit_up_for_rent               = 'unit_up_for_rent'.$f;
                        $checked_units = [];
                        $checked_units = isset($request->$floor_unit_sub_cat_id_status) ? $request->$floor_unit_sub_cat_id_status : [] ;
                        if(! isset($request->$unit_id_key[$u])){
                            // $check_units = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $floor->id)->count();
                            // if($check_units == 1){
                            //     FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $floor->id)->delete();
                            // }
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u]: 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                            // $unit->unit_brand_id        = isset($request->$unit_brand_key[$u]) ? $request->$unit_brand_key[$u] : 0;
                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0 ;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0 ;
                            $unit->merge_parent_unit_id = NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ;
                            $unit->floor_unit_sub_cat_id = 0;
                             if(isset($request->$unit_brand_key[$u])){
                                if(is_numeric($request->$unit_brand_key[$u])){
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if($check_floor_category){
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                }
                                else{
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name =$request->$unit_brand_key[$u];
                                }
                            } 
                            // $unit->brand_name           = isset($request->$unit_brand_name[$u]) ? $request->$unit_brand_name[$u] : '';
                            $unit->save();
                            // echo isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ;
                            // echo $request->merge_unit_parent_floor_id .'-'. $f .'&&'. $request->merge_parent_unit_id .'-'. $u;
                            
                            if($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u){
                                $merge_parent_unit_id = ($request->unit_exist == 1) ? $request->merge_parent_unit_id : $unit->id;
                            }
                            // 
                            // $merge_parent_unit_id = $request->merge_parent_unit_id;
                        }
                        elseif($request->$unit_id_key[$u]  != 0){
                            
                            $unit = FloorUnitMap::find($request->$unit_id_key[$u]);
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u]: 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                            // $unit->unit_brand_id        = isset($request->$unit_brand_key[$u]) ? $request->$unit_brand_key[$u] : 0;
                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0 ;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0 ;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->merge_parent_unit_id = ($unit->merge_parent_unit_id != NULL)? $unit->merge_parent_unit_id : NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ;
                            $unit->floor_unit_sub_cat_id = 0;
                             if(isset($request->$unit_brand_key[$u])){
                                if(is_numeric($request->$unit_brand_key[$u])){
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if($check_floor_category){
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                }
                                else{
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name =$request->$unit_brand_key[$u];
                                }
                            } 
                            // $unit->brand_name           = isset($request->$unit_brand_name[$u]) ? $request->$unit_brand_name[$u] : '';
                            $unit->save();
                            // if($request->merge_parent_unit_id == $unit->id && $request->merge_parent_floor_id == $current_floor_id){
                                // $merge_parent_unit_id = $unit->id;
                            // }
                            $merge_parent_unit_id = $request->merge_parent_unit_id;
                            
                        }
                            //   echo $request->floor_id[$f];
                        
                    }
                }
                 else{
                     if(isset($new_floor_id)){
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0 ;
                        $unit->unit_type_id         = $request->unit_type[$f] ?? 0 ;
                        $unit->unit_cat_id          = $request->fu_category[$f] ?? 0 ;
                        $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0 ;
                        $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0 ;
                        $unit->person_name          = $request->person_name[$f] ?? '' ;
                        $unit->mobile               = $request->mobile[$f] ?? '' ;
                        $unit->up_for_sale          = isset($request->up_for_sale[$f]) ? 1 : 0 ;
                        $unit->up_for_rent          = isset($request->up_for_rent[$f]) ? 1 : 0 ;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->save();
                     }
                    
                }
                
            }
            
        }
        
        $units = FloorUnitMap::where('property_id', $request->property_id)->where('merge_parent_unit_status', 1)->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
            foreach($units as $unit){
                if($merge_parent_unit_id != $unit->id){
                    $unit = FloorUnitMap::find($unit->id);
                    $unit->unit_name            = $parent_unit->unit_name;
                    $unit->unit_cat_type_id     = $parent_unit->unit_cat_type_id;
                    $unit->unit_type_id         = $parent_unit->unit_type_id;
                    $unit->unit_cat_id          = $parent_unit->unit_cat_id;
                    $unit->unit_sub_cat_id      = $parent_unit->unit_sub_cat_id;
                    $unit->unit_brand_id        = $parent_unit->unit_brand_id;
                    $unit->person_name          = $parent_unit->person_name;
                    $unit->mobile               = $parent_unit->mobile;
                    $unit->up_for_sale          = $parent_unit->up_for_sale;
                    $unit->up_for_rent          = $parent_unit->up_for_rent;
                    $unit->merge_parent_unit_id = $merge_parent_unit_id;  
                    $unit->merge_parent_unit_status = 0;
                    $unit->brand_name           = $parent_unit->brand_name;
                    $unit->save();
                }
            }

       if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                                'id' => $request->property_id,
                                'action_url' => url('surveyor/property/update_details/'.$request->property_id),
                            ],
            ), 200);
        }
    }

    public function get_floors(Request $request){
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id','name', 'field_type'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id','name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;
   
        return view('admin.pages.property.secondary_data.floor', get_defined_vars());
    }

    public function get_units(Request $request){
        $prop_categories = Category::where('parent_id', NULL)->get();
        $categories = FloorUnitCategory::where('category_code', 1)->select(['id','name'])->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id','name','field_type'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id','name','field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->select(['id','name'])->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $floor_id = $request->floor_id;
        $start_index = $request->start_index;
        if($request->floor_idoc !=0 && !empty($request->property_id)){
            $unit_count = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id',$request->floor_idoc )->get();
            if($unit_count->count()  == 1){
                $unit = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id',$request->floor_idoc )->first();
                $unit->is_single = 1;
                $unit->save();
                // add_cloumn
            }
        }
        return view('admin.pages.property.secondary_data.unit', get_defined_vars());
    }

    public function editSecondaryDataFloors(Request $request){
        $property_id = $request->property_id;
        $property_cat_id = Property::where('id',$request->property_id)->first();
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)->orderBy('id', 'ASC')->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach($floors as $key=> $floor){
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }
        
        $units = FloorUnitMap::where('property_id', $property_id)->where('is_single', 0)->orderBy('id', 'ASC')->get();
        $parent_units = [];
        foreach($units as $key=> $unit){
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)->get();
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
       return view('admin.pages.property.secondary_data.edit_floor', get_defined_vars());
    }
    public function test(Request $request){
        return $request->all();
    }
}