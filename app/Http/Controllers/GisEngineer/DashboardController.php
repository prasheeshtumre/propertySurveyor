<?php

namespace App\Http\Controllers\GisEngineer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Category;
use Carbon\Carbon;
use Auth;
use App\Models\{AmenityOption, Role, FloorUnitMap, GeoID, ProjectStatusFilterField, PropertyAmenity, GisIDMapping};

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return GeoID::pluck('gis_id')->all();
        $merge_properties = Property::whereHas('gisIdMapping', function ($query) {
                                            $query->whereColumn('gis_id', 'properties.gis_id');
                                        })->whereIn('temp_gis_id_status', [0,1])->count();
        $split_properties = Property::whereHas('splitMapping', function ($query) {
                                            $query->whereColumn('split_gis_id', 'properties.gis_id');
                                        })->whereIn('temp_gis_id_status', [0,1])->count();
        $temporary_gis_properties = Property::whereHas('temporayGisIdMappings', function ($query) {
                                            $query->whereColumn('gis_id_temp', 'properties.gis_id');
                                        })->whereIn('temp_gis_id_status', [0,1])->count();
        $completed_properties = Property::where('temp_gis_id_status', 2)->count();
        return view('admin.pages.dashboard', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // get properties count on type basis
    public function propertyCount(Request $request)
    {
        if ($request->type == 'all') {
            $data['count'] = Property::count();
            $data['type'] = 'TOTAL SURVEYED';
            $data['key'] = 'all';
            return $data;
        } elseif ($request->type == 'month') {
            $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
            $data['type'] = 'SURVEYED THIS MONTH';
            $data['key'] = 'month';
            return $data;
        } elseif ($request->type == 'week') {
            $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['type'] = 'SURVEYED THIS WEEK';
            $data['key'] = 'week';
            return $data;
        } elseif ($request->type == 'today') {
            $data['count'] = Property::whereDate('created_at', Carbon::today())->count();
            $data['type'] = 'SURVEYED TODAY';
            $data['key'] = 'today';
            return $data;
        }
    }

    public function search_dropdown(Request $request)
    {
        if ($request->ajax()) {
            $options = Category::where('cat_name', 'like', '%' . $request->search_key . '%')
                ->OrderBy('cat_name', 'ASC')
                ->get();
            return response()->json(['options' => $options], 200);
        }
        return view('admin.pages.property.search_dropdown');
    }
    public function check_log()
    {
        return response()->json([], 403);
    }
    public function upload_test()
    {
        return view('upload_files');
    }
    public function store_files(Request $request)
    {
        dd($request->all());
        // if ($request->hasfile('files')) {

        //     foreach ($request->file('files') as $image) {
        //         $name = $image->getClientOriginalName();
        //         $file_name = uniqid() . "." . $image->getClientOriginalExtension();
        //         $image->move(public_path() . '/uploads/property/images', $file_name);
        //         $property_img = new PropertyImage;
        //         $property_img->file_url = $file_name;
        //         $property_img->property_id = $id;
        //         $property_img->save();
        //         //    $data[] = $name;
        //     }
        //     // if (File::exists(public_path('uploads/csv/img.png'))) {
        //     //     File::delete(public_path('uploads/csv/img.png'));
        //     // }
        // }
    }

    public function getBrandSubCategories(Request $request)
    {
        $brand_sub_categories = FloorUnitCategory::where('parent_id', $request->c_id)->get();
        return $brand_sub_categories;
    }

    public function getSubResidentials(Request $request)
    {
        if ($request->c_id) {
            $sub_residentials = Category::where('parent_id', $request->c_id)->get();
            return $sub_residentials;
        }
    }

    public function getDefinedOptions(Request $request)
    {
        $data = Category::where('parent_id', $request->c_id)->get();
        return response()->json($data);
    }

    public function last30DaysCount($condition, $value)
    {
        $properties = property::withCount([
            'floor_units' => function ($query) use ($condition, $value) {
                $query->where($condition, $value)->whereDate('updated_at', '>=', now()->subDays(30));
            },
        ])
            ->where('created_by', auth()->id())
            ->get();
        $totalFloorUnitsCount = $properties->sum('floor_units_count');
        return $totalFloorUnitsCount;
    }
}
