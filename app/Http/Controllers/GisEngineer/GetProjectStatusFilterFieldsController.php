<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Category,
    SubCategory,
    PropertyImage,
    Property,
    FloorUnitCategory,
    Tower,
    FloorUnitMap,
    PropertyFloorMap,
    Builder,
    ProjectStatusFilterField
};

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


class GetProjectStatusFilterFieldsController extends Controller
{
    public function project_status_fields(Request $request){
        $options = ProjectStatusFilterField::where('type', $request->type)
                                    ->where('status_id', $request->status_id)
                                    ->where('construction_stage_id', $request->construction_stage)
                                    ->get();
        $property_id = $request->property_id;
        $toggle_class_name = $request->class_name;
        return view('admin.pages.property.secondary_data.project_status_fields', get_defined_vars());
        // if($options->count() > 0){
        //     return response()->json(['options' => $options],200);
        // }
    }
}