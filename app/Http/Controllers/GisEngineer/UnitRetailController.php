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
use App\Models\Unit;
use App\Models\UnitAmenity;
use App\Models\UnitAmenityCategory;
use App\Models\UnitAmenityOptionValue;
use App\Models\UnitImage;
use App\Models\UnitPriceLog;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;
use File;

class UnitRetailController extends Controller
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
    public function storeCommOfcPropertyDetails(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'availability_status' => ['required'],
                'possesion_by' => ['required_if:availability_status,==,"24"'],
                'property_age' => ['required_if:possesion_by,==,null'],
                'carpet_area' => ['required_without_all:buildup_area,super_buildup_area'],
                // 'buildup_area' => ['required_without_all:carpet_area,super_buildup_area'],
                // 'super_buildup_area' => ['required_without_all:carpet_area,buildup_area'],
                'property_facing' => ['required'],
                'washrooms' => ['required'],
                'parking_type' => ['required'],
                'priavate_washrooms' => ['required_if:washrooms,==,"84"'],
                'shared_washrooms' => ['required_if:washrooms,==,"84"'],
            ],
            [
                'carpet_area.required_without_all' => 'Any one field is required',
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
        $save = SecondaryUnitLevelData::updateOrCreate(
            [
                'property_id' => $request->property_id,
                'unit_id' => $request->unit_id,
                'unit_type_id' => $request->unit_type_id,
                'unit_cat_id' => $request->unit_cat_id,
                'property_cat_id' => $request->property_cat_id,
            ],
            [
                'carpet_area' => $request->carpet_area,
                'carpet_area_unit' => $request->carpet_area != '' ? $request->carpet_area_unit : '',
                'buildup_area' => $request->buildup_area,
                'buildup_area_unit' => $request->buildup_area != '' ? $request->buildup_area_unit : '',
                'super_buildup_area' => $request->super_buildup_area,
                'super_buildup_area_unit' => $request->super_buildup_area != '' ? $request->super_buildup_area_unit : '',
                'property_facing' => $request->property_facing,
                'availability_status' => $request->availability_status,
                'age_of_property' => $request->availability_status == '23' ? $request->property_age : null,
                'possesion_by' => $request->availability_status == '24' ? $request->possesion_by : null,

                'enterance_width' => $request->enterance_width,
                'enterance_width_unit' => $request->enterance_width_unit,
                'ceiling_height' => $request->ceiling_height,
                'ceiling_height_unit' => $request->ceiling_height_unit,
                'washrooms' => $request->washrooms,
                'priavate_washrooms' => $request->priavate_washrooms,
                'shared_washrooms' => $request->shared_washrooms,
                'located_near' => $request->located_near,
                'parking_type' => $request->parking_type,
                'created_by' => auth()->user()->id,
            ],
        );
    }

    public function storePricingDetails(Request $request)
    {
        if (!$request->has('pricing_details_for')) {
            $request->merge(['pricing_details_for' => null]);
        }
        $validator = Validator::make(
            $request->all(),
            [
                'pricing_details_for' => ['required'],
                'expected_price' => ['required_if:pricing_details_for,==,1'],
                'price_per_sq_ft' => ['required_if:pricing_details_for,==,1'],
                'expected_rent' => ['required_if:pricing_details_for,==,2'],
                'rented_date' => ['required_if:pricing_details_for,==,3'],
                'rented_price' => ['required_if:pricing_details_for,==,3'],
                'ownership' => ['required_if:pricing_details_for,==,1'],
                'sold_date' => ['required_if:pricing_details_for,==,4'],
                'sold_price' => ['required_if:pricing_details_for,==,4'],
            ],
            [
                'ownership.required_if' => 'ownership field is required for Sale',
                'expected_price.required_if' => 'Expected Price is Mandatory',
                'rented_price.required_if' => 'Rented Price is Mandatory',
                'price_per_sq_ft.required_if' => 'Price Per Sq.Ft is Mandatory',
                'expected_rent.required_if' => 'Expected Rent is Mandatory',
                'rented_date.required_if' => 'Rented Date is Mandatory',
                'sold_date.required_if' => 'Sold Date is Mandatory',
                'sold_price.required_if' => 'Sold Price is Mandatory',
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

        if ($request->pricing_details_for == 1) {
            // pricing_details_for=1 for sale and pricing_details_for=2 for rent
            $save = SecondaryUnitLevelData::updateOrCreate(
                [
                    'property_id' => $request->property_id,
                    'unit_id' => $request->unit_id,
                    'unit_type_id' => $request->unit_type_id,
                    'unit_cat_id' => $request->unit_cat_id,
                    'property_cat_id' => $request->property_cat_id,
                ],
                [
                    'pricing_details_for' => $request->pricing_details_for,
                    'ownership' => $request->ownership,
                    'expected_price' => $request->expected_price,
                    'price_per_sq_ft' => $request->price_per_sq_ft,
                    // 'all_inclusive_price' => $request->all_inclusive_price,
                    // 'price_negociable' => $request->price_negociable,
                    'mainteinance' => $request->mainteinance,
                    'maintenance_period' => $request->price_period,
                    'expected_rental' => $request->expected_rental,
                    'booking_amount' => $request->booking_amount,
                    'annual_due_pay' => $request->annual_due_pay,
                    'membership_charge' => $request->membership_charge,
                    'remark' => $request->remark,
                    // 'price_period' =>
                    'agreement_type' => null,
                    'expected_rent' => null,
                    // 'facility' => null,
                    'maintenance_rent' => $request->maintenance_rent,
                    'booking_amount_rent' => null,
                    'annual_dues_rent' => null,
                    'membership_charge_rent' => null,
                    'security_deposit' => null,
                    'notice_period' => null,
                ],
            );
            $this->saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->expected_price, date('Y-m-d'));

            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '22')
                ->delete();
            if ($request->has('price_details')) {
                foreach ($request->price_details as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->amenity_id = '22';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
            }
        } elseif ($request->pricing_details_for == 2) {
            $save = SecondaryUnitLevelData::updateOrCreate(
                [
                    'property_id' => $request->property_id,
                    'unit_id' => $request->unit_id,
                    'unit_type_id' => $request->unit_type_id,
                    'unit_cat_id' => $request->unit_cat_id,
                    'property_cat_id' => $request->property_cat_id,
                ],
                [
                    'pricing_details_for' => $request->pricing_details_for,
                    'agreement_type' => $request->agreement_type,
                    'expected_rent' => $request->expected_rent,
                    // 'facility' => $request->facility,
                    'maintenance_rent' => $request->maintenance_rent,
                    'booking_amount_rent' => $request->booking_amount_rent,
                    'annual_dues_rent' => $request->annual_dues_rent,
                    'membership_charge_rent' => $request->membership_charge_rent,
                    'security_deposit' => $request->security_deposit,
                    'agreement_duration' => $request->agreement_duration,
                    'notice_period' => $request->notice_period,

                    'ownership' => null,
                    'expected_price' => null,
                    'price_per_sq_ft' => null,
                    // 'all_inclusive_price' => null,
                    // 'price_negociable' => null,
                    'mainteinance' => null,
                    'maintenance_period' => $request->maintenance_period,
                    'expected_rental' => null,
                    'booking_amount' => null,
                    'annual_due_pay' => null,
                    'membership_charge' => null,
                    'remark' => null,
                ],
            );
            $this->saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->expected_rent, date('Y-m-d'));

            if ($request->has('facility')) {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '17')
                    ->delete();
                foreach ($request->facility as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->amenity_id = '17';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
            } else {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '17')
                    ->delete();
            }
        } elseif ($request->pricing_details_for == 3) {
            $save = SecondaryUnitLevelData::updateOrCreate(
                [
                    'property_id' => $request->property_id,
                    'unit_id' => $request->unit_id,
                    'unit_type_id' => $request->unit_type_id,
                    'unit_cat_id' => $request->unit_cat_id,
                    'property_cat_id' => $request->property_cat_id,
                ],
                [
                    'pricing_details_for' => $request->pricing_details_for,
                    'agreement_type' => $request->agreement_type,
                    'expected_rent' => $request->rented_price,
                    // 'facility' => $request->facility,
                    'maintenance_rent' => $request->maintenance_rent,
                    'booking_amount_rent' => $request->booking_amount_rent,
                    'annual_dues_rent' => $request->annual_dues_rent,
                    'membership_charge_rent' => $request->membership_charge_rent,
                    'security_deposit' => $request->security_deposit,
                    'agreement_duration' => $request->agreement_duration,
                    'notice_period' => $request->notice_period,
                    'rented_date' => $request->rented_date,

                    'ownership' => null,
                    'expected_price' => null,
                    'price_per_sq_ft' => null,
                    // 'all_inclusive_price' => null,
                    // 'price_negociable' => null,
                    'mainteinance' => null,
                    'maintenance_period' => $request->maintenance_period,
                    'expected_rental' => null,
                    'booking_amount' => null,
                    'annual_due_pay' => null,
                    'membership_charge' => null,
                    'remark' => null,
                ],
            );
            $this->saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->rented_price, $request->rented_date);

            if ($request->has('facility')) {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '17')
                    ->delete();
                foreach ($request->facility as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->amenity_id = '17';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
            } else {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '17')
                    ->delete();
            }
        } else {
            $save = SecondaryUnitLevelData::updateOrCreate(
                [
                    'property_id' => $request->property_id,
                    'unit_id' => $request->unit_id,
                    'unit_type_id' => $request->unit_type_id,
                    'unit_cat_id' => $request->unit_cat_id,
                    'property_cat_id' => $request->property_cat_id,
                ],
                [
                    'pricing_details_for' => $request->pricing_details_for,
                    'ownership' => $request->ownership,
                    'expected_price' => $request->sold_price,
                    'rented_date' => $request->sold_date,
                    'price_per_sq_ft' => $request->price_per_sq_ft,
                    // 'all_inclusive_price' => $request->all_inclusive_price,
                    // 'price_negociable' => $request->price_negociable,
                    'mainteinance' => $request->mainteinance,
                    'maintenance_period' => $request->price_period,
                    'expected_rental' => $request->expected_rental,
                    'booking_amount' => $request->booking_amount,
                    'annual_due_pay' => $request->annual_due_pay,
                    'membership_charge' => $request->membership_charge,
                    'remark' => $request->remark,
                    'rented_date' => $request->rented_date,
                    // 'price_period' =>
                    'agreement_type' => null,
                    'expected_rent' => null,
                    // 'facility' => null,
                    'maintenance_rent' => $request->maintenance_rent,
                    'booking_amount_rent' => null,
                    'annual_dues_rent' => null,
                    'membership_charge_rent' => null,
                    'security_deposit' => null,
                    'notice_period' => null,
                ],
            );
            $this->saveUnitPriceLog($request->property_id, $request->unit_id, $request->pricing_details_for, $request->sold_price, $request->sold_date);

            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '22')
                ->delete();
            if ($request->has('price_details')) {
                foreach ($request->price_details as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->amenity_id = '22';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
            }
        }
    }

    public static function saveUnitPriceLog($property_id, $unit_id, $pricing_details_for, $price, $date)
    {
        $savePriceLogs = UnitPriceLog::create([
            'property_id' => $property_id,
            'unit_id' => $unit_id,
            'pricing_details_for' => $pricing_details_for,
            'price' => $price,
            'date' => $date,
        ]);
    }

    public function storeImages(Request $request)
    {
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
        $get_gallery_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)
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
        $get_amenities_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)
            ->where('file_type', 'amenities_images')
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

        $get_interior_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)
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

        $get_floor_plan_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)
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
    }

    public function updateImages(Request $request)
    {
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
        // $get_gallery_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)->where('file_type', 'gallery_images')->get();
        // foreach ($get_gallery_images_to_unlink as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name))) {

        //         File::delete(public_path('/uploads/property/unit/gallery_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }

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

        // $get_amenities_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)->where('file_type', 'amenities_images')->get();
        // foreach ($get_amenities_images_to_unlink as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name))) {

        //         File::delete(public_path('/uploads/property/unit/amenity_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
        if ($request->hasfile('amenities_images')) {
            foreach ($request->file('amenities_images') as $image) {
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/amenity_images', $file_name);
                $property_img = new UnitImage();
                $property_img->unit_id = $request->unit_id;
                $property_img->property_id = $request->property_id;
                $property_img->file_type = 'amenity_images';
                $property_img->file_path = '/uploads/property/unit/amenity_images';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }

        // $get_interior_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)->where('file_type', 'interior_images')->get();
        // foreach ($get_interior_images_to_unlink as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name))) {

        //         File::delete(public_path('/uploads/property/unit/interior_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
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

        // $get_floor_plan_images_to_unlink = UnitImage::where('unit_id', $request->unit_id)->where('file_type', 'floor_plan_images')->get();
        // foreach ($get_floor_plan_images_to_unlink as $img_unlink) {
        //     if (File::exists(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name))) {

        //         File::delete(public_path('/uploads/property/unit/floor_plan_images/' . $img_unlink->file_name));

        //         $delete = UnitImage::where('id', $img_unlink->id)->delete();
        //     }
        // }
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
    }

    public function storeAmenities(Request $request)
    {
        if ($request->has('amenity')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '20')
                ->delete();
            foreach ($request->amenity as $amenity) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '20';
                $amenityValue->amenity_option_id = $amenity;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '20')
                ->delete();
        }

        if ($request->has('society_features')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '29')
                ->delete();
            foreach ($request->society_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '29';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '29')
                ->delete();
        }

        if ($request->has('additional_features')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '30')
                ->delete();
            foreach ($request->additional_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '30';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '30')
                ->delete();
        }

        if ($request->has('other_features')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '31')
                ->delete();
            foreach ($request->other_features as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '31';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '31')
                ->delete();
        }

        if ($request->has('water_source')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '32')
                ->delete();
            foreach ($request->water_source as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '32';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '32')
                ->delete();
        }

        if ($request->has('overlooking')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '33')
                ->delete();
            foreach ($request->overlooking as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '33';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '33')
                ->delete();
        }

        if ($request->has('power_backup')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '34')
                ->delete();
            foreach ($request->power_backup as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '34';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '34')
                ->delete();
        }

        if ($request->has('location_advantage')) {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '21')
                ->delete();
            foreach ($request->location_advantage as $loc_adv) {
                $amenityValue = new UnitAmenityOptionValue();
                $amenityValue->property_id = $request->property_id;
                $amenityValue->unit_id = $request->unit_id;
                $amenityValue->amenity_id = '21';
                $amenityValue->amenity_option_id = $loc_adv;
                $amenityValue->save();
            }
        } else {
            $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('amenity_id', '21')
                ->delete();
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

        return response()->json(
            [
                // 'success' => false,
                // 'errors' => $validator->getMessageBag()->toArray(),
                'data' => $request->unit_id,
            ],
            200,
        );
        // return redirect()->route('surveyor.property.report_details', $request->property_id)->with('property', $request->property_   id);
    }
}
