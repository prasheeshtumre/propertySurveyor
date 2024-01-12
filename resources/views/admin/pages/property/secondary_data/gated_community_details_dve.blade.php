<style>

</style>
@extends('admin.layouts.main')
@push('css')
    <link href="{{ asset('assets/css/view-gated-community-details.css') }}?v=98" rel="stylesheet" type="text/css" />
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
                        <div class="row">
                            @if($property->images->count() > 0)
                                <div class="col-md-9 le-pimg-o-body" >
                                    <div class="product d-flex justify-content-center shadow-sm rounded">
                                            @foreach ($property->images->take(1) as $image)
                                                        @php
                                                            $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                                        @endphp
                                                        <a data-fancybox="gallery" class="w-100"
                                                            href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                                            <img 
                                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                                                                src="{{ asset('uploads/property/images/' . $image->file_url) }}"
                                                            @elseif($extension == 'pdf')
                                                                src="{{ asset('assets/images/svg/default-pdf.svg') }}"
                                                            @endif
                                                                class="img-fluid le-pimg">
                                                        </a>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3 ri-pimg-o-body" style="">
                                    <div class="row">
                                        @php 
                                            $ri_img_status = 2;
                                        @endphp
                                        @foreach ($property->images as $key=>$image)
                                            @if ($key > 0 && $key < 3)

                                                <div class="col-md-12 mb-2">
                                                    <div class="product shadow-sm rounded">
                                                        @php
                                                            $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                                            $ri_img_status--;
                                                        @endphp
                                                        <a data-fancybox="gallery"
                                                            href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                                            <img 
                                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                                                                src="{{ asset('uploads/property/images/' . $image->file_url) }}"
                                                            @elseif($extension == 'pdf')
                                                                src="{{ asset('assets/images/svg/default-pdf.svg') }}"
                                                            @endif
                                                                class="img-fluid ri-pimg">
                                                        </a>
                                                        @if($key == 2)
                                                        <div class="InlinePhotoPreview--RightButtons">
                                                            <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0" >
                                                            <span class="mdi mdi-image-multiple text-dark"></span>    
                                                            <span class="text-dark">{{count($property->images)}} photos</span>
                                                            </button>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($ri_img_status != 0)
                                            @foreach (range(1, $ri_img_status) as $index)
                                                <div class="col-md-12 mb-2 ri-empty-img-body">
                                                    <div class="product d-flex justify-content-center shadow-sm rounded">
                                                        <a 
                                                            href="javascript:void;">
                                                            <img 
                                                                src="{{ asset('assets/images/svg/image-na.svg') }}"
                                                                class="img-fluid ri-empty-pimg ri-pimg">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-12">
                                <div class="">
                                    <div class="">
                                        <div class="row ">
                                            @if ($property->up_for_sale == 1 || $property->up_for_rent == 1)
                                                <div class="d-flex mb-2 border-bottom">
                                                        <span class="mdi mdi-circle text-success"></span>
                                                        <span class="mx-1"> FOR
                                                            @if ($property->up_for_sale == 1) SALE @endif
                                                            @if ($property->up_for_rent == 1) 
                                                            @if ($property->up_for_sale == 1) / @endif RENT  @endif
                                                        </span>
                                                </div>
                                            @endif
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="">
                                    <div class="">
                                        <div class="row ">
                                            <div class="keyDetailsList col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="w-50">Latitude</span><strong class="px-1 ">:</strong>  {{ $property->latitude ?? '-' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-50">Longitude</span><strong class="px-1 ">:</strong>  {{ $property->longitude ?? '-' }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="keyDetailsList col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="w-50">GIS ID</span><strong class="px-1">:</strong>  {{ $property->gis_id }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-50">Category of the property</span><strong class="px-1">:</strong>  {{ $property->category->cat_name }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <h2 class="h4 inline-block heading-medium">About this Property</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="">
                                    <div class="">
                                        <div class="row ">
                                            <div class="keyDetailsList col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Category of the property</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->category->cat_name ?? '' }}
                                                    </li>
                                                    @if ($property->plot_land_type == 14)
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Plot Sub Land Type</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->plot_land_sub_type->cat_name ?? '' }}
                                                    </li>
                                                    @else
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Residential Type</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->residential_category->cat_name ?? '' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Residential Sub Type</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->residential_sub_category->cat_name ?? '' }}
                                                    </li>
                                                    @endif
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Project Name</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->project_name ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Builder</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->getBuilderName->name ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Contact No</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->contact_no ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">House No</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->house_no ?? 'N/A' }}
                                                    </li>
                                                    
                                                   
                                                </ul>
                                            </div>
                                            <div class="keyDetailsList col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Plot No</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->plot_no ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Street Name/No/Road No</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->street_details ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Colony/Locality Name</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->locality_name ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Website Address</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->website_address ?? 'N/A' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="w-md-50">Club House Details</span>
                                                        <strong class="px-1 atp-title--seperator">:</strong>  
                                                        {{ $property->club_house_details ?? 'N/A' }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <h2 class="title text heading-medium py-3">Blocks / Floors details for {{ $property->project_name ?? '' }}</h2>
                                
                                <div class="property-group-title ">Blocks</div>
                                <div class="keyDetailsList">
                                    <ul class=" ul-group">
                                        
                                        <li class="row">
                                            @forelse($blocks as $block)
                                                <div class="col-md-4 border-bottom m-2">{{ $block->block_name }}</div>
                                            @empty
                                            @endforelse 
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="property-group-title ">{{ $property->residential_type == 7 ? 'Towers' : 'Units' }}</div>
                                <div class="keyDetailsList row">
                                    
                                    @forelse($blocks as $key=>$block)
                                        <ul class="col-md-6 ul-group">
                                            <strong>{{ $property->residential_type == 7 ? 'Tower' : 'Unit' }} : {{ $block->block_name }}</strong>
                                            <li class="row">
                                                @if ($block->towers->count() > 0)
                                                    @forelse($block->towers->where('no_of_towers','>',0) as $tower)
                                                        @if ($property->residential_type == 7)
                                                            <div class="col-md-4 border-bottom m-2">{{ $tower->tower_name }}</div>
                                                        @else
                                                            <div class="col-md-4 border-bottom m-2"> <a target="_blank"
                                                                    href="{{ route('surveyor.property.unit_details', [$tower->id, $property->residential_type]) }}">{{ $tower->tower_name }}</a>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                @endif

                                            </li>
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
                            <div class="col-sm-12 col-md-12">
                                <h2 class="title text heading-medium py-3">{{ $property->project_name ?? '' }} Status</h2>
                                <div class="scrollbar" id="project-status-log">
                                   
                                    @include(
                                        'admin.pages.property.secondary_data.project_status.index_log',
                                        ['towers' => $tower_log, 'project_status_log', $project_status_log]
                                    )
                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <h2 class="title text heading-medium py-3">{{ $property->project_name ?? '' }} Amenities</h2>
                                <div class="keyDetailsList row">
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
                                            
                                            <ul class="col-md-6 ul-group">
                                                <strong>{{ $propertyAmenity->name }}</strong>
                                                <li class="row ">
                                                    @php $status = false; @endphp
                                                    @forelse($propertyAmenity->options as $option)
                                                        @if ($property->id == $option->pivot->property_id)
                                                            @php $status = true; @endphp
                                                            <div class="col-md-6 "><span class="mdi mdi-circle-small mdi-18px px-1"></span>{{ $option->name ?? '' }}</div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    
                                                </li> 
                                            </ul>
                                        @endif
                                    @empty
                                    @endforelse
                                </div> 
                            </div>
                            <div class="col-sm-12 col-md-12 " >
                                <h2 class="title text heading-medium py-3 ">Compliances for {{ $property->project_name ?? '' }}</h2>
                                <div class="row">
                                        @include(
                                            'admin.pages.property.secondary_data.compliances.media_files',
                                            [
                                                'compliances' => $compliances,
                                                'default_pdf_icon' => $default_pdf_icon,
                                                'files' => $files,
                                                'file_name' => $file_name,
                                            ]
                                        )
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <h2 class="title text heading-medium py-3">Repositories for {{ $property->project_name ?? '' }}</h2>
                                  
                                @include(
                                        'admin.pages.property.secondary_data.repositories.media_files',
                                        get_defined_vars())
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <h2 class="title text heading-medium py-3"> {{ $property->project_name ?? '' }} Price Trends</h2>
                                @include(
                                        'admin.pages.property.secondary_data.price_trends.price_trends_paginate',
                                        get_defined_vars())
                                        
                            </div>

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
    <script>
       
       function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= $(window).height() &&
                rect.right <= $(window).width()
            );
        }

        // Function to handle the scroll event
        function handleScroll() {
            var targetElement = $('#compliance-media-files');

            if (isElementInViewport(targetElement[0])) {
                // The target element is visible on scroll
                alert()
                targetElement.show();
                // You can add any other actions you want to perform here
            } else {
                // The target element is not visible on scroll
                targetElement.hide();
                // You can add any other actions you want to perform here
            }
        }

        // Add a scroll event listener to the window using jQuery
        $(window).on('scroll', handleScroll);

    </script>
@endpush
