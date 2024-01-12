@extends('admin.layouts.main')
@section('content')
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <style>
        .apart-images img {
            width: 150px !important;
            height: 150px !important;
            padding: 2px !important;
            object-fit: cover !important;
            border: 3px solid #662e93;
            border-radius: 5px;
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

        .merged-notch {
            position: relative;
            margin: -8px auto;
            height: 40px;
            z-index: 3;
        }

        .unit-notch {
            position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: rgba(53, 119, 241);
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);

        }

        .merged-notch {
            position: relative;
            margin: -8px auto;
            height: 40px;
            z-index: 3;
        }

        .unit-notch {
            position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: rgba(53, 119, 241);
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);

        }

        .notch {
            position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: #222;
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);
        }

        .notch::before,
        .notch::after {
            content: '';
            position: absolute;
            top: 0;
            left: -7px;
            width: 14px;
            height: 7px;
            background-size: 50% 100%;
            background-repeat: no-repeat;
            background-image: radial-gradient(circle at 0 100%, transparent 6px, #222 7px);
        }

        .notch::after {
            left: 100%;
            margin-right: corner-sizepx;
            background-image: radial-gradient(circle at 100% 100%, transparent 6px, #222 7px);
        }

        .unit-notch::before,
        .unit-notch::after {
            content: '';
            position: absolute;
            top: 0;
            left: -6px;
            width: 14px;
            height: 7px;
            background-size: 50% 100%;
            background-repeat: no-repeat;
            background-image: radial-gradient(circle at 0 100%, transparent 6px, rgba(53, 119, 241) 7px);
        }

        .unit-notch::after {
            left: 99.6%;
            margin-right: corner-sizepx;
            background-image: radial-gradient(circle at 100% 100%, transparent 6px, rgba(53, 119, 241) 7px);
        }

        .floor-mask {
            position: absolute;
            background-color: rgba(255, 255, 255, .5);
            height: 100%;
            width: 99%;
            z-index: 3;
        }

        .storey-unit {
            position: relative;
        }

        .unit-mask {
            position: absolute;
            height: 90%;
            background-color: rgba(255, 255, 255, .5);
            z-index: 1;
        }

        @media only screen and (max-width: 600px) {

            span.remove-storey,
            span.remove-storey-unit {
                position: absolute;
                top: 1%;
                left: 92%;
                width: 20px;
                cursor: pointer;
            }

            .unit-notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 0px 10px;
                height: 27px;
                background-color: rgba(53, 119, 241);
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                min-width: 70%;
                text-align: center;
            }

            .notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 4px 33px;
                height: 27px;
                background-color: #222;
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                width: 70%;
                text-align: center;
            }
        }

        /*# sourceMappingURL=custom.min.css.map */
        .accordion-button:not(.collapsed) {
            color: white !important;
            background-color: rgb(64 81 137) !important;
            -webkit-box-shadow: inset 0 calc(-1 * var(--vz-accordion-border-width)) 0 var(--vz-accordion-border-color) !important;
            box-shadow: inset 0 calc(-1 * var(--vz-accordion-border-width)) 0 var(--vz-accordion-border-color) !important;
        }

        .accordion-button {
            background-color: #dee6ff !important;
        }

        .Unit_Details span:nth-child(1) {
            font-weight: 600;
            font-size: 12px;
        }

        .Unit_Details span:nth-child(2) {
            margin-left: 5px;
            font-size: 12px;
        }

        .Unit_Details {
            padding: 2px 0px;
        }

        .Unit_MainDetails {
            background: #fff !important;
            border: 1px solid #405189 !important;
            transition: 0.3s !important;
            border-radius: 5px !important;
            height: 290px;
        }

        .accordion-button:not(.collapsed)::after {
            content: '\f077' !important;
            font-weight: 900 !important;
            font-family: "Font Awesome 6 Free";
        }

        .accordion-button::after {
            content: '\f078' !important;
            font-weight: 900 !important;
            font-family: "Font Awesome 6 Free";
            background-image: none !important;
        }

        .Unit_MainDetails:hover {
            background: #dee6ff !important;
            border: 1px solid #405189 !important;
            transition: 0.3s !important;
            border-radius: 5px !important;
            height: 290px;
        }

        .Unit_MainDetails .card-header {
            padding: 6px 10px;
        }

        .dropzone .dz-message {
            font-size: 24px;
            width: 100%;
            margin: 0em 0;
        }

        .btn-grediyent {
            background: rgb(102, 46, 147);
            background: linear-gradient(0deg, rgba(102, 46, 147, 1) 0%, rgba(205, 144, 255, 1) 100%);
            border: solid 1px #662e93;
            color: #fff;
        }

        .MobilelistFurninshed {
            width: 500px !important;
            background: white !important;
            box-shadow: 2px 3px 10px 1px lightgrey !important;
            text-align: left;
            z-index: 9999;
        }

        .MobilelistFurninshed2 {
            width: 500px !important background: white !important;
            box-shadow: 2px 3px 10px 1px lightgrey !important;
            text-align: left;
            transform: translate3d(-149.333px, 26px, 0px);
        }

        /*Responsive design for mobile*/
        @media only screen and (max-width: 600px) {
            .progress-step-arrow {
                display: block;
            }

            .progress-step-arrow .progress-bar {
                padding: 10px;
            }

            .progress-step-arrow {
                height: 133px;
                background: white;
            }

            .progress-step-arrow .progress-bar:nth-child(1)::after {
                content: "";
                position: absolute;
                border: 10px solid transparent;
                bottom: -20px;
                right: 47%;
                z-index: 1;
                rotate: 90deg;
            }

            .progress-step-arrow .progress-bar:nth-child(2)::after {
                content: "";
                position: absolute;
                border: 10px solid transparent;
                bottom: -20px;
                right: 47%;
                z-index: 1;
                rotate: 90deg;
            }

            .progress-step-arrow .progress-bar:nth-child(3)::after {
                display: none;
            }

            .progress-info .progress-bar:nth-child(2)::after {
                border-left-color: rgb(233 245 251) !important
            }

            .progress-info .progress-bar:nth-child(1)::after {
                border-left-color: #299cdb !important;
            }

            .progress-info .progress-bar:nth-child(3)::after {
                border-left-color: #dae0e3 !important
            }

            .progress-step-arrow .bg-light {
                background-color: #dae0e3 !important;
            }

            .page-content {
                padding: calc(70px + 1.5rem) calc(0rem * .5) 60px calc(0rem * 0);
            }

            .Mobilemt-3 {
                margin-top: 1rem;
            }

            .MobilelistFurninshed {
                width: 300px !important;
                background: white !important;
                box-shadow: 2px 3px 10px 1px lightgrey !important;
                text-align: left;
                transform: translate3d(-149.333px, 26px, 0px);
            }

            .MobilelistFurninshed2 {
                width: 370px !important;
                background: white !important;
                box-shadow: 2px 3px 10px 1px lightgrey !important;
                text-align: left;
                transform: translate3d(-149.333px, 26px, 0px);
            }
        }
    </style>
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
                            <div class="row border-bottom mb-3">

                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Latitude<span
                                                class="errorcl">*</span></label>
                                        <input disabled type="text" value="{{ $property->latitude ?? '-' }}"
                                            name="locality_name" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Longitude<span
                                                class="errorcl">*</span></label>
                                        <input disabled type="text" value="{{ $property->longitude ?? '-' }}"
                                            name="locality_name" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">GIS ID<span
                                                class="errorcl">*</span></label>
                                        <input disabled type="text" value="{{ $property->gis_id }}" name="locality_name"
                                            class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Category of the property<span
                                                class="errorcl">*</span></label>
                                        <input disabled type="text" value="{{ $property->category->cat_name }}"
                                            name="locality_name" class="form-control" id="">
                                    </div>
                                </div>


                            </div>
                            @include('admin.pages.property.' . $defined_blade, ['floors' => $floors])

                            <div class="row">
                                @if ($property->up_for_sale == 1)
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                            <span class="mdi mdi-decagram text-success"></span>
                                            <!--<input class="form-check-input" disabled @if ($property->up_for_sale == 1) checked @endif type="checkbox" name="up_for_sale" id="up_for_sale">-->
                                            <label class="form-check-label" for="up_for_sale">
                                                UP for Sale
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                @if ($property->up_for_rent == 1)
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                            <span class="mdi mdi-decagram text-success"></span>
                                            <!--<input class="form-check-input" disabled @if ($property->up_for_rent == 1) checked @endif type="checkbox" name="up_for_rent" id="up_for_rent" >-->
                                            <label class="form-check-label" for="up_for_rent">
                                                UP for Rent
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <label><b>Property Images</b></label>
                                <div class="apart-images">

                                    @foreach ($property->images as $image)
                                        <a data-fancybox="gallery"
                                            href="{{ config('app.propert') }}{{ '/public/uploads/property/images/' . $image->file_url }}">
                                            <img src="{{ config('app.propert') }}{{ '/public/uploads/property/images/' . $image->file_url }}"
                                                class="img-fluid">
                                        </a>
                                    @endforeach

                                </div>
                            </div>


                            <div class="col-md-12 mb-3">
                                @include('admin.pages.property.view_floor', ['floors' => $floors])
                            </div>

                            <div class="col-md-12 mb-3 text-end">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Preview the Map
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body p-1" style="height:500px;">
                                                <div id="map" style="clear:both; height:100%;">
                                                    <div id="map"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<button class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>-->
                            </div>
                        </div>
                        <div class="card-footer" style="background-color:#e1e1ef;">
                            <div class="d-flex justify-content-end">

                                <a class="btn btn-warning me-2 edit-modal-btn"
                                    href="{{ route('surveyor.property.edit_details', [$property->id]) }}"><span
                                        class="mdi mdi-layers-edit me-2 "></span> EDIT </a>

                                <a class="btn btn-primary me-2"
                                    href="https://maps.google.com/?q={{ $property->latitude ?? '-' }},{{ $property->longitude ?? '-' }}">
                                    <span class="mdi mdi-map me-2"></span> View on Google Map </a>

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
    <script>
        $(document).on('submit', "#update_property", function(e) {
            e.preventDefault();
            let url = $(this).data('action');
            // $('<span class="input-error" style="color: red">dfgs</span>')
            //     .insertAfter("input[name=category]");
            $.ajax({
                type: "POST",
                data: new FormData($("#update_property")[0]),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response.success)
                    if (response.success == true) {
                        $('#editProperty').modal('hide');
                        $('#update_success').modal('show');
                        setInterval(() => {
                            location.reload();
                        }, 3000);

                    }
                },
                error: function(data) {
                    let errors = data.errors;
                    if (data.responseJSON.success == false) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('.err-' + key).addClass("is-invalid");
                            $('.err-' + key).html('');
                            $('.err-' + key).append('<span class="text-danger">' +
                                value[0] + '</span>');
                            $(".name-msg").show();
                        });
                    }
                }
            });
        });
        // $(document).on('change', '#category', function(e) {
        //     let c_id = $(this).val();
        //     $.ajax({
        //         type: "GET",
        //         data: {
        //             c_id: c_id
        //         },
        //         url: "{{ url('surveyor/ajax/sub_categories') }}",
        //         success: function(response) {
        //             $('#sub_category').empty();
        //             $("#sub_category").append(
        //                 '<option selected disabled>--Select Type of property--</option>');
        //             if (response) {
        //                 $.each(response, function(key, value) {
        //                     $('#sub_category').append($("<option/>", {
        //                         value: value.id,
        //                         text: value.title
        //                     }));
        //                 });ro
        //             }
        //         }
        //     });
        // })

        $(document).on('click', ".remove-image", function(e) {
            // let url = $(this).attr('href');
            $.ajax({
                type: "GET",
                url: $(this).data('href'),
                success: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
    <script>
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            toastr.success("{{ Session::get('message') }}")
        @endif
    </script>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"
        async defer></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
@endpush
