<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyImage;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyImagesRequest;
use App\Http\Requests\UpdatePropertyImagesRequest;

class PropertyImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // if ($request->hasFile('files')) {
        //     $files = $request->file('files');
        //     foreach ($files as $file) {
        //         // Process each uploaded file as needed
        //         // $file->store('uploads');
        //         echo $file->getClientOriginalName();
        //     }
        //     // return 'Files uploaded successfully.';
        // }

        // if ($request->hasfile('files')) {

            
            $property = Property::find($request->property_id);
            if($property){
                // foreach ($request->file('files') as $image) {
                //     $name = $image->getClientOriginalName();
                //     $file_name = $name.'_'. uniqid() . "." . $image->getClientOriginalExtension();
                //     $image->move(public_path() . '/uploads/property/images', $file_name);
                //     $property_img = new PropertyImage;
                //     $property_img->file_url = $file_name;
                //     $property_img->property_id = $request->property_id;
                //     $property_img->save();
                // }

                $property->remarks = $request->remarks;
                $property->up_for_sale = $request->up_for_sale;
                $property->up_for_rent = $request->up_for_rent;
                $property->save();

            }
            else{
                return response()->json(['status' => false,'message'=> 'Please Try Again Later'],409);
            }
            
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyImagesRequest $request, PropertyImages $propertyImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        
        $property_img = PropertyImage::find($id);
        if ($property_img) {
            PropertyImage::destroy($id);
                // $fileToDelete = public_path('path/to/your/file.jpg');

                // if (File::exists($fileToDelete)) {
                //     File::delete($fileToDelete);
                //     // File has been successfully removed
                // } else {
                //     // File not found, handle the error or display a message
                // }
                return response()->json(array(
                    'success' => true,
                    'message' => 'Property image Deleted Successfully'
                ), 200);
                
            } else {
                return response()->json(array(
                    'success' => false,
                    'message' => 'Please Try Again Later'
                ), 400);
            }
        
       
        // return $id;
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        // $imageName = time().'.'.$image->extension();
        // $image->move(public_path('images'),$imageName);

        $name = $image->getClientOriginalName();
        $file_name = uniqid() . "." . $image->getClientOriginalExtension();

        $property_img = new PropertyImage;
        $property_img->file_url = $file_name;
        $property_img->property_id = $request->prop_id;
        $property_img->save();
        try{ 
            if($image->move(public_path('/uploads/property/images/'), $file_name)){
                return response()->json(['success'=>$file_name,'id' => $property_img->id],200);
            }
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message'=> $e->getMessage()], 422);
        }
   
        
    }

    public function removePropertyImage(Request $request)
    {

        $fileToDelete = public_path('path/to/your/file.jpg');

        if (File::exists($fileToDelete)) {
            File::delete($fileToDelete);
            // File has been successfully removed
        } else {
            // File not found, handle the error or display a message
        }

    }

    
}
