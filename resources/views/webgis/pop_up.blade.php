<style>
    .tableProperty th,
    td {
        padding: 8px;
        font-size: 14px;
        color: black;
    }

    /*.tableProperty td:nth-child(1) {*/
    /*    font-weight: 600;*/
    /*}*/
    .tableProperty {
        width: 100% !important;
    }

    /*.tableProperty tr:hover:not(:first-child) {*/
    /*    background-color: #d8e7f3;*/
    /*  }*/
    /*.tableProperty tr:nth-child(odd) {*/
    /*    background-color: #e1edff;*/
    /*}*/
    .ol-popup {
        padding: 3px 10px 2px 10px !important;
        bottom: 35px !important;
        left: -50px !important;
    }

    .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: -10px !important;
        right: -10px !important;
        /*background-color: #207dff;*/
        color: #FFF !important;
        border-radius: 50%;
        width: 28px !important;
        height: 28px !important;
        text-align: center;
        padding-top: 5px !important;
        text-decoration: none;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- commercial category --}}

@if ($property->cat_id == config('constants.COMMERCIAL') || $property->cat_id == config('constants.MULTI_UNIT'))
    @include('webgis.includes.modals.commercial')

    {{-- residential apartment category --}}
@elseif (
    $property->cat_id == config('constants.RESIDENTIAL') &&
        ($property->residential_sub_type == config('constants.STAND_ALONE_APARTMENT') ||
            $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT')))
    @include('webgis.includes.modals.residential_apartment')

    {{-- residential Gated category --}}
@elseif (
    ($property->cat_id == config('constants.RESIDENTIAL') || $property->cat_id == config('constants.PLOT_LAND')) &&
        $property->residential_sub_type == config('constants.GATED_COMMUNITY_APARTMENT'))
    @include('webgis.includes.modals.residential_apartment_gated')
@elseif (
    ($property->cat_id == config('constants.RESIDENTIAL') || $property->cat_id == config('constants.PLOT_LAND')) &&
        ($property->residential_sub_type == config('constants.GATED_COMMUNITY_VILLA') ||
            $property->residential_sub_type == config('constants.SEMI_GATED_COMMUNITY') ||
            $property->residential_sub_type == config('constants.GATED_COMMUNITY_PLOT_LAND')))
    @include('webgis.includes.modals.residential_plot_gated')

    {{-- plot land category --}}
@elseif(
    $property->cat_id == config('constants.PLOT_LAND') &&
        $property->plot_land_type == config('constants.OPEN_PLOT_LAND'))
    @include('webgis.includes.modals.open_plot_land')

    {{-- plot land gated community --}}
@elseif(
    $property->cat_id == config('constants.PLOT_LAND') &&
        $property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND'))
    @include('webgis.includes.modals.residential_plot_gated')


    {{-- under construction category --}}
@elseif ($property->cat_id == config('constants.UNDER_CONSTRUCTION'))
    @include('webgis.includes.modals.underconstruction')

    {{-- demolished category --}}
@elseif($property->cat_id == config('constants.DEMOLISHED'))
    @include('webgis.includes.modals.demolished')
@endif
