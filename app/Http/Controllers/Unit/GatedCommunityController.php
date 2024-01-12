<?php

namespace App\Http\Controllers\Unit;

use App\Exports\GatedPropertiesExport;
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
use App\Models\UnitPriceLog;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;
use File;

class GatedCommunityController extends Controller
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
    public function storeServicedApartmentsDetails(Request $request)
    {
        //   return $request->covered_parking;

        $validator = Validator::make(
            $request->all(),
            [
                'bedrooms' => ['required_without:other_bedrooms'],
                'washrooms' => ['required_without:other_washrooms'],
                'balconies' => ['required_without:other_balconies'],
                'furnished_option' => ['required'],
                'property_facing' => ['required'],
                'availability_status' => ['required'],
                'age_of_property' => 'required_if:availability_status,23',
                // 'possession_date' => 'required_if:availability_status,24',
                'carpet_area' => ['required_without_all:built_area,super_built_area'],
            ],
            [
                'age_of_property.required_if' => 'Age of Property is required',
                // 'possession_date.required_if' => 'Possession Date is required',
                'carpet_area.required_without_all' => 'Atleast one field  is required',
            ],
        );
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
        }

        $serviced_apartment = SecondaryUnitLevelData::where([
            ['property_id', $request->property_id],
            ['unit_id', $request->unit_id],
            ['unit_type_id', $request->unit_type_id],
            // ['unit_cat_id', $request->unit_cat_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if ($serviced_apartment) {
            $save = $serviced_apartment;
        } else {
            $save = new SecondaryUnitLevelData();
        }
        $save->property_id = $request->property_id;
        $save->unit_id = $request->unit_id;
        $save->unit_type_id = $request->unit_type_id;
        // $save->unit_cat_id = $request->unit_cat_id;
        $save->property_cat_id = $request->property_cat_id;
        $save->rooms = $request->bedrooms ? $request->bedrooms : $request->other_bedrooms;
        $save->washrooms = $request->washrooms ? $request->washrooms : $request->other_washrooms;
        $save->property_facing = $request->property_facing;
        $save->balconies = $request->balconies ? $request->balconies : $request->other_balconies;
        $save->carpet_area = $request->carpet_area ? $request->carpet_area : null;
        $save->carpet_area_unit = $request->carpet_area ? $request->carpet_area_units : null;
        $save->buildup_area = $request->built_area ? $request->built_area : null;
        $save->buildup_area_unit = $request->built_area ? $request->builtup_area_units : null;
        $save->super_buildup_area = $request->super_built_area ? $request->super_built_area : null;
        $save->super_buildup_area_unit = $request->super_built_area ? $request->super_built_area_units : null;
        $save->covered_parking = $request->covered_parking;
        $save->open_parking = $request->open_parking;
        $save->furnishing_option = $request->furnished_option;
        $save->availability_status = $request->availability_status;
        $save->age_of_property = $request->age_of_property;
        $save->possesion_by = $request->possession_date;
        $save->created_by = Auth::id();
        $save->save();

        $delete_before_insert = UnitAmenityOptionValue::where('unit_id', $request->unit_id)
            ->where('property_id', $request->property_id)
            ->where('amenity_id', 13)
            ->delete();
        if (isset($request->other_rooms)) {
            if (count($request->other_rooms) > 0) {
                foreach ($request->other_rooms as $value) {
                    $options = new UnitAmenityOptionValue();
                    $options->property_id = $request->property_id;
                    $options->unit_id = $request->unit_id;
                    $options->amenity_id = 13;
                    $options->amenity_option_id = $value;
                    $options->save();
                }
            }
        }

        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
        $delete_before_insert = UnitAmenityOptionValue::where('unit_id', $request->unit_id)
            ->where('property_id', $request->property_id)
            ->where('amenity_id', 14)
            ->delete();
        foreach ($furnished_options as $furnish) {
            if ($furnish->id == $request->furnished_option) {
                if ($furnish->furnished_type_options->count() > 0) {
                    foreach ($furnish->furnished_type_options as $option) {
                        $option_name = str_replace([' ', '-'], '_', $furnish->name) . '_' . str_replace([' ', '-'], '_', $option->name);
                        if (isset($request->$option_name) && !empty($request->$option_name)) {
                            $furnish_options = new UnitAmenityOptionValue();
                            $furnish_options->property_id = $request->property_id;
                            $furnish_options->unit_id = $request->unit_id;
                            $furnish_options->amenity_id = 14;
                            $furnish_options->amenity_option_id = $request->furnished_option;
                            $furnish_options->amenity_option_value_id = $option->id;
                            if ($option->input_type != 'checkbox') {
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
    public function storeServicedApartmentsPricingDetails(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'pricing_details_for' => ['required'],
                'new_resale_unit' => ['required_if:pricing_details_for,==,1'],
                'ownership' => ['required_if:new_resale_unit,1,2'],
                'expected_price' => ['required_if:new_resale_unit,1,2'],
                'price_per_sq_ft' => ['required_if:new_resale_unit,1,2'],
                'expected_rent' => ['required_if:pricing_details_for,==,2'],
                'agreement_type' => ['required_if:pricing_details_for,==,2'],
                'rented_date' => ['required_if:pricing_details_for,==,3'],
                'rented_price' => ['required_if:pricing_details_for,==,3'],
                'sold_date' => ['required_if:pricing_details_for,==,4'],
                'sold_price' => ['required_if:pricing_details_for,==,4'],
            ],
            [
                'ownership.required_if' => 'ownership field is required for Sale',
                'pricing_details_for.required' => 'The pricing details field is required.',
                'expected_price.required_if' => 'The expected price field is required when pricing details is For Sale.',
                'price_per_sq_ft.required_if' => 'The price per sq ft field is required when pricing details is For Sale.',
                'expected_rent.required_if' => 'The expected rent field is required when pricing details is For Rent.',
                'agreement_type.required_if' => 'The agreement type field is required when pricing details is For Rent.',
                'rented_price.required_if' => 'Rented Price is Mandatory',
                'rented_date.required_if' => 'Rented Date is Mandatory',
                'sold_date.required_if' => 'Sold Date is Mandatory',
                'sold_price.required_if' => 'Sold Price is Mandatory',
                'new_resale_unit.required_if' => 'Sale Status is Required',
            ],
        );
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $serviced_apartment = SecondaryUnitLevelData::where([
            ['property_id', $request->property_id],
            ['unit_id', $request->unit_id],
            ['unit_type_id', $request->unit_type_id],
            // ['unit_cat_id', $request->unit_cat_id],
            ['property_cat_id', $request->property_cat_id],
        ])->first();

        if ($serviced_apartment) {
            if ($request->pricing_details_for == 1) {
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->ownership = $request->ownership;
                $serviced_apartment->expected_price = $request->expected_price;
                $serviced_apartment->price_per_sq_ft = $request->price_per_sq_ft;
                $serviced_apartment->mainteinance = $request->mainteinance;
                $serviced_apartment->maintenance_period = $request->price_period;
                $serviced_apartment->expected_rental = $request->expected_rental;
                $serviced_apartment->booking_amount = $request->booking_amount;
                $serviced_apartment->annual_due_pay = $request->annual_due_pay;
                $serviced_apartment->membership_charge = $request->membership_charge;
                $serviced_apartment->remark = $request->remark;
                $serviced_apartment->sale_status = $request->new_resale_unit;
                $serviced_apartment->sqft_based_on = isset($request->sqft_based_on) ? $request->sqft_based_on : 1;
                $serviced_apartment->save();

                updateSaleRent($request->property_id, $request->unit_id, $request->pricing_details_for);
                saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->expected_price, date('Y-m-d'), $request->price_per_sq_ft, $request->sqft_based_on, $request->new_resale_unit);

                salePriceDetails($request);
                return response()->json(['message' => 'Form submitted successfully']);
            } elseif ($request->pricing_details_for == 2) {
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->agreement_type = $request->agreement_type;
                $serviced_apartment->expected_rent = $request->expected_rent;
                $serviced_apartment->maintenance_period = $request->maintenance_period;
                $serviced_apartment->maintenance_rent = $request->maintenance_rent;
                $serviced_apartment->booking_amount_rent = $request->booking_amount_rent;
                $serviced_apartment->annual_dues_rent = $request->annual_dues_rent;
                $serviced_apartment->membership_charge_rent = $request->membership_charge_rent;
                $serviced_apartment->notice_period = $request->notice_period;
                $serviced_apartment->agreement_duration = $request->agreement_duration;
                $serviced_apartment->remark = $request->remark;
                $serviced_apartment->sqft_based_on = isset($request->sqft_based_on) ? $request->sqft_based_on : 0;
                $serviced_apartment->save();

                updateSaleRent($request->property_id, $request->unit_id, $request->pricing_details_for);
                saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->expected_rent, date('Y-m-d'), 0, 0);

                rentPriceDetails($request);
                $security_deposit = UnitAmenityOption::where('parent_id', 18)->get();
                $delete_before_insert = UnitAmenityOptionValue::where('unit_id', $request->unit_id)
                    ->where('property_id', $request->property_id)
                    ->where('amenity_id', 18)
                    ->delete();
                foreach ($security_deposit as $key => $value) {
                    $requestname = 'scurity_deposit_' . $value->id;
                    if (isset($request->$requestname) and !empty($request->$requestname)) {
                        $options = new UnitAmenityOptionValue();
                        $options->property_id = $request->property_id;
                        $options->unit_id = $request->unit_id;
                        $options->amenity_id = 18;
                        $options->amenity_option_id = $value->id;
                        $options->save();
                    }
                }
                return response()->json(['message' => 'Form submitted successfully']);
            } elseif ($request->pricing_details_for == 3) {
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->agreement_type = $request->agreement_type;
                $serviced_apartment->expected_rent = $request->rented_price;
                $serviced_apartment->maintenance_period = $request->maintenance_period;
                $serviced_apartment->maintenance_rent = $request->maintenance_rent;
                $serviced_apartment->booking_amount_rent = $request->booking_amount_rent;
                $serviced_apartment->annual_dues_rent = $request->annual_dues_rent;
                $serviced_apartment->membership_charge_rent = $request->membership_charge_rent;
                $serviced_apartment->notice_period = $request->notice_period;
                $serviced_apartment->agreement_duration = $request->agreement_duration;
                $serviced_apartment->remark = $request->remark;
                $serviced_apartment->rented_date = $request->rented_date;
                $serviced_apartment->sqft_based_on = isset($request->sqft_based_on) ? $request->sqft_based_on : 0;
                $serviced_apartment->save();

                updateSaleRent($request->property_id, $request->unit_id, $request->pricing_details_for);
                saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->rented_price, $request->rented_date, 0, 0);
                rentPriceDetails($request);

                $security_deposit = UnitAmenityOption::where('parent_id', 18)->get();
                $delete_before_insert = UnitAmenityOptionValue::where('unit_id', $request->unit_id)
                    ->where('property_id', $request->property_id)
                    ->where('amenity_id', 18)
                    ->delete();
                foreach ($security_deposit as $key => $value) {
                    $requestname = 'scurity_deposit_' . $value->id;
                    if (isset($request->$requestname) and !empty($request->$requestname)) {
                        $options = new UnitAmenityOptionValue();
                        $options->property_id = $request->property_id;
                        $options->unit_id = $request->unit_id;
                        $options->amenity_id = 18;
                        $options->amenity_option_id = $value->id;
                        $options->save();
                    }
                }
                return response()->json(['message' => 'Form submitted successfully']);
            } else {
                $serviced_apartment->pricing_details_for = $request->pricing_details_for;
                $serviced_apartment->ownership = $request->ownership;
                $serviced_apartment->expected_price = $request->sold_price;
                $serviced_apartment->rented_date = $request->sold_date;
                $serviced_apartment->price_per_sq_ft = $request->price_per_sqft_sold;
                $serviced_apartment->mainteinance = $request->mainteinance;
                $serviced_apartment->maintenance_period = $request->price_period;
                $serviced_apartment->expected_rental = $request->expected_rental;
                $serviced_apartment->booking_amount = $request->booking_amount;
                $serviced_apartment->annual_due_pay = $request->annual_due_pay;
                $serviced_apartment->membership_charge = $request->membership_charge;
                $serviced_apartment->remark = $request->remark;
                $serviced_apartment->sale_status = $request->new_resale_unit;
                $serviced_apartment->sqft_based_on = isset($request->sqft_based_on_sold) ? $request->sqft_based_on_sold : 0;
                $serviced_apartment->save();

                updateSaleRent($request->property_id, $request->unit_id, $request->pricing_details_for);
                saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->sold_price, $request->sold_date, $request->price_per_sqft_sold, $request->sqft_based_on_sold, $request->new_resale_unit);

                salePriceDetails($request);
                return response()->json(['message' => 'Form submitted successfully']);
            }
        }
    }

    //  store Images
    public function storeServicedApartmentsUnitImages(Request $request)
    {
        // return "hii";

        $validator = Validator::make($request->all(), [
            'gallery_images' => 'required_without_all:amenities_images,interior_images,floor_plan_images',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'amenities_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'floor_plan_images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
        }
        $get_gallery_images_to_unlink = UnitImage::where('property_id', $request->property_id)
            ->where('unit_id', $request->unit_id)
            ->where('file_type', 'gallery_images')
            ->get();
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
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);
                $property_img = new UnitImage();
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'gallery_images';
                $property_img->file_path = '/uploads/property/unit/gallery_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        $get_amenities_images_to_unlink = UnitImage::where('property_id', $request->property_id)
            ->where('unit_id', $request->unit_id)
            ->where('file_type', 'amenity_images')
            ->get();
        // dd($get_images_to_unlink);
        foreach ($get_amenities_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name))) {
                File::delete(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('amenities_images')) {
            foreach ($request->file('amenities_images') as $image) {
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);
                $property_img = new UnitImage();
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'amenity_images';
                $property_img->file_path = '/uploads/property/unit/amenity_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

        $get_interior_images_to_unlink = UnitImage::where('property_id', $request->property_id)
            ->where('unit_id', $request->unit_id)
            ->where('file_type', 'interior_images')
            ->get();
        // dd($get_images_to_unlink);
        foreach ($get_interior_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {
                File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('interior_images')) {
            foreach ($request->file('interior_images') as $image) {
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/interior_images', $file_name);
                $property_img = new UnitImage();
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->unit_id;
                $property_img->file_type = 'interior_images';
                $property_img->file_path = '/uploads/property/unit/interior_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

        $get_floor_plan_images_to_unlink = UnitImage::where('property_id', $request->property_id)
            ->where('unit_id', $request->unit_id)
            ->where('file_type', 'floor_plan_images')
            ->get();
        // dd($get_images_to_unlink);
        foreach ($get_floor_plan_images_to_unlink as $img_unlink) {
            if (File::exists(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name))) {
                File::delete(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name));

                $delete = UnitImage::where('id', $img_unlink->id)->delete();
            }
        }

        if ($request->hasfile('floor_plan_images')) {
            foreach ($request->file('floor_plan_images') as $image) {
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/floor_plan_images', $file_name);
                $property_img = new UnitImage();
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

    public function updateServicedApartmentsUnitImages(Request $request)
    {
        // return "hii";

        $validator = Validator::make($request->all(), [
            // 'gallery_images' => 'required_without_all:amenities_images,interior_images,floor_plan_images',
            // 'amenities_images' => 'required_without_all:gallery_images,interior_images,floor_plan_images',
            // 'interior_images' => 'required_without_all:gallery_images,amenities_images,floor_plan_images',
            // 'floor_plan_images' => 'required_without_all:gallery_images,amenities_images,interior_images',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'amenities_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'floor_plan_images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
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
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/gallery_images', $file_name);
                $property_img = new UnitImage();
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
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);
                $property_img = new UnitImage();
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
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/interior_images', $file_name);
                $property_img = new UnitImage();
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
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/floor_plan_images', $file_name);
                $property_img = new UnitImage();
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

    public function storeAmenities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facing_road_width' => 'sometimes|nullable|integer',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    ],
                    422,
                );
            }
        }
        $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
            ->where('unit_id', $request->unit_id)
            ->where('amenity_id', '20')
            ->delete();
        if ($request->has('amenity')) {
            foreach ($request->amenity as $amenity) {
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                $amenityValue = new UnitAmenityOptionValue();
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
                    'floor_type' => $request->floor_type,
                ]);
        }
        if ($request->has('facing_road_width')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'facing_road_width' => $request->facing_road_width,
                ]);
        }
        if ($request->has('facing_road_width_unit')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'facing_road_width_unit' => $request->facing_road_width_unit,
                ]);
        }

        return response()->json(['data' => $request->unit_id], 200);
    }

    public function gatedReports(Request $request, $type = null)
    {
        // $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $cat_ids = [config('constants.APARTMENT'), config('constants.INDEPENDENT_HOUSE_VILLA'), config('constants.PLOT_LAND')];
        $type_of_projects = Category::whereIn('id', $cat_ids)
            ->OrderBy('cat_name', 'ASC')
            ->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $residential = Category::where('parent_id', 2)
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $brand_sub_categories = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $brands = FloorUnitCategory::where('category_code', 4)
            ->orderBy('id', 'ASC')
            ->get();
        $builders = Builder::all();
        $properties = Property::query();

        $length = $request->length;
        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $from = date($request->get('start_date') . ' 00:00:00');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . ' 23:58:59';
        }

        if ($request->has('end_date') && !empty($request->get('end_date'))) {
            $to = date($request->get('end_date') . ' 23:58:59');
        }

        $properties
            ->when($request->category, function ($query) use ($request) {
                $query->where('cat_id', $request->category);
            })
            ->when($request->gis_id, function ($query) use ($request) {
                $query->where('gis_id', 'like', '%' . $request->gis_id . '%');
            })
            // ->when($request->type_of_project, function ($query) use ($request) {
            //     $query->where('residential_type', 'like', '%' . $request->type_of_project . '%');
            // })
            ->when($request->residential_category, function ($query) use ($request) {
                $query->where('residential_type', 'like', '%' . $request->residential_category . '%');
            })
            ->when($request->residential_sub_category, function ($query) use ($request) {
                $query->where('residential_sub_type', 'like', '%' . $request->residential_sub_category . '%');
            })
            ->when($request->building_name, function ($query) use ($request) {
                $query->where('building_name', 'like', '%' . $request->building_name . '%');
            })
            ->when($request->house_no, function ($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
            })
            ->when($request->locality_name, function ($query) use ($request) {
                $query->where('locality_name', 'like', '%' . $request->locality_name . '%');
            })
            ->when($request->plot_no, function ($query) use ($request) {
                $query->where('plot_no', 'like', '%' . $request->plot_no . '%');
            })
            ->when($request->street_name, function ($query) use ($request) {
                $query->where('street_details', 'like', '%' . $request->street_name . '%');
            })
            ->when($request->owner_name, function ($query) use ($request) {
                $query->where('owner_name', 'like', '%' . $request->owner_name . '%');
            })
            ->when($request->builder_name, function ($query) use ($request) {
                $query->where('builder_id', $request->builder_name);
            })
            ->when($request->contact_no, function ($query) use ($request) {
                $query->where('contact_no', 'like', '%' . $request->contact_no . '%');
            })
            ->when($request->pin_code, function ($query) use ($request) {
                $query->where('pincode', 'like', '%' . $request->pin_code . '%');
            })
            ->when($request->project_name, function ($query) use ($request) {
                $query->where('project_name', 'like', '%' . $request->project_name . '%');
            })
            ->when($request->no_of_floors, function ($query) use ($request) {
                $query->where('no_of_floors', $request->no_of_floors);
            });

        if (isset($request->brand_category) && !empty($request->brand_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_id', $request->brand_category);
            });
        }
        if (isset($request->no_of_units) && !empty($request->no_of_units)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('units', $request->no_of_units);
            });
        }
        if (isset($request->brand_sub_category) && !empty($request->brand_sub_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_sub_cat_id', $request->brand_sub_category);
            });
        }
        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_brand_id', $request->brand_sub_category);
            });
        }
        // return $request->pincode;
        if (isset($request->pincode) && !empty($request->pincode)) {
            $properties = $properties->whereHas('pincode', function ($query) use ($request) {
                $query->where('pincode_id', $request->pincode);
            });
        }

        // if(isset($request->owner_name) && !empty($request->owner_name)){
        //     $properties = $properties->whereHas('builderName', function ($query) use ($request) {
        //                                 $query->where('name', 'like', '%' .$request->owner_name  . '%');
        //                             });
        // }

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        // if ($request->has('type') && !empty($request->get('type'))) {
        if ($type && !empty($type)) {
            if ($type == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($type == 'week') {
                // dd($now->startOfWeek()->format('Y-m-d'));
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($type == 'today') {
                // dd($type);
                $properties = $properties->whereDate('created_at', Carbon::today());
            }
        }

        $searchKeyword = $request->get('search');
        if (!empty($searchKeyword)) {
            $properties = $properties->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('gis_id', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('owner_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('house_no', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('locality_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('contact_no', 'LIKE', '%' . $request->search . '%');
                    // ->whereHas('property.category', function ($query) use ($value) {
                    //         $query->where('title', 'LIKE', '%'.$request->search.'%');
                    //     });
                });
            });
        }

        if (isset($request->type_of_project) && !empty($request->type_of_project)) {
            if ($request->type_of_project == '4') {
                $properties = $properties->where('cat_id', $request->type_of_project);
                $properties = $properties->where('plot_land_type', config('constants.GATED_COMMUNITY_PLOT_LAND'));
            } else {
                $properties = $properties->where('residential_type', $request->type_of_project);
                $properties->whereIn('residential_sub_type', [config('constants.GATED_COMMUNITY_APARTMENT'), config('constants.GATED_COMMUNITY_VILLA')]);
                // $properties->orWhere('plot_land_type', '14');
            }
        } else {
            $properties->where(function ($query) {
                $query->whereIn('residential_sub_type', [config('constants.GATED_COMMUNITY_APARTMENT'), config('constants.GATED_COMMUNITY_VILLA')])->orWhere('plot_land_type', config('constants.GATED_COMMUNITY_PLOT_LAND'));
            });
        }

        // if(isset($length) && !empty($length)){
        //      $properties=$properties->where('created_by', Auth::user()->id)->orderBy('id','DESC')->paginate($length);
        // }else{
        $properties->where('created_by', Auth::user()->id);
        $property_count = count($properties->get());
        $properties = $properties->orderBy('id', 'DESC')->paginate(50);
        // }
        $properties->setPath(route('surveyor.gated-reports', [], true));

        foreach ($properties as $key => $property) {
            $towers = Tower::where('gis_id', $property->gis_id)->first();
            $properties[$key]['date'] = $property->created_at->format('d-m-Y');
            $properties[$key]['time'] = $property->created_at->format('H:i A');
            $properties[$key]['cat'] = $property->category->cat_name ?? '';
            $properties[$key]['surveyor_name'] = $property->users->username ?? '';
            $properties[$key]['residential_type'] = $property->residential_category->cat_name ?? $property->category->cat_name;
            $properties[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? $property->plot_land_type_category->cat_name;
            $properties[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
            $properties[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
        }

        if ($request->ajax()) {
            return view('admin.pages.property.reports.gated_property_pagination', ['properties' => $properties, 'category_type' => $request->type_of_project, 'property_count' => $property_count]);
        }
        return view('admin.pages.property.reports.gated_reports', get_defined_vars());
    }

    public function exportReport(Request $request)
    {
        // return $request->all();
        // return Excel::download(new GatedPropertiesExport, 'gated_properties.xlsx');
        $type_of_project = $request->type_of_project;
        $gis_id = $request->gis_id;
        $project_name = $request->project_name;
        $builder_name = $request->builder_name;
        $pin_code = $request->pincode;

        $type = $request->format;
        $fileName = 'gated_properties.' . $type;
        $export = new GatedPropertiesExport($type_of_project, $gis_id, $project_name, $builder_name, $pin_code);
        $filePath = 'export/' . $fileName;

        if ($type == 'xlsx') {
            Excel::store($export, $filePath);
        } elseif ($type == 'csv') {
            Excel::store($export, $filePath, 'local');
        } else {
            Excel::store($export, $filePath, 'local');
        }

        // Return the file path so it can be used in the Ajax response
        return response()->file(storage_path('app/' . $filePath));
    }
}
