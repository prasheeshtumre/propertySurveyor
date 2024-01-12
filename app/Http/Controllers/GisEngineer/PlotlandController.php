<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitAmenityOption;
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

class PlotlandController extends Controller
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
    public function storePlotlandPropertyDetails(Request $request)
    {
      
      
        $validator = Validator::make($request->all(), [
            'plot_area' => ['required'],
            // 'furnished_option' => ['required'],
            // 'property_facing' => ['required'],
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }
        
        $plot_land = SecondaryUnitLevelData:: where([
            ['property_id', $request->property_id],
            ['unit_id', $request->property_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if($plot_land){
            $save = $plot_land;
        }else{
            $save = new SecondaryUnitLevelData;
        }
        $save->property_id = $request->property_id;
        $save->unit_id = $request->property_id;
        $save->property_cat_id = $request->property_cat_id;
        $save->plot_area = $request->plot_area;
        $save->plot_area_units = $request->plot_area_units;
        $save->plot_length = $request->plot_length;
        $save->plot_breadth = $request->plot_breadth;
        $save->floors_allowed = $request->floors_allowed;
        $save->no_of_open_side = $request->no_of_open_side;
        $save->created_by = Auth::id();
        $save->save();
        return response()->json(['message' => 'Form submitted successfully']);
        
    }

    // storing pricing details 
    public function storePlotlandPricingDetails(Request $request){
        
         $validator = Validator::make($request->all(), [
            'pricing_details_for' => ['required'],
            'ownership'=> ['required_if:pricing_details_for,==,1'],
            'expected_price' => ['required_if:pricing_details_for,==,1'],
            'price_per_sq_ft' => ['required_if:pricing_details_for,==,1'],
            'expected_rent' => ['required_if:pricing_details_for,==,2'],
            'agreement_type' => ['required_if:pricing_details_for,==,2'],
        ],[
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


        $plot_land = SecondaryUnitLevelData:: where([
            ['property_id', $request->property_id],
            ['unit_id', $request->property_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if($plot_land){
            if($request->pricing_details_for == 1){
                $plot_land->pricing_details_for = $request->pricing_details_for;
                $plot_land->ownership = $request->ownership;
                $plot_land->expected_price = $request->expected_price;
                $plot_land->price_per_sq_ft = $request->price_per_sq_ft;
                $plot_land->mainteinance = $request->pricing_maintenance_price;
                $plot_land->maintenance_period = $request->maintenance_period;
                $plot_land->expected_rental = $request->pricing_expected_rental;
                $plot_land->booking_amount = $request->pricing_booking_amount;
                $plot_land->annual_due_pay = $request->pricing_annual_dues_payable;
                $plot_land->membership_charge = $request->pricing_membership_charge;
                $plot_land->remark = $request->remarks_on_property;
                $plot_land->save();
                
                // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->property_id)->where('property_id',$request->property_id)->delete();
                $price_details = UnitAmenityOption::where('parent_id', 22)->get();
                $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->property_id)->where('property_id',$request->property_id)->where('amenity_id',22)->delete();
                // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('amenity_id',22)->delete();
                foreach ($price_details as $key => $value) {
                    $requestname = 'price_details_'.$value->id;
                   if(isset($request->$requestname) and !empty($request->$requestname)){
                        $options = new  UnitAmenityOptionValue;
                        $options->property_id =  $request->property_id;
                        $options->unit_id =  $request->property_id;
                        $options->amenity_id = 22;
                        $options->amenity_option_id = $value->id;
                        $options->save();
                   }
                }
                return response()->json(['message' => 'Form submitted successfully']);
            }elseif($request->pricing_details_for == 2){
                $plot_land->pricing_details_for = $request->pricing_details_for;
                $plot_land->agreement_type = $request->agreement_type;
                $plot_land->expected_rent = $request->expected_rent;
                $plot_land->maintenance_period = $request->maintenance_period_rent;
                $plot_land->maintenance_rent = $request->rent_maintenance;
                $plot_land->booking_amount_rent = $request->rent_booking_amount;
                $plot_land->annual_dues_rent = $request->rent_annual_dues_payable;
                $plot_land->membership_charge_rent = $request->rent_membership_charge;
                $plot_land->notice_period = $request->notice_period;
                $plot_land->agreement_duration = $request->agreement_durations;
                $plot_land->remark = $request->remarks_on_property;
                $plot_land->save();

                // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->delete();
                $rent_details = UnitAmenityOption::where('parent_id', 17)->get();
                $delete_before_insert = UnitAmenityOptionValue::where('property_id',$request->property_id)->where('unit_id',$request->property_id)->where('amenity_id',17)->delete();
                foreach ($rent_details as $key => $value) {
                    $requestname = 'rent_details_'.$value->id;
                   if(isset($request->$requestname) and !empty($request->$requestname)){
                        $options = new  UnitAmenityOptionValue;
                        $options->property_id =  $request->property_id;
                        $options->unit_id =  $request->property_id;
                        $options->amenity_id = 17;
                        $options->amenity_option_id = $value->id;
                        $options->save();
                   }
                }
                // $security_deposit = UnitAmenityOption::where('parent_id', 18)->get();
                // $delete_before_insert = UnitAmenityOptionValue::where('unit_id',$request->unit_id)->where('amenity_id',18)->delete();
                // foreach ($security_deposit as $key => $value) {
                //     $requestname = 'scurity_deposit_'.$value->id;
                //    if(isset($request->$requestname) and !empty($request->$requestname)){
                //         $options = new  UnitAmenityOptionValue;
                //         $options->unit_id =  $request->unit_id;
                //         $options->amenity_id = 18;
                //         $options->amenity_option_id = $value->id;
                //         $options->save();
                //    }
                // }
                return response()->json(['message' => 'Form submitted successfully']);
            }
        }
    }

    //  store Images 
    public function storePlotlandunitImages(Request $request){
        // return "hii";
       
        $validator = Validator::make($request->all(), [
            'gallery_images' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);
    
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }
        $get_gallery_images_to_unlink = UnitImage::where('property_id', $request->parent_id)->where('unit_id', $request->parent_id)->where('file_type', 'gallery_images')->get();
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
                $property_img->unit_id = $request->property_id;
                $property_img->file_type = 'gallery_images';
                $property_img->file_path = '/uploads/property/unit/gallery_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(array(
            // 'success' => false,
            // 'errors' => $validator->getMessageBag()->toArray(),
            'data' => $request->property_id
        ), 200);
        
    }

    public function updatePlotlandunitImages(Request $request){
        // return "hii";
       
        $validator = Validator::make($request->all(), [
            // 'gallery_images' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
           
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
            // $get_gallery_images_to_unlink = UnitImage::where('property_id', $request->property_id)->where('unit_id', $request->property_id)->where('file_type', 'gallery_images')->get();
           
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
                $property_img->unit_id = $request->property_id;
                $property_img->file_type = 'gallery_images';
                $property_img->file_path = '/uploads/property/unit/gallery_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(array(
            // 'success' => false,
            // 'errors' => $validator->getMessageBag()->toArray(),
            'data' => $request->property_id
        ), 200);

    }

   
}
