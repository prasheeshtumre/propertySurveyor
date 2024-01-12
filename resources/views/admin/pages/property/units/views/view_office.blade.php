@extends('admin.layouts.main')
@section('content')
@php use App\Models\SecondaryUnitLevelData; @endphp
<link href="{{ asset('assets/css/view-units.css?v=852963') }}" rel="stylesheet" type="text/css" />
<style>
    p {

        margin-bottom: 0px;

    }

    .count-list,
    .check-list {
        margin: 0;
        padding: 0;
        width: 100%
    }

    .count-list li {
        list-style: none;
        float: left;
        padding: 14px;
        border: 1px solid #ddd;
        border-radius: 100px;
        margin: 5px;
        height: 36px;
        width: 36px;
        text-align: center;
        line-height: 10px;
        transition: 0.3s
    }

    .count-list li:hover {
        background: #f7ecff;
        border: solid 1px #000;
        transition: 0.3s;
        cursor: pointer;
    }

    .count-list li.active {
        background: #f7ecff;
        border: solid 1px #662e93;
        transition: 0.3s;
        color: #662e93
    }



    .check-list li {
        list-style: none;
        float: left;
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 100px;
        margin: 5px;
        text-align: center;
        line-height: 10px;
        transition: 0.3s
    }

    .check-list li:hover {
        background: #f7ecff;
        border: solid 1px #000;
        transition: 0.3s;
        cursor: pointer;
    }

    .check-list li.active {
        background: #f7ecff;
        border: solid 1px #662e93;
        transition: 0.3s;
        color: #662e93
    }


    .btn-primary {
        background: #662e93 !important;
        border: solid 1px #662e93;
    }



    .form-label {
        position: relative;
    }

    .required::after {
        content: '*';
        color: red;
        position: absolute;
        right: -10px;
    }

    .box-bdr {
        border: solid 1px #ddd;
        padding: 0px;
        border-radius: 6px;
    }

    .form-control-b0 {
        border: none !important;
    }

    .form-control,

    .form-select {
        /*            min-height: 50px*/
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-menu span {
        line-height: 24px;
        display: flex
    }

    input[type=checkbox] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }

    .input-step.step-primary button {
        background: #f7ecff;
        border: solid 1px #662e93;
        color: #662e93
    }

    .simplecheck span {
        line-height: 24px;
        display: flex
    }

    .screen {
        display: none;
    }

    .visible {
        display: block;
    }


    /*.progress-bar {*/
    /*  transition: width 0.3s ease-in-out;*/
    /*}*/
    .progress-bar {
        background-color: #deedf6 !important;
        color: black !important;
    }

    .progress-bar1 {
        background-color: #299cdb !important;
        color: white !important;
    }

    .progress-bar.active {

        background-color: #299cdb !important;
        color: white !important;
    }

    .progress-info .progress-bar::after {
        border-left-color: #7ed1ff !important;
    }
