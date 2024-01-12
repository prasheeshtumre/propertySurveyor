@extends('admin.layouts.main')
@section('content')
@push('css')
<link href="{{ asset('assets/css/unit-details.css') }}?v=21" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icm_zone_ui.css') }}" rel="stylesheet" type="text/css" />

@endpush
<style>
    .mylabel {
        padding: 10px;
        background: #ff7b24;
        display: table;
        color: #fff;
        border-radius: 5px;
    }

    .mainDiiv {

        display: flex;
        flex-wrap: wrap;
        column-gap: 15px;
        row-gap: 15px;
    }



    input[type="file"] {
        display: none;
        cursor: none;
    }


    .dropdown .dropdown-list::-webkit-scrollbar {

        width: 5px;

        height: 8px;

        background-color: #aaa;
        /* or add it to the track */

    }

    .dropdown .dropdown-list::-webkit-scrollbar-thumb {

        background: #000;

    }

    .dropdown label {
        margin-bottom: 0px;
    }

    .dropdown {
        position: relative;
        font-size: 14px;
        color: #333;
        width: 100%;
    }

    .dropdown .dropdown-list {
        padding: 7px;
        background: #fff;
        position: absolute;
        top: 50px;
        left: 2px;
        right: 2px;
        box-shadow: 0 1px 2px 1px rgba(0, 0, 0, .15);
        transform-origin: 50% 0;
        transform: scale(1, 0);
        transition: transform 0.15s ease-in-out 0.15s;
        max-height: 66vh;
        overflow-y: scroll;
        z-index: 99;
    }

    .dropdown .dropdown-option {
        display: block;
        padding: 8px 12px;
        opacity: 0;
        transition: opacity 0.15s ease-in-out;
    }

    .dropdown .dropdown-label {
        display: block;
        height: 30px;
        background: #fff;
        border: 1px solid #ccc;
        padding: 6px 12px;
        line-height: 1;
        cursor: pointer;
    }

    .dropdown .dropdown-label:before {
        content: '▼';
        float: right;
    }

    .dropdown.on .dropdown-list {
        transform: scale(1, 1);
        transition-delay: 0s;
    }

    .dropdown.on .dropdown-list .dropdown-option {
        opacity: 1;
        transition-delay: 0.2s;
    }

    .dropdown.on .dropdown-label:before {
        content: '▲';
    }

    .dropdown [type="checkbox"] {
        position: relative;
        top: -1px;
        margin-right: 4px;
    }



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
        transition: 0.3s
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
        transition: 0.3s
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

    .btn-grediyent {
        background: rgb(102, 46, 147);
        background: linear-gradient(0deg, rgba(102, 46, 147, 1) 0%, rgba(205, 144, 255, 1) 100%);
        border: solid 1px #662e93;
        color: #fff;
    }

    .btn-grediyent:hover {
        background: rgb(102, 46, 147);
        background: linear-gradient(180deg, rgba(102, 46, 147, 1) 0%, rgba(205, 144, 255, 1) 100%);
        border: solid 1px #662e93;
        color: #fff;
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
        padding: 5px;
        border-radius: 6px;
    }

    .form-control-b0 {
        border: none !important;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-menu span {
        line-height: 24px;
        display: flex
    }

    input[type=checkbox] {
        width: 15px;
        height: 15px;
        margin-right: 10px;
    }

    .input-step.step-primary button {
        background: #f7ecff;
        border: solid 1px #662e93;
        color: #662e93
    }

    .my_chk {
        line-height: 24px;
        display: flex;
    }

    small {
        color: #a0a0a0;
    }

    .form-control,
    .form-select {
        /*min-height: 50px*/
    }

    .box-bdr {
        padding: 0px;
    }

    .simplecheck span {
        display: flex;
    }

    .required::after {
        content: '*';
        color: red;
        position: absolute;
        right: -10px;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Demolished Details</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form id="SubmitDemolished" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="row mt-3 mb-3">
                            <div class="col-md-4">
                                <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}} </span></p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Address : </b> <span class="project-head"> {{$property->street_details}} </span></p>
                            </div>
                        </div>

                        <h4 class="mb-3">Property Details</h4>
                        <input type="hidden" name="property_id" value="{{$property->id}}">
                        <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">

                        <label class=" form-label required">Add Area Details </label>
                        <div class="row align-items-center mt-3 mb-3">
                            <div class="col-md-4">
                                <div class="box-bdr">
                                    <div class="d-flex">
                                        <div>
                                            <input type="text" maxlength="11" class="form-control form-control-b0 col-md-3 border-none" value="{{$secondary_level_unit_data->plot_area}}" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="plot_area" id="CarpetArea" placeholder="Plot area">
                                        </div>

                                        <div class="ms-auto" style="">
                                            <select class="form-select form-control-b0" name="plot_area_unit">
                                                @forelse($area_detail_units as $unit)
                                                <option value="{{$unit->id}}" @if($secondary_level_unit_data->plot_area_unit) selected @endif>{{$unit->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-3"></div>

                            <div class="col-md-4" id="BuiltUp" @if($secondary_level_unit_data->carpet_area == null) style="display: none;" @endif>
                                <div class=" box-bdr">
                                    <div class="d-flex">
                                        <div>
                                            <input type="text" maxlength="11" class="form-control form-control-b0 col-md-3 border-none" value="{{$secondary_level_unit_data->carpet_area}}" name="carpet_area" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" 5 id="BuildupArea" placeholder="Add Carpet area">
                                        </div>
                                        <div class="ms-auto" style="">
                                            <select class="form-select form-control-b0" name="carpet_area_unit">
                                                @forelse($area_detail_units as $unit)
                                                <option value="{{$unit->id}}" @if($secondary_level_unit_data->carpet_area_unit) selected @endif>{{$unit->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-3"></div>

                            <div class="col-md-4" id="SuperBuiltUp" @if($secondary_level_unit_data->buildup_area == null) style="display: none;" @endif>
                                <div class="box-bdr">
                                    <div class="d-flex">
                                        <div>
                                            <input type="text"  class="form-control form-control-b0 col-md-3 border-none" value="{{$secondary_level_unit_data->buildup_area}}" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" name="buildup_area" id="SuperBuildupArea" placeholder="Add Built up area">
                                        </div>
                                        <div class="ms-auto" style="">
                                            <select class="form-select form-control-b0" name="buildup_area_unit">
                                                @forelse($area_detail_units as $unit)
                                                <option value="{{$unit->id}}" @if($secondary_level_unit_data->buildup_area_unit) selected @endif>{{$unit->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-3"></div>
                            <div class="col-md-2" @if($secondary_level_unit_data->carpet_area != null) style="display: none;" @endif>
                                <a style="color: var(--vz-link-color);" id="ShowBuiltUp"> + Add Carpet  area</a>
                            </div>

                            <div class="col-md-3" @if($secondary_level_unit_data->buildup_area != null) style="display: none;" @endif>
                                <a style="color: var(--vz-link-color);" id="ShowSuperBuiltUp"> + Add  Built up area</a>
                            </div>

                            
                        </div>

                        <div class="clearfix mb-3"></div>
                        <label class="form-label">Property Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="property_description" rows="4">{{$secondary_level_unit_data->property_description}}

                            </textarea>
                        </div>
                        <div class="clearfix mb-3"></div>



                        <label class="form-label m-0">Previous Use</label><br>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center mt-1">
                                <input class="form-control " type="text"  oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" value="{{$secondary_level_unit_data->previous_use}}" name="previous_use" placeholder="Length of Plot (in Ft.)">
                            </div>
                        </div>

                        <div class="clearfix mb-3"></div>

                        <label class="form-label m-0">Current Use</label><br>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center mt-1">
                                <input class="form-control " type="text"  oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" value="{{$secondary_level_unit_data->current_use}}" name="current_use" placeholder="Length of Plot (in Ft.)">
                            </div>
                        </div>

                        <div class="clearfix mb-3"></div>

                        <label class="form-label m-0">Price </label><br>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center mt-1">
                                <input class="form-control "  oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11"  type="text" name="price" value="{{$secondary_level_unit_data->price}}" placeholder="Length of Plot (in Ft.)">
                            </div>
                        </div>

                        <div class="clearfix mb-3"></div>


                        <div class="clearfix mb-3"></div>
                        <label class="form-label  required">Add Images</label>
                        <div class="unit-gallery-zone icm-zone" >
                            <div class="icm-file-list"></div>
                            <input type="file" id="demolishedImageInput" name="demolished_images[]" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.image-gallery') }}" >
                     
                            <div class="row old-files-icm-lable-preview-group">
                                @if($secondary_level_unit_data->demolished_images->count() > 0)
                                <div class="dropzone-img-gallery col-md-6">
                                    @forelse($secondary_level_unit_data->demolished_images as $rec)
                                        
                                            <a data-fancybox="gallery"
                                                class="w-100 dropzone-img-gallery-item @if ($loop->iteration > 2) d-none @endif"
                                                href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                                                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}"
                                                    class="img-fluid">
                                            </a>
                                      
                                    @empty
                                    @endforelse
                                </div>
                                @endif
                                <label for="demolishedImageInput" class="icm-zone-label col">Drop Gallery files here to upload</label>
                            </div>
                            
                        </div>
                     
                        <div class="col-xxl-2 col-md-3 mb-3 ">
                            <div class="form-group">
                                <!-- <label class="form-label">Gallery Images </label> -->
                                <div class="d-flex justify-content-center flex-column">
                                </div>
                                <div id="DemolishedImages"></div>
                                <span id="errdemolished_images[]"></span>
                            </div>

                        </div>
                       




                        <div class="clearfix mb-3"></div>

                        <label class="form-label m-0">Property History </label><br>
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center mt-1">
                                <textarea class="form-control " name="property_history" type="text" rows="3">{{$secondary_level_unit_data->property_history}}

                                </textarea>
                            </div>
                        </div>

                        <div class="clearfix mb-3"></div>

                        <label class="form-label m-0">Development Potential </label><br>
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center mt-1">
                                <textarea class="form-control" name="development_potential" type="text" rows="3">{{$secondary_level_unit_data->development_potential}}

                                </textarea>
                            </div>
                        </div>
                        <div class="clearfix mb-3"></div>
                        <div class="row align-items-center mb-1">
                            <div class="col-md-2 mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div> <!-- container-fluid -->
        </form>
    </div><!-- End Page-content -->

</div>
@endsection
@push('scripts')
<script src="{{url('public/assets/js/property/extra.js')}}"></script>
<script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=41"></script>
<script src="{{ url('public/assets/js/demolished-image-compression-helper.js') }}?v=85225"></script>
<script>
    // @foreach($errors -> all() as $error)
    // toastr.error("{{ $error }}")
    // @endforeach
    // @if(Session::has('message'))
    // toastr.success("{{ Session::get('message') }}")
    // @endif
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $(document).ready(function() {

        $("#ShowBuiltUp").on('click', function() {
            $('#BuiltUp').show();
            $('#ShowBuiltUp').hide();
        });
        $("#ShowSuperBuiltUp").on('click', function() {
            $("#SuperBuiltUp").show();
            $("#ShowSuperBuiltUp").hide();
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
        $('form[id=SubmitDemolished]').submit(function(e) {
            toggleLoadingAnimation();
            $('.progress-bar').removeClass('active');

            // $(".nextBtn").on("click", function() {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('surveyor.property.unit_details.demolished.update_property_details')}}",
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
                    toastr.success("Record Updated Successfully")
                    $('.input-error').remove();
                    $('input').removeClass('is-invalid');
                    $('.btn-primary').addClass('nextBtn');
                    if (currentScreen < $screens.length - 1) {
                        currentScreen++;
                        showScreen(currentScreen);
                        progressbar++;
                        showAtive(progressbar);
                    }
                    var unit_id = response.data;
                    var url = "{{ route('surveyor.property.demolished.unit_details', [':id']) }}";
                    url = url.replace(':id', unit_id);
                    window.location.href = url;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toggleLoadingAnimation();
                    $('.input-error').remove();
                    $('input').removeClass('is-invalid');
                    if (jqXHR.status == 422) {
                        for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                            toastr.error(value[0]);
                            if (key.startsWith('demolished_images')) {
                                $("#DemolishedImages").append('<span class="input-error" style="color:red">' + value + '</span>');
                            }
                            $('form[id=SubmitDemolished] input[name=' + key + ']').addClass(
                                'is-invalid');
                            $('form[id=SubmitDemolished] input[name=' + key + ']').after(
                                '<span class="text-danger input-error" role="alert">' + value +
                                '</span>');
                            $('form[id=SubmitDemolished] textarea[name=' + key + ']').addClass('is-invalid');
                            $('form[id=SubmitDemolished] textarea[name=' + key + ']').after(
                                '<span class="text-danger input-error" role="alert">' + value + '</span>');

                            $('#err' + key).after('<span class="input-error" style="color:red">' + value + '</span>');
                        }
                        $('.btn-primary').removeClass('nextBtn');

                    } else {
                        // alert('something went wrong! please try again..');
                    }
                },

            });
        })


    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
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

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#amenity-files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
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
        if (window.File && window.FileList && window.FileReader) {
            $("#InteriorFiles").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#interior-files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
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
        if (window.File && window.FileList && window.FileReader) {
            $("#FloorPlanFiles").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#floor-plan-files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
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
</script>

@endpush