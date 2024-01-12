<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Property, GeoID, GisIDMapping};

class GISIDController extends Controller
{
    public function search_mgis(Request $request)
    {
        $merge_gis_id_arr = GeoID::whereIn('gis_id', $request->merge_ids)->pluck('gis_id')->toArray();
        if(count($merge_gis_id_arr) == count($request->merge_ids)){
             $prior_pincode = GeoID::where('gis_id', $request->prior_gis_id)->value('pincode_id');
            $matched_pincode_gis_ids = GeoID::where('pincode_id', $prior_pincode)->whereIn('gis_id', $request->merge_ids)->pluck('gis_id')->toArray();
            if(count($matched_pincode_gis_ids) != count($request->merge_ids)){
                return response()->json(['status' => false, 'egis_ids' => array_values(array_diff($request->merge_ids, $matched_pincode_gis_ids)), 'msg' => "Pincode doesn't match with Prior GIS-ID."], 200);
            }
            $merge_gis_ids = Property::whereIn('gis_id', $request->merge_ids)->pluck('gis_id')->toArray();
            if(count($merge_gis_ids) > 0){
                $status = (count($merge_gis_ids) > 0) ? false : true;
                return response()->json(['status' => $status, 'egis_ids' => $merge_gis_ids, 'msg' => 'Property is Existing with this GIS-ID.'], 200);
            }
            $merged_gis_ids = GisIDMapping::whereIn('merge_id', $request->merge_ids)->pluck('merge_id')->toArray();
            if(count($merged_gis_ids) > 0){
                $status = (count($merged_gis_ids) > 0) ? false : true;
                return response()->json(['status' => $status, 'egis_ids' => $merged_gis_ids, 'msg' => 'This GIS-ID already merged with another Property.'], 200);
            }
        }
        if(count($merge_gis_id_arr) != count($request->merge_ids)){
            return response()->json(['status' => false, 'egis_ids' => array_values(array_diff($request->merge_ids, $merge_gis_id_arr)), 'msg' => 'This GIS-ID Not Available.'], 200);
        }
    }

    public function split_merge_options(Request $request){
        $geo_id = GeoID::with('property')->where('gis_id', $request->gis_id)->first();
        if (!$geo_id) {
            return response()->json(['status' => false, 'message' => 'Please Enter valid GIS-ID'], 404);
        }
        if ($geo_id->property == null) {
            //split can't be done for new property
            return response()->json(['status' => false, 'message' => 'Please Enter valid GIS-ID'], 404);
        }
        $merges = GisIDMapping::where('gis_id' ,$request->gis_id)->pluck('merge_id')->toArray();
        $splits = Property::where('parent_split_id', $request->gis_id)->get()->count();
        $merge_count = count($merges);
        return response()->json([ 'splits' => ($splits + 1), 'merges' => $merge_count , 'mergeContent' => $merges], 200);
    }

}
