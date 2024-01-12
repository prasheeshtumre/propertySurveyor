<?php

namespace App\Http\Controllers\WebGis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\Models\{UnitAmenity, UnitAmenityOption, Budget, AreaMeasurement, FloorType, Parcel, Property, Ammenitity, Category, FloorUnitCategory, FloorUnitMap, PropertyFloorMap, SecondaryUnitLevelData};
use Carbon\Carbon;
use DB;
use Auth;
use PSpell\Config;
use GuzzleHttp\Client;

class WebGisController extends Controller
{
    public function index()
    {
        $property_facing = UnitAmenity::where('id', '12')->first();
        $property_facing_options = UnitAmenityOption::where('parent_id', '12')->get();
        $age_of_property_options = UnitAmenityOption::where('parent_id', '11')->get();
        $age_of_property_options = UnitAmenityOption::where('parent_id', '11')->get();
        $construction_status = UnitAmenityOption::where('parent_id', '10')->get();
        $ameneties = UnitAmenityOption::where('parent_id', '20')->get();

        $budgets = Budget::with('units')
            ->where('type', 1)
            ->get();

        $area_measurments = AreaMeasurement::with('units')->get();
        $categories = Category::where('parent_id', null)
            ->OrderBy('id', 'ASC')
            ->get();
        $subCategories = Category::where('parent_id', 1) // Commercial
            ->OrderBy('id', 'ASC')
            ->get();
        $plotLandCategories = Category::where('parent_id', 4) //  Plot/Land
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        return view('webgis.index', get_defined_vars());
    }

    public function handleClickOnMap(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $distance = 0.001;

        $results = DB::table('Parcel AS parcel')
            ->select('uniq_id')
            ->whereRaw('ST_DWithin(geom, ST_Transform(ST_SetSRID(ST_MakePoint(?, ?), 900913), 32644), ?)', [$lat, $lng, $distance])
            ->get();

        // $results_dummy = DB::table('DUMMY_FOR_BHANU AS dummy')
        //     ->select('uniq_id')
        //     ->whereRaw('ST_DWithin(geom, ST_Transform(ST_SetSRID(ST_MakePoint(?, ?), 900913), 32644), ?)', [$lat, $lng, $distance])
        //     ->get();
        // dd($results_dummy);
        $uniq_id = [];

        if (count($results) > 0) {
            foreach ($results as $row) {
                $uniq_id[] = $row;
            }

            echo $this->json_response($uniq_id, 200);
            return;
        } else {
            echo $this->json_response($uniq_id, 200);
            return;
        }
        return response()->json($results);
    }

    private function getNonSurveyFeature($request)
    {
        $minX = $request->minX;
        $minY = $request->minY;
        $maxX = $request->maxX;
        $maxY = $request->maxY;
        $gis_id = $request->gis_id;

        // dd($gis_id);

        if ($gis_id === null) {
            $properties_non_survey = Parcel::select(DB::raw('ST_AsText(geom) AS geometry'), 'uniq_id AS gis_id')
                ->whereNotIn('uniq_id', Property::pluck('gis_id')->toArray())
                ->whereRaw('ST_Intersects(ST_Transform(geom, 900913), ST_MakeEnvelope(?, ?, ?, ?, 900913))', [$minX, $minY, $maxX, $maxY])
                ->addSelect(DB::raw("'not-surveyed' AS surveyed"))
                ->limit(5000)
                ->get()
                ->toArray();
            return $properties_non_survey;
        } else {
            return [];
        }
    }

