<style>
    .addpuls {
        background: #662e93;
        padding: 2px 6px;
        border-radius: 3px;
        color: white;
        font-size: 14px;
        margin-left: 5px;
    }

    .brder_round .row {
        border: 1px solid #000;
        border-radius: 3px;
        margin: 10px 0px;
        padding: 15px 0px;
    }

    span.remove-storey,
    span.remove-storey-unit {
        position: absolute;
        top: 2.5%;
        left: 96.5%;
        width: 20px;
        cursor: pointer;
    }

    .brder_round {
        position: relative;
    }

    .btn-save {
        background-color: #f06548 !important;
        color: white !important;
    }

    .nav-pills .nav-link:hover {
        background: #662e93;
        color: white;
    }

    .project-head {
        font-size: 14px;
        font-weight: 600;
        color: #662e93;
        margin-left: 5px;
    }

    .add-floor,
    #create_property_btn {
        display: none !important;
    }

    .card-img-top {
        max-height: 220px !important;
        object-fit: cover;
    }

    .block-items {
        margin: 0;
        padding: 0;
        margin-bottom: 30px;
    }

    .block-items li {
        float: left;
        padding: 6px;
        width: auto;
        background: #D5A5FC;
        list-style: none;
        border-radius: 6px;
        margin-right: 10px;
        color: #000;
        text-align: center;
    }

    .block-items li:last-child {
        margin-right: 0px;
    }

    .tower-title {
        background: #662E93;
        color: #fff;
        padding: 14px;
        border-radius: 6px;
    }
