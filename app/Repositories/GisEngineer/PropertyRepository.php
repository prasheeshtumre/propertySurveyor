<?php

namespace App\Repositories\GisEngineer;

use App\Models\Property;
use App\Repositories\GisEngineer\IPropertyRepository;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\FloorUnitCategory;
use App\Models\Builder;
use App\Models\{Tower, PropertyFloorMap, FloorUnitMap, GisIDMapping};
use Carbon\Carbon;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class PropertyRepository implements IPropertyRepository
{
    public function properties(Request $request, $type)
    {
        
        $categories = Category::where('parent_id', null)
            ->OrderBy('id', 'ASC')
            ->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $residential = Category::where('parent_id', 2)
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $brand_sub_categories = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $brands = FloorUnitCategory::where('category_code', 4)
            ->orderBy('id', 'ASC')
            ->get();
        $builders = Builder::all();
        $properties = Property::query();

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $from = date($request->get('start_date') . ' 00:00:00');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . ' 23:58:59';
        }

        if ($request->has('end_date') && !empty($request->get('end_date'))) {
            $to = date($request->get('end_date') . ' 23:58:59');
        }
        $properties
            ->when($request->category, function ($query) use ($request) {
                $query->where('cat_id', $request->category);
            })
            ->when($request->gis_id, function ($query) use ($request) {
                $query->where('gis_id', 'like', '%' . $request->gis_id . '%');
            })
            // ->when($request->pincode, function ($query) use ($request) {
            //     $query->where('pincode', $request->pincode);
            // })
            ->when($request->project_name, function ($query) use ($request) {
                $query->where('project_name', 'like', '%' . $request->project_name . '%');
            })
            ->when($request->residential_category, function ($query) use ($request) {
                $query->where('residential_type', 'like', '%' . $request->residential_category . '%');
            })
            ->when($request->residential_sub_category, function ($query) use ($request) {
                $query->where('residential_sub_type', 'like', '%' . $request->residential_sub_category . '%');
            })
            ->when($request->building_name, function ($query) use ($request) {
                $query->where('building_name', 'like', '%' . $request->building_name . '%');
            })
            ->when($request->house_no, function ($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
            })
            ->when($request->locality_name, function ($query) use ($request) {
                $query->where('locality_name', 'like', '%' . $request->locality_name . '%');
            })
            ->when($request->plot_no, function ($query) use ($request) {
                $query->where('plot_no', 'like', '%' . $request->plot_no . '%');
            })
            ->when($request->plot_name, function ($query) use ($request) {
                $query->where('plot_name', 'like', '%' . $request->plot_name . '%');
            })
            ->when($request->street_name, function ($query) use ($request) {
                $query->where('street_details', 'like', '%' . $request->street_name . '%');
            })
            ->when($request->owner_name, function ($query) use ($request) {
                $query->where('owner_name', 'like', '%' . $request->owner_name . '%');
            })
            ->when($request->builder_name, function ($query) use ($request) {
                $query->where('builder_id', $request->builder_name);
            })
            ->when($request->contact_no, function ($query) use ($request) {
                $query->where('contact_no', 'like', '%' . $request->contact_no . '%');
            })
            ->when($request->plot_land_types, function ($query) use ($request) {
                $query->where('plot_land_type', $request->plot_land_types);
            })
            ->when($request->construction_type, function ($query) use ($request) {
                $query->where('under_construction_type', $request->construction_type);
            })
            ->when($request->no_of_floors, function ($query) use ($request) {
                $query->where('no_of_floors', $request->no_of_floors);
            });

        if (isset($request->property_type) && !empty($request->property_type)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_type_id', $request->property_type);
            });
        }
        if (isset($request->brand_category) && !empty($request->brand_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_id', $request->brand_category);
            });
        }

        // if (isset($request->no_of_units) && !empty($request->no_of_units)) {
        //     $properties = $properties->whereHas('property_floors', function ($query) use ($request) {
        //         $query->where('units', $request->no_of_units);
        //     });
        // }

        if (isset($request->no_of_units) && !empty($request->no_of_units)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->selectRaw('COUNT(*) as row_count')->having('row_count', '=', $request->no_of_units);
            });
        }

        if (isset($request->brand_sub_category) && !empty($request->brand_sub_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_sub_cat_id', $request->brand_sub_category);
            });
        }
        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_brand_id', $request->brand_id);
            });
        }

        if (isset($request->pincode) && !empty($request->pincode)) {
            $properties = $properties->whereHas('pincode', function ($query) use ($request) {
                $query->where('pincode_id', $request->pincode);
            });
        }

        if (isset($request->unit_type_id) && !empty($request->unit_type_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_type_id', $request->unit_type_id);
            });
        }

        // if(isset($request->owner_name) && !empty($request->owner_name)){
        //     $properties = $properties->whereHas('builderName', function ($query) use ($request) {
        //                                 $query->where('name', 'like', '%' .$request->owner_name  . '%');
        //                             });
        // }

        if ($request->sale_rent == 1) {
            $properties = $properties->where(function ($query) use ($request) {
                $query->where('up_for_sale', 1);
                if ($request->sale_rent == 1) {
                    $query->orWhereHas('floors', function ($floorsQuery) {
                        $floorsQuery->where('up_for_sale', 1);
                    });
                }
            });
        }
        if ($request->sale_rent == 2) {
            $properties = $properties->where(function ($query) use ($request) {
                $query->where('up_for_rent', 1);
                if ($request->sale_rent == 2) {
                    $query->orWhereHas('floors', function ($floorsQuery) {
                        $floorsQuery->where('up_for_rent', 1);
                    });
                }
            });
        }

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        // if ($request->has('type') && !empty($request->get('type'))) {
        if ($type && !empty($type)) {
            if ($type == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($type == 'week') {
                // dd($now->startOfWeek()->format('Y-m-d'));
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($type == 'today') {
                $properties = $properties->whereDate('created_at', Carbon::today());
            }
            if ($type == 'for-rent') {
                $properties = $properties->withCount(['floor_units' => function ($query) {
                                                $query->where('up_for_rent', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            }])
                                            ->whereHas('floor_units', function ($query) {
                                                $query->where('up_for_rent', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            });
            }
            if ($type == 'vacant') {
                $properties = $properties->withCount(['floor_units' => function ($query) {
                                                $query->where('unit_type_id', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            }])
                                            ->whereHas('floor_units', function ($query) {
                                                $query->where('unit_type_id', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            });
            }
            if ($type == 'for-sale') {
                $properties = $properties->withCount(['floor_units' => function ($query) {
                                                $query->where('up_for_sale', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            }])->whereHas('floor_units', function ($query) {
                                                $query->where('up_for_sale', 1)
                                                    ->whereDate('updated_at', '>=', now()->subDays(30));
                                            });
            }
            if ($type == 'under-construction') {
                $properties = $properties->where('cat_id', 5)
                                         ->whereDate('updated_at', '>=', Carbon::now()->subDays(90));
            }
            if ($type == 'splits') {
                $properties = $properties->whereHas('splitMapping', function ($query) {
                                                $query->whereColumn('split_gis_id', 'properties.gis_id');
                                            });
            }
            if ($type == 'merged') {
                $properties = $properties->whereHas('gisIdMapping', function ($query) {
                                                $query->whereColumn('gis_id', 'properties.gis_id');
                                            })->whereIn('temp_gis_id_status', [0,1]);
            }
            if ($type == 'temporary-gis-id') {
                $properties = $properties->whereHas('temporayGisIdMappings', function ($query) {
                                                $query->whereColumn('gis_id_temp', 'properties.gis_id');
                                            });
            }
            if ($type == 'completed') {
                $properties = $properties->where('temp_gis_id_status', 2);
            }
        }

        $searchKeyword = $request->get('search');
        if (!empty($searchKeyword)) {
            $properties = $properties->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('gis_id', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('owner_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('house_no', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('locality_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('contact_no', 'LIKE', '%' . $request->search . '%');
                    // ->whereHas('property.category', function ($query) use ($value) {
                    //         $query->where('title', 'LIKE', '%'.$request->search.'%');
                    //     });
                });
            });
        }

        $property_count = count($properties->get());

        $properties = $properties
            ->orderBy('id', 'DESC')
            ->paginate(50);
        $properties->setPath(route('gis-engineer.properties', $type, [], true));
        foreach ($properties as $key => $property) {
            $towers = Tower::where('gis_id', $property->gis_id)->first();
            $properties[$key]['date'] = $property->created_at->format('d-m-Y');
            $properties[$key]['time'] = $property->created_at->format('H:i A');
            $properties[$key]['cat'] = $property->category->cat_name ?? '';
            $properties[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
            $properties[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? 'N/A';
            $properties[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
            $properties[$key]['plot_land_sub_type'] = $property->plot_land_sub_type->cat_name ?? 'N/A';
            $properties[$key]['construction_type'] = $property->under_construction_category->cat_name ?? 'N/A';
        }

        $category_type = '';
        if ($request->ajax()) {
            // dd("testing");
            if ($request->category == 1 || $request->category == 6) {
                return view('surveyor.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            } elseif ($request->residential_sub_category == 9 || $request->residential_sub_category == 10 || $request->residential_sub_category == 11 || $request->residential_sub_category == 12) {
                return view('surveyor.property_pagination', ['properties' => $properties, 'category_type' => $request->residential_sub_category, 'property_count' => $property_count]);
            } elseif ($request->plot_land_types == 13 || $request->plot_land_types == 14) {
                return view('surveyor.property_pagination', ['properties' => $properties, 'category_type' => $request->plot_land_types, 'property_count' => $property_count]);
            } elseif ($request->property_type == 1) {
                return view('surveyor.property_pagination', ['properties' => $properties, 'category_type' => $request->property_type, 'property_count' => $property_count]);
            } else {
                return view('surveyor.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            }
        }
        
        return ['categories' =>$categories,
        'unit_categories' => $unit_categories,
        'residential' =>$residential,
        'brand_parent_categories' =>$brand_parent_categories,
        'brand_sub_categories' =>$brand_sub_categories,
        'brands' =>$brands,
        'builders' =>$builders,'properties' => $properties, 'category_type' => $category_type, 'property_count' => $property_count];
    }

    public function getProperty(Request $request, $id)
    {
        $property = Property::with('unit_level_details')->find($request->id);
        $property;
        $unit_detail_ids = !empty($property->unit_level_details) ? $property->unit_level_details->pluck('unit_id')->toArray() : [];
        if ($property) {

            $categories = Category::all();
            $property_id = $property->id;
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
            $defined_blade = Category::where('id', $property->cat_id)->value('blade_slug');
            $defined_blade = str_replace('primary_data.', 'primary_data.view_', $defined_blade);
            $units = FloorUnitMap::where('property_id', $property_id)
                ->where('is_single', 0)
                ->orderBy('id', 'ASC')
                ->get();
            $parent_units = [];
            foreach ($units as $key => $unit) {
                $parent_unit_id[$unit->id] = $unit->floor_id;
                array_push($parent_units, $unit->merge_parent_unit_id);
            }
            $custom_brands = FloorUnitMap::where('property_id', $property_id)->get();
            $prop_categories = Category::where('parent_id', null)->get();
            $unit_categories = FloorUnitCategory::where('category_code', 1)
                ->select(['id', 'name', 'field_type'])
                ->get();
            $unit_category_list = FloorUnitCategory::where('category_code', 2)
                ->select(['id', 'name', 'field_type'])
                ->get();
            $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)
                ->select(['id', 'name', 'field_type'])
                ->get();
            $brands = FloorUnitCategory::where('category_code', 4)->get();
            $floor_visible_status =  $property->residential_sub_type == 10 || $property->residential_sub_type == 12 || $property->plot_land_type == 14 || $property->commercial_type == 16 ? 'd-none' : '';
             $merges = GisIDMapping::where('gis_id', $property->gis_id)
                ->pluck('merge_id')
                ->toArray();
                // dd($merges);
            $splits = 0;
            if (!empty($property->parent_split_id)) {
                $splits = Property::where('parent_split_id', $property->parent_split_id)->get();
                $splits = $splits ? $splits->count() : 0;
            }
            // dd($defined_blade);
            return [
                'property' =>$property,'categories' =>$categories,'property_id' =>$property_id,'floors' =>$floors,
                'floor_index' =>$floor_index,'parent_unit_id' =>$parent_unit_id,'parent_floors' =>$parent_floors,'defined_blade' => $defined_blade,'units' => $units,
                'parent_units' =>$parent_units,'custom_brands' =>$custom_brands,'prop_categories' =>$prop_categories,'unit_categories' =>$unit_categories,'unit_category_list' =>$unit_category_list,
                'unit_sub_category_list' =>$unit_sub_category_list, 'unit_detail_ids' => $unit_detail_ids,
                'brands' => $brands,'floor_visible_status' => $floor_visible_status,'merges' =>$merges, 'splits' =>$splits
            ];

            // return view('admin.pages.property.report_details', get_defined_vars());
        } else {
            abort(404);
        }
    }

    public function editProperty($id)
    {
        // $sub_categories = SubCategory::all();
        $property = Property::with('builder.sub_groups')->find($id);
        if ($property) {
            $categories = Category::all();
            $property->images;
            $property_id = $property->id;
            $property_cat_id = $property->cat_id;
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
            $defined_blade = Category::where('id', $property->cat_id)->value('blade_slug');
            $defined_blade = str_replace('primary_data.', 'primary_data.edit.edit_', $defined_blade);
            $units = FloorUnitMap::where('property_id', $property_id)
                ->where('is_single', 0)
                ->orderBy('id', 'ASC')
                ->get();
            $parent_units = [];
            foreach ($units as $key => $unit) {
                $parent_unit_id[$unit->id] = $unit->floor_id;
                array_push($parent_units, $unit->merge_parent_unit_id);
            }
            $custom_brands = FloorUnitMap::where('property_id', $property_id)
                ->where('brand_name', '!=', '')
                ->get();
            $prop_categories = Category::where('parent_id', null)->get();
            $unit_categories = FloorUnitCategory::where('category_code', 1)
                ->select(['id', 'name', 'field_type', 'parent_id'])
                ->get();
            $unit_category_list = FloorUnitCategory::where('category_code', 2)
                ->select(['id', 'name', 'field_type', 'parent_id'])
                ->get();
            $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)
                ->select(['id', 'name', 'field_type', 'parent_id'])
                ->get();
            $brands = FloorUnitCategory::where('category_code', 4)->get();
            $sub_categories = Category::where('parent_id', $property->cat_id)
                ->orderBy('id', 'ASC')
                ->get();
            $builders = Builder::all();
            // 4,5,6 --> Under Construction, Plot/Land, Demolised
            $edit_allowed_categories = [4, 5, 6];
            $merges = GisIDMapping::where('gis_id', $property->gis_id)
                ->pluck('merge_id')
                ->toArray();
            $floor_visible_status = $property->residential_sub_type == 10 || $property->residential_sub_type == 12 || $property->plot_land_type == 14 ? 'd-none' : '';

            return ['categories' => $categories,
                    'property_id' => $property_id,
                    'property_cat_id' => $property_cat_id,
                    'floors' => $floors,
                    'floor_index' => $floor_index,
                    'parent_unit_id' => $parent_unit_id,
                    'parent_floors' => $parent_floors,
                    'defined_blade' => $defined_blade,
                    'units' => $units,
                    'parent_units' => $parent_units,
                    'custom_brands' => $custom_brands,
                    'prop_categories' => $prop_categories,
                    'unit_categories' => $unit_categories,
                    'unit_category_list' => $unit_category_list,
                    'unit_sub_category_list' => $unit_sub_category_list,
                    'brands' => $brands,
                    'sub_categories' => $sub_categories,
                    'builders' => $builders,
                    'edit_allowed_categories' => $edit_allowed_categories,
                    'merges' => $merges,
                    'floor_visible_status' => $floor_visible_status,
                    'property' => $property];

        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $input_data = $request->all();
        $validator = Validator::make(
            $input_data,
            [
                // 'files.*' => 'mimes:jpg,jpeg,png,bmp|max:20000',
                // 'city' => 'required',
                // 'gis_id' => 'required',
                //  'latitude' => 'required',
                //  'longitude' => 'required',
                // 'category' => 'required',
                // 'sub_category' => 'required_if:category,' . implode(',', [1, 2, 3, 4]),
                // 'house_no' => '',
                // 'plot_no' => '',
                // 'street_details' => 'required',
                // 'locality_name' => 'required',
                // 'owner_name' => '',
                // 'contact_no' => '',
                // 'remarks' => '',
            ],
            [
                // 'image_file.*.required' => 'Please upload an image',
                // 'files.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                // 'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'category.numeric' => 'Please choose a category',
                'sub_category.numeric' => 'Please choose a Sub Category',
            ],
        );

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
        // return request()->all();
        $property = Property::find($id);
        if ($property) {
            request()->merge(['gis_id' => $property->gis_id]);
            if (isset($request->split_merge) && $request->split_merge == 2) {
                $validations = self::validate_mgis($request);
                if (!empty($validations) && $validations->getData()->status == false) {
                    return $validations;
                }
            }
            $property->cat_id = $request->category;
            $property->sub_cat_id = $request->sub_category;
            $property->house_no = $request->house_no;
            $property->building_name = $request->building_name;
            $property->plot_no = $request->plot_no;
            $property->street_details = $request->street_name;
            $property->locality_name = $request->locality_name;
            $property->owner_name = $request->owner_name;

            $property->contact_no = $request->contact_no;
            $property->remarks = $request->remarks;
            $property->created_by = Auth::user()->id;
            $property->no_of_floors = $request->no_of_floors;
            $property->residential_type = isset($request->residential_type) ? $request->residential_type : 0;
            $property->residential_sub_type = isset($request->residential_sub_type) ? $request->residential_sub_type : 0;
            $property->project_name = isset($request->project_name) ? $request->project_name : 0;
            $property->builder_id = isset($request->builder_id) ? $request->builder_id : 0;
            $property->builder_sub_group = isset($request->builder_sub_group) ? $request->builder_sub_group : 0;
            $property->plot_land_type = isset($request->plot_land_type) ? $request->plot_land_type : 0;
            $property->plot_name = isset($request->plot_name) ? $request->plot_name : '';
            $property->boundary_wall_availability = isset($request->boundary_wall_availability) ? 1 : 0;
            $property->any_legal_litigation_board = isset($request->any_legal_litigation_board) ? 1 : 0;
            $property->ownership_claim_board = isset($request->ownership_claim_board) ? 1 : 0;
            $property->bank_auction_board = isset($request->bank_auction_board) ? 1 : 0;
            $property->for_sale_board = isset($request->for_sale_board) ? 1 : 0;
            $property->under_construction_type = isset($request->under_construction_type) ? $request->under_construction_type : null;
            $property->up_for_sale = isset($request->up_for_sale) ? 1 : 0;
            $property->up_for_rent = isset($request->up_for_rent) ? 1 : 0;
            $property->cat_gc = isset($request->property_gcc) ? $request->property_gcc : 0;
            $property->save();

            if (isset($request->split_merge) && $request->split_merge == 2) {
                //performing GIS-ID Merge
                request()->merge(['created_by' => Auth::user()->id]);
                request()->merge(['gis_id' => $property->gis_id]);
                foreach ($request->mgis_id as $merge_id) {
                    request()->merge(['merge_id' => $merge_id]);
                    //performing GISID merge for property
                    $mergeGISIDRequestDTO = new MergeGISIDRequestDTO($request);
                    // Resolve the MergeGISIDRequestDTO instance
                    $mergeGISIDController = app(MergeGISIDController::class);
                    // Calling the create method
                    $mergeGISID = $mergeGISIDController->create($mergeGISIDRequestDTO);
                }
                $property->merges = count($request->mgis_id);
                $property->save();
            }

            $floors_merge_status = $property->floors_merge_status;
            $units_merge_status = $property->units_merge_status;
            // $this->floorService->processFloorData($request->all());

            $merge_parent_floor_id = 0;
            $child_floor_arr = [];

            // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
            $merge_parent_unit_id = null;
            // $merge_unit_parent_floor_id = 0;
            // $child_unit_arr = [];
            $checked_floors = isset($request->floor) ? $request->floor : [];
            for ($f = 0; $f < (int) $request->no_of_floors; $f++) {
               
                if(isset($request->floor_id[$f])){
                    $floor = PropertyFloorMap::find($request->floor_id[$f]);
                    $floor->property_id =  $request->property_id;
                    $floor->floor_no = $f ?? 0;
                    $floor->units = $request->nth_unit[$f] ?? 0;
                    $floor->floor_name = $request->floor_name[$f] ?? 0;
                    $floor->merge_parent_floor_status = in_array($f, $checked_floors) ? 1 : 0;
                    $floor->save();
                }else{
                    $floor = new PropertyFloorMap;
                    $floor->property_id =  $request->property_id;
                    $floor->floor_no = $f ?? 0;
                    $floor->units = $request->nth_unit[$f] ?? 0;
                    $floor->floor_name = $request->floor_name[$f] ?? 0;
                    $floor->merge_parent_floor_status = in_array($f, $checked_floors) ? 1 : 0;
                    $floor->save();
                }
      
                // echo $floor->id;
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                // isset($request->nth_unit[$f]) ? array_push($child_floor_arr, $floor->id) : '' ;

                if (isset($request->nth_unit[$f])) {
                    if ((int) $request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int) $request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $uprop_category_key = 'uprop_category' . $f;
                            $uu_type_key = 'uu_type' . $f;
                            $unit_category_key = 'unit_category' . $f;
                            $unit_sub_category_key = 'unit_sub_category' . $f;
                            $unit_brand_key = 'unit_brand' . $f;
                            $person_name_key = 'person_name' . $f;
                            $mobile_key = 'mobile' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand_name = 'unit_brand_name' . $f;
                            $unit_id_key = 'unit_id' . $f;
                            $unit_up_for_sale = 'unit_up_for_sale' . $f;
                            $unit_up_for_rent = 'unit_up_for_rent' . $f;
                            $unit_brand = null;
                            $unit_brand_id = null;
                            $uu_brand_name = '';
                            if (isset($request->$unit_brand_key[$u])) {
                                if (is_numeric($request->$unit_brand_key[$u])) {
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if ($check_floor_category) {
                                        $unit_brand_id = $request->$unit_brand_key[$u];
                                        $uu_brand_name = '';
                                    }
                                } else {
                                    $unit_brand_id = 0;
                                    $uu_brand_name = $request->$unit_brand_key[$u];
                                }
                            }

                            
                            if(isset($request->$unit_id_key[$u])){
                                $unit = FloorUnitMap::find($request->$unit_id_key[$u]);
                                $unit->property_id = $request->property_id;
                                $unit->floor_id = $floor->id;
                                $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                                $unit->unit_cat_type_id = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                                $unit->unit_type_id = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                                $unit->unit_cat_id = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                                $unit->unit_sub_cat_id = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                                $unit->person_name = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                                $unit->mobile = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                                $unit->up_for_sale = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                                $unit->up_for_rent = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                                $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                                $unit->floor_unit_sub_cat_id = 0;
                                $unit->unit_brand_id = isset($request->$unit_sub_category_key[$u]) && !empty($request->$unit_sub_category_key[$u]) ? $unit_brand_id : 0;
                                $unit->brand_name = isset($request->$unit_sub_category_key[$u]) && !empty($request->$unit_sub_category_key[$u]) ? $uu_brand_name : '';
                                $unit->save();
                            }else{ 
                                $unit = new FloorUnitMap;
                                $unit->property_id = $request->property_id;
                                $unit->floor_id = $floor->id;
                                $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                                $unit->unit_cat_type_id = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                                $unit->unit_type_id = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                                $unit->unit_cat_id = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                                $unit->unit_sub_cat_id = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                                $unit->person_name = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                                $unit->mobile = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                                $unit->up_for_sale = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                                $unit->up_for_rent = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                                $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                                $unit->floor_unit_sub_cat_id = 0;
                                $unit->unit_brand_id = isset($request->$unit_sub_category_key[$u]) && !empty($request->$unit_sub_category_key[$u]) ? $unit_brand_id : 0;
                                $unit->brand_name = isset($request->$unit_sub_category_key[$u]) && !empty($request->$unit_sub_category_key[$u]) ? $uu_brand_name : '';
                                $unit->save();
                            }
                           
                            // update children unit names

                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {
                        $floor_unit = FloorUnitMap::where('floor_id', $floor->id)->first();
                        $floor_unit_id = !empty($floor_id) ? $floor_unit->id : FloorUnitMap::max('id') + 1;
                        $floor_brand_id = null;
                        $floor_brand_name = '';
                        if (isset($request->floor_brand[$f])) {
                            if (is_numeric($request->floor_brand[$f])) {
                                $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                                if ($check_floor_category) {
                                    $floor_brand_id = $request->floor_brand[$f];
                                    $floor_brand_name = '';
                                }
                            } else {
                                $floor_brand_id = 0;
                                $floor_brand_name = $request->floor_brand[$f];
                            }
                        }
                        if(!empty($floor->id)){
                            $unit = FloorUnitMap::find($floor_unit->id);
                            $unit->property_id = $request->property_id;
                            $unit->floor_id = $floor->id;
                            $unit->unit_name = '';
                            $unit->unit_cat_type_id = $request->prop_category[$f] ?? 0;
                            $unit->unit_type_id = $request->unit_type[$f] ?? 0;
                            $unit->unit_cat_id = $request->fu_category[$f] ?? 0;
                            $unit->unit_sub_cat_id = $request->fu_sub_category[$f] ?? 0;
                            $unit->person_name = $request->person_name[$f] ?? '';
                            $unit->mobile = $request->mobile[$f] ?? '';
                            $unit->up_for_sale = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                            $unit->up_for_rent = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                            // 'merge_parent_unit_id'  => NULL,
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->unit_brand_id = $floor_brand_id;
                            $unit->brand_name = $floor_brand_name;
                            $unit->save();
                        }else{
                            $unit = new FloorUnitMap;
                            $unit->property_id = $request->property_id;
                            $unit->floor_id = $floor->id;
                            $unit->unit_name = '';
                            $unit->unit_cat_type_id = $request->prop_category[$f] ?? 0;
                            $unit->unit_type_id = $request->unit_type[$f] ?? 0;
                            $unit->unit_cat_id = $request->fu_category[$f] ?? 0;
                            $unit->unit_sub_cat_id = $request->fu_sub_category[$f] ?? 0;
                            $unit->person_name = $request->person_name[$f] ?? '';
                            $unit->mobile = $request->mobile[$f] ?? '';
                            $unit->up_for_sale = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                            $unit->up_for_rent = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                            // 'merge_parent_unit_id'  => NULL,
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->unit_brand_id = $floor_brand_id;
                            $unit->brand_name = $floor_brand_name;
                            $unit->save();
                        }
                        
                    }
                } else {
                    $unit = new FloorUnitMap();
                    $unit->property_id = $request->property_id;
                    $unit->floor_id = $floor->id;
                    $unit->unit_name = '';
                    $unit->unit_cat_type_id = $request->prop_category[$f] ?? 0;
                    $unit->unit_type_id = $request->unit_type[$f] ?? 0;
                    $unit->unit_cat_id = $request->fu_category[$f] ?? 0;
                    $unit->unit_sub_cat_id = $request->fu_sub_category[$f] ?? 0;
                    // $unit->unit_brand_id         = $request->floor_brand[$f] ?? 0 ;
                    $unit->person_name = $request->person_name[$f] ?? '';
                    $unit->mobile = $request->mobile[$f] ?? '';
                    $unit->up_for_sale = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                    $unit->up_for_rent = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                    $unit->merge_parent_unit_id = null;
                    $unit->floor_unit_sub_cat_id = 0;
                    // $unit->brand_name            = $request->floor_brand_name[$f] ?? '' ;
                    if (isset($request->floor_brand[$f])) {
                        if (is_numeric($request->floor_brand[$f])) {
                            $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                            if ($check_floor_category) {
                                $unit->unit_brand_id = $request->floor_brand[$f];
                                $unit->brand_name = '';
                            }
                        } else {
                            $unit->unit_brand_id = 0;
                            $unit->brand_name = $request->floor_brand[$f];
                        }
                    }
                    $unit->save();
                }
            }

            $exist_units = FloorUnitMap::where('property_id', $request->property_id)->get();
            foreach ($exist_units as $exist_unit) {
                $merged_units = FloorUnitMap::where('property_id', $request->property_id)
                    ->where('merge_parent_unit_id', $exist_unit->id)
                    ->pluck('id')
                    ->toArray();
                // Perform the child units update with parent unit data
                DB::table('floor_unit_map')
                    ->whereIn('id', $merged_units)
                    ->update([
                        'unit_name' => $exist_unit->unit_name,
                        'unit_cat_type_id' => $exist_unit->unit_cat_type_id,
                        'unit_type_id' => $exist_unit->unit_type_id,
                        'unit_cat_id' => $exist_unit->unit_cat_id,
                        'unit_sub_cat_id' => $exist_unit->unit_sub_cat_id,
                        'unit_brand_id' => $exist_unit->unit_brand_id,
                        'person_name' => $exist_unit->person_name,
                        'mobile' => $exist_unit->mobile,
                        'up_for_sale' => $exist_unit->up_for_sale,
                        'up_for_rent' => $exist_unit->up_for_rent,
                        'brand_name' => $exist_unit->brand_name,
                    ]);
            }
            $exist_floors = PropertyFloorMap::where('property_id', $request->property_id)->get();
            // $exist_floor_unit = PropertyFloorMap::
            foreach ($exist_floors as $exist_floor) {
                $merged_floors = PropertyFloorMap::where('property_id', $request->property_id)
                    ->where('merge_parent_floor_id', $exist_floor->id)
                    ->pluck('id')
                    ->toArray();
                $merged_floor_unit = FloorUnitMap::where('property_id', $request->property_id)
                    ->where('floor_id', $exist_floor->id)
                    ->first();
                // Perform the child units update with parent unit data
                DB::table('property_floor_map')
                    ->whereIn('id', $merged_floors)
                    ->update([
                        'floor_name' => $exist_floor->floor_name,
                    ]);
                if ($exist_floor->units <= 1) {
                    DB::table('floor_unit_map')
                        ->whereIn('floor_id', $merged_floors)
                        ->update([
                            'unit_name' => $merged_floor_unit->unit_name,
                            'unit_cat_type_id' => $merged_floor_unit->unit_cat_type_id,
                            'unit_type_id' => $merged_floor_unit->unit_type_id,
                            'unit_cat_id' => $merged_floor_unit->unit_cat_id,
                            'unit_sub_cat_id' => $merged_floor_unit->unit_sub_cat_id,
                            'unit_brand_id' => $merged_floor_unit->unit_brand_id,
                            'person_name' => $merged_floor_unit->person_name,
                            'mobile' => $merged_floor_unit->mobile,
                            'up_for_sale' => $merged_floor_unit->up_for_sale,
                            'up_for_rent' => $merged_floor_unit->up_for_rent,
                            'brand_name' => $merged_floor_unit->brand_name,
                        ]);
                }
            }

            $floors = PropertyFloorMap::where('property_id', $request->property_id)
                ->where('merge_parent_floor_status', 1)
                ->get();
            $parent_floor_unit = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
            $parent_floor = PropertyFloorMap::where('id', $merge_parent_floor_id)->first();
            foreach ($floors as $floor) {
                if ($merge_parent_floor_id != $floor->id) {
                    $floor = PropertyFloorMap::find($floor->id);
                    $floor->units = 0;
                    $floor->floor_name = $parent_floor->floor_name;
                    $floor->merge_parent_floor_id = $merge_parent_floor_id;
                    $floor->merge_parent_floor_status = 0;
                    $floor->save();

                    $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                    $child_floor->unit_cat_type_id = $parent_floor_unit->unit_cat_type_id;
                    $child_floor->unit_type_id = $parent_floor_unit->unit_type_id;
                    $child_floor->unit_cat_id = $parent_floor_unit->unit_cat_id;
                    $child_floor->unit_sub_cat_id = $parent_floor_unit->unit_sub_cat_id;
                    $child_floor->unit_brand_id = $parent_floor_unit->unit_brand_id;
                    $child_floor->person_name = $parent_floor_unit->person_name;
                    $child_floor->mobile = $parent_floor_unit->mobile;
                    $child_floor->up_for_sale = $parent_floor_unit->up_for_sale;
                    $child_floor->up_for_rent = $parent_floor_unit->up_for_sale;
                    $child_floor->brand_name = $parent_floor_unit->brand_name;
                    $child_floor->save();
                    $floors_merge_status++;
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
                    $unit->unit_cat_type_id = $parent_unit->unit_cat_type_id;
                    $unit->unit_type_id = $parent_unit->unit_type_id;
                    $unit->unit_cat_id = $parent_unit->unit_cat_id;
                    $unit->unit_sub_cat_id = $parent_unit->unit_sub_cat_id;
                    $unit->unit_brand_id = $parent_unit->unit_brand_id;
                    $unit->person_name = $parent_unit->person_name;
                    $unit->mobile = $parent_unit->mobile;
                    $unit->up_for_sale = $parent_unit->up_for_sale;
                    $unit->up_for_rent = $parent_unit->up_for_rent;
                    $unit->brand_name = $parent_unit->brand_name;
                    $unit->merge_parent_unit_id = $merge_parent_unit_id;
                    $unit->merge_parent_unit_status = 0;
                    $unit->save();
                    $units_merge_status++;
                }
            }
            $property->floors_merge_status = $floors_merge_status > 0 ? 1 : 0;
            $property->units_merge_status = $units_merge_status > 0 ? 1 : 0;
            $property->save();
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => true,
                        'data' => [
                            'id' => $property->id,
                            'action_url' => url('surveyor/property/update_details/' . $property->id),
                            'floors_merge_status' => $floors_merge_status,
                            'units_merge_status' => $units_merge_status,
                        ],
                    ],
                    200,
                );
            }
            return redirect()
                ->route('update_screen')
                ->with('message', 'Property Updated Successfully')
                ->with('back_url', url('surveyor/property/report_details/' . $property->id));
        } else {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Your property not found!',
                    ],
                    400,
                );
            }
            $notification = [
                'message' => 'Your property not found!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    
}
