<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class DashboardRemaindersController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function search(Request $request)
    {
        $properties = $this->propertyService->searchProperties($request);
        
        // Process and return the properties as needed
        return view('admin.pages.property.property_pagination', ['properties' => $properties]);
    }
    
}
