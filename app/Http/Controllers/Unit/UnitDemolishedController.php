<?php

namespace App\Http\Controllers\Unit;

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
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;
use File;
error_reporting(0);

class UnitDemolishedController extends Controller
{
    protected $floorService;

    public function __construct(FloorService $floorService)
    {
        $this->floorService = $floorService;
    }

    /**
     * Display a listing of the resource.
     */

    public function unitDetails($unit_id)
    {
        $unit_data = FloorUnitMap::find($unit_id);
        $property = Property::find($unit_id);
        $prop_category_data = Category::find($property->category->id);
        $units = Unit::whereIn('id', ['3', '4'])->get(); //land Measuring units
        $area_detail_units = Unit::whereIn('id', ['3'])->get(); //land Measuring units
        $width_facing_road_units = Unit::whereIn('id', ['1'])->get(); //land Measuring units
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
        $amenities = UnitAmenityOption::where('parent_id', 20)->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $check_record = SecondaryUnitLevelData::where('property_id', $unit_id)->first();
       
        if ($check_record) {
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->with([
                    'demolished_images',
                ])
                ->first();

            return view('admin.pages.property.units.views.view_office', get_defined_vars());
        } else {
            return view('admin.pages.property.units.demolished', get_defined_vars());
        }
    }
    public function editUnitDetails($property_id)
    {
        $unit_data = FloorUnitMap::where('property_id', $property_id)->first();
        $property = Property::find($property_id);
        $prop_category_data = Category::find($property->category->id);
        $units = Unit::whereIn('id', ['3', '4'])->get(); //land Measuring units
        $area_detail_units = Unit::whereIn('id', ['3'])->get(); //land Measuring units
        $width_facing_road_units = Unit::whereIn('id', ['1'])->get(); //land Measuring units
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
        $amenities = UnitAmenityOption::where('parent_id', 20)->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $images = UnitImage::where('property_id', $property_id)->get();
        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
            ->where('unit_id', $property->id)
            ->first();
        if ($secondary_level_unit_data) {
            return view('admin.pages.property.units.edits.demolished-edit', get_defined_vars());
        } else {
            return view('admin.pages.property.units.demolished', get_defined_vars());
        }
    }