    public function getSearchedFeature(Request $request)
    {
        // $user_role_id = Auth::user()->role;
        $minX = $request->minX;
        $minY = $request->minY;
        $maxX = $request->maxX;
        $maxY = $request->maxY;

        $dateFilter = $request->dateFilter;
        $from_date = $request->from_date . ' 00:00:00';
        $to_date = $request->to_date . ' 23:59:59';
        $sale_rent = $request->sale_rent;

        $all_bedrooms = $request->all_bedrooms;
        $all_bathrooms = $request->all_bathrooms;

        $min_area = $request->min_area;
        $max_area = $request->max_area;
        $min_budget = $request->min_budget;
        $max_budget = $request->max_budget;
        $surveyed_id = $request->surveyed_id;
        $no_price = $request->no_price;
        $gated_community = $request->gated_community;
        $construction_state = $request->construction_state;
        $furnishing_status = $request->furnishing_status;
        $ameneties = $request->ameneties;
        $no_of_bedrooms = $request->no_of_bedrooms;
        $no_of_bathrooms = $request->no_of_bathrooms;
        $age_of_property = $request->age_of_property;
        $property_facing_id = $request->property_facing_id;
        $no_of_open_sides = $request->no_of_open_sides;

        $properties = Property::select('properties.*', DB::raw('ST_AsText(geom) AS geometry'))->leftJoin('Parcel', 'properties.gis_id', '=', 'Parcel.uniq_id');
        // $properties = Property::select('properties.*',
        //     DB::raw('CASE WHEN Parcel.uniq_id = properties.gis_id THEN ST_AsText(geom) ELSE NULL END AS geometry')
        // )
        // ->leftJoin('Parcel', 'properties.gis_id', '=', 'Parcel.uniq_id');

        // ->leftJoin('floor_unit_map', 'floor_unit_map.property_id', '=', 'properties.id')
        // ->leftJoin('secondary_level_unit_data', 'secondary_level_unit_data.property_id', '=', 'properties.id')
        // ->leftJoin('unit_amenity_option_values', 'unit_amenity_option_values.unit_id', '=', 'secondary_level_unit_data.unit_id');

        // Execute the query
        // $results = $query->get();
        $properties
            ->when($request->category_property, function ($query) use ($request) {
                $query->where('cat_id', $request->category_property);
            })
            ->when($request->subCategories, function ($query) use ($request) {
                $query->where('commercial_type', $request->subCategories);
            })
            ->when($request->plotLandTypes, function ($query) use ($request) {
                $query->where('plot_land_type', $request->plotLandTypes);
            })
            ->when($request->gis_id, function ($query) use ($request) {
                $query->where('gis_id', 'like', '%' . $request->gis_id . '%');
            })
            ->when($request->contact_no, function ($query) use ($request) {
                $query->where('contact_no', 'like', '%' . $request->contact_no . '%');
            })
            ->when($request->owner_full_name, function ($query) use ($request) {
                $query->where('owner_name', 'like', '%' . $request->owner_full_name . '%');
            })
            ->when($request->plot_no, function ($query) use ($request) {
                $query->where('plot_no', 'like', '%' . $request->plot_no . '%');
            })
            ->when($request->locality_name, function ($query) use ($request) {
                $query->where('locality_name', 'like', '%' . $request->locality_name . '%');
            })
            ->when($request->street_name, function ($query) use ($request) {
                $query->where('street_details', 'like', '%' . $request->street_name . '%');
            })
            ->when($request->house_no, function ($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
            })
            ->when($request->surveyor_id, function ($query) use ($request) {
                $query->where('created_by', $request->surveyor_id);
            });

        if ($request->category_property == config('constants.RESIDENTIAL')) {
            if (isset($gated_community) && $gated_community == 1) {
                $properties = $properties->where(function ($query) use ($gated_community) {
                    if ($gated_community == 1) {
                        $query->orWhere(function ($gatedQuery) {
                            $gatedQuery
                                ->where('residential_sub_type', config('constants.GATED_COMMUNITY_APARTMENT'))
                                ->orWhere('residential_sub_type', config('constants.GATED_COMMUNITY_VILLA'))
                                ->orWhere('plot_land_type', config('constants.GATED_COMMUNITY_PLOT_LAND'));
                        });
                    }
                });
                // $properties
                //     ->where('residential_sub_type', config('constants.GATED_COMMUNITY_APARTMENT'))
                //     ->orWhere('residential_sub_type', config('constants.GATED_COMMUNITY_VILLA'))
                //     ->orWhere('plot_land_type', config('constants.GATED_COMMUNITY_PLOT_LAND'));
            }
            if (isset($gated_community) && $gated_community == 0) {
                $properties = $properties->where(function ($query) use ($gated_community) {
                    if ($gated_community == 0) {
                        $query->orWhere(function ($gatedQuery) {
                            $gatedQuery
                                ->where('residential_sub_type', config('constants.STAND_ALONE_APARTMENT'))
                                ->orWhere('residential_sub_type', config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
                                ->orWhere('plot_land_type', config('constants.OPEN_PLOT_LAND'));
                        });
                    }
                });

                // $properties
                //     ->where('residential_sub_type', config('constants.STAND_ALONE_APARTMENT'))
                //     ->orWhere('residential_sub_type', config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
                //     ->orWhere('plot_land_type', config('constants.OPEN_PLOT_LAND'));
            }
        }

        if (isset($request->brand_category_id) && !empty($request->brand_category_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_id', $request->brand_category_id);
            });
        }

        if (isset($request->brand_sub_category_id) && !empty($request->brand_sub_category_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_sub_cat_id', $request->brand_sub_category_id);
            });
        }

        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_brand_id', $request->brand_id);
            });
        }

        if (isset($request->unit_type) && !empty($request->unit_type)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_type_id', $request->unit_type);
            });
        }

        if (isset($request->pincode) && !empty($request->pincode)) {
            $properties = $properties->whereHas('pincode', function ($query) use ($request) {
                $query->where('pincode_id', $request->pincode);
            });
        }

        if (!empty($min_area) || !empty($max_area)) {
            if (!empty($min_area) && !empty($max_area)) {
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($min_area, $max_area) {
                    $query
                        ->whereBetween('carpet_area', [$min_area, $max_area])
                        ->orWhereBetween('buildup_area', [$min_area, $max_area])
                        ->orWhereBetween('super_buildup_area', [$min_area, $max_area])
                        ->orWhereBetween('plot_area', [$min_area, $max_area]);
                    // $query
                    //     ->where('carpet_area', '>=', $min_area)
                    //     ->orWhere('carpet_area', '<=', $max_area)
                    //     ->orWhere('buildup_area', '>=', $min_area)
                    //     ->orWhere('buildup_area', '<=', $max_area)
                    //     ->orWhere('super_buildup_area', '>=', $min_area)
                    //     ->orWhere('super_buildup_area', '<=', $max_area);
                });
            } elseif (!empty($max_area)) {
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($max_area) {
                    $query
                        ->where('carpet_area', '<=', $max_area)
                        ->orWhere('buildup_area', '<=', $max_area)
                        ->orWhere('super_buildup_area', '<=', $max_area)
                        ->orWhere('plot_area', '<=', $max_area);
                });
            } else {
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($min_area) {
                    $query
                        ->where('carpet_area', '>=', $min_area)
                        ->orWhere('buildup_area', '>=', $min_area)
                        ->orWhere('super_buildup_area', '>=', $min_area)
                        ->orWhere('plot_area', '>=', $min_area);
                });
            }
        }

        if (!empty($min_budget) || !empty($max_budget)) {
            $minBudget = $this->getFormattedBudget($min_budget);
            $maxBudget = $this->getFormattedBudget($max_budget);

            if (!empty($min_budget) && !empty($max_budget)) {
                // $properties->where(function ($query) use ($minBudget, $maxBudget) {
                // $query->where('price', '>=', $minBudget)->orWhere('price', '<=', $maxBudget);
                // dd($minBudget, $maxBudget);
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($minBudget, $maxBudget) {
                    $query->whereBetween('expected_price', [$minBudget, $maxBudget]);
                    $query->orWhereBetween('expected_rent', [$minBudget, $maxBudget]);
                    $query->orWhereBetween('price', [$minBudget, $maxBudget]);
                });

                // });
            } elseif (!empty($max_budget)) {
                // $properties->where(function ($query) use ($maxBudget) {
                //     $query->where('price', '<=', $maxBudget);
                // });
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($maxBudget) {
                    $query->where('expected_price', '<=', $maxBudget);
                    $query->orWhere('expected_rent', '<=', $maxBudget);
                    $query->orWhere('price', '<=', $maxBudget);
                });
            } else {
                // $properties->where(function ($query) use ($minBudget) {
                //     $query->where('price', '>=', $minBudget);
                // });
                $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($minBudget) {
                    $query->where('expected_price', '>=', $minBudget);
                    $query->orWhere('expected_rent', '>=', $minBudget);
                    $query->orWhere('price', '>=', $minBudget);
                });
            }
        }

        if (!empty($all_bedrooms)) {
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) {
                $query->where('rooms', '!=', null);
            });
        }

        if (!empty($all_bathrooms)) {
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) {
                $query->where('washrooms', '!=', null)->orWhere('no_of_bathrooms', '!=', null);
            });
        }

        if (isset($no_price) && $no_price == 1) {
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) {
                $query
                    ->where('expected_price', '!=', null)
                    ->orWhere('expected_rent', '!=', null)
                    ->orWhere('price', '!=', null);
            });
        }

        if (isset($no_price) && $no_price == 0) {
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) {
                $query
                    ->where('expected_price', null)
                    ->where('expected_rent', null)
                    ->where('price', null);
            });
        }

        if (!empty($construction_state)) {
            $values = implode(',', $construction_state);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($construction_state) {
                $query->whereIn('availability_status', $construction_state);
            });
        }

        if (!empty($furnishing_status)) {
            $values = implode(',', $furnishing_status);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($values) {
                $furnishingValues = explode(',', $values);
                $query->whereIn('furnishing', $furnishingValues)->orWhereIn('furnishing_option', $furnishingValues);
            });
        }

        if (!empty($ameneties)) {
            $values = implode(',', $ameneties);
            $properties = $properties->whereHas('unit_amenity_option_values_s_u', function ($query) use ($values) {
                $amenetiesValues = explode(',', $values);
                $query->whereIn('amenity_option_id', $amenetiesValues);
            });
        }

        if (!empty($no_of_bedrooms)) {
            // $values = implode(',', $no_of_bedrooms);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($no_of_bedrooms) {
                $query->whereIn('rooms', $no_of_bedrooms);
            });
        }
        if (!empty($no_of_bathrooms)) {
            // $values = implode(',', $no_of_bathrooms);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($no_of_bathrooms) {
                $query->whereIn('no_of_bathrooms', $no_of_bathrooms)->orWhereIn('washrooms', $no_of_bathrooms);
            });
        }
        if (!empty($age_of_property)) {
            // $values = implode(',', $age_of_property);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($age_of_property) {
                $query->whereIn('age_of_property', $age_of_property);
            });
        }
        if (!empty($property_facing_id)) {
            // $values = implode(',', $property_facing_id);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($property_facing_id) {
                $query->whereIn('property_facing', $property_facing_id);
            });
        }
        if (!empty($no_of_open_sides)) {
            // $values = implode(',', $no_of_open_sides);
            $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($no_of_open_sides) {
                $query->whereIn('no_of_open_side', $no_of_open_sides);
            });
        }

        if ($sale_rent == 1) {
            $properties = $properties->where(function ($query) use ($sale_rent) {
                $query->where('up_for_sale', 1);
                if ($sale_rent == 1) {
                    $query->orWhereHas('floors', function ($floorsQuery) {
                        $floorsQuery->where('up_for_sale', 1);
                    });
                }
            });
        }
        if ($sale_rent == 2) {
            $properties = $properties->where(function ($query) use ($sale_rent) {
                $query->where('up_for_rent', 1);
                if ($sale_rent == 2) {
                    $query->orWhereHas('floors', function ($floorsQuery) {
                        $floorsQuery->where('up_for_rent', 1);
                    });
                }
            });
        }

        // if (!empty($sale_rent)) {
        //     // $properties = $properties->whereHas('secondary_unit_level_data', function ($query) use ($sale_rent) {
        //     //     $query->where('pricing_details_for', '=', $sale_rent);
        //     // });
        //     if ($sale_rent == 1) {
        //         if ($request->category_property == config('constants.PLOT_LAND') || $request->category_property == config('constants.UNDER_CONSTRUCTION') || $request->category_property == config('constants.DEMOLISHED')) {
        //             $properties = $properties->where('up_for_sale', 1);
        //         } else {
        //             $properties = $properties->whereHas('floors', function ($query) {
        //                 $query->orWhere('up_for_sale', 1);
        //                 // $query->orWhere('up_for_rent', 1);
        //             });
        //             $properties->where('up_for_sale', 1);
        //         }
        //     }
        //     if ($sale_rent == 2) {
        //         if ($request->category_property == config('constants.PLOT_LAND') || $request->category_property == config('constants.UNDER_CONSTRUCTION') || $request->category_property == config('constants.DEMOLISHED')) {
        //             $properties = $properties->where('up_for_rent', 1);
        //         } else {
        //             $properties = $properties->whereHas('floors', function ($query) {
        //                 // $query->where('up_for_sale', 1);
        //                 $query->orWhere('up_for_rent', 1);
        //             });
        //             $properties = $properties->where('up_for_rent', 1);
        //         }
        //     }
        // }

        // if (isset($user_role_id) && !empty($user_role_id) && $user_role_id != 1) {
        // $properties->where('created_by', Auth::user()->id);
        // }

        if ($dateFilter && !empty($dateFilter)) {
            if ($dateFilter == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($dateFilter == 'week') {
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($dateFilter == 'today') {
                $properties = $properties->whereDate('created_at', Carbon::today());
            }

            if ($dateFilter == 'customDate') {
                if ($request->has('from_date') && !empty($request->get('from_date'))) {
                    $properties = $properties->whereBetween('created_at', [$from_date, $to_date]);
                }
            }
        }

        if ($surveyed_id != 2) {
            $properties->where('created_by', Auth::user()->id);
        }

        // $result;
        $pointList = [];

        $properties->addSelect(DB::raw("'surveyed' AS surveyed"));
        $properties_non_survey = $this->getNonSurveyFeature($request);

        if ($surveyed_id == 1) {
            $result = $properties->get()->toArray();
        } elseif ($surveyed_id == 2) {
            $result = $properties_non_survey;
        } else {
            $result = array_merge($properties->get()->toArray(), $properties_non_survey);
        }

        $this->returnData($result, $pointList);

        // if (count($result) > 0) {
        //     // output data of each row

        //     foreach ($result as $row) {
        //         $pointList[] = $row;
        //     }

        //     echo $this->json_response($pointList, 200);
        //     return;
        // } else {
        //     //$pointList[] = $sqlGetSearchePolygon;

        //     echo $this->json_response($pointList, 200);
        //     return;
        // }
    }

    private function returnData($result, $pointList)
    {
        if (count($result) > 0) {
            foreach ($result as $row) {
                $pointList[] = $row;
            }

            echo $this->json_response($pointList, 200);
            return;
        } else {
            echo $this->json_response($pointList, 200);
            return;
        }
    }

    public function updateNonServeyLayer(Request $request)
    {
        $filterArray = [];
        $idsParam = $request->ids;
        $uniqIds = explode(',', $idsParam);

        foreach ($request->filterData as $data) {
            $filterArray[$data['name']] = $data['value'];
        }

        $properties = DB::table('Parcel AS parcel')
            ->select([DB::raw('ST_AsText(ST_Transform(parcel.geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(parcel.geom, 900913))) AS centroid_point')])
            ->addSelect(DB::raw("'not-surveyed' AS surveyed"))
            ->whereIn(DB::raw('CAST(uniq_id AS INTEGER)'), $uniqIds);

        $result = $properties->get();
        $buildingLayer = [];

        if (count($result) > 0) {
            foreach ($result as $row) {
                $buildingLayer[] = $row;
            }
            echo $this->json_response($buildingLayer, 200);
            return;
        } else {
            echo $this->json_response($buildingLayer, 200);
            return;
        }
    }

    public function updateBuildingLayer(Request $request)
    {
        $filterArray = [];
        foreach ($request->filterData as $data) {
            $filterArray[$data['name']] = $data['value'];
        }
        $surveyed_id = $filterArray['surveyed_id'];

        $idsParam = $request->ids;
        $uniqIds = explode(',', $idsParam);

        $unit_type = $filterArray['unit_type'];
        $sale_rent = $filterArray['sale_rent'];
        $category_property = $filterArray['category_property'];
        if (isset($filterArray['gated_community'])) {
            $gated_community = $filterArray['gated_community'];
        } else {
            $gated_community = 0;
        }

        $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];

        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('1 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('1 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('1 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT') && $sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT') && $sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED') && $sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED') && $sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($category_property == config('constants.DEMOLISHED') && ($sale_rent == config('constants.FOR_SALE') || $sale_rent == config('constants.FOR_RENT'))) {
            $selectArray = ['properties.gis_id AS gis_id', 'properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($gated_community == 1) {
            $selectArray = ['properties.gis_id AS gis_id', DB::raw('7 as cat_id'), DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($gated_community == 1 && $unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT')) {
            $selectArray = ['properties.gis_id AS gis_id', DB::raw('7 as cat_id'), DB::raw('1 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(geom, 4326)) AS polygon_4326'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($gated_community == 1 && $sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.gis_id AS gis_id', DB::raw('7 as cat_id'), DB::raw('0 as unit_type'), DB::raw('1 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }
        if ($gated_community == 1 && $sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.gis_id AS gis_id', DB::raw('7 as cat_id'), DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('1 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.longitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point'), DB::raw('ST_AsText(ST_Centroid(ST_Transform(geom, 900913))) AS centroid_point')];
        }

        $properties = Property::select($selectArray)
            ->leftJoin('Parcel', 'properties.gis_id', '=', 'Parcel.uniq_id')
            ->addSelect(DB::raw("'surveyed' AS surveyed"));

        // $properties->whereIn(DB::raw('CAST(uniq_id AS TEXT)'), $uniqIds);
        $properties->whereIn('gis_id', $uniqIds);

        $result1 = $properties->get();

        $buildingLayer = [];

        if (count($result1) > 0) {
            foreach ($result1 as $row) {
                $buildingLayer[] = $row;
            }

            echo $this->json_response($buildingLayer, 200);
            return;
        } else {
            echo $this->json_response($buildingLayer, 200);
            return;
        }
    }

    public function addDataForLiveLocation(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $filterArray = [];
        foreach ($request->filterData as $data) {
            $filterArray[$data['name']] = $data['value'];
        }

        $unit_type = $filterArray['unit_type'];
        $sale_rent = $filterArray['sale_rent'];
        $category_property = $filterArray['category_property'];

        $idsParam = $request->ids;
        $uniqIds = explode(',', $idsParam);

        $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];

        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('1 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('1 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('1 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT') && $sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.VACANT') && $sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED') && $sale_rent == config('constants.FOR_SALE')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }
        if ($unit_type == config('constants.FLOOR_UNIT_CATEGORY.OCCUPIED') && $sale_rent == config('constants.FOR_RENT')) {
            $selectArray = ['properties.cat_id AS cat_id', DB::raw('0 as unit_type'), DB::raw('0 as for_sale'), DB::raw('0 as for_rent'), DB::raw('ST_AsText(geom) AS geometry'), DB::raw('ST_AsText(ST_Transform(geom, 900913)) AS polygon'), DB::raw('ST_AsText(ST_Transform(ST_SetSRID(ST_Point(CAST(properties.latitude AS double precision), CAST(properties.latitude AS double precision)), 4326), 900913)) AS survey_point')];
        }

        $properties = Property::select($selectArray)->leftJoin('Parcel', 'properties.gis_id', '=', 'Parcel.uniq_id');

        $properties->whereRaw('ST_DWithin(geom, ST_Transform(ST_SetSRID(ST_MakePoint(?, ?), 900913), 32644), 1000)', [$lat, $lng]);

        $result = $properties->get();

        $buildingLayer = [];

        if (count($result) > 0) {
            foreach ($result as $row) {
                $buildingLayer[] = $row;
            }

            echo $this->json_response($buildingLayer, 200);
            return;
        } else {
            echo $this->json_response($buildingLayer, 200);
            return;
        }
    }

    public function json_response($message = null, $code = 200)
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code($code);
        // set the header to make sure cache is forced
        header('Cache-Control: no-transform,public,max-age=300,s-maxage=900');
        // treat this as json
        header('Content-Type: application/json');
        $status = [
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error',
        ];
        // ok, validation error, or failure
        header('Status: ' . $status[$code]);
        // return the encoded json
        return json_encode([
            'status' => $code < 300, // success or not?
            'message' => $message,
        ]);
    }

    public function getFormattedBudget($budgetId)
    {
        $budget_unit = Budget::when($budgetId, function ($query, $budgetId) {
            $query->where('id', $budgetId);
        })->first();
        $formattedBudget = $budget_unit->unit == 5 ? $budget_unit->amount * 100000 : ($budget_unit->unit == 6 ? $budget_unit->amount * 10000000 : ($budget_unit->unit == 7 ? $budget_unit->amount * 1000 : ''));
        return $formattedBudget;
    }

    public function getPopupController(Request $request)
    {
        $coordinate = $request->latLongs ?? '';
        if (!empty($request->latLongs)) {
            $lat = $coordinate[1];
            $long = $coordinate[0];
        }
        if (isset($request->gis_id[0])) {
            $gis_id = $request->gis_id[0];

            $property = Property::with([
                'floor_units.secondary_unit_data.unit_images',
                'floor_units' => function ($query) {
                    $query->where('is_single', 0);
                    $query->where('up_for_sale', 1);
                    $query->orWhere('up_for_rent', 1);
                    $query->orderBy('id', 'asc');
                },
            ])
                ->where('gis_id', $gis_id)
                ->first();
            if ($property) {
                $floors = PropertyFloorMap::where('property_id', $property->id)
                    ->orderBy('id', 'ASC')
                    ->get();

                $allUnits = FloorUnitMap::where('property_id', $property->id)
                    ->where('is_single', 0)
                    ->orderBy('id', 'ASC')
                    ->get();

                $single_units = FloorUnitMap::where('property_id', $property->id)
                    ->where('is_single', 1)
                    ->orderBy('id', 'ASC')
                    ->get();

                $propert_unit_sale = Property::with([
                    'floor_units' => function ($query) {
                        $query->where('up_for_sale', '1');
                    },
                ])
                    ->where('gis_id', $gis_id)
                    ->first();
                $propert_unit_rent = Property::with([
                    'floor_units' => function ($query) {
                        $query->where('up_for_rent', 1);
                    },
                ])
                    ->where('gis_id', $gis_id)
                    ->first();

                $propert_unit_sale_gated = SecondaryUnitLevelData::where('pricing_details_for', '1')
                    ->where('property_id', $property->id)
                    ->count();
                $propert_unit_rent_gated = SecondaryUnitLevelData::where('pricing_details_for', '2')
                    ->where('property_id', $property->id)
                    ->count();
            }

            if (!empty($property->gis_id)) {
                return view('webgis.pop_up', get_defined_vars());
            } else {
                return view('webgis.no_gisid_pop_up', get_defined_vars());
            }
        } else {
            return view('webgis.no_gisid_pop_up', get_defined_vars());
        }
    }

    public function getMetroCardController(Request $request)
    {
        $metro_name = $request->metro_name;
        return view('webgis.metro_card', get_defined_vars());
    }

    public function getPlaceCardController(Request $request)
    {
        $name = $request->name;
        $open = $request->open;
        $rating = $request->rating;
        $website = $request->website;
        $pluscode = $request->pluscode;
        $url_place = $request->url_place;
        $phone_number = $request->phone_number;
        $photo_list = $request->photo_list;
        $user_ratings_total = $request->user_ratings_total;
        return view('webgis.place_card', get_defined_vars());
    }

    public function getBudget(Request $request)
    {
        if ($request->sale_type == 1) {
            $budgets = Budget::select('budgets.id', 'budgets.amount', 'units.name')
                ->leftjoin('units', 'units.id', '=', 'unit')
                ->where('type', 1)
                ->get();
        } else {
            $budgets = Budget::select('budgets.id', 'budgets.amount', 'units.name')
                ->leftjoin('units', 'units.id', '=', 'unit')
                ->where('type', 2)
                ->get();
        }

        return $budgets;
    }

    public function autoCompleteSearch(Request $request)
    {
        $client = new Client();
        $input = $request->input;
        $location = $request->location;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json';

        $response = $client->get($url, [
            'query' => [
                'input' => $input,
                'location' => $location,
                'radius' => 50000,
                'strictbounds' => true,
                'types' => 'establishment',
                'key' => $key,
            ],
        ]);

        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function textSearch(Request $request)
    {
        $client = new Client();
        $input = $request->input;
        $location = $request->location;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/textsearch/json';

        $response = $client->get($url, [
            'query' => [
                'location' => $location,
                'query' => $input,
                'radius' => 50000,
                'key' => $key,
            ],
        ]);

        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function textSearchNextPage(Request $request)
    {
        $client = new Client();
        $pagetoken = $request->pagetoken;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';
        $response = $client->get($url, [
            'query' => [
                'pagetoken' => $pagetoken,
                'key' => $key,
            ],
        ]);
        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function placeSearch(Request $request)
    {
        $client = new Client();
        $input = $request->input;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json';

        $response = $client->get($url, [
            'query' => [
                'fields' => 'place_id,icon,geometry',
                'input' => $input,
                'inputtype' => 'textquery',
                'key' => $key,
            ],
        ]);

        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function searchNearBy(Request $request)
    {
        $client = new Client();
        $input = $request->input;
        $location = $request->location;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';

        $response = $client->get($url, [
            'query' => [
                'location' => $location,
                'rankby' => 'distance',
                'keyword' => $input,
                'types' => 'establishment',
                'key' => $key,
            ],
        ]);

        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function placeDetail(Request $request)
    {
        $client = new Client();
        $place_id = $request->place_id;
        $key = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $url = 'https://maps.googleapis.com/maps/api/place/details/json';

        $response = $client->get($url, [
            'query' => [
                'place_id' => $place_id,
                'key' => $key,
            ],
        ]);

        $data = json_decode($response->getBody());
        return response()->json($data);
    }

    public function createIconImage(Request $request)
    {
        $icon_url = $request->icon_url;

        if ($icon_url) {
            $response = Http::get($icon_url);
            if ($response->successful()) {
                $content_type = $response->header('Content-Type');

                if (str_starts_with($content_type, 'image/')) {
                    $image_data = $response->body();

                    // Set the appropriate content type header for the image
                    return response($image_data)->header('Content-Type', $content_type);
                }
            }
        }

        // Return a response in case of an error or invalid URL
        return response('Error fetching image', 500);
    }
}