</style>
@extends('admin.layouts.main')
@push('css')
    <link href="{{ asset('assets/css/gated-community-details.css') }}?v=2366" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">View Gated Community Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <!--APARTMENT Category-->
                    <div class="card" style="">
                        <div class="card-body ">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <div>
                                        <label for="" class="form-label"> GIS ID :
                                            {{ $property->gis_id ?? '' }}</label>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div>
                                        <a class="btn btn-sm btn-success"
                                            href="{{ url('surveyor/property/gated-community-details/edit/' . $property->id) }}">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card " id="add_gated_community_details">
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true"><i
                                            class="bi bi-clipboard-check-fill"></i> General details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Blocks / Floors</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-property-status-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-property-status" type="button" role="tab"
                                        aria-controls="pills-property-status" aria-selected="false">Property Status</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-amenities-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-amenities" type="button" role="tab"
                                        aria-controls="pills-amenities" aria-selected="false">Ameneties</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-compliances-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-compliances" type="button" role="tab"
                                        aria-controls="pills-compliances" aria-selected="false">Compliances</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-reposotories-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-reposotories" type="button" role="tab"
                                        aria-controls="pills-reposotories" aria-selected="false">Repositories</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-price-trends-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-price-trends" type="button" role="tab"
                                        aria-controls="pills-price-trends" aria-selected="false">Price Trends</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <input type="hidden" id="property_id" value="{{ $property->id }}">
                                <input type="hidden" id="gis_id" value="{{ $property->gis_id }}">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div id="defined_gis_block">
                                        <div class="row residential-apartment-gated-community residential-fields-child">
                                            <div
                                                class="row residential-apartment-gated-community residential-fields-child">
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Category of the
                                                            property</label>
                                                        <input type="text" class="form-control" id=""
                                                            readonly disabled
                                                            value="{{ $property->category->cat_name ?? '' }}">
                                                    </div>
                                                </div>
                                                @if ($property->plot_land_type == 14)
                                                    <div class="col-xxl-3 col-md-3 mt-3">
                                                        <div>
                                                            <label for="" class="form-label">Plot Sub Land
                                                                Type</label>
                                                            <input type="text" class="form-control" id=""
                                                                readonly disabled
                                                                value="{{ $property->plot_land_sub_type->cat_name ?? '' }}">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-xxl-3 col-md-3 mt-3">
                                                        <div>
                                                            <label for="" class="form-label">Residential
                                                                Type</label>
                                                            <input type="text" class="form-control" id=""
                                                                readonly disabled
                                                                value="{{ $property->residential_category->cat_name ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-3 mt-3">
                                                        <div>
                                                            <label for="" class="form-label">Residential Sub
                                                                Type</label>
                                                            <input type="text" class="form-control" id=""
                                                                readonly disabled
                                                                value="{{ $property->residential_sub_category->cat_name ?? '' }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Project Name</label>
                                                        <input type="text" name="project_name" class="form-control"
                                                            id="" readonly disabled
                                                            value="{{ $property->project_name ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <label for="" class="form-label"> Builder </label>
                                                    <input type="text" name="builder_name" class="form-control"
                                                        id="" readonly disabled
                                                        value="{{ $property->getBuilderName->name ?? '' }}">
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Contact No</label>
                                                        <input type="text" name="contact_no" class="form-control"
                                                            id="" readonly disabled
                                                            value="{{ $property->contact_no ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">House No</label>
                                                        <input type="text" name="house_no" class="form-control"
                                                            id="" readonly disabled
                                                            value="{{ $property->house_no ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Plot No</label>
                                                        <input type="text" name="plot_no" class="form-control"
                                                            id="" readonly disabled
                                                            value="{{ $property->plot_no ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Street Name/No/Road No
                                                        </label>
                                                        <input type="text" name="street_name"
                                                            class="form-control ctfd-required" id="" readonly
                                                            disabled value="{{ $property->street_details ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Colony/Locality
                                                            Name</label>
                                                        <input type="text" name="locality_name"
                                                            class="form-control ctfd-required" id="" readonly
                                                            disabled value="{{ $property->locality_name ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Website Address</label>
                                                        <input type="text" name="website_address" class="form-control"
                                                            id="" readonly disabled
                                                            value="{{ $property->website_address ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-md-3 mt-3">
                                                    <div>
                                                        <label for="" class="form-label">Club House
                                                            Details</label>
                                                        <input type="text" name="club_house_details"
                                                            class="form-control" id="" readonly disabled
                                                            value="{{ $property->club_house_details ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <!--Add Blocks/Floors Tab-->
                                    <div id="defined_block_tab">
                                        <div class="row border-bottom pt-3 pb-3">
                                            <div class="col-md-4">
                                                <p><b>Project Name : </b> <span class="project-head">
                                                        {{ $property->project_name ?? '' }}</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><b>Builder Name : </b> <span
                                                        class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><b>Address : </b> <span class="project-head">
                                                        {{ $property->locality_name ?? '' }} </span></p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Blocks
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            {{-- <div id="add_view_block"> --}}
                                                            <ul class="block-items">
                                                                @forelse($blocks as $block)
                                                                    <li> {{ $block->block_name }}</li>
                                                                @empty
                                                                @endforelse
                                                            </ul>
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            {{ $property->residential_type == 7 ? 'Towers' : 'Units' }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div id="add_view_tower">
                                                                @forelse($blocks as $key=>$block)
                                                                    <p class="tower-title mb-2">
                                                                        <b>{{ $block->block_name }}</b>
                                                                    </p>

                                                                    <ul class="block-items clearfix">
                                                                        @if ($block->towers->count() > 0)
                                                                            @forelse($block->towers->where('no_of_towers','>',0) as $tower)
                                                                                @if ($property->residential_type == 7)
                                                                                    <li>{{ $tower->tower_name }}</li>
                                                                                @else
                                                                                    <li> <a target="_blank"
                                                                                            href="{{ route('surveyor.property.unit_details', [$tower->id, $property->residential_type]) }}">{{ $tower->tower_name }}</a>
                                                                                    </li>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                        @endif

                                                                    </ul>
                                                                @empty

                                                                    @if ($towers->count() > 0)
                                                                        <ul class="block-items clearfix">
                                                                            @forelse($towers as $tower_key => $tower)
                                                                                @if ($tower->no_of_towers > 0)
                                                                                    <li>{{ $tower->tower_name }}</li>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                            <ul class="block-items clearfix">
                                                                    @endif
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($property->residential_type == 7)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="floors-tab">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                aria-expanded="false" aria-controls="collapseThree">
                                                                Floors
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                            aria-labelledby="floors-tab"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body  p-0  ">
                                                                <div class="card-body primary-block">
                                                                    <div id="add_view_floor">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-property-status" role="tabpanel"
                                    aria-labelledby="pills-property-status-tab">
                                    <!--Add Blocks/Floors Tab-->
                                    <div class="row border-bottom pt-3 pb-3">
                                        <div class="col-md-4">
                                            <p><b>Project Name : </b> <span class="project-head">
                                                    {{ $property->project_name ?? '' }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Builder Name : </b> <span
                                                    class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Address : </b> <span class="project-head">
                                                    {{ $property->locality_name ?? '' }} </span></p>
                                        </div>
                                    </div>
                                    <div class="row residential-apartment-gated-community residential-fields-child">
                                        @include(
                                            'admin.pages.property.secondary_data.project_status.index_log',
                                            ['towers' => $tower_log, 'project_status_log', $project_status_log]
                                        )
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-amenities" role="tabpanel"
                                    aria-labelledby="pills-amenities-tab">
                                    <div class="row border-bottom pt-3 pb-3">
                                        <div class="col-md-4">
                                            <p><b>Project Name : </b> <span class="project-head">
                                                    {{ $property->project_name ?? '' }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Builder Name : </b> <span
                                                    class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Address : </b> <span class="project-head">
                                                    {{ $property->locality_name ?? '' }} </span></p>
                                        </div>
                                    </div>
                                    <div id="amenities_defined_block_tab">
                                        @forelse($propertyAmenities as $propertyAmenity)
                                            @php
                                                $amenity_status = 0;
                                            @endphp
                                            @foreach ($propertyAmenity->options as $option)
                                                @if ($property->id == $option->pivot->property_id)
                                                    @php
                                                        $amenity_status++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($amenity_status > 0)
                                                <label
                                                    class="form-label small-heading h5"><strong>{{ $propertyAmenity->name }}</strong>
                                                </label>
                                                <div class="row align-items-center mb-2">
                                                    @php $status = false; @endphp
                                                    @forelse($propertyAmenity->options as $option)
                                                        @if ($property->id == $option->pivot->property_id)
                                                            @php $status = true; @endphp
                                                            <div class="col-md-3 simplecheck mb-3">
                                                                <span>{{ $option->name }}</span>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    {{-- @if ($status == false)
                                                    <div class="col-md-3 simplecheck mb-3">
                                                        <span></span>
                                                    </div>
                                                @endif --}}
                                                </div>
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <!-- amenities -->
                                        <div class="text-end">
                                            <!-- <input type="submit" class="btn btn-md btn-primary" value="Save &amp; Procced"> -->
                                            <!--<button class="btn btn-md btn-save">Save </button>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-compliances" role="tabpanel"
                                    aria-labelledby="pills-compliances-tab">
                                    <div class="row border-bottom pt-3 pb-3">
                                        <div class="col-md-4">
                                            <p><b>Project Name : </b> <span class="project-head">
                                                    {{ $property->project_name ?? '' }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Builder Name : </b> <span
                                                    class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Address : </b> <span class="project-head">
                                                    {{ $property->locality_name ?? '' }} </span></p>
                                        </div>
                                    </div>
                                    <div id="complainces_defined_tab_content" class="m-2 row">
                                        @include(
                                            'admin.pages.property.secondary_data.compliances.view_index',
                                            [
                                                'compliances' => $compliances,
                                                'default_pdf_icon' => $default_pdf_icon,
                                                'files' => $files,
                                                'file_name' => $file_name,
                                            ]
                                        )
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-reposotories" role="tabpanel"
                                    aria-labelledby="pills-reposotories-tab">
                                    <div class="row border-bottom pt-3 pb-3">
                                        <div class="col-md-4">
                                            <p><b>Project Name : </b> <span class="project-head">
                                                    {{ $property->project_name ?? '' }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Builder Name : </b> <span
                                                    class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Address : </b> <span class="project-head">
                                                    {{ $property->locality_name ?? '' }} </span></p>
                                        </div>
                                    </div>
                                    @include(
                                        'admin.pages.property.secondary_data.repositories.view_index',
                                        get_defined_vars())
                                </div>
                                <div class="tab-pane fade" id="pills-price-trends" role="tabpanel"
                                    aria-labelledby="pills-price-trends-tab">
                                    <div class="row border-bottom pt-3 pb-3">
                                        <div class="col-md-4">
                                            <p><b>Project Name : </b> <span class="project-head">
                                                    {{ $property->project_name ?? '' }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Builder Name : </b> <span
                                                    class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Address : </b> <span class="project-head">
                                                    {{ $property->locality_name ?? '' }} </span></p>
                                        </div>
                                    </div>                                  
                                    @include(
                                        'admin.pages.property.secondary_data.price_trends.price_trends_paginate',
                                        get_defined_vars())
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        $(document).on('click', '#floors-tab', function(e) {
            // toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            let gisId = $("#gis_id").val();
            $.ajax({
                type: "GET",
                url: "{{ route('floors.index') }}",
                data: {
                    property_id: property_id,
                    gis_id: gisId,
                    page_type: 'view'
                },
                success: function(response) {
                    if (response.status === false) {
                        // toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#add_view_floor').empty();
                    } else {
                        let propertyId = property_id;
                        $('#property_id').val(propertyId);
                        // $('.sd-floor-fields').html(response);
                        $('#add_view_floor').html(response.floor_view);
                        $('#blocks').empty();
                        if (response.blocks.length == 0) {
                            $('#blocks').parent().parent().addClass('d-none');
                            $('#blocks').removeClass('ctfd-required');
                            $("#blocks").append('<option selected disabled >--Select Block--</option>');
                            if (response.towers.length > 0) {
                                // $("#towers").append('<option selected disabled >--Select Tower--</option>');
                                $.each(response.towers, function(key, value) {
                                    $('#towers').append($("<option/>", {
                                        value: value.id,
                                        text: value.tower_name
                                    }));
                                });
                            }
                        }
                        if (response.blocks.length > 0) {
                            $('#blocks').parent().parent().removeClass('d-none');
                            $('#blocks').addClass('ctfd-required');
                            $("#blocks").append('<option selected disabled >--Select Block--</option>');
                            $.each(response.blocks, function(key, value) {
                                $('#blocks').append($("<option/>", {
                                    value: value.id,
                                    text: value.block_name
                                }));
                            });
                        }
                    }
                }
            });
        });
        $(document).on('change', '#blocks', function(e) {
            let blockId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ url('get_block_towers') }}",
                data: {
                    block_id: blockId
                },
                success: function(response) {
                    $('#towers').empty();
                    $('.storey').remove();
                    $('.storey-unit').remove();
                    $('.unit-container').remove();
                    if (response.towers.length == 0) {
                        $("#towers").append('<option selected disabled >--Select Tower--</option>');
                    }
                    if (response.towers) {
                        $("#towers").append('<option selected disabled >--Select Tower--</option>');
                        $.each(response.towers, function(key, value) {
                            $('#towers').append($("<option/>", {
                                value: value.id,
                                text: value.tower_name
                            }));
                        });
                    }
                }
            });
        });
        $(document).on('change', '#towers', function(e) {
            $('.storey').remove();
            $('.storey-unit').remove();
            $('.unit-container').remove();
            let propertyId = $('#property_id').val();
            let floors = getPropertyFloors(propertyId)
            $(floors).insertAfter(".append-floors");
            // enableFloorsRemoveAction()
        });

        function getPropertyFloors(property_id) {
            var temp_floors = null;
            let c_id = $('#category').val();
            let blockId = $('#blocks').val();
            let towerId = $('#towers').val();
            // alert('tower id : ' +""+ towerId)
            $.ajax({
                type: "GET",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('get_edit_secondary_data_floors') }}",
                data: {
                    c_id: c_id,
                    property_id: property_id,
                    block_id: blockId,
                    tower_id: towerId,
                    page_type: 'view'
                },
                success: function(response) {
                    temp_floors = response;
                }
            });
            return temp_floors;
        }
    </script>
@endpush
