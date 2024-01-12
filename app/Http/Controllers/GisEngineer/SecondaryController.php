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
use App\Models\Category;
use App\Models\FloorUnitCategory;
use App\Models\Block;
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
// error_reporting(0);

class SecondaryController extends Controller
{
    public function add_gated_comunity()
    {
        $project_status = ProjectStatus::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $under_construction = UnderConstruction::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();

        // FloorType
        $floor_type = FloorType::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();

        // units
        $units = Unit::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();

        return view('admin.pages.property.secondary_data.add_gated_comunity', get_defined_vars());
    }

    public function get_secondary_defined_block(Request $request)
    {
        $gis_id = $request->gis_id;
        $get_property = Property::where('gis_id', $gis_id)
            ->whereIn('cat_id', [2, 4])
            ->where('created_by', Auth::user()->id)
            ->first();
        // ->where('created_by',Auth::user()->id)
        if ($get_property) {
            if ($get_property->residential_sub_type == 10 || $get_property->residential_sub_type == 12 || $get_property->plot_land_type == 14) {
                $secondary_blade_slug = Category::whereIn('id', [10, 12, 14])->value('secondary_blade_slug');
                $property = $get_property;
                $towers = Tower::where('property_id', $request->property_id)
                    ->where('tower_status', '!=', null)
                    ->get();

                return view('admin.pages.property.' . $secondary_blade_slug, get_defined_vars());
            } else {
                return ['status' => false, 'message' => 'Please enter Gated Community GIS ID'];
            }
        } else {
            return ['status' => false, 'message' => 'GIS ID Not Found'];
        }
    }

