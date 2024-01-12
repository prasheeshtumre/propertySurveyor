<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\PropertyFloorMap;
use App\Models\FloorUnitMap;
use App\Models\FloorUnitCategory;
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

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.pages.task.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reports(Request $request)
    {
        return view('admin.pages.task.reports');
    }
    /**
     *.
     */
    public function show(Request $request)
    {
        return view('admin.pages.task.show');
    }
}