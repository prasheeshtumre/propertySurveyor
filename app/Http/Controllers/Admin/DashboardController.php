<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Category;
use Carbon\Carbon;
use Auth;
use App\Models\{AmenityOption, Role, FloorUnitMap, ProjectStatusFilterField, PropertyAmenity};
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{

    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {

        $this->dashboardService = $dashboardService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $property_count = Property::where('created_by', Auth::user()->id)->count();

        $today_data = $this->dashboardService->getThisDayProperties();
        $this_week  = $this->dashboardService->getThisWeekProperties();
        $this_month = $this->dashboardService->getThisMonthProperties();
        
        $for_sale           = $this->dashboardService->getForSalePropertiesBefore30Days();
        $for_rent           = $this->dashboardService->getForRentPropertiesBefore30Days();
        $vacant             = $this->dashboardService->getVacantPropertiesBefore30Days();
        $under_construction = $this->dashboardService->getUnderConstructionPropertiesBefore30Days();

        $user = \Auth::user();
        return view('admin.pages.dashboard', get_defined_vars());
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

}

