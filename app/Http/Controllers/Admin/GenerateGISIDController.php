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
use App\Models\Unit;
use App\Models\{GeoID, GisIDMapping, GISIDSplitLog};
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;
use App\DTO\SplitGISIDRequestDTO;
use App\Services\SplitGISIDService;
use App\DTO\MergeGISIDRequestDTO;
use App\Services\GenerateGISIDService;

class GenerateGISIDController extends Controller
{
    private $generateGISIDService;

    public function __construct(GenerateGISIDService $generateGISIDService)
    {
        $this->generateGISIDService = $generateGISIDService;
    }

    public function generate(Request $request): JsonResponse
    {
        $temporaryGisId = $this->generateGISIDService->generate($request->lat, $request->long);
        return response()->json(['temporaryGisId' => $temporaryGisId], 200);
    }
}
