<div class="col-12 unit-main-title">
    @if (
        $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.OFFICE') &&
            ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
                $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
        <h4 class="mb-sm-0">View Office Details</h4>
    @elseif(
        $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.RETAIL') &&
            ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
                $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
        <h4 class="mb-sm-0">View Retail Details</h4>
    @elseif(
        $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.STORAGE_INDUSTRY') &&
            ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
                $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
        <h4 class="mb-sm-0">View Storage/Indusrty Details</h4>
    @elseif(
        $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.OTHER_COMMERCIAL') &&
            ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
                $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
        <h4 class="mb-sm-0">View Other Commercial Details</h4>
    @elseif(
        $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.HOSPITALITY_HOTEL') &&
            ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
                $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
        <h4 class="mb-sm-0">View Hospitality Details</h4>
    @elseif(
        $property->cat_id == config('constants.PLOT_LAND') &&
            $property->plot_land_type == config('constants.OPEN_PLOT_LAND'))
        <h4 class="mb-sm-0">View Plot/Land Details</h4>
    @elseif(
        $property->cat_id == config('constants.PLOT_LAND') &&
            $property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND'))
        <h4 class="mb-sm-0">View Villa Details</h4>
    @elseif(
        $property->cat_id == config('constants.RESIDENTIAL') &&
            $property->residential_type == config('constants.APARTMENT') &&
            $property->residential_sub_type == config('constants.STAND_ALONE_APARTMENT') &&
            $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.STAND_ALONE_APARTMENT'))
        <h4 class="mb-sm-0">View Stand Alone Apartment Details</h4>
    @elseif(
        $property->cat_id == config('constants.RESIDENTIAL') &&
            $property->residential_type == config('constants.APARTMENT') &&
            $property->residential_sub_type == config('constants.STAND_ALONE_APARTMENT') &&
            $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.SERVICED_APARTMENT'))
        <h4 class="mb-sm-0">View Serviced Apartments Details</h4>
    @elseif(
        $property->cat_id == config('constants.RESIDENTIAL') &&
            $property->residential_type == config('constants.APARTMENT') &&
            $property->residential_sub_type == config('constants.GATED_COMMUNITY_APARTMENT'))
        <h4 class="mb-sm-0">View Apartment Details</h4>
    @elseif(
        $property->cat_id == config('constants.RESIDENTIAL') &&
            $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
            $property->residential_sub_type == config('constants.GATED_COMMUNITY_VILLA'))
        <h4 class="mb-sm-0">View Villa Details</h4>
    @elseif($secondary_level_unit_data->property_cat_id == config('constants.DEMOLISHED'))
        <h4 class="mb-sm-0">View Demolished Details</h4>
    @elseif(
        ($secondary_level_unit_data->property_cat_id == config('constants.RESIDENTIAL') ||
            $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')) &&
            $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.ONE_RK_APARTMENT'))
        <h4 class="mb-sm-0">View 1 RK Details</h4>
    @elseif(
        $property->cat_id == config('constants.RESIDENTIAL') &&
            $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
            $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
        <h4 class="mb-sm-0">View Individual House Details</h4>
    @elseif(
        $property->cat_id == config('constants.MULTI_UNIT') &&
            $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.STAND_ALONE_APARTMENT'))
        <h4 class="mb-sm-0">View Stand Alone Apartment Details</h4>
    @elseif(
        $property->cat_id == config('constants.MULTI_UNIT') &&
            $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.SERVICED_APARTMENT'))
        <h4 class="mb-sm-0">View Serviced Apartment Details</h4>
    @else
        <h4 class="mb-sm-0">View {{ $unit_data->categoryName->title ?? 'Other' }} Details </h4>
    @endif

</div>
