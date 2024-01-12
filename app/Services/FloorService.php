<?php
// Service
namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Tower;
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
use App\Models\FloorUnitMap;
use App\Models\PropertyFloorMap;
use App\Models\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;


class FloorService
{
    public function processFloorData($request)
    {
return $request;
        $merge_parent_floor_id = 0;  
        $child_floor_arr = [];
        
        // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
        $merge_parent_unit_id = NULL;  
        // $merge_unit_parent_floor_id = 0;  
        // $child_unit_arr = [];
        $checked_floors = isset($request->floor) ? $request->floor : [] ;
        for($f = 0; $f < (int)$request->no_of_floors; $f++){
            $floor_id = (isset($request->floor_id[$f])) ? $request->floor_id[$f] : '';
            
            $floor = PropertyFloorMap::updateOrCreate([ 'id'=> $floor_id],
                                                    [
                                                        'property_id'   =>  $request->property_id,
                                                        'floor_no'  =>  $f ?? 0,
                                                        'units' =>  $request->nth_unit[$f] ?? 0 ,
                                                        'floor_name'    =>  $request->floor_name[$f] ?? 0 ,
                                                        'merge_parent_floor_id' =>   NULL ,
                                                        'merge_parent_floor_status' =>   (in_array($f, $checked_floors)) ? 1 : 0,
                                                 ]);

            if($request->merge_parent_floor_id == $f){
            $merge_parent_floor_id = $floor->id;
            }
            
            // isset($request->nth_unit[$f]) ? array_push($child_floor_arr, $floor->id) : '' ;
            
            if(isset($request->nth_unit[$f])){
                if((int)$request->nth_unit[$f] > 1){
                    for($u = 0; $u < (int)$request->nth_unit[$f]; $u++){
                        $checked_units = [];
                        $nth_unit_name_key = 'nth_unit_name'.$f;
                        $uprop_category_key = 'uprop_category'.$f;
                        $uu_type_key = 'uu_type'.$f;
                        $unit_category_key = 'unit_category'.$f;
                        $unit_sub_category_key = 'unit_sub_category'.$f;
                        $unit_brand_key = 'unit_brand'.$f;
                        $person_name_key = 'person_name'.$f;
                        $mobile_key = 'mobile'.$f;
                        $floor_unit_sub_cat_id_status = 'unit_check'.$f;
                        $unit_brand_name = 'unit_brand_name'.$f;
                        $unit_id_key                    = 'unit_id'.$f;
                        $unit_up_for_sale = 'unit_up_for_sale'.$f;
                        $unit_up_for_rent = 'unit_up_for_rent'.$f;
                        $unit_brand = NULL;
                        
                        $unit_id = (isset($request->$unit_id_key[$u])) ? $request->$unit_id_key[$u] : '';
            
                        $unit = FloorUnitMap::updateOrCreate([ 'id'=> $unit_id],
                                                    [
                                                        'property_id' => $request->property_id,
                                                        'floor_id' => $floor->id,
                                                        'unit_name' => isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '',
                                                        'unit_cat_type_id' => isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u]: 0,
                                                        'unit_type_id' => isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0,
                                                        'unit_cat_id' => isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0,
                                                        'unit_sub_cat_id' => isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0,
                                                                          
                                                        'person_name' => isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '',
                                                        'mobile' => isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '',
                                                        'up_for_sale' => isset($request->$unit_up_for_sale[$u]) ? 1 : 0 ,
                                                        'up_for_rent' => isset($request->$unit_up_for_rent[$u]) ? 1 : 0 ,
                                                        'merge_parent_unit_id' => NULL,
                                                        'merge_parent_unit_status' => isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ,
                                                        'floor_unit_sub_cat_id' => 0,
                                                 ]);
                        
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
                                $unit->brand_name = $request->$unit_brand_key[$u];
                            }
                        } 
                        
                        $unit->save();
                        
                        if($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u){
                         $merge_parent_unit_id = $unit->id;
                        }
                    }
                }
                else{
                    $unit = new FloorUnitMap;
                    $unit->property_id          = $request->property_id;
                    $unit->floor_id             = $floor->id;
                    $unit->unit_name            = '';
                    $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0 ;
                    $unit->unit_type_id         = $request->unit_type[$f] ?? 0 ;
                    $unit->unit_cat_id          = $request->fu_category[$f] ?? 0 ;
                    $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0 ;
                    // $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0 ;
                    $unit->person_name          = $request->person_name[$f] ?? '' ;
                    $unit->mobile               = $request->mobile[$f] ?? '' ;
                    $unit->up_for_sale          = isset($request->floor_up_for_sale[$f]) ? 1 : 0 ;
                    $unit->up_for_rent          = isset($request->floor_up_for_rent[$f]) ? 1 : 0 ;
                    $unit->merge_parent_unit_id = NULL;
                    $unit->floor_unit_sub_cat_id= 0; 
                    if(isset($request->floor_brand[$f])){
                            if(is_numeric($request->floor_brand[$f])){
                                $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                                if($check_floor_category){
                                    $unit->unit_brand_id = $request->floor_brand[$f];
                                    $unit->brand_name = '';
                                }
                            }
                            else{
                                $unit->unit_brand_id = 0;
                                $unit->brand_name =$request->floor_brand[$f];
                            }
                        } 
                    // $unit->brand_name      = $request->floor_brand_name[$f] ?? '' ;
                    $unit->save();
                }
                            
            } 
            else{
                    $unit = new FloorUnitMap;
                    $unit->property_id           = $request->property_id;
                    $unit->floor_id              = $floor->id;
                    $unit->unit_name             = '';
                    $unit->unit_cat_type_id      = $request->prop_category[$f] ?? 0 ;
                    $unit->unit_type_id          = $request->unit_type[$f] ?? 0 ;
                    $unit->unit_cat_id           = $request->fu_category[$f] ?? 0 ;
                    $unit->unit_sub_cat_id       = $request->fu_sub_category[$f] ?? 0 ;
                    // $unit->unit_brand_id         = $request->floor_brand[$f] ?? 0 ;
                    $unit->person_name           = $request->person_name[$f] ?? '' ;
                    $unit->mobile                = $request->mobile[$f] ?? '' ;
                    $unit->up_for_sale           = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                    $unit->up_for_rent           = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                    $unit->merge_parent_unit_id  = NULL;
                    $unit->floor_unit_sub_cat_id = 0;
                    // $unit->brand_name            = $request->floor_brand_name[$f] ?? '' ;
                    if(isset($request->floor_brand[$f])){
                        if(is_numeric($request->floor_brand[$f])){
                            $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                            if($check_floor_category){
                                $unit->unit_brand_id = $request->floor_brand[$f];
                                $unit->brand_name = '';
                            }
                        }
                        else{
                            $unit->unit_brand_id = 0;
                            $unit->brand_name =$request->floor_brand[$f];
                        }
                    } 
                    $unit->save();
                }    
        }
        
        $floors = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
        $parent_floor_unit = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        $parent_floor        = PropertyFloorMap::where('id', $merge_parent_floor_id)->first();
            foreach($floors as $floor){
                if($merge_parent_floor_id != $floor->id){
                    $floor = PropertyFloorMap::find($floor->id);
                    $floor->units                   = 0;
                    $floor->floor_name                   = $parent_floor->floor_name;
                    $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                    $floor->merge_parent_floor_status = 0;
                    $floor->save();
                    $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                    $child_floor->unit_cat_type_id     = $parent_floor_unit->unit_cat_type_id;
                    $child_floor->unit_type_id         = $parent_floor_unit->unit_type_id;
                    $child_floor->unit_cat_id          = $parent_floor_unit->unit_cat_id;
                    $child_floor->unit_sub_cat_id      = $parent_floor_unit->unit_sub_cat_id;
                    $child_floor->unit_brand_id        = $parent_floor_unit->unit_brand_id;
                    $child_floor->person_name          = $parent_floor_unit->person_name;
                    $child_floor->mobile               = $parent_floor_unit->mobile;
                    $child_floor->up_for_sale          = $parent_floor_unit->up_for_sale;
                    $child_floor->up_for_rent          = $parent_floor_unit->up_for_sale;
                    $child_floor->brand_name           = $parent_floor_unit->brand_name;
                    $child_floor->save();
                    
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
                    $unit->brand_name           = $parent_unit->brand_name;
                    $unit->merge_parent_unit_id = $merge_parent_unit_id;
                    $unit->merge_parent_unit_status = 0;
                    $unit->save();
                }
            }
    }
}
