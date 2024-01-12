<?php

namespace App\Http\Controllers\CommercialTowerGatedCommunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{ProjectStatus, UnderConstruction, FloorType, Unit, Property, Category, FloorUnitCategory, Block, BlockTowerRepository, Compliances, Tower, PropertyFloorMap, FloorUnitMap, PriceTrend, ProjectRepository, ProjectStatusLog, PropertyAmenity, TowerLog};

use Validator;
use Auth;
use PSpell\Config;

// error_reporting(0);

class CommercialTowerController extends Controller
{
    public function add_commercial_tower()
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

        return view('admin.pages.property.commercial_tower_gated_community.add_commercial_tower', get_defined_vars());
    }

    public function get_commercial_defined_block(Request $request)
    {
        $gis_id = $request->gis_id;
        $get_property = Property::where('gis_id', $gis_id)
            ->where('cat_id', config('constants.COMMERCIAL'))
            ->where('created_by', Auth::user()->id)
            ->first();
        if ($get_property) {
            if ($get_property->commercial_type == config('constants.COMMERCIAL_TOWER')) {
                $secondary_blade_slug = Category::where('id', config('constants.COMMERCIAL_TOWER'))->value('secondary_blade_slug');
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
    //update
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
        $property->no_of_units = $request->no_of_units;
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
                        'action_url' => route('commercial-tower.blocks.index'),
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
        return view('admin.pages.property.commercial_tower_gated_community.blocks.index', get_defined_vars());
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
        $property = $get_property;

        $towers = Tower::where('property_id', $get_property->id)
            ->where('block_id', '0')
            ->where('type', 1)
            ->orderBy('id', 'ASC')
            ->get();

        return view('admin.pages.property.commercial_tower_gated_community.towers.get_block_towers', get_defined_vars());
    }

    public function getTowers(Request $request)
    {
        $count = $request->count;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;
        $id = $request->id;
        $residential_type = $request->residential_type;
        $default_unit_name = $start_index + ($id + 1) * 100;

        return view('admin.pages.property.commercial_tower_gated_community.towers.get_towers', get_defined_vars());
    }

    public function createTowers(Request $request)
    {
        // return $request->all();
        $rules = $error_messages = [];
        $rules['no_of_towers0'] = 'required|integer';
        if (isset($request->tower_name0)) {
            foreach ($request->tower_name0 as $key => $val) {
                $rules["tower_name$key.*"] = 'required|distinct';
                $error_messages["tower_name$key.*.distinct"] = 'Tower name must be unique.';
            }
        }
        $error_messages['no_of_towers0.required'] = 'No of Tower field is required';
        $validator = Validator::make($request->all(), $rules, $error_messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // return $request->all();

        $type = 1; // tower
        $message = 'Towers Created Successfully.';

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

    public function floors(Request $request)
    {
        $blocks = Block::where('gis_id', $request->gis_id)
            ->where('no_of_blocks', '>', '0')
            ->orderBy('id', 'ASC')
            ->get();
        $towers = Tower::where('gis_id', $request->gis_id)
            ->where('no_of_towers', '>', '0')
            ->orderBy('id', 'ASC')
            ->get();
        $categories = Category::where('parent_id', null)
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $property_id = $request->property_id;

        if ($request->page_type == 'view') {
            $floor_view = view('admin.pages.property.commercial_tower_gated_community.floors.view_index', get_defined_vars())->render();
        } else {
            $floor_view = view('admin.pages.property.commercial_tower_gated_community.floors.index', get_defined_vars())->render();
        }

        return response()->json(
            [
                'success' => true,
                'blocks' => $blocks,
                'towers' => $towers,
                'floor_view' => $floor_view,
            ],
            200,
        );
    }

    public function editCommercialTowerFloors(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::find($property_id);
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)
            ->where('tower_id', $request->tower_id)
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
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();
        $single_units = FloorUnitMap::where('property_id', $property_id)
            ->where('is_single', 1)
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)
            ->where('tower_id', $request->tower_id)
            ->get();
        $prop_categories = Category::where('parent_id', null)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        if (isset($request->page_type) && $request->page_type == 'view') {
            return view('admin.pages.property.secondary_data.view_floor', get_defined_vars());
        }
        return view('admin.pages.property.secondary_data.edit_floor', get_defined_vars());
    }

    public function get_ct_floors(Request $request)
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

        return view('admin.pages.property.commercial_tower_gated_community.floor', get_defined_vars());
    }

    public function get_ct_units(Request $request)
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
        $default_unit_name = $start_index + ($floor_id + 1) * 100;
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

    public function store_ct_floors(Request $request)
    {
        // return $request->all();
        $rules = $error_messages = [];
        $rules['floor_name.*'] = 'required|distinct';
        $rules['no_of_floors'] = 'required|integer|min:1';

        if (isset($request->block)) {
            $rules['block'] = 'required';
        }

        $rules['tower'] = 'required';
        if (isset($request->nth_unit)) {
            foreach ($request->nth_unit as $key => $val) {
                $rules["nth_unit_name$key.*"] = 'required|distinct';
                $error_messages["nth_unit_name$key.*.required"] = 'This field is required.';
                $error_messages["nth_unit_name$key.*.distinct"] = 'Unit name must be unique.';
            }
        }
        $error_messages['floor_name.*.required'] = 'This field is required.';
        $error_messages['floor_name.*.distinct'] = 'Floor name must be unique.';

        $validator = Validator::make($request->all(), $rules, $error_messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // return $request->all();

        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $merge_parent_unit_id = null;
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int) $request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                // return $request->all();
                $floor = new PropertyFloorMap();
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id = null;
                $floor->merge_parent_floor_status = in_array($f, $checked_floors) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                if (isset($request->nth_unit[$f])) {
                    if ((int) $request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int) $request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand = null;

                            $unit = new FloorUnitMap();
                            $unit->property_id = $request->property_id;
                            $unit->floor_id = $floor->id;
                            $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->block_id = $request->block ?? 0;
                            $unit->tower_id = $request->tower;
                            $unit->merge_parent_unit_id = null;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->save();
                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {
                        $unit = new FloorUnitMap();
                        $unit->property_id = $request->property_id;
                        $unit->floor_id = $floor->id;
                        $unit->unit_name = isset($request->floor_name[$f]) ? $request->floor_name[$f] : '';
                        $unit->block_id = $request->block ?? 0;
                        $unit->tower_id = $request->tower;
                        $unit->merge_parent_unit_id = null;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->is_single = 1;
                        $unit->save();
                    }
                } else {
                    $unit = new FloorUnitMap();
                    $unit->property_id = $request->property_id;
                    $unit->floor_id = $floor->id;
                    $unit->unit_name = isset($request->floor_name[$f]) ? $request->floor_name[$f] : '';
                    $unit->block_id = $request->block ?? 0;
                    $unit->tower_id = $request->tower;
                    $unit->merge_parent_unit_id = null;
                    $unit->floor_unit_sub_cat_id = 0;
                    $unit->is_single = 1;
                    $unit->save();
                }
            } else {
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id = null;
                $floor->merge_parent_floor_status = in_array($f, $checked_floors) ? 1 : 0;
                $floor->save();
                // return $request->all();
                if (isset($request->nth_unit[$f])) {
                    $unit_id = 'unit_id' . $f;
                    if ((int) $request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int) $request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;

                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand = null;

                            if (isset($request->$unit_id[$u])) {
                                $unit = FloorUnitMap::find($request->$unit_id[$u]);
                                $unit->property_id = $request->property_id;
                                $unit->floor_id = $floor->id;
                                $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                                $unit->block_id = $request->block ?? 0;
                                $unit->tower_id = $request->tower;
                                $unit->merge_parent_unit_id = null;
                                $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                                $unit->floor_unit_sub_cat_id = 0;
                                $unit->save();
                            } else {
                                $unit = new FloorUnitMap();
                                $unit->property_id = $request->property_id;
                                $unit->floor_id = $floor->id;
                                $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                                $unit->block_id = $request->block ?? 0;
                                $unit->tower_id = $request->tower;
                                $unit->merge_parent_unit_id = null;
                                $unit->floor_unit_sub_cat_id = 0;
                                $unit->save();
                            }
                        }
                    }
                } else {
                    $unit = new FloorUnitMap();
                    $unit->property_id = $request->property_id;
                    $unit->floor_id = $floor->id;
                    $unit->unit_name = isset($request->floor_name[$f]) ? $request->floor_name[$f] : '';
                    $unit->block_id = $request->block ?? 0;
                    $unit->tower_id = $request->tower;
                    $unit->merge_parent_unit_id = null;
                    $unit->floor_unit_sub_cat_id = 0;
                    $unit->is_single = 1;
                    $unit->save();
                }
            }
        }

        $floors = PropertyFloorMap::where('property_id', $request->property_id)
            ->where('merge_parent_floor_status', 1)
            ->get();
        $parent_floor = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        foreach ($floors as $floor) {
            if ($merge_parent_floor_id != $floor->id) {
                $floor = PropertyFloorMap::find($floor->id);
                $floor->units = 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id = $merge_parent_floor_id;
                $floor->merge_parent_floor_status = 0;
                $floor->save();
                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->brand_name = $parent_floor->brand_name;
                $child_floor->block_id = $request->block ?? 0;
                $child_floor->tower_id = $request->tower;
                $child_floor->save();
            }
        }
        $units = FloorUnitMap::where('property_id', $request->property_id)
            ->where('merge_parent_unit_status', 1)
            ->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
        foreach ($units as $unit) {
            if ($merge_parent_unit_id != $unit->id) {
                $unit = FloorUnitMap::find($unit->id);
                $unit->unit_name = $parent_unit->unit_name;
                $unit->block_id = $request->block ?? 0;
                $unit->tower_id = $request->tower;
                $unit->merge_parent_unit_id = $merge_parent_unit_id;
                $unit->merge_parent_unit_status = 0;
                $unit->save();
            }
        }
        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id' => $request->property_id,
                        'action_url' => '',
                        'message' => 'Floors Added Successfully.',
                    ],
                ],
                200,
            );
        }
    }

    public function commercialTowerDetails(Request $request, $id)
    {
        $property = Property::where('cat_id', config('constants.COMMERCIAL'))
            ->where('created_by', Auth::user()->id)
            ->where('id', $id)
            ->first();
        // $propertyAmenities = PropertyAmenity::where('property_category_id', $property->cat_gc)->get();
        $blocks = Block::where('property_id', $property->id)
            ->where('no_of_blocks', '>', 0)
            ->get();

        $towers = Tower::where('property_id', $property->id)
            ->where('tower_status', '!=', null)
            ->where('no_of_towers', '>', 0)
            ->get();

        $propertyAmenities = PropertyAmenity::where('property_category_id', 16)->get();

        $project_status = ProjectStatus::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $under_construction = UnderConstruction::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $floor_type = FloorType::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $units = Unit::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $gis_id = $property->gis_id;
        $get_property = Property::where('gis_id', $gis_id)
            ->where('cat_id', '2')
            ->first();
        // $get_property->residential_sub_type
        // $secondary_blade_slug = Category::where('id', 10)->value('secondary_blade_slug');
        $towers = Tower::where('property_id', $property->id)
            // ->where('tower_status', '!=', null)
            ->where('no_of_towers', '>', 0)
            ->get();

        $tower_log = TowerLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();
        $project_status_log = ProjectStatusLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();

        $compliances = Compliances::where('property_id', $property->id)->first();
        $files = null;
        $file_name = null;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($compliances->images)) {
            foreach ($compliances->images as $key => $image) {
                $files[$image->file_type][$key] = asset($image->file_path . $image->file_name);
                $file_name[$image->file_type][$key] = $image->file_type;
            }
        }

        $project_repository = ProjectRepository::where('property_id', $property->id)->first();
        $block_tower_repositories = BlockTowerRepository::with('block')
            ->where('property_id', $property->id)
            ->get();
        // $block_id = $request->block_id;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($project_repository->media_files)) {
            foreach ($project_repository->media_files as $key => $image) {
                $project_repository_files[$image->file_type][$key] = asset($image->file_name);
                $project_repository_file_name[$image->file_type][$key] = $image->file_type;
            }
        }

        if (isset($project_repository->other_files)) {
            foreach ($project_repository->other_files->where('form_id', 1) as $key => $image) {
                if (!empty($image->image)) {
                    $project_repository_other_files[$key] = asset($image->image);
                    $project_repository_other_file_name[$key] = $image->name;
                }
            }
        }

        foreach ($block_tower_repositories as $id => $block_tower_repository) {
            if (isset($block_tower_repository->media_files)) {
                foreach ($block_tower_repository->media_files as $key => $image) {
                    $block_tower_repository_files_array[$id][$image->file_type][$key] = asset($image->file_name);
                    $block_tower_repository_file_name[$id][$image->file_type][$key] = $image->file_type;
                }
            }

            if (isset($block_tower_repository->other_files)) {
                foreach ($block_tower_repository->other_files->where('form_id', 2) as $key => $image) {
                    $block_tower_repository_other_files[$id][$key] = asset($image->image);
                    $block_tower_repository_other_file_name[$id][$key] = $image->name;
                }
            }
        }

        // dd($block_tower_repository->media_files);

        $price_trends = PriceTrend::where('property_id', $property->id)->paginate(10);
        // dd($block_tower_repository_files);
        return view('admin.pages.property.commercial_tower_gated_community.commercial_tower_details', get_defined_vars());
    }

    public function commercialTowerFloorDetails(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::find($property_id);
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)
            ->where('tower_id', $request->tower_id)
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
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();

        $single_units = FloorUnitMap::where('property_id', $property_id)
            ->where('is_single', 1)
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)
            ->where('tower_id', $request->tower_id)
            ->get();
        $prop_categories = Category::where('parent_id', null)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        if (isset($request->page_type) && $request->page_type == 'view') {
            return view('admin.pages.property.commercial_tower_gated_community.view_floor', get_defined_vars());
        }
        return view('admin.pages.property.commercial_tower_gated_community.edit_floor', get_defined_vars());
    }

    public function commercialTowerEditDetails(Request $request, $id)
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

        $gis_id = $request->gis_id;
        $property = Property::where('id', $id)
            ->where('cat_id', config('constants.COMMERCIAL'))
            ->where('created_by', Auth::user()->id)
            ->first();

        $get_property = $property;
        if ($property) {
            if ($property->cat_id == config('constants.COMMERCIAL')) {
                $general_detail_blade_slug = Category::where('id', config('constants.COMMERCIAL_TOWER'))->value('secondary_blade_slug');
                // return view('admin.pages.property.'.$secondary_blade_slug, get_defined_vars());
            }
        }

        return view('admin.pages.property.commercial_tower_gated_community.edit_commercial_tower_comunity', get_defined_vars());
    }
}
