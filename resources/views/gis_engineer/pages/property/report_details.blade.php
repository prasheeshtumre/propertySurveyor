@extends('admin.layouts.main')
@section('content')
@push('css')
<link href="{{ asset('assets/css/show-property-details.css') }}?v=3456353" rel="stylesheet" type="text/css" />
@endpush
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Report Details </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="row">
                            @if ($property->images->count() > 0)
                            <div class="col-md-9 le-pimg-o-body">
                                <div class="product d-flex justify-content-center shadow-sm rounded">
                                    @foreach ($property->images->take(1) as $image)
                                    @php
                                    $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                    @endphp
                                    <a data-fancybox="gallery" class="w-100" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                        <img @if (in_array($extension, ['jpg', 'jpeg' , 'png' , 'gif' ], true)) src="{{ asset('uploads/property/images/' . $image->file_url) }}" @elseif($extension=='pdf' ) src="{{ asset('assets/images/svg/default-pdf.svg') }}" @endif class="img-fluid le-pimg">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3 ri-pimg-o-body" style="">
                                <div class="row">
                                    @php
                                    $ri_img_status = 2;
                                    @endphp
                                    @foreach ($property->images as $key => $image)
                                    @if ($key > 0 && $key < 3) <div class="col-md-12 mb-2">
                                        <div class="product shadow-sm rounded">
                                            @php
                                            $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                            $ri_img_status--;
                                            @endphp
                                            <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                                <img @if (in_array($extension, ['jpg', 'jpeg' , 'png' , 'gif' ], true)) src="{{ asset('uploads/property/images/' . $image->file_url) }}" @elseif($extension=='pdf' ) src="{{ asset('assets/images/svg/default-pdf.svg') }}" @endif class="img-fluid ri-pimg">
                                            </a>
                                            @if ($key == 2)
                                            <div class="InlinePhotoPreview--RightButtons">
                                                <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                                    <span class="mdi mdi-image-multiple text-dark"></span>
                                                    <span class="text-dark">{{ count($property->images) }}
                                                        photos</span>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                </div>
                                @endif
                                @endforeach
                                @if ($ri_img_status != 0)
                                @foreach (range(1, $ri_img_status) as $index)
                                <div class="col-md-12 mb-2 ri-empty-img-body">
                                    <div class="product d-flex justify-content-center shadow-sm rounded">
                                        <a href="javascript:void;">
                                            <img src="{{ asset('assets/images/svg/image-na.svg') }}" class="img-fluid ri-empty-pimg ri-pimg">
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
                                            @if ($property->up_for_sale == 1)
                                            SALE
                                            @endif
                                            @if ($property->up_for_rent == 1)
                                            @if ($property->up_for_sale == 1)
                                            /
                                            @endif RENT
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                <div class=" ">
                                    @if (count($merges) > 0)
                                    <span class="badge bg-success">This Property Merged with
                                        {{ implode(',', $merges) }} GIS-ID's</span>
                                    @endif
                                    @if ($splits > 0)
                                    <span class="badge bg-success">This Property Split into {{ $splits ?? 0 }}
                                    </span>
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
                                                <span class="w-50">Latitude</span><strong class="px-1 ">:</strong> {{ $property->latitude ?? '-' }}
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-50">Longitude</span><strong class="px-1 ">:</strong> {{ $property->longitude ?? '-' }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-50">GIS ID</span><strong class="px-1">:</strong>
                                                {{ $property->gis_id }}
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-50">Category of the property</span><strong class="px-1">:</strong> {{ $property->category->cat_name }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-50">Surveyor</span><strong class="px-1">:</strong>
                                                {{ $property->surveyor->name ?? 'N/A' }}
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h2 class="h4 inline-block heading-medium">About this Property</h2>
                                </div>

                                <div class="keyDetailsList">
                                    <ul class="list-group list-group-flush">
                                        @include('admin.pages.property.' . $defined_blade, [
                                        'floors' => $floors,
                                        ])
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12  d-none">
                        <label><b>Property Images</b></label>
                        <div class="apart-images">

                            @foreach ($property->images as $key => $image)
                            @if ($key >= 3)
                            @php
                            $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                <img src="{{ asset('uploads/property/images/' . $image->file_url) }}" class="img-fluid">
                            </a>
                            @elseif($extension == 'pdf')
                            <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                <img src="{{ asset('assets/images/svg/default-pdf.svg') }}" class="img-fluid">
                            </a>
                            @endif
                            @endif
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-12  {{ $floor_visible_status ?? '' }}">
                        @include('gis_engineer.pages.property.view_floor', ['floors' => $floors])
                    </div>
                    @if (Auth::user()->hasRole('surveyor'))
                    @if (!empty($property->remarks))
                    <div class="col-sm-12 col-md-12 mt-3">
                        <div class="">
                            <div class="">
                                <div class="">
                                    <h2 class="h4 inline-block heading-medium">Remarks</h2>
                                </div>
                                <p>
                                    {{ $property->remarks ?? '' }}
                                </p>

                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($property->cat_id == 6)
                    <div class="col-xxl-12 col-md-12 mt-3 mb-3">
                        <div class="">
                            <a class="btn btn-outline-primary  me-2" href="{{ url('surveyor/property/demolished/unit_details') }}/{{ $property->id }}">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="mdi mdi-chevron-double-right mdi-18px"></span>
                                    <span class="text-dark">View Unit Details</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if ($property->cat_id == 4 && $property->plot_land_type == 13)
                    <div class="col-xxl-12 col-md-12 mt-3 mb-3">
                        <div class="">
                            <a class="btn btn-outline-primary me-2 p-1" href="{{ url('surveyor/property/plot-land/unit_details') }}/{{ $property->id }}">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="mdi mdi-chevron-double-right mdi-18px"></span>
                                    <span class="text-dark">View Unit Details</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endif



                    <div class="col-md-12 mb-3 mt-3 text-end">
                        <div class="">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Preview the Map

                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-1 pgmap-body" style="">
                                            <div id="map" style="clear:both; height:100%;">
                                                <div id="map"></div>
                                            </div>

                                        </div>
                                        <a class="badge bg-light d-flex justify-content-center" href="https://maps.google.com/?q={{ $property->latitude ?? '-' }},{{ $property->longitude ?? '-' }}">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <span class="mdi mdi-google-maps mdi-18px"></span>
                                                <span class="text-dark">View on Google Map</span>
                                            </div>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--<button class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>-->
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        @if(isset($type ) && $type != 'completed')
                        <a class="btn btn-outline-success me-2 edit-modal-btn p-1" href="{{ route('gis-engineer.property.edit_details', [$property->id]) }}/{{$type ?? ''}}">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="mdi mdi-store-edit-outline mdi-24px px-1"></span>
                                <span class="px-1"> EDIT This Property</span>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>


