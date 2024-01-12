@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h4 class="mb-sm-0">Edit Plot/Land Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="progress progress-step-arrow progress-info">
                        <a href="javascript:void(0);" class="progress-bar progress-bar1 active" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property
                            Details</a>
                        <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                        <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Add Images</a>
                        {{-- <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar"
                                style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities
                                Details(Optional)</a> --}}
                    </div>
                    <!-- step -1 -->
                    <div class="mt-4 mb-4">
                        <div id="screens">
                            <form id="SubmitPropertyDetails" method="POST">
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">

                                <div class="screen visible">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row mt-3 mb-3">
                                                @include('admin.pages.property.units.includes.property_information')
                                            </div>
                                        </div>
                                        <h4 class="mb-3">Property Details</h4>

                                        <label class="form-label required m-0">Add Area Details </label>
                                        <div class="row align-items-center mt-3 mb-3">
                                            <div class="col-md-4">
                                                <div class="box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control form-control-b0 col-md-3 border-none" value="{{ $secondary_level_unit_data->plot_area ?? '' }}" name="plot_area" id="CarpetArea" placeholder="Plot Area " />

                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0" name="plot_area_units">
                                                                @forelse($units as $unit)
                                                                <option value="{{ $unit->id }}" @if ($unit->id == $secondary_level_unit_data->plot_area_units) checked @endif>
                                                                    {{ $unit->name }}
                                                                </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <span id="err_plot_area"></span>
                                        </div>


                                        <label class="form-label m-0">Property Dimensions </label><br>

                                        <div class="row">
                                            <div class="col-md-3 d-flex align-items-center mt-1">
                                                <input class="form-control " type="text" name="plot_length" maxlength="11" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $secondary_level_unit_data->plot_length ?? '' }}" placeholder="Length of Plot (in Ft.)">
                                            </div>

                                            <div class="col-md-3 d-flex align-items-center mt-1">
                                                <input class="form-control " type="text" name="plot_breadth" maxlength="11" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $secondary_level_unit_data->plot_breadth ?? '' }}" placeholder=" Breadth of Plot (in Ft.)">
                                            </div>

                                        </div>

                                        <div class="clearfix mb-3"></div>

                                        <label class="form-label">Floors Allowed for Construction</label>
                                        <div class="col-md-4">
                                            <input class="form-control" name="floors_allowed" maxlength="11" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $secondary_level_unit_data->floors_allowed ?? '' }}" type="text" placeholder="No. of Floors">
                                        </div>


                                        <div class="clearfix mb-3"></div>
                                        <label class="form-label  ">No of open side</label>

                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="openside1" name="no_of_open_side" value="1" @if ($secondary_level_unit_data->no_of_open_side == 1) checked @endif>
                                                    <label for="openside1">1</label>
                                                    <input type="radio" id="openside2" name="no_of_open_side" value="2" @if ($secondary_level_unit_data->no_of_open_side == 2) checked @endif>
                                                    <label for="openside2">2</label>
                                                    <input type="radio" id="openside3" name="no_of_open_side" value="3" @if ($secondary_level_unit_data->no_of_open_side == 3) checked @endif>
                                                    <label for="openside3">3</label>
                                                    <input type="radio" id="openside4" name="no_of_open_side" value="4" @if ($secondary_level_unit_data->no_of_open_side == 4) checked @endif>
                                                    <label for="openside4">4</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="ms-auto text-end">
                                            <!-- <button class="btn btn-done btn-primary nextBtn">Next &nbsp;<i class="fa fa-arrow-right"></i></button> -->
                                            <button type="submit" class="btn btn-done btn-primary">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- scrren2 -->
                            @include('admin.pages.property.units.edits.includes.pricing_and_other_details')
                            


                        <!-- scrren3 -->


                        <div class="screen">
                            <!-- Section for Pricing & Other Details -->
                            <div class="card3">
                                <div class="row mt-3 mb-3">
                                    @include('admin.pages.property.units.includes.property_information')
                                </div>
                                <div class="mt-4 mb-4">
                                    <h4 class="mb-3">Add Images</h4>
                                    <!-- <label class="form-label  mt-3">Add images <span class="text-danger"> *</span></label>  -->
                                    <div class="row images-block" style="display:block;">
                                        <div class="col-xxl-2 col-md-3 mb-3 ">
                                            <div class="form-group">
                                                <label class="form-label">Gallery Images </label>
                                                <div class="d-flex justify-content-center flex-column">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="mainDiiv">

                                        </div>
                                        <div class="row">
                                            <div id="files-preview"></div>
                                        </div>
                                    </div>
                                    <ul class="error_images"> </ul>
                                </div>
                                <form class="unit-gallery-zone icm-zone">
                                    <div class="icm-file-list"></div>
                                    <input type="file" id="image-gallery" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.plot-land-images') }}">

                                    <div>
                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                        <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
                                    </div>

                                    <div class="row old-files-icm-lable-preview-group">
                                        @if($secondary_level_unit_data->open_plot_land_images->count() > 0)
                                        <div class="dropzone-img-gallery col-md-6">
                                            @forelse($secondary_level_unit_data->open_plot_land_images as $rec)

                                            <a data-fancybox="gallery" class="w-100 dropzone-img-gallery-item @if ($loop->iteration > 2) d-none @endif" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" class="img-fluid">
                                            </a>

                                            @empty
                                            @endforelse
                                        </div>
                                        @endif
                                        <label for="image-gallery" class="icm-zone-label col">Drop Gallery files here to upload</label>
                                    </div>
                                </form>

                            </div>

                            <div class="card-footer">
                                <div class="ms-auto text-end">
                                    <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                    <button type="submit" class="btn btn-done btn-primary nxt-btn" data-screen="plot-land" id="step3" data-images-count="{{$secondary_level_unit_data->open_plot_land_images->count() ?? 0}}">Update &nbsp;<i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
        </div>
    </div>
    <!-- End Page-content -->