    public function updateCommOfcPropertyDetails(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                //first tab
                'plot_area' => ['required_without_all:buildup_area,carpet_area'],
                // 'carpet_area' => ['required_without_all:buildup_area,plot_area'],
                // 'buildup_area' => ['required_without_all:carpet_area,plot_area'],
                'demolished_images.*' => ['mimes:jpeg,png,jpg,gif', 'image'],
                // 'demolished_images' => ['required'],
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
        // try {
        $check_property_exist = SecondaryUnitLevelData::where('property_id', $request->property_id)->get();
        // if (empty($check_property_exist)) {
        $save = SecondaryUnitLevelData::updateOrCreate(
            [
                'property_id' => $request->property_id,
                'unit_id' => $request->property_id,
                // 'unit_type_id' => $request->unit_type_id,
                // 'unit_cat_id' => $request->unit_cat_id,
                'property_cat_id' => $request->property_cat_id,
            ],
            [
                'plot_area' => $request->plot_area,
                'plot_area_unit' => $request->plot_area_unit != '' ? $request->plot_area_unit : '',
                'carpet_area' => $request->carpet_area,
                'carpet_area_unit' => $request->carpet_area_unit != '' ? $request->carpet_area_unit : '',
                'buildup_area' => $request->buildup_area,
                'buildup_area_unit' => $request->buildup_area != '' ? $request->buildup_area_unit : '',
                'property_description' => $request->property_description,
                'previous_use' => $request->previous_use,
                'current_use' => $request->current_use,
                'price' => $request->price,
                'property_history' => $request->property_history,
                'development_potential' => $request->development_potential,
                'created_by' => auth()->user()->id,
            ],
        );

        if ($request->hasfile('demolished_images') && $save) {
            $delete = UnitImage::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->where('file_type', 'demolished')
                ->delete();
            foreach ($request->file('demolished_images') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/demolished', $file_name);
                $property_img = new UnitImage();
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->property_id;
                $property_img->file_type = 'demolished';
                $property_img->file_path = '/uploads/property/unit/demolished';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(
            [
                'success' => true,
                // 'errors' => $validator->getMessageBag()->toArray(),
                'data' => $request->property_id,
            ],
            200,
        );
    }

    /** functions for commercial->office starting below */
    public function storeCommOfcPropertyDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //first tab
            'plot_area' => ['required_without_all:buildup_area,carpet_area'],
            // 'carpet_area' => ['required_without_all:buildup_area,plot_area'],
            // 'buildup_area' => ['required_without_all:carpet_area,plot_area'],
            'demolished_images.*' => ['mimes:jpeg,png,jpg,gif', 'image'],
            'demolished_images' => ['required'],
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
        // try {
        $check_property_exist = SecondaryUnitLevelData::where('property_id', $request->property_id)->get();
        // if (empty($check_property_exist)) {
        $save = SecondaryUnitLevelData::updateOrCreate(
            [
                'property_id' => $request->property_id,
                'unit_id' => $request->property_id,
                // 'unit_type_id' => $request->unit_type_id,
                // 'unit_cat_id' => $request->unit_cat_id,
                'property_cat_id' => $request->property_cat_id,
            ],
            [
                'plot_area' => $request->plot_area,
                'plot_area_unit' => $request->plot_area_unit != '' ? $request->plot_area_unit : '',
                'carpet_area' => $request->carpet_area,
                'carpet_area_unit' => $request->carpet_area_unit != '' ? $request->carpet_area_unit : '',
                'buildup_area' => $request->buildup_area,
                'buildup_area_unit' => $request->buildup_area != '' ? $request->buildup_area_unit : '',
                'property_description' => $request->property_description,
                'previous_use' => $request->previous_use,
                'current_use' => $request->current_use,
                'price' => $request->price,
                'property_history' => $request->property_history,
                'development_potential' => $request->development_potential,
                'created_by' => auth()->user()->id,
            ],
        );

        if ($request->hasfile('demolished_images') && $save) {
            $delete = UnitImage::where('property_id', $request->property_id)
                ->where('unit_id', $request->property_id)
                ->where('file_type', 'demolished')
                ->delete();
            foreach ($request->file('demolished_images') as $image) {
                $name = $image->getClientOriginalName();
                $file_name = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/uploads/property/unit/demolished', $file_name);
                $property_img = new UnitImage();
                $property_img->property_id = $request->property_id;
                $property_img->unit_id = $request->property_id;
                $property_img->file_type = 'demolished';
                $property_img->file_path = '/uploads/property/unit/demolished';
                $property_img->file_name = $file_name;
                $property_img->created_by = auth()->user()->id;
                $property_img->save();
            }
        }
        return response()->json(
            [
                'success' => true,
                // 'errors' => $validator->getMessageBag()->toArray(),
                'data' => $request->property_id,
            ],
            200,
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
            ],
            [
                'expected_price.required_if' => 'Expected Price is Mandatory',
                'price_per_sq_ft.required_if' => 'Price Per Sq.Ft is Mandatory',
                'expected_rent.required_if' => 'Expected Rent is Mandatory',
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
                    'sqft_based_on' => isset($request->sqft_based_on) ? $request->sqft_based_on : 1,
                    // 'price_period' =>
                    'agreement_type' => null,
                    'expected_rent' => null,
                    // 'facility' => null,
                    'maintenance_rent' => null,
                    'booking_amount_rent' => null,
                    'annual_dues_rent' => null,
                    'membership_charge_rent' => null,
                    'security_deposit' => null,
                    'notice_period' => null,
                ],
            );
            if ($request->has('price_details')) {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '22')
                    ->delete();
                foreach ($request->price_details as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->amenity_id = '22';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
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
                    'sqft_based_on' => isset($request->sqft_based_on) ? $request->sqft_based_on : 0,

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
            if ($request->has('facility')) {
                $delete = UnitAmenityOptionValue::where('property_id', $request->property_id)
                    ->where('unit_id', $request->unit_id)
                    ->where('amenity_id', '17')
                    ->delete();
                foreach ($request->facility as $amenity) {
                    $amenityValue = new UnitAmenityOptionValue();
                    $amenityValue->unit_id = $request->unit_id;
                    $amenityValue->property_id = $request->property_id;
                    $amenityValue->amenity_id = '17';
                    $amenityValue->amenity_option_id = $amenity;
                    $amenityValue->save();
                }
            }
        }
    }

    public function storeImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery_images' => 'required_without_all:amenities_images,interior_images,floor_plan_images',
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
        }

        if ($request->has('property_feature_suggesion')) {
            $amenityValue = SecondaryUnitLevelData::where('property_id', $request->property_id)
                ->where('unit_id', $request->unit_id)
                ->update([
                    'property_feature_suggestion' => $request->property_feature_suggesion,
                ]);
        }
        return response()->json(
            [
                // 'success' => false,
                // 'errors' => $validator->getMessageBag()->toArray(),
                'data' => $request->property_id,
            ],
            200,
        );
        // return redirect()->route('surveyor.property.report_details', $request->property_id)->with('property', $request->property_   id);
    }
}
