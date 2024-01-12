<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloorUnitCategory;

class FloorUnitCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = FloorUnitCategory::all();
        return view('floor_unit_category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveyor.builder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required'
        ]);
        
        $category  = new  FloorUnitCategory;
        $category->name = $request->name;
        $category->save();
        
        return redirect()->back()->with('message', 'Category Successfully Created');
        // $builder = Builder::updateOrCreate(
        //     [
        //       'id'   => $request->get('id'),
        //     ],
        //     [
        //       'name'     => $request->get('name')
        //     ]
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function get_floors(Request $request){
        $prop_categories = Category::get();
        $categories = FloorUnitCategory::where('category_code', 1)->select(['id','name'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id','name'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->select(['id','name'])->get();
        $count = $request->count;
        $c_id = $request->c_id;
        return view('admin.pages.property.floor', get_defined_vars());
    }
    
    public function get_units(Request $request){
        $prop_categories = Category::get();
        $categories = FloorUnitCategory::where('category_code', 1)->select(['id','name'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id','name'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->select(['id','name'])->get();
        $count = $request->count;
        $c_id = $request->c_id;
        return view('admin.pages.property.unit', get_defined_vars());
    }
    
}