</div>


<!-- Modal -->
<input type="hidden" id="lat" value="{{ $property->latitude }}">
<input type="hidden" id="long" value="{{ $property->longitude }}">

</div> <!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
@push('scripts')
<script type="text/javascript">
    var map;

    parseInt(string)($('#long').val());
    parseInt(string)($('#lat').val());

    function initMap() {
        var latitude = parseFloat($('#lat').val()); // YOUR LATITUDE VALUE
        var longitude = parseFloat($('#long').val()); // YOUR LONGITUDE VALUE
        // var latitude = 17.4563197; // YOUR LATITUDE VALUE
        // var longitude = 78.3728344; // YOUR LONGITUDE VALUE
        var myLatLng = {
            lat: latitude,
            lng: longitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 18
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            //title: 'Hello World'
            // setting latitude & longitude as title of the marker
            // title is shown when you hover over the marker
            title: latitude + ', ' + longitude
        });
    }
    $('.edit-modal-btn').on('click', function() {
        alert()
        $('#editProperty').modal('show');
    });

    // Images viewer
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap" async defer></script>
<script>
    $(function() {
        let latitude = parseFloat($('#lat').val()); // YOUR LATITUDE VALUE
        let longitude = parseFloat($('#long').val()); // YOUR LONGITUDE VALUE
        let apikey = 'AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw';
        $.get({
            url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&sensor=false&key=${apikey}`,
            success(data) {
                // console.log(data.results[0].formatted_address);
                console.log(data.results[0]);

            }
        });

    });
    $(document).on('click', '#photo-preview-button', function() {
        $('[data-fancybox="gallery"]').first().trigger('click');
        // $('[data-fancybox="gallery"]:nth-child(1)').trigger('click');
    })
</script>

@if(Session::has('message'))
<script>
    $(function() {
        toastr.success("{{ Session::get('message') }}");
    });
</script>
@endif
@endpush