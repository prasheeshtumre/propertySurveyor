<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitAmenityOption;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\FloorType;
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
use App\Models\FireSafteyMeasureMap;
use App\Models\OwnershipOptions;
use App\Models\PropertyFacing;
use App\Models\SecondaryUnitLevel;
use App\Models\SecondaryUnitLevelData;
use App\Models\UnitImage;
use App\Models\Unit;
use App\Models\UnitAmenity;
use App\Models\UnitAmenityCategory;
use App\Models\UnitAmenityOptionValue;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;
use File;

class OneRkController extends Controller
{
    protected $floorService;

    public function __construct(FloorService $floorService)
    {
        $this->floorService = $floorService;
    }

    /**
     * Display a listing of the resource.
     */

  
    /** functions for commercial->office starting below */
    public function storePropertyDetails(Request $request)
    {
    //   return 'hii';
      
        $validator = Validator::make($request->all(), [
            
            'bedrooms' => ['required'],
            'washrooms' => ['required'],
            'balconies' => ['required_without:other_balconies'],
            'furnished_option' => ['required'],
            'property_facing' => ['required'],
            'availability_status' => ['required'],
            'age_of_property' => 'required_if:availability_status,23',  
            'possession_date' => 'required_if:availability_status,24',
            'carpet_area' => ['required_without_all:built_area,super_built_area'],
            
          
        ],[
            'age_of_property.required_if' => 'Age of Property is required',
            'possession_date.required_if' => 'Possession Date is required',
            'carpet_area.required_without_all'=> 'Atleast one field  is required',
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }
        
        $serviced_apartment = SecondaryUnitLevelData:: where([
            ['property_id', $request->property_id],
            ['unit_id', $request->unit_id],
            ['unit_type_id', $request->unit_type_id],
            // ['unit_cat_id', $request->unit_cat_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if($serviced_apartment){
            $save = $serviced_apartment;
        }else{
            $save = new SecondaryUnitLevelData;
        }
        $save->property_id = $request->property_id;
        $save->unit_id = $request->unit_id;
        $save->unit_type_id = $request->unit_type_id;
        // $save->unit_cat_id = $request->unit_cat_id;
        $save->property_cat_id = $request->property_cat_id;
        $save->rooms = $request->bedrooms;
        $save->washrooms =  $request->washrooms ;
        $save->property_facing = $request->property_facing;
        $save->balconies = $request->other_balconies ? $request->other_balconies : $request->balconies;
        $save->carpet_area = $request->carpet_area ? $request->carpet_area :null;
        $save->carpet_area_unit = $request->carpet_area ? $request->carpet_area_units :null;
        $save->buildup_area = $request->built_area ? $request->built_area :null;
        $save->buildup_area_unit = $request->built_area ? $request->builtup_area_units :null;
        $save->super_buildup_area = $request->super_built_area ? $request->super_built_area :null;
        $save->super_buildup_area_unit = $request->super_built_area ? $request->super_built_area_units :null;
        $save->covered_parking = $request->covered_parking;
        $save->open_parking = $request->open_parking;
        $save->furnishing_option = $request->furnished_option;
        $save->availability_status = $request->availability_status;
        $save->age_of_property = $request->age_of_property;
        $save->possesion_by = $request->possession_date;
        $save->created_by = Auth::id();
        $save->save();

        $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->where('amenity_id',13)->delete();
        if(isset($request->other_rooms)){
            if(count($request->other_rooms) > 0){
                foreach ($request->other_rooms as  $value) {
                $options = new  UnitAmenityOptionValue;
                $options->property_id =  $request->property_id;
                $options->unit_id =  $request->unit_id;
                $options->amenity_id = 13;
                $options->amenity_option_id = $value;
                $options->save();
                }
            }
        }
        
        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
        $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->where('amenity_id',14)->delete();
        foreach ($furnished_options as $furnish){
            if($furnish->id == $request->furnished_option){
                if($furnish->furnished_type_options->count()>0){
                    foreach($furnish->furnished_type_options as $option){
                        $option_name = str_replace([' ', '-'], '_', $furnish->name).'_'.str_replace([' ', '-'], '_', $option->name);
                        if(isset($request->$option_name) && !empty($request->$option_name)){
                            $furnish_options = new  UnitAmenityOptionValue;
                            $furnish_options->property_id =  $request->property_id;
                            $furnish_options->unit_id =  $request->unit_id;
                            $furnish_options->amenity_id = 14;
                            $furnish_options->amenity_option_id =  $request->furnished_option;
                            $furnish_options->amenity_option_value_id = $option->id;
                            if($option->input_type != 'checkbox'){
                                $furnish_options->value = $request->$option_name;
                            }
                            $furnish_options->save();
                        }
                    }
                }
            }
                
        }
        
        return response()->json(['message' => 'Form submitted successfully']);
        
    }

    // storing pricing details 
    public function storePricingDetails(Request $request){
        
         $validator = Validator::make($request->all(), [
            'pricing_details_for' => ['required'],
            'ownership'=> ['required_if:pricing_details_for,==,1'],
            'expected_price' => ['required_if:pricing_details_for,==,1'],
            'price_per_sq_ft' => ['required_if:pricing_details_for,==,1'],
            'expected_rent' => ['required_if:pricing_details_for,==,2'],
            'agreement_type' => ['required_if:pricing_details_for,==,2'],
        ],[
            'ownership' => 'ownership field is required for Sale',
            'pricing_details_for.required' => 'The pricing details field is required.',
            'expected_price.required_if' => 'The expected price field is required when pricing details is For Sale.',
            'price_per_sq_ft.required_if' => 'The price per sq ft field is required when pricing details is For Sale.',
            'expected_rent.required_if' => 'The expected rent field is required when pricing details is For Rent.',
            'agreement_type.required_if' => 'The agreement type field is required when pricing details is For Rent.',
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }


        $serviced_apartment = SecondaryUnitLevelData:: where([
            ['property_id', $request->property_id],
            ['unit_id', $request->unit_id],
            ['unit_type_id', $request->unit_type_id],
            // ['unit_cat_id', $request->unit_cat_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if($serviced_apartment){
            if($request->pricing_details_for == 1){
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->ownership = $request->ownership;
                $serviced_apartment->expected_price = $request->expected_price;
                $serviced_apartment->price_per_sq_ft = $request->price_per_sq_ft;
                $serviced_apartment->mainteinance = $request->pricing_maintenance_price;
                $serviced_apartment->maintenance_period = $request->maintenance_period;
                $serviced_apartment->expected_rental = $request->pricing_expected_rental;
                $serviced_apartment->booking_amount = $request->pricing_booking_amount;
                $serviced_apartment->annual_due_pay = $request->pricing_annual_dues_payable;
                $serviced_apartment->membership_charge = $request->pricing_membership_charge;
                $serviced_apartment->remark = $request->remarks_on_property;
                $serviced_apartment->save();
                
                // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->delete();
                $price_details = UnitAmenityOption::where('parent_id', 22)->get();
                $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->where('amenity_id',22)->delete();
                foreach ($price_details as $key => $value) {
                    $requestname = 'price_details_'.$value->id;
                   if(isset($request->$requestname) and !empty($request->$requestname)){
                        $options = new  UnitAmenityOptionValue;
                        $options->property_id =  $request->property_id;
                        $options->unit_id =  $request->unit_id;
                        $options->amenity_id = 22;
                        $options->amenity_option_id = $value->id;
                        $options->save();
                   }
                }
                return response()->json(['message' => 'Form submitted successfully']);
            }elseif($request->pricing_details_for == 2){
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->agreement_type = $request->agreement_type;
                $serviced_apartment->expected_rent = $request->expected_rent;
                $serviced_apartment->maintenance_rent = $request->rent_maintenance;
                $serviced_apartment->maintenance_period = $request->maintenance_period_rent;
                $serviced_apartment->booking_amount_rent = $request->rent_booking_amount;
                $serviced_apartment->annual_dues_rent = $request->rent_annual_dues_payable;
                $serviced_apartment->membership_charge_rent = $request->rent_membership_charge;
                $serviced_apartment->notice_period = $request->notice_period;
                $serviced_apartment->agreement_duration = $request->agreement_durations;
                $serviced_apartment->remark = $request->remarks_on_property;
                $serviced_apartment->save();

               // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->delete();
               $rent_details = UnitAmenityOption::where('parent_id', 17)->get();
               $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->where('amenity_id',17)->delete();
               foreach ($rent_details as $key => $value) {
                   $requestname = 'rent_details_'.$value->id;
                  if(isset($request->$requestname) and !empty($request->$requestname)){
                       $options = new  UnitAmenityOptionValue;
                       $options->property_id =  $request->property_id;
                       $options->unit_id =  $request->unit_id;
                       $options->amenity_id = 17;
                       $options->amenity_option_id = $value->id;
                       $options->save();
                  }
               }
               $security_deposit = UnitAmenityOption::where('parent_id', 18)->get();
               $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('property_id',$request->property_id)->where('amenity_id',18)->delete();
               foreach ($security_deposit as $key => $value) {
                   $requestname = 'scurity_deposit_'.$value->id;
                  if(isset($request->$requestname) and !empty($request->$requestname)){
                       $options = new  UnitAmenityOptionValue;
                       $options->property_id =  $request->property_id;
                       $options->unit_id =  $request->unit_id;
                       $options->amenity_id = 18;
                       $options->amenity_option_id = $value->id;
                       $options->save();
                  }
               }
               return response()->json(['message' => 'Form submitted successfully']);
            }
        }
    }

    //  store Images 
    public function storeUnitImages(Request $request){
        // return "hii";
       
        $validator = Validator::make($request->all(), [
            'gallery_images' => 'required_without_all:amenities_images,interior_images,floor_plan_images',
            // 'amenities_images' => 'required_without_all:gallery_images,interior_images,floor_plan_images',
            // 'interior_images' => 'required_without_all:gallery_images,amenities_images,floor_plan_images',
            // 'floor_plan_images' => 'required_without_all:gallery_images,amenities_images,interior_images',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'floor_plan_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }
        $get_gallery_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'gallery_images')->get();
        // dd($get_images_to_unlink);
        foreach ($get_gallery_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name))) {

                File::delete(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'gallery_images';
                $property_img->file_path = '/uploads/property/unit/gallery_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        $get_amenities_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'amenity_images')->get();
        // dd($get_images_to_unlink);
        foreach ($get_amenities_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name))) {

                File::delete(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('amenities_images')) {
            foreach ($request->file('amenities_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'amenity_images';
                $property_img->file_path = '/uploads/property/unit/amenity_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

        $get_interior_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'interior_images')->get();
        // dd($get_images_to_unlink);
        foreach ($get_interior_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {

                File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('interior_images')) {
            foreach ($request->file('interior_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/interior_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'interior_images';
                $property_img->file_path = '/uploads/property/unit/interior_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

        $get_floor_plan_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'floor_plan_images')->get();
        // dd($get_images_to_unlink);
        foreach ($get_floor_plan_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name))) {

                File::delete(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('floor_plan_images')) {
            foreach ($request->file('floor_plan_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/floor_plan_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'floor_plan_images';
                $property_img->file_path = '/uploads/property/unit/floor_plan_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(['message' => 'Form submitted successfully']);
        
    }

    public function updateUnitImages(Request $request){
        // return "hii";
       
        $validator = Validator::make($request->all(), [
            // 'gallery_images' => 'required_without_all:amenities_images,interior_images,floor_plan_images',
            // 'amenities_images' => 'required_without_all:gallery_images,interior_images,floor_plan_images',
            // 'interior_images' => 'required_without_all:gallery_images,amenities_images,floor_plan_images',
            // 'floor_plan_images' => 'required_without_all:gallery_images,amenities_images,interior_images',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'floor_plan_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }
       
        if ($request->hasfile('gallery_images')) {
            // $get_gallery_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'gallery_images')->get();
           
            // foreach ($get_gallery_images_to_unlink as $img_unlink) {
            //     if (File::exists(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name))) {
    
            //         File::delete(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name));
    
            //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
            //     }
            // }
    
            foreach ($request->file('gallery_images') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'gallery_images';
                $property_img->file_path = '/uploads/property/unit/gallery_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        

        if ($request->hasfile('amenities_images')) {
            // $get_amenities_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'amenity_images')->get();
           
            // foreach ($get_amenities_images_to_unlink as $img_unlink) {
            //     if (File::exists(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name))) {

            //         File::delete(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name));

            //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
            //     }
            // }

            foreach ($request->file('amenities_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'amenity_images';
                $property_img->file_path = '/uploads/property/unit/amenity_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

       

        if ($request->hasfile('interior_images')) {
            // $get_interior_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'interior_images')->get();
           
            // foreach ($get_interior_images_to_unlink as $img_unlink) {
            //     if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {
    
            //         File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));
    
            //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
            //     }
            // }

            foreach ($request->file('interior_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/interior_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'interior_images';
                $property_img->file_path = '/uploads/property/unit/interior_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

       

        if ($request->hasfile('floor_plan_images')) {

            // $get_floor_plan_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->unit_id)->where('file_type', 'floor_plan_images')->get();
           
            // foreach ($get_floor_plan_images_to_unlink as $img_unlink) {
            //     if (File::exists(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name))) {
    
            //         File::delete(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name));
    
            //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
            //     }
            // }
            foreach ($request->file('floor_plan_images') as $image) {
                $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/floor_plan_images', $file_name);
                $property_img = new UnitImage;
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'floor_plan_images';
                $property_img->file_path = '/uploads/property/unit/floor_plan_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(['message' => 'Form submitted successfully']);
        
    }

    public function storeAmenities(Request $request){
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
        ->where('unit_id', $request->unit_id)
        ->where('amenity_id', '20')
        ->delete();
        if ($request->has('amenity')) {
          
            foreach ($request->amenity as $amenity) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '20';
                $amenityValue->amenity_option_id = $amenity;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '29')
                ->delete();

        if ($request->has('society_features')) {
            
            foreach ($request->society_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '29';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
        ->where('unit_id', $request->unit_id)
        ->where('amenity_id', '30')
        ->delete();
        if ($request->has('additional_features')) {
           
            foreach ($request->additional_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '30';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
        ->where('unit_id', $request->unit_id)
        ->where('amenity_id', '31')
        ->delete();

        if ($request->has('other_features')) {
           
            foreach ($request->other_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '31';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '32')
                ->delete();

        if ($request->has('water_source')) {
            
            foreach ($request->water_source as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '32';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
        ->where('unit_id', $request->unit_id)
        ->where('amenity_id', '33')
        ->delete();

        if ($request->has('overlooking')) {
          
            foreach ($request->overlooking as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '33';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '34')
                ->delete();

        if ($request->has('power_backup')) {
            
            foreach ($request->power_backup as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '34';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
        ->where('unit_id', $request->unit_id)
        ->where('amenity_id', '21')
        ->delete();
        if ($request->has('location_advantage')) {
           
            foreach ($request->location_advantage as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue;
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '21';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        }

        if ($request->has('floor_type')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'floor_type' => $request->floor_type
                ]);
        }
        if ($request->has('facing_road_width')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'facing_road_width' => $request->facing_road_width
                ]);
        }
        if ($request->has('facing_road_width_unit')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'facing_road_width_unit' => $request->facing_road_width_unit
                ]);
        }
        
        return response()->json(array('data' => $request->property_id), 200);

    }

    // edit details
    public function editDetails($unit_id){
        $unit_data = FloorUnitMap::find($unit_id);
        $property = Property::find($unit_data->property_id);
        $prop_category_data = Category::find($property->category->id);
        $units = Unit::whereIn('id', ['3', '4'])->get();  //land Measuring units
        $ownerships = OwnershipOptions::get();
        $property_facings = PropertyFacing::get();
        $unit_amenity = UnitAmenity::get();
        $price_details = UnitAmenityOption::where('parent_id', 22)->get();
        $price_details_periods = UnitAmenityOption::where('parent_id', 23)->get();
        $agreement_types = UnitAmenityOption::where('parent_id', 15)->get();
        $rent_details = UnitAmenityOption::where('parent_id', 17)->get();
        $security_deposit = UnitAmenityOption::where('parent_id', 18)->get();
        $agreement_durations = UnitAmenityOption::where('parent_id', 16)->get();
        $notice_months = UnitAmenityOption::where('parent_id', 19)->get();
        //Amenity
        $amenities = UnitAmenityOption::where('parent_id', 20) ->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $Society_features = UnitAmenityOption::where('parent_id', 29)->get();
        $additional_features = UnitAmenityOption::where('parent_id', '30')->get();
        $other_features = UnitAmenityOption::where('parent_id', '31') ->get();
        $water_source = UnitAmenityOption::where('parent_id', '32')->get();
        $overlooking = UnitAmenityOption::where('parent_id', '33') ->get();
        $power_backup = UnitAmenityOption::where('parent_id', '34')->get();
        $flooring_type = FloorType::get();
        if ($property->cat_id == 2) {
            if ($property->residential_type == 7 && $property->residential_sub_type == 9) {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                 if ($unit_data->apartment_id == 3) {
                    $onerkdata = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->first();
                    if ($onerkdata) {
                        $textOptions = [];
                        $chechkOptions = [];
                        $furnished_option_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('amenity_id',14)->get();
                        foreach($furnished_option_values  as $options){
                          if($options->value != null){
                            $textOptions[$options->amenity_option_value_id] = $options->value;
                          }elseif($options->value == null){
                            $chechkOptions[$options->amenity_option_value_id] = $options->amenity_option_value_id;
                          }
                        }
                        $other_room_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('amenity_id',13)->pluck('amenity_option_id')->toArray();
                        $price_details_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('amenity_id',22)->pluck('amenity_option_id')->toArray();
                        $rent_details_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('amenity_id',17)->pluck('amenity_option_id')->toArray();
                        $security_deposit_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('amenity_id',18)->pluck('amenity_option_id')->toArray();
                        $galleryImages = UnitImage::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('file_type','gallery_images')->get();
                        $AmenityImages = UnitImage::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('file_type','amenity_images')->get();
                        $interiorImages = UnitImage::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('file_type','interior_images')->get();
                        $floorPlanImages = UnitImage::where('property_id', $unit_data->property_id)->where('unit_id', $unit_id)->where('file_type','floor_plan_images')->get();
                        return view('admin.pages.property.units.edits.1rk-edit', get_defined_vars());
                    }
                }
            }
        }
    }

   
}
