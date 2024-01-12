@extends('admin.layouts.main')
@section('content')
    <style>
          .errorcl {
            color: red;
        }

        .apart-images img {
            padding: 4px !important;
        }

        .image-area {
            position: relative;
            /* width: 50%; */
            margin: 20px;
            background: #333;
            border-radius: 5px;
        }

        .image-area img {
            max-width: 100%;

            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        #files-preview {
            border: 2px dashed gray;
            background: lightgray;
            /* visibility: hidden; */

        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Basic Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('surveyor.property.store') }}" method="post" id="create_property" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xxl-6 col-md-6">

                                        <div class="">
                                            <!--<div class="form-group picking">-->
                                            <!--    <label>City</label>-->
                                            <!--    <input type="text" placeholder="" name="city" id="searchInput"-->
                                            <!--        class="form-control controls" placeholder="Enter a location">-->
                                            <!--    <div  class="picklocation"><span class="mdi mdi-crosshairs-gps"></span> Pick-->
                                            <!--        my location</div>-->
                                            <!--</div>-->
                                            <div onclick="getCordinates()" class="form-group picking row">

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Latitude" name="latitude"
                                                        id="latitude" class="form-control controls"
                                                        value="{{ old('latitude') }}">
                                                    @error('latitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Longitude" name="longitude"
                                                        id="longitude" class="form-control controls"
                                                        value="{{ old('longitude') }}">
                                                    @error('longitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-info " type="button">
                                                        <label style="cursor:pointer; margin-bottom:0px;">
                                                            <span class="mdi mdi-crosshairs-gps  "></span>
                                                            Pick my Location
                                                        </label>
                                                    </button>
                                                </div>


                                            </div>
                                            {{-- <input type="text" name="myAddress" placeholder="Enter your address" --}}
                                            {{-- value="333 Alberta Place, Prince Rupert, BC, Canada" id="myAddress" /> --}}

                                            <!-- Search input -->


                                            <!-- Google map -->
                                            <div id="map"></div>

                                            <!-- Display geolocation data -->
                                            {{-- <ul class="geo-data">
                                                <li>Full Address: <span id="location"></span></li>
                                                <li>Postal Code: <span id="postal_code"></span></li>
                                                <li>Country: <span id="country"></span></li>
                                                <li>Latitude: <span id="lat"></span></li>
                                                <li>Longitude: <span id="lon"></span></li>
                                            </ul> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req-" id=" "
                                                placeholder="EX:7255158845" value="{{ old('gis_id') }}"
                                                onkeypress="return isNumber(event)">
                                            @error('gis_id')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Category of the property <span
                                                    class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected disabled>-Select Category-</option>
                                                @forelse($categories as $key=>$category)
                                                    @if (old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected> {{ $category->title }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endif

                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                            @error('category')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Type of property <span
                                                    class="errorcl">*</span></label>
                                            <select class="form-select" name="sub_category" id="sub_category">
                                                <option selected disabled>-Select Category-</option>

                                            </select>
                                            <!--@error('sub_category')-->
                                            <!--    <span class="input-error" style="color: red">{{ $message }}</span>-->
                                            <!--@enderror-->

                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">House No. <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="house_no" class="form-control" placeholder=" "
                                                value="{{ old('house_no') }}">
                                            @error('house_no')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Plot No. <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="plot_no" class="form-control" placeholder=" "
                                                value="{{ old('plot_no') }}">
                                            @error('plot_no')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Street Name/No/Road No. <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="street_details" class="form-control"
                                                placeholder=" " value="{{ old('street_details') }}">
                                            @error('street_details')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Colony/Locality Name <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="locality_name" class="form-control"
                                                placeholder=" " value="{{ old('locality_name') }}">
                                            @error('locality_name')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Owner Full Name </label>
                                            <input type="text" name="owner_name" class="form-control" placeholder=" "
                                                value="{{ old('owner_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Contact No </label>
                                            <input type="text" name="contact_no" class="form-control" placeholder=" "
                                                value="{{ old('contact_no') }}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="files" class="form-label">
                                                Capture Property Images 
                                                <span
                                                    class="errorcl">*</span></label>
                                            <div class="d-flex justify-content-center flex-column " >
                                                <input type="file" name="files[]" id="files" class="form-control"
                                                    multiple placeholder=" " style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Capture Property Images</span></label>
                                                @error('files')
                                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                                @enderror
                                                @error('files.*')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>@php print_r($message); @endphp</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                     <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap">

                                        </div>
                                    </div>

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div>
                                            <label for="" class="form-label">Remarks </label>
                                            <textarea name="remarks" class="form-control" rows="3" value="{{ old('remarks') }}"></textarea>
                                        </div>
                                    </div>

                                    <!--<input type="hidden" name="latitude" id="latitude">-->
                                    <!--<input type="hidden" name="longitude" id="longitude">-->

                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit"
                                        class="btn btn-warning waves-effect waves-light w_100">Submit</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="create_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Added Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
    <script>
        $(document).on('change', '#category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('surveyor/ajax/sub_categories') }}",
                success: function(response) {
                    
                    $('#sub_category').empty();
                    if(response.length == 0){
                        $("#sub_category").append('<option selected >--Select Type of property--</option>');
                    }
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    }
                    
                    
                //   let subCatLength = $('#sub_category option').length; 
                //   alert(subCatLength)
                }
            });
        });
        
        $(document).on('click', '.picklocation', function(e) {
            $.ajax({
                type: "GET",
                url: "{{ url('user_loc_details') }}",
                success: function(response) {
                    $('#city').val(response.cityName);
                    console.log(response.cityName)
                }
            });
        });

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                  
                var files = e.target.files,
                    filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            $(this).parent(".image-area").remove();
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

        function getCordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    $('#latitude').val(lat);
                    $('#longitude').val(lon);

                });
            } else {
                toastr.error("Geolocation is not supported by this browser.");
            }
        }

        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hidden.bs.modal', function() {
            // location.reload();
        });
        
        $(document).on('submit','#create_property', function(){
            // alert()
        //   let opCount = $('#sub_category option').size();
        //   alert(opCount)
        })
        
        //  
    </script>
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
    </script>
    {{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&sensor=false"></script> --}}



    <script>
    
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['(cities)']
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry.location.lat())
                $('#longitude').val(place.geometry.location.lng())
                // console.log(place.name);
                // console.log(place.geometry.location.lat());
                // console.log(place.geometry.location.lng());
                //alert("This function is working!");
                //alert(place.name);
                // alert(place.address_components[0].long_name);

            });
            //This will get only the address
            // input.value = placeResult.name;
            // cosole.log(autocomplete)

            // autocomplete.bindTo('bounds', map);

            // var infowindow = new google.maps.InfoWindow();
            // var marker = new google.maps.Marker({
            //     map: map,
            //     anchorPoint: new google.maps.Point(0, -29)
            // });

            // autocomplete.addListener('place_changed', function() {
            //     infowindow.close();
            //     marker.setVisible(false);
            //     var place = autocomplete.getPlace();
            //     if (!place.geometry) {
            //         window.alert("Autocomplete's returned place contains no geometry");
            //         return;
            //     }

            //     // If the place has a geometry, then present it on a map.
            //     // if (place.geometry.viewport) {
            //     //     map.fitBounds(place.geometry.viewport);
            //     // } else {
            //     //     map.setCenter(place.geometry.location);
            //     //     map.setZoom(17);
            //     // }
            //     // marker.setIcon(({
            //     //     url: place.icon,
            //     //     size: new google.maps.Size(71, 71),
            //     //     origin: new google.maps.Point(0, 0),
            //     //     anchor: new google.maps.Point(17, 34),
            //     //     scaledSize: new google.maps.Size(35, 35)
            //     // }));
            //     // marker.setPosition(place.geometry.location);
            //     // marker.setVisible(true);

            //     // var address = '';
            //     // if (place.address_components) {
            //     //     address = [
            //     //         (place.address_components[0] && place.address_components[0].short_name || ''),
            //     //         (place.address_components[1] && place.address_components[1].short_name || ''),
            //     //         (place.address_components[2] && place.address_components[2].short_name || '')
            //     //     ].join(' ');
            //     // }

            //     // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            //     // infowindow.open(map, marker);
            //     $('#latitude').val(place.geometry.location.lat())
            //     $('#longitude').val(place.geometry.location.lng())
            //     // Location details
            //     // for (var i = 0; i < place.address_components.length; i++) {
            //     //     if (place.address_components[i].types[0] == 'postal_code') {
            //     //         document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            //     //     }
            //     //     if (place.address_components[i].types[0] == 'country') {
            //     //         document.getElementById('country').innerHTML = place.address_components[i].long_name;
            //     //     }
            //     // }
            //     // document.getElementById('location').innerHTML = place.formatted_address;
            //     // document.getElementById('lat').innerHTML = place.geometry.location.lat();
            //     // document.getElementById('lon').innerHTML = place.geometry.location.lng();
            // });
        }
        var input1 = document.getElementById('searchInput');
        input1.addEventListener('blur', function() {
            // timeoutfunction allows to force the autocomplete field to only display the street name.


            setTimeout(function() {
                let s = input1.value;
                let cityName = s.split(',')[0];
                input1.value = cityName;
            }, 500);

        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"
        async defer></script>
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush
