@extends('admin.layouts.main')
@section('content')
    @push('css')
        <link href="{{ asset('assets/css/unit-details.css') }}?v=2385" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icm_zone_ui.css') }}" rel="stylesheet" type="text/css" />
    @endpush
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

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $unit_data->categoryName->title ?? 'Other' }} Details </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="progress progress-step-arrow progress-info">
                            <!-- <a href="javascript:void(0);" class="progress-bar progress-bar1 active" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property Details</a>
                                                    <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                                                    <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Add Images</a>
                                                    <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities Details(Optional)</a> -->
                            <a href="javascript:void(0);" class="progress-bar progress-bar1 active" role="progressbar"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property
                                Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Add Images</a>
                            <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar"
                                style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities
                                Details(Optional)</a>
                        </div>
                        <!-- step -1 -->
                        <div class="mt-3 mb-3">
                            <div id="screens">
                                <!--1st screen-->
                                <form id="SubmitPropertyDetails" method="POST">
                                    <div class=" screen visible">
                                        <div class="card1">
                                            <div class="row mt-3 mb-3">
                                                @include('admin.pages.property.units.includes.property_information')
                                            </div>
                                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                                            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
                                            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
                                            <input type="hidden" name="unit_type_id"
                                                value="{{ $unit_data->unit_type_id }}">
                                            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
                                            <input type="hidden" name="unit_sub_cat_id"
                                                value="{{ $unit_data->unit_sub_cat_id }}">
                                            <h4 class="mb-3">Property Details</h4>

                                            <label class=" form-label ">Add Area Details </label>
                                            <div class="row align-items-center mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <div class="box-bdr">
                                                        <div class="d-flex">
                                                            <div>
                                                                <input type="text"
                                                                    class="form-control form-control-b0 col-md-3 border-none"
                                                                    onkeypress="return isNumber(event)" name="carpet_area"
                                                                    id="CarpetArea" placeholder="carpet area">
                                                            </div>

                                                            <div class="ms-auto" style="">
                                                                <select class="form-select form-control-b0"
                                                                    name="carpet_area_unit">
                                                                    @forelse($area_detail_units as $unit)
                                                                        <option value="{{ $unit->id }}">
                                                                            {{ $unit->name }}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span id="errcarpet_area"></span>
                                                </div>
                                                <div class="clearfix mb-3"></div>

                                                <div class="col-md-4" id="BuiltUp" style="display:none">
                                                    <div class=" box-bdr">
                                                        <div class="d-flex">
                                                            <div>
                                                                <input type="text"
                                                                    class="form-control form-control-b0 col-md-3 border-none"
                                                                    name="buildup_area"
                                                                    onkeypress="return isNumber(event)" id="BuildupArea"
                                                                    placeholder="Add Built up area">
                                                            </div>
                                                            <div class="ms-auto" style="">
                                                                <select class="form-select form-control-b0"
                                                                    name="buildup_area_unit">
                                                                    @forelse($area_detail_units as $unit)
                                                                        <option value=" {{ $unit->id }}">
                                                                            {{ $unit->name }}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix mb-3"></div>

                                                <div class="col-md-4" id="SuperBuiltUp" style="display:none">
                                                    <div class="box-bdr">
                                                        <div class="d-flex">
                                                            <div>
                                                                <input type="text"
                                                                    class="form-control form-control-b0 col-md-3 border-none"
                                                                    onkeypress="return isNumber(event)"
                                                                    name="super_buildup_area" id="SuperBuildupArea"
                                                                    placeholder="Add Super Built up area">
                                                            </div>
                                                            <div class="ms-auto" style="">
                                                                <select class="form-select form-control-b0"
                                                                    name="super_buildup_area_unit">
                                                                    @forelse($area_detail_units as $unit)
                                                                        <option value=" {{ $unit->id }}">
                                                                            {{ $unit->name }}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix mb-3"></div>
                                                <div class="col-md-2">
                                                    <a style="color: var(--vz-link-color);" id="ShowBuiltUp"> + Add Built
                                                        up area</a>
                                                </div>

                                                <div class="col-md-3">
                                                    <a style="color: var(--vz-link-color);" id="ShowSuperBuiltUp"> + Add
                                                        Super Built up area</a>
                                                </div>
                                            </div>

                                            <label class="form-label ">Property Facing <span
                                                    id="errcarpet_area"></span></label>
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-12 mb-3">
                                                    <div class="radio-toolbar-text">
                                                        @forelse($property_facings as $prop_face)
                                                            <input type="radio" id="PropFace-{{ $prop_face->id }}"
                                                                name="property_facing" value="{{ $prop_face->id }}">
                                                            <label
                                                                for="PropFace-{{ $prop_face->id }}">{{ $prop_face->name }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <span id="errproperty_facing"></span>
                                                </div>
                                            </div>




                                            <label class="form-label ">Availability Status <span
                                                    id="errcarpet_area"></span></label>
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-12 mb-3">
                                                    <div class="radio-toolbar-text">
                                                        @forelse($availability_status as $avlbl_sts)
                                                            <input type="radio" id="avlbl_sts-{{ $avlbl_sts->id }}"
                                                                name="availability_status" value="{{ $avlbl_sts->id }}">
                                                            <label
                                                                for="avlbl_sts-{{ $avlbl_sts->id }}">{{ $avlbl_sts->name }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <span id="erravailability_status"></span>
                                                </div>
                                            </div>


                                            <div class="row mb-3" id="AgeOfProperty" style="display:none">
                                                <label class="form-label m-0 ">Age of Property <span
                                                        style="color:red">*</span></label>
                                                <div class=" col-md-12">
                                                    <div class="radio-toolbar-text">
                                                        @forelse($age_of_property as $property_age)
                                                            <input type="radio"
                                                                id="property_age-{{ $property_age->id }}"
                                                                name="property_age" value="{{ $property_age->id }}">
                                                            <label
                                                                for="property_age-{{ $property_age->id }}">{{ $property_age->name }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <span id="errproperty_age"></span>
                                                </div>
                                            </div>

                                            <div class="row mb-3" id="PossesionBy" style="display:none">
                                                <label class="form-label m-0 ">Possesion by<span
                                                        style="color:red">*</span></label>
                                                <div class="col-md-3  align-items-center mt-1">
                                                    <input type="date" class="form-control " name="possesion_by"
                                                        id="">
                                                </div>
                                            </div>


                                            <div class="card-footer">
                                                <div class="ms-auto text-end">
                                                    <!-- <button class="btn btn-done btn-primary nextBtn">Next &nbsp;<i class="fa fa-arrow-right"></i></button> -->
                                                    <button class="btn btn-done btn-primary">Next &nbsp;<i
                                                            class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Section for Pricing & Other Details -->
                                @include('admin.pages.property.units.includes.pricing_and_other_details')
                                <!--screen 2 end -->
                            </div>
                        </div>
                        <!-- screen 3 -->
                        @include('admin.pages.property.units.includes.add_images')
                        <!--screen3 end-->
                        <!-- Section Amenities start -->
                        @include('admin.pages.property.units.includes.amenities')
                        <!-- Section Amenities end -->

                    </div>

                </div> <!-- container-fluid -->
            </div>
        </div>

    </div> <!-- container-fluid -->
    </div> <!--End Page-content -->
@endsection
@push('scripts')
    <script src="{{ url('public/assets/js/property/extra.js') }}"></script>
    <script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=8574"></script>
    <script src="{{ url('public/assets/js/property/units/pricing_other_details/addPricingDetails.js') }}?v=2"></script>
    <script src="{{ url('public/assets/js/image-compression-helper.js') }}?v=15663"></script>
    <script src="{{ url('public/assets/js/video-compression-helper.js') }}?v=58298"></script>
    <script>
        // @foreach ($errors->all() as $error)
        // toastr.error("{{ $error }}")
        // @endforeach
        // @if (Session::has('message'))
        // toastr.success("{{ Session::get('message') }}")
        // @endif
    </script>
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;

            var charCode = (evt.which) ? evt.which : evt.keyCode;

            var inputValue = evt.target.value;

            var currentLength = inputValue.length;



            // Check if the character code is a numerical digit (0-9)

            if (charCode >= 48 && charCode <= 57) {

                // Check if the current input length is already 11 digits

                if (currentLength >= 11) {

                    return false; // Prevent further input if the limit is reached

                }

                return true; // Allow numerical digits if the limit is not reached

            } else {

                // For non-numerical characters, prevent the input

                return false;

            }

        }
        $(document).ready(function() {
            $("#Facilitis").hide();
            $("#ReceptionArea").hide();
            $("#ConferenceRoom").hide();
            $("#Pantry").hide();
            $("#MeetingRooms").hide();
            $("#NoOfCabins").hide();
            $("#MaxNoOfSeats").hide();
            $("#MinNoOfSeats").hide();

            $("#TypeOfOffice").on("change", function() {
                if ($("#TypeOfOffice").val() == "82") {
                    console.log($("#TypeOfOffice").val());

                    $("#Facilitis").hide();
                    $("#ReceptionArea").hide();
                    $("#ConferenceRoom").hide();
                    $("#Pantry").hide();
                    $("#MeetingRooms").hide();
                    $("#NoOfCabins").hide();
                    $("#MaxNoOfSeats").hide();
                    $("#MinNoOfSeats").hide();

                } else {
                    $("#Facilitis").show();
                    $("#ReceptionArea").show();
                    $("#ConferenceRoom").show();
                    $("#Pantry").show();
                    $("#MeetingRooms").show();
                    $("#NoOfCabins").show();
                    $("#MaxNoOfSeats").show();
                    $("#MinNoOfSeats").show();
                }

            });

            $("#ShowBuiltUp").on('click', function() {
                $('#BuiltUp').show();
                $('#ShowBuiltUp').hide();
            });

            $("#ShowSuperBuiltUp").on('click', function() {
                $("#SuperBuiltUp").show();
                $("#ShowSuperBuiltUp").hide();
            })

            $("#AddStaircase").on('click', function() {
                $("#ExtraStaircase").show();
                $("#ShowStaircaseDone").show();
            })

            $("#ShowStaircaseDone").on('click', function() {
                const extra_staicase_value = $("#ExtraStaircase").val();
                var html = `<input type="radio" id="radio-${extra_staicase_value}" name="staircase" value="${extra_staicase_value}" checked>
                        <label for="radio-${extra_staicase_value}">${extra_staicase_value}</label>`;
                $("#AppendStaricase").append(html);
                $("#ExtraStaircase").hide();
                $("#ShowStaircaseDone").hide();

                // console.log($('form[id=SubmitPropertyDetails] input[name=staircase][4]').length)
                const staircaseInputs = document.querySelectorAll('input[name="staircase"]');
                if (document.getElementsByName('staircase').length >= 6) {
                    const fifthStaircaseInput = staircaseInputs[4];
                    if (fifthStaircaseInput && fifthStaircaseInput.parentNode) {
                        fifthStaircaseInput.parentNode.removeChild(fifthStaircaseInput);
                        const labelElement = document.querySelector(`label[for=${fifthStaircaseInput.id}]`);
                        labelElement.style.display = "none";
                    }

                }

            })

            $("#avlbl_sts-23").on('click', function() {
                $("#AgeOfProperty").show();
                $("#PossesionBy").hide();
            })
            $("#avlbl_sts-24").on('click', function() {
                $("#AgeOfProperty").hide();
                $("#PossesionBy").show();
            })

            // $(document).ready(function() {
            const $screens = $(".screen");
            let currentScreen = 0;
            const $screens1 = $(".progress-bar");
            let progressbar = 0;

            function showScreen(screenIndex) {
                $screens.removeClass("visible highlight");
                $screens.eq(screenIndex).addClass("visible");

                if (screenIndex > 0) {
                    $screens.eq(screenIndex - 1).addClass("highlight");
                }
            }

            function showAtive(screenIndex) {

                $screens1.removeClass("active");
                $screens1.eq(screenIndex).addClass("active");

                if (screenIndex > 0) {
                    $screens1.eq(screenIndex - 1).addClass("active");

                }
                if (screenIndex === 2)
                    $screens1.eq(screenIndex).addClass("active");
            }

            // Initially show the first screen
            showScreen(currentScreen);
            // Next button click event handler
            $(".nextBtn").on("click", function() {
                if (currentScreen < $screens.length - 1) {
                    currentScreen++;
                    showScreen(currentScreen);
                    progressbar++;
                    showAtive(progressbar);
                }
            });

            // Previous button click event handler
            $(".prevBtn").on("click", function() {
                if (currentScreen > 0) {
                    currentScreen--;
                    showScreen(currentScreen);
                    progressbar--;
                    showAtive(progressbar);
                }
            });


            //First Tab Submission
            $('form[id=SubmitPropertyDetails]').submit(function(e) {
                toggleLoadingAnimation();
                $('.progress-bar').removeClass('active');

                // $(".nextBtn").on("click", function() {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.other.store_property_details') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // Handle success response
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                toastr.error(value[0]);
                                if (key != 'property_facing' && key != 'pantry' && key !=
                                    'conference_room' && key != 'reception_area' &&
                                    key != 'furnishing' && key != 'central_air_conditions' &&
                                    key != 'oxygen_dust' && key != 'ups' &&
                                    key != 'lift' && key != 'availability_status' && key !=
                                    'property_age' && key != 'carpet_area' &&
                                    key != 'staircase') {
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .addClass(
                                            'is-invalid');
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .after(
                                            '<span class="text-danger input-error" role="alert">' +
                                            value +
                                            '</span>');
                                }
                                $('form[id=SubmitPropertyDetails] textarea[name=' + key + ']')
                                    .addClass('is-invalid');
                                $('form[id=SubmitPropertyDetails] textarea[name=' + key + ']')
                                    .after(
                                        '<span class="text-danger input-error" role="alert">' +
                                        value + '</span>');

                                $('#err' + key).after(
                                    '<span class="input-error" style="color:red">' + value +
                                    '</span>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    },

                });
            })

            //Second Tab Submission
            let pricingUrl =
                "{{ route('surveyor.property.unit_details.commercial.other.store_pricing_details') }}";

            @include('admin.pages.property.units.scripts.submit.unit_pricing_details')


            //Third Tab Submission
            $('form[id=AddImage]').submit(function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.other.store_images') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // Handle success response
                        // console.log(response);
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                    },
                    error: function(jqXHR, status, error) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                toastr.error(value[0]);
                                if (key.startsWith('gallery_images')) {
                                    $("#GalleryImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }

                                if (key.startsWith('amenities_images')) {
                                    $("#AmenityImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                                if (key.startsWith('interior_images')) {
                                    $("#InteriorImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                                if (key.startsWith('floor_plan_images')) {
                                    $("#FloorPlanImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    }
                });
            })

            //Fourth Tab Submission
            $('form[name=AmenitiesForm]').submit(function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.other.store_amenities') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // console.log(response.data)
                        toastr.success('Record Added Successfully');
                        var unit_id = response.data;
                        var url =
                            "{{ route('surveyor.property.unit_details', [':id']) }}";
                        url = url.replace(':id', unit_id);
                        window.location.href = url;

                    },
                    error: function(jqXHR, status, error) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                toastr.error(value[0]);
                            }
                        }
                    }

                });
            })


        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script>
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                $("#files-preview").html('');
                var files = e.target.files,
                    filesLength = files.length;
                console.log(filesLength, "files");
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#files')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#AmenityFiles").on("change", function(e) {
                $("#amenity-files-preview").html('');
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#amenity-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#AmenityFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#InteriorFiles").on("change", function(e) {
                $("#interior-files-preview").html('');
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#interior-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#InteriorFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#FloorPlanFiles").on("change", function(e) {
                $("#floor-plan-files-preview").html('');
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#floor-plan-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#FloorPlanFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    </script>
@endpush
