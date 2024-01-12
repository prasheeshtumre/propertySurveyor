<?php

namespace App\Repositories;

use App\Models\Property;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\{ Category, SubCategory, PropertyImage, FloorUnitCategory,FloorUnitMap,PropertyFloorMap,Builder,Unit,GeoID, GisIDMapping, GISIDSplitLog,Tower};
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;

use App\DTO\SplitGISIDRequestDTO;
use App\Services\SplitGISIDService;
use App\DTO\MergeGISIDRequestDTO;
use App\Services\MergeGISIDService;


class PropertyRepository
{
    public function searchProperties($request, $type = null)
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

        $length = $request->length;

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
            ->when($request->pincode, function ($query) use ($request) {
                $query->where('pincode', $request->pincode);
            })
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

        if ($request->sale_rent == 1) {
            $properties = $properties->where('up_for_sale', 1);
            if ($request->category != 2 && $request->category != 3 && $request->category != 4 && $request->category != 5 && $request->category != 6) {
                if (isset($request->sale_rent) && !empty($request->sale_rent)) {
                    $properties = $properties->whereHas('floors', function ($query) {
                        $query->where('up_for_sale', 1);
                    });
                }
            }
        }
        if ($request->sale_rent == 2) {
            $properties = $properties->where('up_for_rent', 1);
            if ($request->category != 2 && $request->category != 3 && $request->category != 4 && $request->category != 5 && $request->category != 6) {
                if (isset($request->sale_rent) && !empty($request->sale_rent)) {
                    $properties = $properties->whereHas('floors', function ($query) {
                        $query->where('up_for_rent', 1);
                    });
                }
            }
        }

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        if ($type && !empty($type)) {
            if ($type == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($type == 'week') {
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($type == 'today') {
                $properties = $properties->whereDate('created_at', Carbon::today());
            }
            if ($type == 'for-rent') {
                $properties = $properties->where('up_for_rent', 1);
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
                });
            });
        }

        $property_count = count($properties->get());
        $properties = $properties->orderBy('id', 'DESC')->paginate(50);

        $properties->setPath(route('surveyor.property.reports', [], true));

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
            if ($request->category == 1 || $request->category == 6) {
                return view('admin.pages.property.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            } elseif ($request->residential_sub_category == 9 || $request->residential_sub_category == 10 || $request->residential_sub_category == 11 || $request->residential_sub_category == 12) {
                return view('admin.pages.property.property_pagination', ['properties' => $properties, 'category_type' => $request->residential_sub_category, 'property_count' => $property_count]);
            } elseif ($request->plot_land_types == 13 || $request->plot_land_types == 14) {
                return view('admin.pages.property.property_pagination', ['properties' => $properties, 'category_type' => $request->plot_land_types, 'property_count' => $property_count]);
            } elseif ($request->property_type == 1) {
                return view('admin.pages.property.property_pagination', ['properties' => $properties, 'category_type' => $request->property_type, 'property_count' => $property_count]);
            } else {
                return view('admin.pages.property.property_pagination', ['properties' => $properties, 'category_type' => $request->category, 'property_count' => $property_count]);
            }
        }

        return $properties;
    }
}
