<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\FloorUnitCategory;
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
use App\Models\FloorUnitMap;
use App\Models\PropertyFloorMap;
use App\Models\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
   public function floor_unit_categories(Request $request){
    try {
        $options = FloorUnitCategory::where('category_code', 1)->get();
        $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get()->take(2);

        if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'options'    => $options,
                'categories' => $categories,
                'statusCode' => 200,
                'message' => get_response_description(200)
            ), 200);
        }

    } catch (\Exception $e) {
        $statusCode = $e->getCode();
        if ($statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }
        if ($request->ajax()) {
            return response()->json(array(
                'success' => false,
                'options'    => [],
                'statusCode' => $statusCode,
                'message' => get_response_description($statusCode)
            ), $statusCode);
        }
    }
        
   }
}