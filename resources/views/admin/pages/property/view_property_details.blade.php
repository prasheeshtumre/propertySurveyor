@extends('admin.layouts.master')
@section('content')
@push('css')
<link href="{{ asset('assets/css/show-property-details.css') }}?v=234567" rel="stylesheet" type="text/css" />


<style>

.auth-one-bg {
    background-image: url(https://proper-t.co/testing.manage.propert/public/assets/images/auth-one-bg.jpg);
    background-position: center;
    background-size: cover;
    position:fixed;
}
    .main-content{
        margin-left:0px !important;
    }
    .page-content{
        padding:30px 20px!important;
    }
    
    footer{
        width:100%!important;
        left:0!important;
        right:0!important;
    }
</style>
@endpush

<div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
<div class="page-content mb-5">
    <div class="container">
        <div class="row card">
            <div class="col-xl-12  text-center border-bottom ">
                <h4 class=" my-3" style="font-family:poppins;text-transform:uppercase;">Property Details </h4>
            </div>            
            <div class="col-xl-12 col-md-12 p-0">
                <div class="">
                  
                    <div class="card-body">
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
                                                <div class="col-md-12 mb-3 ri-empty-img-body">
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
                                        
                                        <div class="keyDetailsList">
                                            <ul class="list-group list-group-flush">
                                                @include('admin.pages.property.' . $defined_blade, ['floors' => $floors])
                                            </ul>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12 mb-3"> 
                            <div class="apart-images">

                                @foreach ($property->images as $image)
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

                        <div class="col-md-12 mb-3 {{$floor_visible_status ?? ''}}">
                            @include('admin.pages.property.view_floor', [ 'floors' => $floors])
                        </div>
                        @if(!empty($property->remarks))
                            <div class="col-sm-12 col-md-12 mt-3">
                                <div class="">
                                    <div class="">
                                        <div class="">
                                        <h2 class="h4 inline-block heading-medium">Remarks</h2>
                                        </div>
                                        <p>
                                        {{ $property->remarks ?? ''}}
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                      
                            <div class="col-md-12 mb-3 mt-3 text-end">
                                <div class="">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    Preview the Map
                                                    
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-1 pgmap-body" style="">
                                                    <div id="map" style="clear:both; height:100%;">
                                                        <div id="map"></div>
                                                    </div>
                                                
                                                </div>
                                                <a 
                                                class="badge bg-light d-flex justify-content-center"
                                                href="https://maps.google.com/?q={{ $property->latitude ?? '-' }},{{ $property->longitude ?? '-' }}">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span class="mdi mdi-google-maps mdi-18px"></span> 
                                                        <span class="text-dark" >View on Google Map</span>  
                                                    </div>
                                                    
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                <!--<button class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>-->
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

@endpush