    public function updateGeneralDetails(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'project_status' => 'required',
                // 'under_construction' => 'required_if:project_status,2',
                // 'slab_completed'=>'required_if:under_construction,2',
            ],
            [
                // 'under_construction.required_if'=>"The Under Construction field is required.",
                // 'slab_completed.required_if'=>"The Slab Completed field is required.",
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $property = Property::find($request->property_id);
        $property->status_level = 1;
        $property->website_address = $request->website_address;
        $property->club_house_details = $request->club_house_details;
        $property->project_area_details = $request->project_area_details;
        // $property->project_status =  $request->project_status;
        // $property->under_construction =  $request->under_construction;
        // $property->slab_completed =  $request->slab_completed ? date('Y-m-d',strtotime($request->slab_completed)):NULL;
        $property->save();

        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id' => $property->id,
                        'action_url' => route('blocks.index'),
                        'message' => 'General details added Successfully.',
                    ],
                ],
                200,
            );
        }
    }

    public function index(Request $request)
    {
        $property = Property::find($request->property_id);
        return view('admin.pages.property.secondary_data.blocks.index', get_defined_vars());
    }
    public function viewBlock(Request $request)
    {
        $property = Property::find($request->property_id);
        $blocks = Block::where('property_id', $request->property_id)
            ->where('no_of_blocks', '!=', 0)
            ->orderBy('id', 'ASC')
            ->get();
        return view('admin.pages.property.secondary_data.blocks.view_block', get_defined_vars());
    }

    public function getBlocks(Request $request)
    {
        $count = $request->count;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;
        return view('admin.pages.property.secondary_data.blocks.get_blocks', get_defined_vars());
    }

    public function createBlocks(Request $request)
    {
        // return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'no_of_blocks' => 'required|numeric',
                'block_name.*' => 'required_with:no_of_blocks|distinct',
            ],
            [
                'block_name.*.required_with' => 'This feild is required.',
                'block_name.*.distinct' => 'Block Name must be unique.',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // exit;
        $no_of_blocks = $request->no_of_blocks;
        if ($no_of_blocks > 0 && $no_of_blocks != '') {
            foreach ($request->block_name as $key => $val) {
                $blocks = isset($request->block_id[$key]) && !empty($request->block_id[$key]) ? Block::find($request->block_id[$key]) : new Block();
                $blocks->property_id = $request->property_id;
                $blocks->gis_id = $request->gis_primary_id;
                $blocks->cat_id = $request->cat_id;
                $blocks->residential_type = $request->residential_type;
                $blocks->residential_sub_type = $request->residential_sub_type;
                $blocks->no_of_blocks = $no_of_blocks;
                $blocks->block_name = $val;
                $blocks->created_by = Auth::user()->id;
                $blocks->save();
            }
        } else {
            $check_block = Block::where('property_id', $request->property_id)->first();
            if ($check_block) {
                $blocks = Block::where('property_id', $request->property_id)->first();
                $blocks->property_id = $request->property_id;
                $blocks->gis_id = $request->gis_primary_id;
                $blocks->cat_id = $request->cat_id;
                $blocks->residential_type = $request->residential_type;
                $blocks->residential_sub_type = $request->residential_sub_type;
                $blocks->no_of_blocks = $no_of_blocks ?? 0;
                $blocks->block_name = $request->block_name;
                $blocks->created_by = Auth::user()->id;
                $blocks->save();
            } else {
                $blocks = new Block();
                $blocks->property_id = $request->property_id;
                $blocks->gis_id = $request->gis_primary_id;
                $blocks->cat_id = $request->cat_id;
                $blocks->residential_type = $request->residential_type;
                $blocks->residential_sub_type = $request->residential_sub_type;
                $blocks->no_of_blocks = $no_of_blocks ?? 0;
                $blocks->block_name = $request->block_name;
                $blocks->created_by = Auth::user()->id;
                $blocks->save();
            }
        }

        $property = Property::find($request->property_id);
        $property->status_level = 1;
        $property->save();

        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id' => $property->id,
                        'action_url' => route('blocks.index'),
                        'message' => 'Blocks Created Successfully.',
                    ],
                ],
                200,
            );
        }

        if ($blocks) {
            return redirect()
                ->route('completed')
                ->with('message', 'Blocks Created Successfully.')
                ->with('url', route('blocks.index'));
        }
    }

    public function towers()
    {
        return view('admin.pages.property.secondary_data.towers.index');
    }

    public function getBlockTowers(Request $request)
    {
        $property_id = $request->property_id;
        $get_property = Property::where('id', $property_id)
            ->where('created_by', Auth::user()->id)
            ->first();

        $blocks = Block::with('towers')
            ->where('property_id', $get_property->id)
            ->where('no_of_blocks', '!=', 0)
            ->orderBy('id', 'ASC')
            ->get();

        if ($get_property->residential_type == 7) {
            $towers = Tower::where('property_id', $get_property->id)
                ->where('block_id', '0')
                ->where('type', 1)
                ->orderBy('id', 'ASC')
                ->get();
            return view('admin.pages.property.secondary_data.towers.get_block_towers', get_defined_vars());
        } else {
            $towers = Tower::where('property_id', $get_property->id)
                ->where('block_id', '0')
                ->where('type', 2)
                ->orderBy('id', 'ASC')
                ->get();
            return view('admin.pages.property.secondary_data.units.get_block_units', get_defined_vars());
        }
    }

    public function getTowers(Request $request)
    {
        $count = $request->count;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;
        $id = $request->id;
        $residential_type = $request->residential_type;
        $default_unit_name = $start_index + ($id + 1) * 100;

        if ($residential_type == 7) {
            return view('admin.pages.property.secondary_data.towers.get_towers', get_defined_vars());
        } else {
            return view('admin.pages.property.secondary_data.units.get_units', get_defined_vars());
        }
    }

    public function createTowers(Request $request)
    {
        // return $request->all();
        $rules = $error_messages = [];
        if (isset($request->block_id)) {
            foreach ($request->block_id as $key => $val) {
                $rules["tower_name$key.*"] = 'required|distinct';
                $error_messages["tower_name$key.*.distinct"] = 'Tower name must be unique.';
            }
        }else{
            foreach ($request->tower_name0 as $key => $val) {
                $rules["tower_name$key.*"] = 'required|distinct';
                $error_messages["tower_name$key.*.distinct"] = 'Tower name must be unique.';
            }
        }
        $validator = Validator::make(
            $request->all(),
            $rules,
            $error_messages,
            // [
            //     'no_of_towers.*' => 'required',

            //     //     // 'under_construction' => 'required_if:project_status,2',
            //     //     // 'slab_completed'=>'required_if:under_construction,2',
            //     //     // 'no_of_blocks'=>'required|numeric',
            //     //     // 'block_name.*'=>'required_if:no_of_blocks,>,0'
            //     //     // 'block_name.*'=>'required_with:no_of_blocks'
            // ],

            // [
            //     'no_of_towers.*' => 'The field is required.',
            //     // 'slab_completed.required_if'=>"The Slab Completed field is required.",
            //     // 'block_name.*.required_if'=>"This feild is required",
            // ],
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // return $request->all();

        if ($request->residential_type == 7) {
            $type = 1; // tower
            $message = 'Towers Created Successfully.';
        } else {
            $type = 2; //  units
            $message = 'Units Created Successfully.';
        }
        $block_id = $request->block_id;
        if (isset($block_id)) {
            foreach ($block_id as $key => $val) {
                $no_of_towers = "no_of_towers$key";
                $tower_name = "tower_name$key";
                $tower_id = "tower_id$key";
                $existing_block_towers = Tower::where('property_id', $request->property_id)
                    ->where('block_id', $val)
                    ->count();
                if ($request->$no_of_towers > 0 && $request->$no_of_towers != '') {
                    for ($i = 0; $i < $request->$no_of_towers; $i++) {
                        //   return  $request->$tower_name;
                        // $towers = new Tower;
                        $towers = isset($request->$tower_id[$i]) && !empty($request->$tower_id[$i]) ? Tower::find($request->$tower_id[$i]) : new Tower();
                        $towers->property_id = $request->property_id;
                        $towers->gis_id = $request->gis_primary_id;
                        $towers->cat_id = $request->cat_id;
                        $towers->residential_type = $request->residential_type;
                        $towers->residential_sub_type = $request->residential_sub_type;
                        $towers->block_id = $val;
                        $towers->no_of_towers = $request->$no_of_towers;
                        $towers->tower_name = $request->$tower_name[$i];
                        $towers->type = $type;
                        $towers->created_by = Auth::user()->id;
                        $towers->save();
                    }
                    $block = Block::find($val);
                    $block->status_level = 1;
                    $block->save();

                    $property = Property::find($request->property_id);
                    $property->status_level = 2;
                    $property->save();
                } else {
                    if ($existing_block_towers == 0) {
                        $towers = new Tower();
                        $towers->property_id = $request->property_id;
                        $towers->gis_id = $request->gis_primary_id;
                        $towers->cat_id = $request->cat_id;
                        $towers->residential_type = $request->residential_type;
                        $towers->residential_sub_type = $request->residential_sub_type;
                        $towers->block_id = $val;
                        $towers->no_of_towers = $request->$no_of_towers ?? 0;
                        $towers->tower_name = $request->$tower_name;
                        $towers->type = $type;
                        $towers->created_by = Auth::user()->id;
                        $towers->save();

                        $block = Block::find($val);
                        $block->status_level = 2;
                        $block->save();

                        $property = Property::find($request->property_id);
                        $property->status_level = 2;
                        $property->save();
                    }
                }
            }
        } else {
            // return $request->all();
            if ($request->no_of_towers0 > 0 && $request->no_of_towers0 != '') {
                for ($t = 0; $t < $request->no_of_towers0; $t++) {
                    if (isset($request->tower_id0[$t])) {
                        $towers = Tower::find($request->tower_id0[$t]);
                        $towers->property_id = $request->property_id;
                        $towers->gis_id = $request->gis_primary_id;
                        $towers->cat_id = $request->cat_id;
                        $towers->residential_type = $request->residential_type;
                        $towers->residential_sub_type = $request->residential_sub_type;
                        $towers->block_id = 0;
                        $towers->no_of_towers = $request->no_of_towers0 ?? 0;
                        $towers->tower_name = $request->tower_name0[$t];
                        $towers->type = $type;
                        $towers->created_by = Auth::user()->id;
                        $towers->save();
                    } else {
                        $towers = new Tower();
                        $towers->property_id = $request->property_id;
                        $towers->gis_id = $request->gis_primary_id;
                        $towers->cat_id = $request->cat_id;
                        $towers->residential_type = $request->residential_type;
                        $towers->residential_sub_type = $request->residential_sub_type;
                        $towers->block_id = 0;
                        $towers->no_of_towers = $request->no_of_towers0 ?? 0;
                        $towers->tower_name = $request->tower_name0[$t];
                        $towers->type = $type;
                        $towers->created_by = Auth::user()->id;
                        $towers->save();
                    }
                }

                $property = Property::find($request->property_id);
                $property->status_level = 2;
                $property->save();
            }
        }

        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id' => $property->id,
                        'action_url' => route('blocks.index'),
                        'message' => $message,
                    ],
                    // 'floors' => self::editFloors($request, $property->id),
                ],
                200,
            );
        }

        if ($towers) {
            return redirect()
                ->route('completed')
                ->with('message', $message)
                ->with('url', route('towers.index'));
        }
    }

    public function get_floors(Request $request)
    {
        $prop_categories = Category::where('parent_id', null)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $brands = FloorUnitCategory::where('category_code', 3)->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;

        return view('admin.pages.property.secondary_data.floor', get_defined_vars());
    }

    public function get_units(Request $request)
    {
        $prop_categories = Category::where('parent_id', null)->get();
        $categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name'])
            ->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $brands = FloorUnitCategory::where('category_code', 3)
            ->select(['id', 'name'])
            ->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $floor_id = $request->floor_id;
        $start_index = $request->start_index;
        if ($request->floor_idoc != 0 && !empty($request->property_id)) {
            $unit_count = FloorUnitMap::where('property_id', $request->property_id)
                ->where('floor_id', $request->floor_idoc)
                ->get();
            if ($unit_count->count() == 1) {
                $unit = FloorUnitMap::where('property_id', $request->property_id)
                    ->where('floor_id', $request->floor_idoc)
                    ->first();
                $unit->is_single = 1;
                $unit->save();
                // add_cloumn
            }
        }
        return view('admin.pages.property.secondary_data.unit', get_defined_vars());
    }

    public function editFloors(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::where('id', $request->property_id)->first();
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)
            ->orderBy('id', 'ASC')
            ->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }

        $units = FloorUnitMap::where('property_id', $property_id)
            ->where('is_single', 0)
            ->orderBy('id', 'ASC')
            ->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)->get();
        $prop_categories = Category::where('parent_id', null)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        return view('admin.pages.property.secondary_data.edit_floor', get_defined_vars());
    }
}
