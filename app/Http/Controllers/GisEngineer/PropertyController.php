<?php

namespace App\Http\Controllers\GisEngineer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GisEngineer\PropertyService;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Tower;
use App\Models\FloorUnitMap;
use App\Models\PropertyFloorMap;
use App\Models\Builder;
use App\Models\Unit;
use App\Models\{GeoID, GisIDMapping, GISIDSplitLog, TemporaryGisId};
use App\DTO\SplitGISIDRequestDTO;
use App\Services\SplitGISIDService;
use App\DTO\MergeGISIDRequestDTO;
use Validator;
use Auth;
use DB;

class PropertyController extends Controller
{
    private $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index(Request $request, $type = null)
    {
        $result = $this->propertyService->getProperties($request, $type);

        $categories = $result['properties']['categories'] ?? [];
        $unit_categories = $result['properties']['unit_categories'] ?? [];
        $residential = $result['properties']['residential'] ?? [];
        $brand_parent_categories = $result['properties']['brand_parent_categories'] ?? [];
        $brand_sub_categories = $result['properties']['brand_sub_categories'] ?? [];
        $brands = $result['properties']['brands'] ?? [];
        $builders = $result['properties']['builders'] ?? [];
        $category_type = $result['properties']['category_type'] ?? [];
        $properties = $result['properties']['properties'] ?? [];
        $property_count = $result['properties']['property_count'] ?? [];

        if ($request->ajax()) {
            if ($request->category == 1 || $request->category == 6) {
                return view('gis_engineer.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            } elseif ($request->residential_sub_category == 9 || $request->residential_sub_category == 10 || $request->residential_sub_category == 11 || $request->residential_sub_category == 12) {
                return view('gis_engineer.property_pagination', ['properties' => $properties, 'category_type' => $request->residential_sub_category, 'property_count' => $property_count]);
            } elseif ($request->plot_land_types == 13 || $request->plot_land_types == 14) {
                return view('gis_engineer.property_pagination', ['properties' => $properties, 'category_type' => $request->plot_land_types, 'property_count' => $property_count]);
            } elseif ($request->property_type == 1) {
                return view('gis_engineer.property_pagination', ['properties' => $properties, 'category_type' => $request->property_type, 'property_count' => $property_count]);
            } else {
                return view('gis_engineer.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            }
        }

        return view('gis_engineer.reports', get_defined_vars());
    }

    public function show(Request $request, $id, $type = null)
    {
        $property = $this->propertyService->getProperty($request, $id);
        $defined_blade = $property['defined_blade'];
        $categories = $property['categories'];
        $property_id = $property['property_id'];
        $floors = $property['floors'];
        $floor_index = $property['floor_index'];
        $parent_unit_id = $property['parent_unit_id'];
        $parent_floors = $property['parent_floors'];
        $units = $property['units'];
        $parent_units = $property['parent_units'];
        $custom_brands = $property['custom_brands'];
        $prop_categories = $property['prop_categories'];
        $unit_categories = $property['unit_categories'];
        $unit_category_list = $property['unit_category_list'];
        $unit_sub_category_list = $property['unit_sub_category_list'];
        $brands = $property['brands'];
        $unit_detail_ids = $property['unit_detail_ids'];
        $floor_visible_status = $property['floor_visible_status'];
        $merges = $property['merges'] != 0 && !empty($property['merges']) ? $property['merges'] : [];
        $splits = $property['splits'] != 0 && !empty($property['splits']) ? $property['splits'] : 0;
        $property = $property['property'];

        // dd(get_defined_vars());
        return view('gis_engineer.pages.property.report_details', get_defined_vars());
    }
    public function edit($id)
    {
        $result = $this->propertyService->editProperty($id);
        $categories = $result['categories'];
        $property_id = $result['property_id'];
        $property_cat_id = $result['property_cat_id'];
        $floors = $result['floors'];
        $floor_index = $result['floor_index'];
        $parent_unit_id = $result['parent_unit_id'];
        $parent_floors = $result['parent_floors'];
        $defined_blade = $result['defined_blade'];
        $units = $result['units'];
        $parent_units = $result['parent_units'];
        $custom_brands = $result['custom_brands'];
        $prop_categories = $result['prop_categories'];
        $unit_categories = $result['unit_categories'];
        $unit_category_list = $result['unit_category_list'];
        $unit_sub_category_list = $result['unit_sub_category_list'];
        $brands = $result['brands'];
        $sub_categories = $result['sub_categories'];
        $builders = $result['builders'];
        $edit_allowed_categories = $result['edit_allowed_categories'];
        $merges = $result['merges'];
        $floor_visible_status = $result['floor_visible_status'];
        $property = $result['property'];

        return view('gis_engineer.pages.property.edit_details', get_defined_vars());
    }

    public function editSplits($id)
    {
        if (!empty($id)) {
            $property = Property::find($id);
            if ($property) {
                return view('gis_engineer.pages.property.edit.splits', get_defined_vars());
            } else {
                abort(404);
            }
        }
    }
    public function editMerged($id)
    {
        if (!empty($id)) {
            $property = Property::find($id);
            if ($property) {
                return view('gis_engineer.pages.property.edit.merged', get_defined_vars());
            } else {
                abort(404);
            }
        }
    }
    public function editTemporaryGisId($id)
    {
        if (!empty($id)) {
            $property = Property::find($id);
            if ($property) {
                return view('gis_engineer.pages.property.edit.temporary_gis_id', get_defined_vars());
            } else {
                abort(404);
            }
        }
    }

    public function updateSplits(Request $request, $id)
    {
        // $this->propertyService->updateSplitProperty($request, $id);
        $input_data = $request->all();
        $validator = Validator::make($input_data, [
            'gis_id' => 'required|unique:geo_ids,gis_id',
            'pincode' => 'required|regex:/^\d{6}$/',
            'web_gis_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $geoId = GeoId::where('gis_id', $request->old_gis_id)->first();
        $geoId->gis_id = $request->gis_id;
        $geoId->pincode_id = $request->pincode;
        $geoId->save();

        $property = Property::find($id);
        $property->temp_gis_id_status = 2;
        $property->webgis_polygon_status = isset($request->web_gis_status) ? 1 : null;
        $property->gis_id = $request->gis_id;
        $property->save();

        return redirect()
            ->route('gis-engineer.property.report_details', $id)
            ->with('message', 'Successfully details Updated.');
    }
    public function updateMerged(Request $request, $id)
    {
        // $this->propertyService->updateSplitProperty($request, $id);
        $input_data = $request->all();
        $validator = Validator::make($input_data, [
            'web_gis_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $property = Property::find($id);
        $property->temp_gis_id_status = 2;
        $property->webgis_polygon_status = isset($request->web_gis_status) ? 1 : null;
        $property->save();

        return redirect()
        ->route('gis-engineer.property.report_details', $id)
            ->with('message', 'Successfully Updated details.');
    }
    public function updateTemporaryGisId(Request $request, $id)
    {
        $input_data = $request->all();
        $validator = Validator::make($input_data, [
            'gis_id' => 'required|unique:geo_ids,gis_id',
            'pincode' => 'required|regex:/^\d{6}$/',
            'web_gis_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $geoId = new GeoId();
        $geoId->gis_id = $request->gis_id;
        $geoId->pincode_id = $request->pincode;
        $geoId->save();

        $property = Property::find($id);
        $property->temp_gis_id_status = 2;
        $property->webgis_polygon_status = isset($request->web_gis_status) ? 1 : null;
        $property->gis_id = $request->gis_id;
        $property->save();
        // echo $request->gis_id;
//  TemporaryGisId::where('gis_id_temp',$request->old_gis_id)->first();
        $temporary_gis = TemporaryGisId::where('gis_id_temp',$request->old_gis_id)->first();
        $temporary_gis->gis_id_org = $request->gis_id;
        $temporary_gis->updated_by = Auth::user()->id;
        $temporary_gis->save();
// return;
        return redirect()
        ->route('gis-engineer.property.report_details', $id)
            ->with('message', 'Successfully Updated details.');
    }
}
