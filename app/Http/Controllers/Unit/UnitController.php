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
use App\Models\FloorType;
use App\Models\OwnershipOptions;
use App\Models\PropertyFacing;
use App\Models\SecondaryUnitLevel;
use App\Models\SecondaryUnitLevelData;
use App\Models\Unit;
use App\Models\UnitAmenity;
use App\Models\UnitAmenityCategory;
use App\Models\UnitAmenityOptionValue;
use App\Models\UnitImage;
use App\Models\UnitApartmentType;
use App\Models\UnitPriceLog;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;

error_reporting(0);

class UnitController extends Controller
{
    protected $floorService;

    public function __construct(FloorService $floorService)
    {
        $this->floorService = $floorService;
    }

    /**
     * Display a listing of the resource.
     */

    public function unitDetails($unit_id, $residential_type = null)
    {
        // dd($residential_type);

        if (isset($residential_type) && ($residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') || $residential_type == config('constants.GATED_COMMUNITY_PLOT_LAND'))) {
            $unit_data = Tower::find($unit_id);
        } else {
            $unit_data = FloorUnitMap::find($unit_id);
        }
        // dd($unit_data->furnished_unit_amenities);
        $property = Property::find($unit_data->property_id);
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
        //Amenity
        $amenities = UnitAmenityOption::where('parent_id', 20)->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $Society_features = UnitAmenityOption::where('parent_id', 29)->get();
        $additional_features = UnitAmenityOption::where('parent_id', '30')->get();
        $other_features = UnitAmenityOption::where('parent_id', '31')->get();
        $water_source = UnitAmenityOption::where('parent_id', '32')->get();
        $overlooking = UnitAmenityOption::where('parent_id', '33')->get();
        $power_backup = UnitAmenityOption::where('parent_id', '34')->get();
        $flooring_type = FloorType::get();
        // unit price logs
        $unit_price_logs = UnitPriceLog::where('unit_id', $unit_id)
            ->where('pricing_details_for','!=',NULL)
            ->orderBy('id', 'DESC')
            ->get();
        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
        if ($property->cat_id == config('constants.COMMERCIAL') && ($unit_data->unit_type_id == config('constants.VACANT') || $unit_data->unit_type_id == config('constants.OCCUPIED')) && $unit_data->unit_cat_id == config('constants.DEFAULT')) {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            $unit_categories = FloorUnitCategory::where('category_code', 1)
                ->select(['id', 'name', 'field_type'])
                ->get();

            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();
                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.vacant-screen', get_defined_vars());
            }
        } elseif ($property->cat_id == config('constants.COMMERCIAL') && ($unit_data->unit_type_id == config('constants.VACANT') || $unit_data->unit_type_id == config('constants.OCCUPIED')) && $unit_data->unit_cat_id == config('constants.OFFICE')) {
            //mrunal (office)
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();
                // dd($secondary_level_unit_data->image_gallery);

                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
            }
        } elseif ($property->cat_id == config('constants.COMMERCIAL') && ($unit_data->unit_type_id == config('constants.VACANT') || $unit_data->unit_type_id == config('constants.OCCUPIED')) && $unit_data->unit_cat_id == config('constants.HOSPITALITY_HOTEL')) {
            //aparanjith (hospitality)
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_props = UnitAmenityOption::where('parent_id', 11)->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.hospitality', get_defined_vars());
            }
        }
        // for Resedential Units
        elseif ($property->cat_id == config('constants.RESIDENTIAL')) {
            if ($property->residential_type == config('constants.APARTMENT') && $property->residential_sub_type == config('constants.STAND_ALONE_APARTMENT')) {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();

                if ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($check_record) {
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                            ->first();
                        return view('admin.pages.property.units.views.view_office', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 3) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        //return view('admin.pages.property.units.views.1rk-view', get_defined_vars());
                        return view('admin.pages.property.units.views.view_office', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                }
            } else {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                    ->where('unit_id', $unit_id)
                    ->first();
                if ($check_record) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                        ->where('unit_id', $unit_id)
                        ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                        ->first();
                    return view('admin.pages.property.units.views.view_office', get_defined_vars());
                } else {
                    if (($property->residential_type == config('constants.APARTMENT') && $property->residential_sub_type == config('constants.GATED_COMMUNITY_APARTMENT')) || ($property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') && $property->residential_sub_type == config('constants.GATED_COMMUNITY_VILLA'))) {
                        return view('admin.pages.property.units.gated-community', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                }
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 104) {
            //for Commercial Retail
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units2 = Unit::whereIn('id', ['1', '2'])->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();
                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.retail_commercial', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 150) {
            //for storage/indusrty
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();

            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();

                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.storage', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 151) {
            //for other commercial
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();

                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }

        // for multiland
        elseif ($property->cat_id == config('constants.MULTI_UNIT')) {
            if ($unit_data->unit_cat_type_id == 1) {
                // commercial
                if (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 0) {
                    $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                    $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                    $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                    $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                    $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                    //Facilities Available
                    $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                    $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                    $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                    $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                    $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                    $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                    $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                    $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                    $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                    $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
                    //Amenities
                    $unit_categories = FloorUnitCategory::where('category_code', 1)
                        ->select(['id', 'name', 'field_type'])
                        ->get();
                    return view('admin.pages.property.units.vacant-screen', get_defined_vars());
                }
                if (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id != 0) {
                    // occupied
                    if ($unit_data->unit_cat_id == 102) {
                        //mrunal (office)
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                        $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                        //Facilities Available
                        $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                        $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                        $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                        $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                        $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                        $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        //Amenities
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                                ->first();
                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 109) {
                        //aparanjith (hospitality)
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.hospitality', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 104) {
                        //for Commercial Retail
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units2 = Unit::whereIn('id', ['1', '2'])->get();
                        //Amenities
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                                ->first();
                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.retail_commercial', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 150) {
                        //for storage/indusrty
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();

                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                                ->first();

                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.storage', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 151) {
                        //for other commercial
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                                ->first();

                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    } else {
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                                ->first();

                            return view('admin.pages.property.units.views.view_office', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    }
                }
            }
            if ($unit_data->unit_cat_type_id == 2) {
                // Resedential
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                if ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($check_record) {
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                            ->first();
                        return view('admin.pages.property.units.views.view_office', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 3) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        //return view('admin.pages.property.units.views.1rk-view', get_defined_vars());
                        return view('admin.pages.property.units.views.view_office', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                }
            }
        } elseif ($property->cat_id == config('constants.PLOT_LAND')) {
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_props = UnitAmenityOption::where('parent_id', 11)->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();
                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                if ($property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND')) {
                    return view('admin.pages.property.units.gated-community', get_defined_vars());
                } else {
                    return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                }
            }
        } else {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();

            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();

                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }
    }
    public function unitDetails_dfd($unit_id, $residential_type = null)
    {
        // dd($residential_type);
        if (isset($residential_type) && $residential_type == 8) {
            $unit_data = Tower::find($unit_id);
        } else {
            $unit_data = FloorUnitMap::find($unit_id);
        }
        $property = Property::find($unit_data->property_id);
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
        //Amenity
        $amenities = UnitAmenityOption::where('parent_id', 20)->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $Society_features = UnitAmenityOption::where('parent_id', 29)->get();
        $additional_features = UnitAmenityOption::where('parent_id', '30')->get();
        $other_features = UnitAmenityOption::where('parent_id', '31')->get();
        $water_source = UnitAmenityOption::where('parent_id', '32')->get();
        $overlooking = UnitAmenityOption::where('parent_id', '33')->get();
        $power_backup = UnitAmenityOption::where('parent_id', '34')->get();
        $flooring_type = FloorType::get();
        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
        if ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 0) {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            $unit_categories = FloorUnitCategory::where('category_code', 1)
                ->select(['id', 'name', 'field_type'])
                ->get();

            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                    ->first();

                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.vacant-screen_dfd', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 102) {
            //mrunal (office)
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();

            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();

                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 109) {
            //aparanjith (hospitality)
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_props = UnitAmenityOption::where('parent_id', 11)->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.hospitality', get_defined_vars());
            }
        }
        // for Resedential Units
        elseif ($property->cat_id == 2) {
            if ($property->residential_type == 7 && $property->residential_sub_type == 9) {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();

                if ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($check_record) {
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 3) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        //return view('admin.pages.property.units.views.1rk-view', get_defined_vars());
                        return view('admin.pages.property.units.views.view_office', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                }
            } else {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                    ->where('unit_id', $unit_id)
                    ->first();
                if ($check_record) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                } else {
                    if (($property->residential_type == 7 && $property->residential_sub_type == 10) || ($property->residential_type == 8 && $property->residential_sub_type == 12)) {
                        return view('admin.pages.property.units.gated-community', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                }
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 104) {
            //for Commercial Retail
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units2 = Unit::whereIn('id', ['1', '2'])->get();
            //Amenities
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();
                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.retail_commercial', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 150) {
            //for storage/indusrty
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();

            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();

                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.storage', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 151) {
            //for other commercial
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();

                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }

        // for multiland
        elseif ($property->cat_id == 3) {
            if ($unit_data->unit_cat_type_id == 1) {
                // commercial
                if (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 0) {
                    $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                    $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                    $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                    $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                    $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                    //Facilities Available
                    $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                    $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                    $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                    $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                    $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                    $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                    $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                    $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                    $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                    $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
                    //Amenities
                    $unit_categories = FloorUnitCategory::where('category_code', 1)
                        ->select(['id', 'name', 'field_type'])
                        ->get();
                    return view('admin.pages.property.units.vacant-screen', get_defined_vars());
                }
                if (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id != 0) {
                    // occupied
                    if ($unit_data->unit_cat_id == 102) {
                        //mrunal (office)
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                        $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                        //Facilities Available
                        $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                        $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                        $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                        $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                        $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                        $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        //Amenities
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();
                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 109) {
                        //aparanjith (hospitality)
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.hospitality', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 104) {
                        //for Commercial Retail
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units2 = Unit::whereIn('id', ['1', '2'])->get();
                        //Amenities
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();
                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.retail_commercial', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 150) {
                        //for storage/indusrty
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();

                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();

                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.storage', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 151) {
                        //for other commercial
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();

                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    } else {
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();

                            return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    }
                }
            }
            if ($unit_data->unit_cat_type_id == 2) {
                // Resedential
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                if ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($check_record) {
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 3) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        //return view('admin.pages.property.units.views.1rk-view', get_defined_vars());
                        return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                }
            }
        } else {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();

                return view('admin.pages.property.units.views.view_office_dfd', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }
    }

    public function getSubCategories(Request $request)
    {
        $unit_sub_category = FloorUnitCategory::where('parent_id', $request->unit_category)->get();
        return response()->json(
            [
                'success' => true,
                'data' => $unit_sub_category,
            ],
            200,
        );
    }

    public function addSubCategory(Request $request, $unit_id)
    {
        $request->validate(
            [
                'fu_category' => 'required',
            ],
            [
                'fu_category.required' => 'Category Field is Required',
            ],
        );

        $update = FloorUnitMap::find($unit_id);
        // $update->unit_type_id = '2';
        $update->unit_cat_id = $request->fu_category;
        $update->unit_sub_cat_id = $request->fu_sub_category ?? 0;
        if (is_numeric($request->floor_brand)) {
            $update->unit_brand_id = $request->floor_brand;
            $update->brand_name = null;
        } else {
            $update->brand_name = $request->floor_brand ?? '';
            $update->unit_brand_id = null;
        }
        $update->save();

        return redirect()
            ->back()
            ->with('success', 'Record Updated Successfully');
    }

    public function plotLandUnitDetails($prop_id)
    {
        //aparanjith (open plot land)
        $property = Property::find($prop_id);
        if ($property->cat_id == 4 && $property->plot_land_type == 13) {
            $units = Unit::whereIn('id', ['3', '4'])->get(); //land Measuring units
            $area_detail_units = Unit::whereIn('id', ['3'])->get(); //land Measuring units
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
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $property->id)
                ->with(['image_gallery', 'amenity_images', 'interior_images', 'floor_plan_images'])
                ->first();
            $unit_price_logs = UnitPriceLog::where('unit_id', $prop_id)
                ->orderBy('id', 'DESC')
                ->get();
            // dd( $secondary_level_unit_data );

            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.views.view_office', get_defined_vars());
            } else {
                return view('admin.pages.property.units.open-plot-land', get_defined_vars());
            }
        }
    }

    public function editPlotLandDetails($prop_id)
    {
        $property = Property::find($prop_id);
        if ($property->cat_id == 4 && $property->plot_land_type == 13) {
            $units = Unit::whereIn('id', ['3', '4'])->get(); //land Measuring units
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
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $property->id)
                ->first();
            if ($secondary_level_unit_data) {
                $price_details_values = UnitAmenityOptionValue::where('property_id', $property->id)
                    ->where('unit_id', $property->id)
                    ->where('amenity_id', 22)
                    ->pluck('amenity_option_id')
                    ->toArray();
                $rent_details_values = UnitAmenityOptionValue::where('property_id', $property->id)
                    ->where('unit_id', $property->id)
                    ->where('amenity_id', 17)
                    ->pluck('amenity_option_id')
                    ->toArray();
                $security_deposit_values = UnitAmenityOptionValue::where('property_id', $property->id)
                    ->where('unit_id', $property->id)
                    ->where('amenity_id', 18)
                    ->pluck('amenity_option_id')
                    ->toArray();
                $galleryImages = UnitImage::where('property_id', $property->id)
                    ->where('unit_id', $property->id)
                    ->where('file_type', 'gallery_images')
                    ->get();

                return view('admin.pages.property.units.edits.open-plot-land-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.open-plot-land', get_defined_vars());
            }
        }
    }

    // add residential unit apartment type
    public function unitApartmentType(Request $request, $unit_id)
    {
        $request->validate([
            'apartment_type' => 'required',
        ]);
        $unit_data = FloorUnitMap::find($unit_id);
        if ($unit_data) {
            $unit_data->apartment_id = $request->apartment_type;
            $unit_data->save();
            // if ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
            return redirect(url('/surveyor/property/unit_details/' . $unit_id));
            // }
        }
    }

    // edit unit details
    public function editUnitDetails($unit_id, $residential_type = null)
    {

        if (isset($residential_type) && ($residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') || $residential_type == config('constants.GATED_COMMUNITY_PLOT_LAND'))) {
            $unit_data = Tower::find($unit_id);
        } else {
            $unit_data = FloorUnitMap::find($unit_id);
        }
        $property = Property::find($unit_data->property_id);
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
        //Amenity
        $amenities = UnitAmenityOption::where('parent_id', 20)->get();
        $location_advantages = UnitAmenityOption::where('parent_id', 21)->get();
        $Society_features = UnitAmenityOption::where('parent_id', 29)->get();
        $additional_features = UnitAmenityOption::where('parent_id', '30')->get();
        $other_features = UnitAmenityOption::where('parent_id', '31')->get();
        $water_source = UnitAmenityOption::where('parent_id', '32')->get();
        $overlooking = UnitAmenityOption::where('parent_id', '33')->get();
        $power_backup = UnitAmenityOption::where('parent_id', '34')->get();
        $flooring_type = FloorType::get();
        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();

        // saved data
        $textOptions = [];
        $chechkOptions = [];
        $furnished_option_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 14)
            ->get();
        if (count($furnished_option_values) > 0) {
            foreach ($furnished_option_values as $options) {
                if ($options->value != null) {
                    $textOptions[$options->amenity_option_value_id] = $options->value;
                } elseif ($options->value == null) {
                    $chechkOptions[$options->amenity_option_value_id] = $options->amenity_option_value_id;
                }
            }
        }
        $other_room_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 13)
            ->pluck('amenity_option_id')
            ->toArray();
        $price_details_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 22)
            ->pluck('amenity_option_id')
            ->toArray();
        $rent_details_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 17)
            ->pluck('amenity_option_id')
            ->toArray();
        $security_deposit_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 18)
            ->pluck('amenity_option_id')
            ->toArray();
        $galleryImages = UnitImage::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('file_type', 'gallery_images')
            ->get();
        $AmenityImages = UnitImage::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('file_type', 'amenity_images')
            ->get();
        $interiorImages = UnitImage::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('file_type', 'interior_images')
            ->get();
        $floorPlanImages = UnitImage::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('file_type', 'floor_plan_images')
            ->get();
        $amenities_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 20)
            ->pluck('amenity_option_id')
            ->toArray();
        $location_advantages_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 21)
            ->pluck('amenity_option_id')
            ->toArray();
        $Society_features_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 29)
            ->pluck('amenity_option_id')
            ->toArray();
        $powerbackup_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 34)
            ->pluck('amenity_option_id')
            ->toArray();
        $additional_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 30)
            ->pluck('amenity_option_id')
            ->toArray();
        $other_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 31)
            ->pluck('amenity_option_id')
            ->toArray();
        $water_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 32)
            ->pluck('amenity_option_id')
            ->toArray();
        $overlooking_values = UnitAmenityOptionValue::where('property_id', $unit_data->property_id)
            ->where('unit_id', $unit_id)
            ->where('amenity_id', 33)
            ->pluck('amenity_option_id')
            ->toArray();

        if ($property->cat_id == config('constants.COMMERCIAL') && ($unit_data->unit_type_id == config('constants.VACANT') || $unit_data->unit_type_id == config('constants.OCCUPIED')) && $unit_data->unit_cat_id == config('constants.DEFAULT')) {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
            //Amenities

            return view('admin.pages.property.units.vacant-screen', get_defined_vars());
        } elseif ($property->cat_id == config('constants.COMMERCIAL') && ($unit_data->unit_type_id == config('constants.VACANT') || $unit_data->unit_type_id == config('constants.OCCUPIED')) && $unit_data->unit_cat_id == config('constants.OFFICE')) {
            //mrunal (office)
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $pantries = UnitAmenityOption::where('parent_id', 1)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
            $receptions = UnitAmenityOption::where('parent_id', 3)->get();
            //Facilities Available
            $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
            $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
            $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
            $UPS = UnitAmenityOption::where('parent_id', 7)->get();
            $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
            $lifts = UnitAmenityOption::where('parent_id', 9)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            //Amenities
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                // stored data
                $fire_safety_values = FireSafteyMeasureMap::where('unit_id', $unit_id)
                    ->pluck('child_id')
                    ->toArray();

                return view('admin.pages.property.units.edits.commercial-office-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 109) {
            //aparanjith (hospitality)--done
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_props = UnitAmenityOption::where('parent_id', 11)->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.edits.hospitality-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.hospitality', get_defined_vars());
            }
        }
        // for Resedential Units
        elseif ($property->cat_id == 2) {
            if ($property->residential_type == 7 && $property->residential_sub_type == 9) {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                if ($unit_data->apartment_id == 3) {
                    //onerk -- done
                    $secondary_level_unit_data = $onerkdata = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($onerkdata) {
                        return view('admin.pages.property.units.edits.1rk-edit', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        return view('admin.pages.property.units.edits.serviced-apartments-edit', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                }
            } else {
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                    ->where('unit_id', $unit_id)
                    ->first();
                if ($secondary_level_unit_data) {
                    if (($property->residential_type == 7 && $property->residential_sub_type == 10) || ($property->residential_type == 8 && $property->residential_sub_type == 12)) {
                        return view('admin.pages.property.units.edits.gated-community-edit', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.edits.serviced-apartments-edit', get_defined_vars());
                    }
                } else {
                    if (($property->residential_type == 7 && $property->residential_sub_type == 10) || ($property->residential_type == 8 && $property->residential_sub_type == 12)) {
                        return view('admin.pages.property.units.gated-community', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                }
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 104) {
            //for Commercial Retail
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units2 = Unit::whereIn('id', ['1', '2'])->get();
            //Amenities
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.edits.commercial-retail-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.retail_commercial', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 150) {
            //for storage/indusrty
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();

            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.edits.commercial-storage-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.storage', get_defined_vars());
            }
        } elseif ($property->cat_id == 1 && ($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 151) {
            //for other commercial
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                return view('admin.pages.property.units.edits.other-commercial-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }
        // for multiland
        elseif ($property->cat_id == 3) {
            if ($unit_data->unit_cat_type_id == 1) {
                // commercial
                if (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id == 0) {
                    $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                    $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                    $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                    $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                    $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                    //Facilities Available
                    $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                    $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                    $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                    $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                    $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                    $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                    $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                    $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                    $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                    $sub_category = FloorUnitCategory::where('parent_id', '2')->get();
                    //Amenities
                    $unit_categories = FloorUnitCategory::where('category_code', 1)
                        ->select(['id', 'name', 'field_type'])
                        ->get();
                    return view('admin.pages.property.units.vacant-screen', get_defined_vars());
                } elseif (($unit_data->unit_type_id == 2 || $unit_data->unit_type_id == 1) && $unit_data->unit_cat_id != 0) {
                    if ($unit_data->unit_cat_id == 102) {
                        //mrunal (office)
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $pantries = UnitAmenityOption::where('parent_id', 1)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $conf_rooms = UnitAmenityOption::where('parent_id', 2)->get();
                        $receptions = UnitAmenityOption::where('parent_id', 3)->get();
                        //Facilities Available
                        $furnishing = UnitAmenityOption::where('parent_id', 4)->get();
                        $central_air_conditions = UnitAmenityOption::where('parent_id', 5)->get();
                        $oxygen_dust = UnitAmenityOption::where('parent_id', 6)->get();
                        $UPS = UnitAmenityOption::where('parent_id', 7)->get();
                        $fire_safety_masures = UnitAmenityOption::where('parent_id', 8)->get();
                        $lifts = UnitAmenityOption::where('parent_id', 9)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                        //Amenities
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            // stored data
                            $fire_safety_values = FireSafteyMeasureMap::where('unit_id', $unit_id)
                                ->pluck('child_id')
                                ->toArray();
                            return view('admin.pages.property.units.edits.commercial-office-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.comm_ofc_unit', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 109) {
                        //aparanjith (hospitality)
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                        $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.edits.hospitality-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.hospitality', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 104) {
                        //for Commercial Retail
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units2 = Unit::whereIn('id', ['1', '2'])->get();
                        //Amenities
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.edits.commercial-retail-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.retail_commercial', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 150) {
                        //for storage/indusrty
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();

                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.edits.commercial-storage-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.storage', get_defined_vars());
                        }
                    } elseif ($unit_data->unit_cat_id == 151) {
                        //for other commercial
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($secondary_level_unit_data) {
                            return view('admin.pages.property.units.edits.other-commercial-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    } else {
                        $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
                        $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                        $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                        $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
                        $office_types = UnitAmenityOption::where('parent_id', 24)->get();
                        $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
                        $located_near = UnitAmenityOption::where('parent_id', 26)->get();
                        $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
                        $units = Unit::whereIn('id', ['3', '4'])->get();
                        $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                            ->where('unit_id', $unit_id)
                            ->first();
                        if ($check_record) {
                            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                                ->where('unit_id', $unit_id)
                                ->first();

                            return view('admin.pages.property.units.edits.other-commercial-edit', get_defined_vars());
                        } else {
                            return view('admin.pages.property.units.other_commercial', get_defined_vars());
                        }
                    }
                }
            }
            if ($unit_data->unit_cat_type_id == 2) {
                // Resedential
                $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
                $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
                $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
                $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
                $age_props = UnitAmenityOption::where('parent_id', 11)->get();
                if ($unit_data->apartment_id == 3) {
                    //onerk -- done
                    $onerkdata = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($onerkdata) {
                        return view('admin.pages.property.units.edits.1rk-edit', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.1rk-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == 1 || $unit_data->apartment_id == 2) {
                    $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                        ->where('unit_id', $unit_id)
                        ->first();
                    if ($secondary_level_unit_data) {
                        return view('admin.pages.property.units.edits.serviced-apartments-edit', get_defined_vars());
                    } else {
                        return view('admin.pages.property.units.serviced-apartments', get_defined_vars());
                    }
                } elseif ($unit_data->apartment_id == null) {
                    $apartment_types = UnitApartmentType::all();
                    return view('admin.pages.property.units.apartment-types', get_defined_vars());
                }
            }
        } elseif ($property->cat_id == config('constants.PLOT_LAND')) {
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $other_rooms = UnitAmenityOption::where('parent_id', 13)->get();
            $furnished_options = UnitAmenityOption::where('parent_id', 14)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_props = UnitAmenityOption::where('parent_id', 11)->get();
            $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($secondary_level_unit_data) {
                if ($property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND')) {
                    return view('admin.pages.property.units.edits.gated-community-edit', get_defined_vars());
                } else {
                    return view('admin.pages.property.units.edits.other-commercial-edit', get_defined_vars());
                }
            } else {
                if ($property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND')) {
                    return view('admin.pages.property.units.gated-community', get_defined_vars());
                } else {
                    return view('admin.pages.property.units.other_commercial', get_defined_vars());
                }
            }
        } else {
            $sub_categories = FloorUnitCategory::where('parent_id', $unit_data->unit_cat_id)->get();
            $property_facings = UnitAmenityOption::where('parent_id', 12)->get();
            $availability_status = UnitAmenityOption::where('parent_id', 10)->get();
            $age_of_property = UnitAmenityOption::where('parent_id', 11)->get();
            $office_types = UnitAmenityOption::where('parent_id', 24)->get();
            $washrooms = UnitAmenityOption::where('parent_id', 25)->get();
            $located_near = UnitAmenityOption::where('parent_id', 26)->get();
            $parking_types = UnitAmenityOption::where('parent_id', 27)->get();
            $units = Unit::whereIn('id', ['3', '4'])->get();
            $check_record = SecondaryUnitLevelData::where('property_id', $unit_data->property_id)
                ->where('unit_id', $unit_id)
                ->first();
            if ($check_record) {
                $secondary_level_unit_data = SecondaryUnitLevelData::where('property_id', $property->id)
                    ->where('unit_id', $unit_id)
                    ->first();

                return view('admin.pages.property.units.edits.other-commercial-edit', get_defined_vars());
            } else {
                return view('admin.pages.property.units.other_commercial', get_defined_vars());
            }
        }
    }
}