</style>
@php $default_img = asset('assets/images/svg/alt-property-img.svg'); @endphp
<div class="page-content">
    <div class="container-fluid pm-0 card">
        <!-- start page title -->
        <div class="row">
            {{-- unit view title --}}
            @include('admin.pages.property.units.views.includes.unit_view_title')
        </div>
        <!-- end page title -->
        <div class="">
            <div class="card-body">
                @php
                $defaultVideoIcon = asset('assets/images/svg/default-mp4.svg');
                @endphp
                @if(in_array($property->cat_id, [1,2,3,5] ))
                <div class="row">
                    <div class="col-md-9 le-pimg-o-body">
                        <div class="product d-flex justify-content-center shadow-sm rounded">
                            @forelse($secondary_level_unit_data->image_gallery as $rec)
                            @if ($rec->file_type == 'gallery_images')
                            <a data-fancybox="gallery" class="w-100 @if ($loop->iteration > 1) d-none @endif " href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" class="img-fluid le-pimg">
                            </a>
                            @endif
                            @empty
                            <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                            </a>
                            @endforelse
                            <div class="InlinePhotoPreview--LeftButtons">
                                <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                    <span class="mdi mdi-image-multiple text-dark"></span>
                                    <span class="text-dark">Gallery Images</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ri-pimg-o-body ri-pimg-v-scroll">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    @forelse($secondary_level_unit_data->amenity_images as $rec)
                                    @if ($rec->file_type == 'amenity_images')
                                    <a data-fancybox="amenity_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif

                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Amenity Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    @forelse($secondary_level_unit_data->interior_images as $rec)
                                    @if ($rec->file_type == 'interior_images')
                                    <a data-fancybox="interior_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif
                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Interior Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">

                                    @forelse($secondary_level_unit_data->floor_plan_images as $rec)
                                    @if ($rec->file_type == 'floor_plan_images')
                                    @php
                                    $extension = pathinfo($rec->file_path . '/' . $rec->file_name, PATHINFO_EXTENSION);
                                    @endphp
                                    <a data-fancybox="floor_plan_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img @if (in_array($extension, ['jpg', 'jpeg' , 'png' , 'gif' ], true)) src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" @elseif($extension=='pdf' ) src="{{ asset('assets/images/svg/default-pdf.svg') }}" @endif onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif
                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Floor Plan Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">

                                    @forelse($secondary_level_unit_data->unit_videos as $rec)
                                    @php
                                    $extension = pathinfo($rec->file_path . '/' . $rec->file_name, PATHINFO_EXTENSION);
                                    @endphp
                                    <a data-fancybox="unit_videos" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ $defaultVideoIcon  ?? '' }}" class="img-fluid ri-pimg">
                                    </a>
                                    @empty
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Unit Videos</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($property->cat_id == 6)
                <div class="row">
                    <div class="col-md-12 le-pimg-o-body">
                        <div class="product d-flex justify-content-center shadow-sm rounded">
                            @forelse($secondary_level_unit_data->demolished_images as $rec)
                            @if ($rec->file_type == 'demolished')
                            <a data-fancybox="gallery" class="w-100 @if ($loop->iteration > 1) d-none @endif " href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" class="img-fluid le-pimg">
                            </a>
                            @endif
                            @empty
                            <a data-fancybox="demolished_images" class="" href="{{ $default_img }}">
                                <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                            </a>
                            @endforelse
                            <div class="InlinePhotoPreview--LeftButtons">
                                <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                    <span class="mdi mdi-image-multiple text-dark"></span>
                                    <span class="text-dark">Images</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @elseif($property->cat_id == 4 && $property->plot_land_type == 13)
                <div class="row">
                    <div class="col-md-12 le-pimg-o-body">
                        <div class="product d-flex justify-content-center shadow-sm rounded">
                            @forelse($secondary_level_unit_data->open_plot_land_images as $rec)
                            @if ($rec->file_type == 'gallery_images')
                            <a data-fancybox="gallery" class="w-100 @if ($loop->iteration > 1) d-none @endif " href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" class="img-fluid le-pimg">
                            </a>
                            @endif
                            @empty
                            <a data-fancybox="gallery_images" class="" href="{{ $default_img }}">
                                <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                            </a>
                            @endforelse
                            <div class="InlinePhotoPreview--LeftButtons">
                                <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                    <span class="mdi mdi-image-multiple text-dark"></span>
                                    <span class="text-dark">Images</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @elseif($property->cat_id == 4 && $property->plot_land_type == 14)
                <div class="row">
                    <div class="col-md-9 le-pimg-o-body">
                        <div class="product d-flex justify-content-center shadow-sm rounded">
                            @forelse($secondary_level_unit_data->image_gallery as $rec)
                            @if ($rec->file_type == 'gallery_images')
                            <a data-fancybox="gallery" class="w-100 @if ($loop->iteration > 1) d-none @endif " href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" class="img-fluid le-pimg">
                            </a>
                            @endif
                            @empty
                            <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                            </a>
                            @endforelse
                            <div class="InlinePhotoPreview--LeftButtons">
                                <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                    <span class="mdi mdi-image-multiple text-dark"></span>
                                    <span class="text-dark">Gallery Images</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ri-pimg-o-body ri-pimg-v-scroll">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    @forelse($secondary_level_unit_data->amenity_images as $rec)
                                    @if ($rec->file_type == 'amenity_images')
                                    <a data-fancybox="amenity_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif

                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Amenity Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    @forelse($secondary_level_unit_data->interior_images as $rec)
                                    @if ($rec->file_type == 'interior_images')
                                    <a data-fancybox="interior_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif
                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Interior Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">

                                    @forelse($secondary_level_unit_data->floor_plan_images as $rec)
                                    @if ($rec->file_type == 'floor_plan_images')
                                    @php
                                    $extension = pathinfo($rec->file_path . '/' . $rec->file_name, PATHINFO_EXTENSION);
                                    @endphp
                                    <a data-fancybox="floor_plan_images" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img @if (in_array($extension, ['jpg', 'jpeg' , 'png' , 'gif' ], true)) src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" @elseif($extension=='pdf' ) src="{{ asset('assets/images/svg/default-pdf.svg') }}" @endif onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endif
                                    @empty
                                    <a data-fancybox="amenity_images" class="" href="{{ $default_img }}">
                                        <img src="{{ $default_img }}" onerror="this.onerror=null; this.src='{{ $default_img }}'" class="img-fluid ri-pimg">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Floor Plan Images</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">

                                    @forelse($secondary_level_unit_data->unit_videos as $rec)
                                    @php
                                    $extension = pathinfo($rec->file_path . '/' . $rec->file_name, PATHINFO_EXTENSION);
                                    @endphp
                                    <a data-fancybox="unit_videos" class="@if ($loop->iteration > 1) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                        <img src="{{ $defaultVideoIcon  ?? '' }}" class="img-fluid ri-pimg">
                                    </a>
                                    @empty
                                    <a class="" href="{{ $defaultVideoIcon }}">
                                        <img src="{{ $defaultVideoIcon }}" onerror="this.onerror=null; this.src='{{ $defaultVideoIcon }}'" class="img-fluid ri-pimg" style="filter: grayscale(0.9);">
                                    </a>
                                    @endforelse
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">Unit Videos</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class=" ">
            @include('admin.pages.property.units.views.includes.property_basic_details')
            <hr class="pb-3">
            <h4 class="page-header"><span>Property Details</span></h4>

            @include('admin.pages.property.units.views.includes.unit_property_details')
        </div>

        @if ($secondary_level_unit_data->property_cat_id != '6')
        <hr class="pb-3">
        <h4 class="page-header"><span> Pricing & Other Details</span></h4>
        @include('admin.pages.property.units.views.includes.unit_pricing_other_details')
        @endif


        {{--
                <hr class="mb-3">
                <h4 class="page-header"><span> Add Images</span></h4>
                 @include('admin.pages.property.units.views.includes.unit_image_details') --}}

        @if ($secondary_level_unit_data->property_cat_id == '6')
        <hr class="mb-3">
        <div class="mainDiiv">
            <div class=" ">
                <div class="viewbedroomsText">
                    <div class="widthImage">
                        <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid" style="width:50px;">
                    </div>
                    <hr class="mb-3">
                    <div>
                        <div>
                            <p><strong>Property History</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{ $secondary_level_unit_data->property_history }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" ">
                <div class="viewbedroomsText">
                    <div class="widthImage">
                        <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid" style="width:50px;">
                    </div>
                    <div>
                        <div>
                            <p><strong>Development Potential</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{ $secondary_level_unit_data->development_potential ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- {{ $property->cat_id }} -->

        {{-- @if (
                $property->cat_id != '4' || 
                    ($property->plot_land_type != '13' || $secondary_level_unit_data->property_cat_id != '6'))
                <hr class="mb-3">
                <h4 class="page-header"><span> Ameneties</span></h4>
            @endif --}}

        @if(in_array($property->cat_id, [1,2,3,5] ))
        <hr class="mb-3">
        <h4 class="page-header"><span> Ameneties</span></h4>
        @elseif($property->cat_id == 4 && $property->plot_land_type == 14)
        <hr class="mb-3">
        <h4 class="page-header"><span> Ameneties</span></h4>
        @endif

        @include('admin.pages.property.units.views.includes.unit_amenities_details')

        <div class="card-footer">
            <div class="ms-auto text-end">
                @php
                $sub_type = $property->cat_id == config('constants.RESIDENTIAL') ? $property->residential_type : $property->plot_land_type;
                @endphp
                @if ($property->cat_id == 4 && $property->plot_land_type == 13)
                <a href="{{ url('surveyor/property/plot-land/edit_unit_details/' . $property->id) }}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                @elseif($secondary_level_unit_data->property_cat_id == '6')
                <a href="{{ url('surveyor/property/demolished/edit_unit_details/' . $property->id) }}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                @elseif(
                $property->cat_id == config('constants.RESIDENTIAL') &&
                $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
                $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
                <a href="{{ url('surveyor/property/edit_unit_details/' . $secondary_level_unit_data->unit_id) }}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                @else
                <a href="{{ url('surveyor/property/edit_unit_details/' . $secondary_level_unit_data->unit_id . '/' . $sub_type) }}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- End Page-content -->

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © ProperT.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end  d-sm-block">
                    Design & Develop by <a href="https://vmaxindia.com/">VMAX</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection
@push('scripts')
<script src="{{ url('public/assets/js/property/extra.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".list-single-main-item").slice(0, 4).show();
        $("#loadMore").on("click", function(e) {
            e.preventDefault();
            $(".list-single-main-item:hidden").slice(0, 4).slideDown();
            if ($(".list-single-main-item:hidden").length == 0) {
                $("#loadMore").text("No Content").addClass("noContent");
                $("#loadMore").hide();
                $("#showLess").show();
            }
        });

        $("#showLess").on("click", function(e) {
            e.preventDefault();
            var $visibleItems = $(".list-single-main-item:visible");
            var totalVisibleItems = $visibleItems.length;
            if (totalVisibleItems > 4) {
                $visibleItems.slice(-4).slideUp();
                $("#showLess").hide();
                $("#loadMore").show();
                $("#loadMore").text("Show More")
            } else {
                $visibleItems.slideUp();
                // $("#showLess").hide();
                // $("#loadMore").show();
            }
        });
    })
</script>
@endpush