</div>




</div> <!-- container-fluid -->
</div>
<!--End Page-content -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=525"></script>
<script src="{{ url('public/assets/js/property/units/pricing_other_details/editPricingDetails.js') }}?v=41"></script>
<script src="{{ url('public/assets/js/image-compression-helper.js') }}?v=85225"></script>
<script>
    $(document).ready(function() {


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
        // });


        //First Tab Submission
        $('form[id=SubmitPropertyDetails]').submit(function(e) {
            $('.progress-bar').removeClass('active');
            toggleLoadingAnimation();

            // $(".nextBtn").on("click", function() {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('surveyor.property.unit_details.plotland.openPlotLand.store_property_details') }}",
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
                            $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                .addClass('is-invalid');
                            $('#err_' + key).after(
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


        let pricingUrl =
            "{{ route('surveyor.property.unit_details.plotland.openPlotLand.store_pricing_details') }}";

        @include('admin.pages.property.units.scripts.submit.unit_pricing_details')



        //Third Tab Submission
        $('form[id=SubmitUnitImages]').submit(function(e) {
            e.preventDefault();
            toggleLoadingAnimation();
            var formData = new FormData($(this)[0]);
            // console.log(formData, "formData")
            $.ajax({
                url: "{{ route('surveyor.property.unit_details.plotland.openPlotLand.update_images') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success response

                },
                error: function(jqXHR, status, error) {
                    toggleLoadingAnimation();
                    $('.input-error').remove();
                    $('input').removeClass('is-invalid');
                    if (jqXHR.status == 422) {
                        for (const [key, value] of Object.entries(jqXHR.responseJSON
                                .errors)) {
                            toastr.error(value[0]);
                            $('.error_images').html(
                                '<li class="input-error"><span  style="color:red">' +
                                value + '</span></li>');
                        }
                        $('.btn-primary').removeClass('nextBtn');

                    } else {
                        alert('something went wrong! please try again..');
                    }
                }
            });
        })


    });
</script>
{{-- scripts for image preview --}}

<script>
    function validateNumericInput(event) {
        const inputValue = event.target.value;
        const numericValue = parseInt(inputValue);

        if (isNaN(numericValue)) {
            event.target.value = "";
        }
    }
    $(document).ready(function() {

        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                $("#files-preview").html('')
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
                            files = Array.from(files).filter((_, i) => i !==
                                imageIndex);
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

    });
</script>
{{-- <script src="{{ url('public/assets/js/property//hospitality_extra.js') }}"></script> --}}
@endpush