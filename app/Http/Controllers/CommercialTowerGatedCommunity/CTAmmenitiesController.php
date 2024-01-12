<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Property, PropertyAmenity, PropertyAmenityAmenityOption};

class CTAmmenitiesController extends Controller
{
    public function amenities(Request $request)
    {
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        $propertyAmenities = PropertyAmenity::with('children')
            ->where('property_category_id', config('constants.COMMERCIAL_TOWER'))
            ->get();
        $checked_amenities = PropertyAmenityAmenityOption::where('property_id', $request->property_id)
            ->pluck('amenity_option_id')
            ->toArray();

        return view('admin.pages.property.commercial_tower_gated_community.amenities.index', get_defined_vars());
    }

    public function store_amenities(Request $request)
    {
        $delete = PropertyAmenityAmenityOption::where('property_id', $request->property_id)->delete();
        foreach ($request->secondary_feature as $key => $amenity) {
            if (isset($amenity)) {
                $option_key = 'amenity_option' . $key;
                if (isset($request->$option_key)) {
                    foreach ($request->$option_key as $option) {
                        $exist_amenity_map = PropertyAmenityAmenityOption::where('property_id', $request->property_id)
                            ->where('property_amenity_id', $amenity)
                            ->where('amenity_option_id', $option)
                            ->first();
                        if ($exist_amenity_map) {
                            $exist_amenity_map->property_id = $request->property_id;
                            $exist_amenity_map->property_amenity_id = isset($amenity) ? $amenity : 0;
                            $exist_amenity_map->amenity_option_id = isset($option) ? $option : 0;
                            $exist_amenity_map->save();
                        } else {
                            $amenity_map = new PropertyAmenityAmenityOption();
                            $amenity_map->property_id = $request->property_id;
                            $amenity_map->property_amenity_id = $amenity;
                            $amenity_map->amenity_option_id = isset($option) ? $option : 0;
                            $amenity_map->save();
                        }
                    }
                }
            }
        }
        if ($request->ajax()) {
            return response()->json(['status' => true, 'message' => 'Amenities Added Successfully .'], 200);
        }
        return redirect()
            ->back()
            ->with('success', 'Successfully Submitted.');
    }
}
