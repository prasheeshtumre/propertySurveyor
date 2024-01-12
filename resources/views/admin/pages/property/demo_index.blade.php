@extends('admin.layouts.main')
@section('content')
@push('css')
<link href="{{ asset('assets/css/property-primary-details.css') }}?v=34567" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/autocompleteDropdown.css') }}?v=85744454 " rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icm_zone_ui.css') }}?v=1" rel="stylesheet" type="text/css" />
@endpush
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Basic Details</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row my-4">
                    <div class="col-6">
                        <span class="status-bar-s1-label">1</span>
                        <div class="progress" style="height:2px;">
                            <div class="progress-bar bg-info status-bar-s1" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <span class="status-bar-s2-label in-active">2</span>
                        <div class="progress" style="height:2px;">
                            <div class="progress-bar bg-info status-bar-s2" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="defined_fields d-none">

                    @forelse($sub_categories as $key=>$cat)
                    @if (!empty($cat->blade_slug))
                    <div class="{{ str_replace('.', '_', $cat->blade_slug) }}">
                        @include('admin.pages.property.' . $cat->blade_slug, [
                        'parent_prop_cat' => $cat->id,
                        ])
                    </div>
                    @endif
                    @empty
                    @endforelse
                </div>

                @include('admin.pages.property.step_1')

                <div class="step step-2 d-none">
                    <div class="card">
                        <div class="card-body ">

                            <div class="property-identity row">
                                <div class="form-group col-auto">
                                    <label for=""><strong>Gis ID : </strong></label>
                                    <span id="d-gis-id"></span>
                                </div>
                                <div class="form-group col-auto">
                                    <label for=""><strong>Address : </strong></label>
                                    <span id="d-address"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <form action="{{ route('surveyor.property.image.dropzone.store') }}" method="post"
                                    name="file" files="true" enctype="multipart/form-data" class="dropzone"
                                    id="image-upload">
                                    @csrf
                                    <div>
                                        <!-- <h3 class="text-center">Upload Images</h3> -->

                                    </div>
                                    <div class="dz-message" data-dz-message><span>Drop files here to upload</span><span class="text-danger">*</span></div>
                                    </form> --}}
                                    <form class="unit-gallery-zone icm-zone">
                                        <div class="icm-file-list"></div>
                                        <input type="hidden" name="prop_id" id="prop_id" value="215">
                                        <input type="file" id="imageInput" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.image.dropzone.store') }}">
                                        <div class="row old-files-icm-lable-preview-group">
                                            <label for="imageInput" class="icm-zone-label col">Click here to upload Images.</label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form action="{{ route('surveyor.property.image.store') }}" method="post" id="" enctype="multipart/form-data">
                                @csrf

                                <div class="col-xxl-3 col-md-3 mt-3 d-none">
                                    <div>
                                        <label for="files" class="form-label">
                                            Capture Property Images
                                            <span class="errorcl">*</span></label>
                                        <div class="d-flex justify-content-center flex-column ">
                                            <input type="file" name="files[]" id="files" class="form-control files" multiple placeholder=" " style="display:none;">
                                            <label for="files" class="form-label btn add-property hoverfEffect  upload-images-lab  p-0 d-flex align-items-center justify-content-center ">
                                                <span class="mdi mdi-tray-arrow-up mdi-24px mx-2"></span>
                                                <span> Capture Property Images</span></label>
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


                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input p-ufs-ufr" type="checkbox" name="up_for_sale" id="property_ufs">
                                            <label class="form-check-label" for="property_ufs">
                                                up for Sale
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input p-ufs-ufr" type="checkbox" name="up_for_rent" id="property_ufr">
                                            <label class="form-check-label" for="property_ufr">
                                                up for Rent
                                            </label>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-xxl-12 col-md-12 mt-3">
                                    <div>
                                        <label for="" class="form-label">Remarks </label>
                                        <textarea name="remarks" id="remarks" class="form-control" rows="3" value="{{ old('remarks') }}"></textarea>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-done btn-primary mb-2" id="prev"><i class="fa fa-arrow-left"></i>&nbsp; Previous</button>
                                    <button type="button" class="btn btn-done btn-primary save-file-uploads mb-2" id="">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title -->

        <!--end row-->

    </div> <!-- container-fluid -->
</div>
<div class="modal fade" id="gis_exists_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modamodal-md ">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p id="def-msg-pe">Property existed with this GIS id, Please Click here <a href="" id="edit_gis_id"></a> to add
                    Details</p>
                <h5 id="ad-msg"><span></span></h5>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="server-error-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"></h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 m-0">
                <span id="server-error-msg">

                </span>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/image-compression-helper.js') }}?v=23456"></script>
<script src="{{ asset('assets/js/property/add-floors.js') }}?v=456789"></script>
<!-- <script src="{{ asset('assets/js/property/add-images.js') }}?v=985"></script> -->
<script src="{{ asset('assets/js/property/split-merge.js') }}?v=7654"></script>
<!-- <script src="{{ asset('assets/js/property/get-builder-sub-groups.js') }}?v=4"></script> -->
<script src="{{ asset('assets/js/property/primaryDetailsInputHelper.js') }}?v=452999"></script>
<script src="{{ asset('assets/js/property/generate-temp-GISID.js') }}?v=5522"></script>
@if($gis_id_status === false && $generate_temp_gis_id_status != true)
<script>
    $(function() {
        toastr.error('invalid GIS ID');
    });
</script>
@endif
@if($gis_id_status === false && $generate_temp_gis_id_status == true)
<script>
    $(function() {
        generateTempGisId("{{$lat ?? 0}}", "{{$long ?? 0}}");
        /* disable pick my location button*/
        $('.pick__my-location').prop('disabled', true);
        $('#longitude').attr('readonly', true);
        $('#longitude').attr('readonly', true);
    });
</script>
@endif
<script>
    $(document).ready(function() {

        // $('.select2-dd').select2();

        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $('#uploadBtn').click(function(e) {
            e.preventDefault();

            var formData = new FormData($('#myForm')[0]);

            $.ajax({
                url: '/upload',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });
        $(document).on('click', '.p-ufs-ufr', function() {
            if ($(this).prop('checked') == true) {
                $('.p-ufs-ufr').each(function() {
                    $(this).prop('checked', false);
                })
                $(this).prop('checked', true);
            }
        });

        $(document).on('click', '.save-file-uploads', function() {
            var formData = new FormData();
            var files = $('#imageInput')[0].files;
            if (files.length == 0) {
                toastr.error('Image files are required');
                return false;
            }
            // let $('#frm input[type=file]').get(0).files.length

            formData.append('property_id', $('#property_id').val());
            let upForSale = ($('#property_ufs').prop('checked') == true) ? 1 : 0;
            let upForRent = ($('#property_ufr').prop('checked') == true) ? 1 : 0;
            let remarks = $('#remarks').val();
            formData.append('up_for_sale', upForSale);
            formData.append('up_for_rent', upForRent);
            formData.append('remarks', remarks);
            toggleLoadingAnimation();

            $.ajax({
                url: "{{ route('surveyor.property.image.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success response
                    toggleLoadingAnimation();
                    let message =
                        'Property Added Successfully'; // Replace 'Your message here' with your actual message
                    localStorage.setItem('message', message);
                    let back_url =
                        "{{ url('surveyor/basic_details') }}"; // Replace 'Your message here' with your actual message
                    localStorage.setItem('back_url', back_url);
                    window.location.replace("{{ route('completed') }}");
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    toggleLoadingAnimation();
                    console.error(error);
                }
            });
        });
        Dropzone.options.imageUpload = {
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
    });
</script>

<script>
    var floorNames = [];
    $(document).on('keyup', "input[name=nth_floor_name]", function() {
        floorNames = [];
        $("input[name=nth_floor_name]").each(function(i) {
            floorNames.push({
                "id": i,
                "text": $(this).val()
            });
        });
        console.log(floorNames);
        $(".commercial-select2").empty();
        $.each(floorNames, function(key, value) {
            $(".commercial-select2").append('<option value="5">' + value.text + '</option>');
        });
        //  $(".js-select2").append('<option value="5">Twitter</option>');
    });

    $(".commercial-select2").select2({
        closeOnSelect: false,
        placeholder: "select units",
        allowHtml: true,
        allowClear: true,
    });

    $(document).on('change', '#category', function(e) {
        let gisId = $('#gis_id').val();
        if (gisId == '') {
            toastr.error('GID field is required.');
            return false
        }
        let id = $(this).val();
        let category_type = $(this).attr('id');
        let bladeSlug = $(this).find(':selected').data('blade-slug');
        let fields = $('.' + bladeSlug).html();
        $('#defined_block').html(fields);
        $('.category-fields-container').html('');
        initiateSelectDD();
        autoCompleteBuilderSearch('.select-suggestions', {
            multiple: true
        });
        ($('#create_property input[name="city"]').is(':visible')) ? fetchCity(): '';
        autoCompleteConstructionPartnerSearch('.construction-partner-select-suggestions');
        autoCompleteAreaSearch('.area-select-suggestions');
    });

    // $(document).on('blur', '#gis_id', function(e) { });

    function validateGISID() {
        let gisId = $('#gis_id').val();
        $.ajax({
            type: "GET",
            url: "{{ url('check_gis_id') }}",
            dataType: "json",
            data: {
                gis_id: gisId
            },
            success: function(response) {
                $('#gis_exists_modal').modal('show');
                $('#edit_gis_id').html($('#gis_id').val());
                $('#gis_id').val('');
                if (response.message != undefined) {
                    $('#def-msg-pe').hide()
                    $('#ad-msg').html(response.message);
                } else {
                    $('#def-msg-pe').show();
                    $('#edit_gis_id').attr('href', "{{ url('surveyor/property/edit_details/') }}/" +
                        response.property_id);
                }

                if (!$('.global-loader-container').hasClass('d-none')) {
                    toggleLoadingAnimation();
                }
            },
            error: function(xhr, status, error) {
                gisIDXhrError(xhr);
            }
        });
    }

    $(document).on('click', '.propert-gcc', function() {
        let propertGcc = $(this).val();
        $('#property_gcc').val(propertGcc);

    })
    // .bind('change', function(){
    //     alert($('#create_property input[name="city"]').is(':visible'));
    //     let gisId = $('#gis_id').val();
    //     ($('#create_property input[name="city"]').is(':visible')) ? fetchCity() : '';
    // })

    $(document).on('change', '.get_subcat_options', function(e) {
        let c_id = $(this).val();
        $('#create_property .get-category-fields').empty();

        $('#create_property .get-category-fields').append(new Option('Select Category', ''));
        $.ajax({
            type: "GET",
            data: {
                c_id: c_id
            },
            url: "{{ url('surveyor/ajax/sub_categories') }}",
            success: function(response) {
                $('#create_property #plot_land_types').empty();
                if (response.length == 0) {
                    $("#create_property #plot_land_types").append('<option selected >--Select Category--</option>');
                }
                if (response) {
                    $.each(response, function(key, value) {
                        $('#create_property .get-category-fields').append($("<option/>", {
                            value: value.id,
                            text: value.cat_name
                        }));
                    });
                }
            }
        });

    });

    // $('.get-category-fields')

    $(document).on('change', '.get-category-fields', function(e) {
        let id = $(this).val();
        let category_type = $(this).attr('id');
        let gisId = $('#gis_id').val();
        $.ajax({
            type: "GET",
            url: "{{ url('get_defined_block') }}",
            data: {
                c_id: id
            },
            success: function(response) {
                $('.category-fields-container').html(response.defined_block);
                initiateSelectDD();
                autoCompleteBuilderSearch('.select-suggestions', {
                    multiple: true
                });
                // autoCompleteAreaSearch('.area-select-suggestions', { multiple: true});
                ($('#create_property input[name="city"]').is(':visible')) ? fetchCity(): '';
                autoCompleteConstructionPartnerSearch('.construction-partner-select-suggestions');
                autoCompleteAreaSearch('.area-select-suggestions');
            },
            error: function(error) {

            }
        });
    });

    $(document).on('change', '#comm_type_of_unit', function() {
        ($(this).val() == 1) ? $('.floor-chk').removeClass('d-none'): $('.floor-chk').addClass('d-none');
        ($(this).val() == 2) ? $('.unit-chk').removeClass('d-none'): $('.unit-chk').addClass('d-none');
    });

    $(document).on('change', '#comm_type_of_unit_child_dd', function() {
        let dependentDdown = $(this).val();
        dependentDdown = dependentDdown.toLowerCase();
        (dependentDdown == 'occupied') ? $('.commercial-' + dependentDdown + '-child').removeClass('d-none'): $(
            '.commercial-tou-name-children').addClass('d-none');
    });





    // add units for floor
    $(document).on('click', ".add-unit", function() {
        let pId = $(".storey").index($(this).closest('.storey'));
        let floorIdOc = $(this).data('floor_id');
        floorIdOc = (floorIdOc == undefined) ? 0 : floorIdOc;
        // alert(floorIdOc);
        // get no of units count
        let count = $(this).closest('.storey-nou-child').find('.no_of_units').val();
        // generate units only if no of units value is greater than 1
        let currentStoreyUnitCount = $(this).closest('.storey').find('.storey-unit').length;
        // let finalCount = (currentStoreyUnitCount > count ) ? currentStoreyCount - count : count ;
        let totalCount = parseInt(currentStoreyUnitCount) + parseInt(count);
        if (count > 1 || currentStoreyUnitCount > 1) {
            // alert('start : '+currentStoreyUnitCount+'totalCount : '+ totalCount)
            let totalFloors = getUnits(currentStoreyUnitCount, totalCount, pId, floorIdOc);
            // append units html to respective floor
            (currentStoreyUnitCount > 0) ?
            $(totalFloors).insertAfter($(this).closest('.floor-dds_row').nextAll('.unit-container').first()
                    .find('.storey-unit').last()): $(this).closest('.floor-dds_row').nextAll('.unit-container')
                .first().html(totalFloors);
            $(".remove-storey-unit").addClass('d-none');
            $('.storey').each(function() {
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass(
                    'd-none');
                let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                $(this).find('.no_of_units').val(currentStoreyUnitLength)
            });
            $(this).closest('.floor-dds_row').find('.append-dd-to').addClass('d-none');

            $(this).closest('.storey').find('.unit-tfd').addClass('d-none');
            $(this).closest('.floor-dds_row').find('.floor-ufs-ufr').prop('checked', false);
        } else {
            ($('#category').val() == 3) ?
            ($(this).closest('.floor-dds_row').find('.append-dd-to').andSelf().slice(0, 2).removeClass(
                'd-none')) :
            ($(this).closest('.floor-dds_row').find('.append-dd-to').first().removeClass('d-none'));
            $(this).closest('.storey').find('.storey-unit').remove();
            // $(this).closest('.storey').find('.unit-tfd').removeClass('d-none');
        }
        $('.storey').each(function() {
            $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass(
                'd-none')
        })
        setTimeout(() => {
            ($('.floor-parent-' + pId).prop('checked') === true) ?
            ($('.nouc-' + pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',
                true)) :
            $('.nouc-' + pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',
                false);
        }, 600);
        $('.un_unit_type_dd').select2();

    });

    // delete floor
    $(document).on('click', ".remove-storey", function() {
        let storey_id = ($(this).data('floor_id') != undefined) ? $(this).data('floor_id') : 0;
        if (storey_id != 0) {
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('remove_floor') }}",
                data: {
                    floor_id: storey_id
                },
                success: function(response) {
                    // $('.storey').remove();
                    // let floors = getPropertyFloors(response.data.id)
                }
            });
        }

        $(this).parent().remove();
        $(".remove-storey").last().removeClass('d-none');
        let currentStoreyLength = $('#create_property .storey').length;
        $('#create_property  .no_of_floors').val(currentStoreyLength);
    });

    // delete unit
    $(document).on('click', ".remove-storey-unit", function() {
        let storey_unit_id = ($(this).data('unit_id') != undefined) ? $(this).data('unit_id') : 0;
        if (storey_unit_id != 0) {
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('remove_unit') }}",
                data: {
                    unit_id: storey_unit_id
                },
                success: function(response) {
                    // $('.storey').remove();
                    // let floors = getPropertyFloors(response.data.id)
                }
            });
        }
        let currentStoreyUnits = $(this).parent().closest('.unit-container').find('.storey-unit');
        // $(this).parent().closest('.storey').find('.add-unit').trigger('click');
        (currentStoreyUnits.length == 2) ? $(this).parent().closest('.unit-container').parent().find('.floor-dds_row').find('.append-dd-to').first().removeClass('d-none'): '';
        (currentStoreyUnits.length == 2) ? currentStoreyUnits.remove(): $(this).parent().remove();

        $('.storey').each(function() {
            $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass(
                'd-none');
            let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
            $(this).find('.no_of_units').val(currentStoreyUnitLength)
        });

    });

    $(document).on('click', ".floor-ufs-ufr", function() {
        let ufsUfrLength = $(this).closest('.storey').find('.floor-ufs-ufr').filter(':checked').length;
        let unitType = $(this).closest('.storey').find('.floor_unit_type_dd').first().val();
        if ($(this).prop('checked') == true) {
            $(this).closest('.floor-parent__ufs-ufr').find('.floor-ufs-ufr').not($(this)).prop('checked', false);
            $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').removeClass('d-none');
        } else {
            (ufsUfrLength == 0) ? $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd')
                .addClass('d-none'): '';
        }
    });
    $(document).on('click', ".unit-ufs-ufr", function() {
        let ufsUfrLength = $(this).closest('.storey-unit').find('.unit-ufs-ufr').filter(':checked').length;
        let unitType = $(this).closest('.storey-unit').find('.floor_unit_type_dd').first().val();
        if ($(this).prop('checked') == true) {
            $(this).closest('.unit-parent__ufs-ufr').find('.unit-ufs-ufr').not($(this)).prop('checked', false);
            $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').removeClass('d-none');
        } else {
            (ufsUfrLength == 0) ? $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd')
                .addClass('d-none'): '';
        }
    });

    //  append  unit drop-down optioins to floors and units
    $(document).on('change', '.floor_ddopt, .unit_ddopt', function() {
        //to get and enable or display next unit drop-down element parenet block
        let next_parent_element = $(this).closest('.append-dd-to').nextAll('.append-dd-to').first();
        let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
        let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
        let current_block_other_text_elements = $(this).closest('.append-dd-to').nextAll('.brand-tfd');
        // to get next occured unit drop-down 
        let fieldType = $(this).find(':selected').data('field');
        let fieldOtherType = $(this).find(':selected').data('others')
        let next_ddopt_child = ($(this).hasClass('floor_ddopt')) ?
            next_parent_element.find('.floor_ddopt') :
            next_parent_element.find('.unit_ddopt');
        // let uType = $(this).val() = 2;
        let cat_id = $(this).val();
        let propertyId = $('#property_id').val();
        let prop_cat = $(this).parent().closest('.dds_row').find('.prop_category_dd').first().val();

        $.ajax({
            type: "GET",
            data: {
                cat_id: cat_id,
                property_id: propertyId
            },
            url: "{{ url('get_unit_categories') }}",
            success: function(response) {
                if (cat_id != null) {
                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) ?
                    (next_parent_element.addClass('d-none')) :
                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 3) ?
                    (prop_cat == 1) ? next_parent_element.removeClass('d-none'): (next_parent_element
                        .addClass('d-none')): '';
                    $(next_ddopt_child).empty();
                    if (response.data) {
                        if (fieldType == 'select') {
                            $(next_ddopt_child).append(
                                '<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            $(current_block_text_elements).addClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                        } else if (fieldType == 'text') {
                            $(current_block_text_elements).removeClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            $(current_block_dd_elements).addClass('d-none');
                        }
                        //this will get hit after first dd change
                        else if (fieldType == undefined || fieldType == '') {
                            $(next_ddopt_child).append(
                                '<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });

                            $.each(response.other_options, function(key, value) {
                                next_ddopt_child.append($("<option></option>").attr({
                                    "value": value.brand_name,
                                    "data-others": 'others'
                                }).text(value.brand_name));
                            });

                        }
                        if (fieldOtherType == 'others') {
                            $(current_block_other_text_elements).removeClass('d-none');
                        }

                    }
                    $(next_ddopt_child).select2({
                        minimumResultsForSearch: -1
                    });

                    initiateSelectDD()
                }


            },
            error: function(xhr, status, error) {

                // let text = ((typeof(xhr.status) != "undefined" && xhr.status !== null) ? xhr.status : 'error-code') + " : " + ((typeof(message) != "undefined" && message !== null) ? message : '') + " error-message" + ", Please click on save or Try again Later";
                $('#server-error-modal').modal('show');
                $('#server-error-msg').html('<p class="h4 text-success text-center"> Message : Please Try Again Later.</p>');
                $('#server-error-modal').modal('show');
                if (!$('.global-loader-container').hasClass('d-none')) {
                    toggleLoadingAnimation();
                }
            }
        });

    });

    $(document).on('change', '.prop_category_dd', function() {
        let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
        let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');

        $(current_block_text_elements).each(function() {
            $(this).addClass('d-none');
        });
        $(current_block_dd_elements).each(function() {
            if (!$(this).hasClass('u-type')) {
                $(this).addClass('d-none');
            } else {
                let currentDD = $(this).find('.futd');
                // let currentDD = $(this).find('.futd');
                $(currentDD).val("--Select Category--").trigger("change");
            }
        });
    });

    function initiateSelectDD() {
        $('.select2-dd').select2({
            minimumResultsForSearch: -1
        });
        $('.is-searchable').select2();
        $('.ddopt_te').select2({
            tags: true,
        });
    }

    // add custom brand
    $(document).on('click', '.add-fbrand', function(e) {
        e.preventDefault();
        $(this).closest('.storey').find('.brand-tfd').first().removeClass('d-none')
    });

    $(document).on('click', '.merge_other_units', function() {
        if ($(this).prop('checked') === true) {
            $(this).parent().closest('.unit-container').addClass('active-unit-merge');
            $(this).addClass('active');
            $(this).parent().find('.merge_other_unit_lable').removeClass('btn-outline-primary');
            $(this).parent().find('.merge_other_unit_lable').addClass('btn-primary');
            $('.merge_other_units').each(function() {
                if (!$(this).hasClass('active')) {
                    $(this).prop('disabled', true)
                } else {
                    $(this).prop('disabled', false)
                }
            });
            $('.unit-container').each(function() {
                if (!$(this).hasClass('active-unit-merge')) {
                    $(this).find('.unit-chk').removeClass('d-none')
                } else {
                    $(this).find('.unit-chk').addClass('d-none')
                }
            });

            $('.oup-unit').addClass('d-none');

            // unit-parent-floor
            let index = -1;
            let currentUnitIndex = 0;
            $(this).parent().closest('.unit-container').find('.merge_other_units').each(function() {
                index++;
                if ($(this).hasClass('active')) {
                    currentUnitIndex = index;
                }
            });
            let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
            // alert(currentFloorIndex);
            // alert(currentUnitIndex);
            $('#unit-parent-floor').val(currentFloorIndex);

            ($(this).data('uid') != undefined) ? ($('#parent-unit').val($(this).data('uid')), $('#unit-exist')
                .val(1)) : ($('#parent-unit').val(currentUnitIndex), $('#unit-exist').val(0));

            $(this).parent('.unit-merge-group').find('.save-unit-merge').removeClass('d-none');

            // current storey unit input validations
            // $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
            let reqElements = $(this).parent().closest('.storey-unit').find('input, select').addClass(
                'req-validate');
            reqElements.each(function() {
                $(this).not(':hidden').addClass('req-validate');
            })
        }
        if ($(this).prop('checked') === false) {
            $(this).parent().closest('.unit-container').removeClass('active-unit-merge');
            $(this).removeClass('active');
            $(this).parent().find('.merge_other_unit_lable').addClass('btn-outline-primary');
            $(this).parent().find('.merge_other_unit_lable').removeClass('btn-primary');
            $('.merge_other_units').prop('disabled', false)
            $('.unit-chk').addClass('d-none');
            $('#unit-exist').val(0);
            $('#parent-unit').val('');
            $('#unit-parent-floor').val('');
            $(this).parent('.unit-merge-group').find('.save-unit-merge').addClass('d-none')
        }

    });

    $(document).on('click', '.merge_other_floors', function() {
        let currentFloorIndex = $(".storey").index($(this).closest('.storey'));

        $('.floor-chk').each(function() {
            ($(this).prop('checked') === false) ? $(this).addClass('d-none'): '';
        });

        $('.unit-chk').each(function() {
            ($(this).prop('checked') === false) ? $(this).addClass('d-none'): '';
        });

        $(this).parent().find('.floor-merge-btn').removeClass('btn-outline-primary');
        $(this).parent().find('.floor-merge-btn').addClass('btn-primary');
        let catId = $('#category').val();
        let currentStorey = $(this).parent().closest('.storey');
        if ($(this).prop('checked') === true) {
            //checking for multi-unit catergory and disabling the floors which are not having same property type category as the current
            //starts 

            if (catId == 3) {
                let propCategoryDDID = currentStorey.find('.prop_category_dd').val();
                $('.storey').each(function() {
                    if ($(this).find('.prop_category_dd').val() != propCategoryDDID) {
                        $(this).find('.floor-chk').addClass('merge_chk_visibility');
                    }
                });
            }
            //ends
            ($(this).data('fid') != undefined) ? $('#parent-floor').val($(this).data('fid')): $('#parent-floor')
                .val(currentFloorIndex);


            $('.no_of_units, .add-unit').prop('disabled', false);
            $(this).closest('.storey').find('.no_of_units').val(0);
            $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
            $(this).closest('.storey').find('.add-unit').prop('disabled', true);

            //
            $('.floor-chk').removeClass('d-none');
            $(this).closest('.storey').find('.floor-chk').addClass('d-none');
            $('.oup-floor').addClass('d-none');
            $('.save-merge-btn').addClass('d-none');
            $(this).closest('.storey').find('.save-merge-btn').removeClass('d-none')

            $(this).closest('.storey').find('.unit-container').html('');

        }

        if ($(this).prop('checked') === false) {
            $('#parent-floor').val('')
            $('.floor-chk').addClass('d-none');
            $('.floor-chk').prop('checked', false);
            $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
            $(this).closest('.storey').find('.add-unit').prop('disabled', false);
            $(this).closest('.storey').find('.save-merge-btn').addClass('d-none');
            $(this).parent().find('.floor-merge-btn').addClass('btn-outline-primary');
            $(this).parent().find('.floor-merge-btn').removeClass('btn-primary');
            //checking for multi-unit catergory and disabling the floors which are not having same property type category as the current
            //starts 
            if (catId == 3) {
                let propCategoryDDID = currentStorey.find('.prop_category_dd').val();
                $('.storey').each(function() {
                    if ($(this).find('.prop_category_dd').val() != propCategoryDDID) {
                        $(this).find('.floor-chk').removeClass('merge_chk_visibility');
                    }
                });
            }
            //ends
        }
    });

    // floor-parent-
    $(document).on('click', '.floor-chk', function() {
        if ($(this).prop('checked') === true) {
            $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
            $(this).closest('.floor-dds_row').find('.no_of_units').val(0);
            $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
            $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled', true);
            $(this).closest('.storey').find('.merge_other_floors').prop('disabled', true);

        } else {
            // $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
            $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
            $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled', false);
            $(this).closest('.storey').find('.merge_other_floors').prop('disabled', false);
        }

    });

    $(document).on('click', '.unit-chk', function() {
        ($(this).prop('checked') === true) ?
        (
            $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled', true)
        ) :
        (
            $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled', false)
        );

    });



    $(document).on('click', '.remove-merge', function(e) {
        remove_merge();
        $(".remove-storey").last().removeClass('d-none');
        let currentStoreyLength = $('.storey').length;
        $('#create_property .no_of_floors').val(currentStoreyLength);
        toggleLoadingAnimation();

    });

    function remove_merge() {
        $('.loader-container').removeClass('d-none');
        var temp_floors = null;
        let c_id = $('#category').val();
        let property_id = $('#property_id').val();

        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('remove_merge') }}",
            data: {
                c_id: c_id,
                property_id: property_id
            },
            success: function(response) {
                toggleLoadingAnimation();
                $('.storey').remove();
                let floors = getPropertyFloors(property_id)
                $(floors).insertAfter("#create_property .append-floors")
                $('.select2-dd').select2();

                $('.storey').each(function() {
                    $(this).children().find('.storey-unit').last().find('.remove-storey-unit')
                        .removeClass('d-none');
                    let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                    $(this).find('.no_of_units').val(currentStoreyUnitLength)
                });

                if (response.data.floors_merge_status == 0 || response.data.units_merge_status == 0) {
                    $('.remove-merge-ele').addClass('d-none');
                }
            }
        });
    }

    function getUnits(startIndex, count, floor_id, floorIdOc) {
        toggleLoadingAnimation();
        var temp_units = null;
        let c_id = $('#category').val();
        let propertyId = $('#property_id').val();
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: "{{ url('get_units') }}",
            data: {
                c_id: c_id,
                count: count,
                floor_id: floor_id,
                start_index: startIndex,
                property_id: propertyId,
                floor_idoc: floorIdOc
            },
            success: function(response) {
                toggleLoadingAnimation();
                temp_units = response;
            }
        });

        return temp_units;
    }

    function getPropertyFloors(property_id) {
        var temp_floors = null;
        let c_id = $('#category').val();
        $.ajax({
            type: "GET",
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('get_edit_floors') }}",
            data: {
                c_id: c_id,
                property_id: property_id
            },
            success: function(response) {
                temp_floors = response;
            }
        });

        return temp_floors;
    }


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

    $(document).on('click', '.save-floor-merge', function(e) {
        $('.loader-container').removeClass('d-none');
        let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_floor_merge') }}" : $(
            '#create_property').attr('action');
        toggleLoadingAnimation();
        saveProperty(save_floor_merge_url, 'save-floor-merge');
    });

    $(document).on('click', '.save-unit-merge', function(e) {
        $('.loader-container').removeClass('d-none');
        let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_unit_merge') }}" : $('#create_property').attr('action');
        // saveProperty(save_floor_merge_url);
        toggleLoadingAnimation();
        $.ajax({
            url: save_floor_merge_url,
            type: 'POST',
            dataType: 'json',
            data: $('#create_property').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#create_property').attr('action', response.data.action_url);
                $('#property_id').val(response.data.id);
                $('.storey').remove();
                let floors = getPropertyFloors(response.data.id)
                $(floors).insertAfter("#create_property .append-floors")
                $('.select2-dd').select2();
                // $('.remove-merge-ele').removeClass('d-none')
                if (response.data.floors_merge_status == 1 || response.data.units_merge_status ==
                    1) {
                    $('.remove-merge-ele').removeClass('d-none');
                }
                toastr.success('Units merged successfully');
                toggleLoadingAnimation();
                $(".remove-storey").last().removeClass('d-none');
                let currentStoreyLength = $('.storey').length;
                $('#create_property  .no_of_floors').val(currentStoreyLength);

                $('.storey').each(function() {
                    $(this).children().find('.storey-unit').last().find(
                        '.remove-storey-unit').removeClass('d-none');
                    let currentStoreyUnitLength = $(this).children().find('.storey-unit')
                        .length;
                    $(this).find('.no_of_units').val(currentStoreyUnitLength)
                });
            },
            error: function(xhr) {
                $('.loader-container').addClass('d-none');
                if (xhr.status === 422) {
                    $('.flash-errors').remove();
                    var errors = xhr.responseJSON.errors;
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('<span class="input-error flash-errors" style="color: red">' +
                            value[0] + '</span>').insertAfter('input[name=' + key + ']');
                    });
                }
            }
        });

    });

    function saveProperty(save_merge_url, ele = null) {

        $.ajax({
            url: save_merge_url,
            type: 'POST',
            dataType: 'json',
            data: $('#create_property').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('.loader-container').addClass('d-none');
                $('#create_property').attr('action', response.data.action_url);
                $('#property_id').val(response.data.id);
                $('#prop_id').val(response.data.id);
                $('.storey').remove();
                let floors = getPropertyFloors(response.data.id)
                $(floors).insertAfter("#create_property .append-floors")
                initiateSelectDD();
                if (response.data.floors_merge_status == 1 || response.data.units_merge_status == 1) {
                    $('.remove-merge-ele').removeClass('d-none');
                }
                // $('.remove-merge-ele').removeClass('d-none');
                toggleLoadingAnimation();
                $(".remove-storey").last().removeClass('d-none');
                let currentStoreyLength = $('#create_property  .storey').length;
                $('#create_property .no_of_floors').val(currentStoreyLength);
                let GISID = $('#gis_id').val();
                $('#split-property').removeClass('ctfd-required');

                if ($('#merge-gis').prop('checked') === true || $('#split-gis').prop('checked') === true) {
                    $('.split-merge-gis').prop('checked', false);
                    setSplitMergeOptionDataAttributes(GISID, false);

                }
                $('.split-merge-container').html('');
                if ($('#merge-gis').prop('checked') === true) {
                    // $('.split-merge-container').find(' button, .mgis-id').prop('disabled', true);

                }

                (ele == 'create_property_btn') ?
                (
                    $('#nextBtn').removeClass('d-none'),
                    toastr.success('Property Details Saved successfully'),
                    $('#d-gis-id').html($('input[name="gis_id"]').val()),
                    $('#d-address').html($('#create_property input[name="locality_name"]').val() ?? 'N/A')
                ) :
                (ele == 'nextBtn') ?
                (
                    $('.step-1').addClass('d-none'),
                    $('.step-2').removeClass('d-none'),
                    $('.status-bar-s2').css('width', '100%'),
                    $('.status-bar-s2-label').removeClass('in-active')
                ) :
                (ele == 'save-floor-merge') ?
                (
                    toastr.success('Floors merged successfully')
                ) :
                '';
            },
            error: function(xhr) {
                $('.loader-container').addClass('d-none');
                if (xhr.status === 422) {
                    $('.flash-errors').remove();
                    var errors = xhr.responseJSON.errors;
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        // $('<span class="input-error flash-errors" style="color: red">' + value[0] +
                        //     '</span>').insertAfter('input[name=' + key + ']');
                        $('input[name=' + key + ']').addClass('is-invalid');
                        console.log(key);
                    });
                }
                throwXhrError(xhr);
            }
            // }
        });
    }



    // $(document).on('click', '.next-step,#nextBtn', function() {
    //     $('.step-1').addClass('d-none');
    //     $('.step-2').removeClass('d-none');
    //     $('.status-bar-s2').css('width', '100%');
    //     $('.status-bar-s2-label').removeClass('in-active');

    //     // toggleLoadingAnimation();
    // });
    function setSplitMergeOptionDataAttributes(GISID, toggleOptions) {
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('surveyor/split-merge-options') }}",
            data: {
                gis_id: GISID,
            },
            success: function(response) {
                if (response.splits > 1) {
                    $('.split-merge-data-container').html(`<span class="badge bg-success">This Property Splitted into ${(response.splits > 1 ? (response.splits-1) : 0 )} times </span>`);
                }
                if (response.merges > 0) {
                    let mergeContent = response.mergeContent;
                    if (typeof mergeContent == 'object') {
                        mergeContent = mergeContent.join(',');
                        $('.split-merge-data-container').html(`<span class="badge bg-success">This Property Merged with ${mergeContent} GIS-ID's</span>`);
                    }

                }
                if (toggleOptions) {
                    $('#split-gis').attr('data-option_cnt', response.splits);
                    $('#merge-gis').attr('data-option_cnt', (5 - response.merges));

                    let valueToEnable = response.splits; // Specifying the value you want to enable

                    $('#split-property').find('option').prop('disabled', true); // Disable all options
                    if (valueToEnable <= 5) {
                        $('#split-property').find('option[value="' + valueToEnable + '"]').prop('disabled', false); // Enabling the specific option
                    }
                }

            },
            error: function(xhr, response) {
                gisIDXhrError(xhr);
            }
        });
    }

    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];

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
        $('.geo-loc-error').html('')
        navigator.permissions.query({
            name: 'geolocation'
        }).then(function(result) {
            // Will return ['granted', 'prompt', 'denied']
            (result.state == 'denied') ? $('.geo-loc-error').html('Please Enable Your Location.'): '';
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                $('#latitude').val(lat);
                $('#longitude').val(lon);
            });
        }
    }

    if (performance.navigation.type == 2) {
        // location.reload();
    }
    $('#create_success').on('hiddebs.modal', function() {
        // location.reload();
    });



    $(document).on('click', '#create_property_btn, #nextBtn', function(e) {
        e.preventDefault(); // Prevent default form submission
        var isValid = validateForm();
        let save_merge_url = $('#create_property').attr('action');
        if (isValid) {
            toggleLoadingAnimation();
            let currentBtn = $(this).attr('id');
            saveProperty(save_merge_url, currentBtn);

        }

    });

    $(document).on('click', '#prev', function() {
        $('.step-2').addClass('d-none');
        $('.step-1').removeClass('d-none');
        $('.status-bar-s2-label').addClass('in-active');
        $('.status-bar-s2').css('width', '0%');
        // toggleLoadingAnimation();
    });

    $(document).on('click', '.dz-remove', function() {

    });

    function evaluateValidGISID() {
        let gisId = $('#gis_id').val();
        let tempGisIdStatus = $('#temp-gis-id-status').val();
        var GISIDStatus = true;
        $.ajax({
            type: "GET",
            url: "{{ url('check_gis_id') }}",
            dataType: "json",
            async: false,
            data: {
                gis_id: gisId,
                temp_gis_id_status: tempGisIdStatus
            },
            success: function(response) {
                $('#gis_exists_modal').modal('show');
                $('#edit_gis_id').html($('#gis_id').val());
                $('#gis_id').val('');
                if (response.message != undefined) {
                    alert()
                    $('#def-msg-pe').hide()
                    $('#ad-msg').html(response.message);
                } else {
                    $('#def-msg-pe').show();
                    $('#edit_gis_id').attr('href', "{{ url('surveyor/property/edit_details/') }}/" +
                        response.property_id);
                }
                if (!$('.global-loader-container').hasClass('d-none')) {
                    toggleLoadingAnimation();
                }
                GISIDStatus = false;

            },
            error: function(xhr, status, error) {
                if (xhr.status == 404 || xhr.status == 403) {
                    GISIDStatus = false;
                    gisIDXhrError(xhr);
                }

            }
        });
        return GISIDStatus;
    }

    function validateForm() {
        //calling validateGISID() for validating GISID 
        // ($('#split-gis').prop('checked') === false) ? validateGISID() : '';
        let validGISIDStatus = true;
        let propertyId = $('#property_id').val();
        if ($('#split-gis').prop('checked') === false && propertyId == '') {
            validGISIDStatus = evaluateValidGISID();
        }

        $('.flash-errors').remove();
        var isValid = true;
        let noOfFloors = $('#create_property .no_of_floors');
        let floors = $('#create_property .storey');
        let mergeGISIDValuesValidStatus = true;
        let matchGISMGISStatus = true;
        if ($('#merge-gis').prop('checked') === true) {

            mergeGISIDValuesValidStatus = areMergeGISIDValuesValid('#create_property input[name="mgis_id[]"]', 'property already exists with this Gis-ID.');
            if ($('#create_property input[name="mgis_id[]"]').length == 1) {
                if ($('#gis_id').val() == $('#create_property input[name="mgis_id[]"]').first().val()) {
                    mergeGISIDValuesValidStatus = false;
                    ($('<span class="input-error flash-errors" style="color: red">GIS ID must be unique.</span>')
                        .insertAfter($('#create_property input[name="mgis_id[]"]').first().parent('.input-group')))
                }
            }
            let match_merge_ids = [];
            match_merge_ids.push($('#gis_id').val())
            $('#create_property input[name="mgis_id[]"]').each(function() {

                var value = $(this).val();
                if (match_merge_ids.includes(value)) {
                    matchGISMGISStatus = false;
                    if (value != '') {
                        ($('<span class="input-error flash-errors" style="color: red">GIS ID must be unique.</span>')
                            .insertAfter($(this).parent('.input-group')))
                    }
                    // return false; // Not unique
                }
                match_merge_ids.push(value);

            });
        }
        // alert(mergeGISIDValuesValidStatus)
        $('#create_property .ctfd-required').each(function() {
            var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
            if (value === '' || value === null) {
                isValid = false;
                // 
                ($(this).hasClass('no_of_floors') || $(this).hasClass('mgis-id')) ?
                ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                    .insertAfter($(this).parent('.input-group')), $(this).addClass('is-invalid')) :
                ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                    .insertAfter(this), $(this).addClass('is-invalid'));
            } else {
                $(this).removeClass('is-invalid');
            }
            $('.is-invalid:first').focus();

        });
        let unitNamesUniqueStatus = true;
        let floorNamesUniqueStatus = true;
        let floorUnitTypeDDStatus = true;
        let floorUnitTypeCatDDStatus = true;
        let noOfFloorsStatus = true;
        let floorsStatus = true;

        // Usage

        if ($('.save-floor-merge').is(':visible') == true) {
            toastr.error('Please Click on save button to merge floors.')
            $('.save-floor-merge:visible').addClass('animate-merge-btn');
            $('.save-floor-merge:visible').focus();
            return false;
        }
        if ($('.save-unit-merge').is(':visible') == true) {
            toastr.error('Please Click on save button to merge units.')
            $('.save-unit-merge:visible').addClass('animate-merge-btn');
            $('.save-unit-merge:visible').focus();
            return false;
        }

        if ($('.is-invalid').length > 0) {
            console.log($('.is-invalid').length)
            // cons
            // return false;
        }

        floorNamesUniqueStatus = areInputValuesUnique('#create_property input[name="floor_name[]"]', 'merged-floor-name', 'Floor Name must be unique.');
        unitNamesUniqueStatus = areInputValuesUnique('#create_property .unit-name', 'merged-unit-name', 'Unit Name must be unique.');
        // mergeGISIDValuesValidStatus  = areMergeGISIDValuesValid('#create_property input[name="mgis_id[]"]', 'property already exists with this Gis-ID.');

        $('#create_property .floor_unit_type_dd, #create_property .un_unit_type_dd').each(function() {
            console.log($(this).is(':visible'))
            if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                if ($(this).val() == null || $(this).val() == undefined) {
                    var errorMessage = $('<span>').attr('class', 'input-error flash-errors').css('color', 'red')
                        .text('This field is required.');
                    $(this).parent().find('.select2-container').append(errorMessage);
                    floorUnitTypeDDStatus = false;
                }
            }
        });

        $('#create_property .floor_unit_type_cat_dd').each(function() {
            console.log($(this).is(':visible'))
            if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                if ($(this).val() == null || $(this).val() == undefined) {
                    var errorMessage = $('<span>').attr('class', 'input-error flash-errors').css('color', 'red')
                        .text('This field is required.');
                    $(this).parent().find('.select2-container').append(errorMessage);
                    floorUnitTypeCatDDStatus = false;
                }
            }
        });
        $('#create_property .cpdd-required').each(function() {
            // console.log($(this).is(':visible')) /
            if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                if ($(this).val() == null || $(this).val() == undefined) {
                    $('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter(this);
                    $(this).addClass('is-invalid');
                    floorUnitTypeDDStatus = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            }
        });
        // alert(floorNamesUniqueStatus);

        if ($('#create_property  .no_of_floors').is(':visible') === true) {
            if (noOfFloors.val() < 1 && noOfFloors.val() != '') {
                $('<span class="input-error flash-errors" style="color: red">Please Enter Valid Floors Count.</span>')
                    .insertAfter(noOfFloors.parent('.input-group'))
                // toastr.error('Invalid Floors Count');
                noOfFloorsStatus = false;
            } else {
                noOfFloorsStatus = true;
            }
            if (floors.length != noOfFloors.val()) {
                $('<span class="input-error flash-errors" style="color: red">Please click on Add Floors button to create Floors.</span>')
                    .insertAfter(noOfFloors.parent('.input-group'))
                floorsStatus = false;
            } else {
                floorsStatus = true;
            }
        }
        // alert(isValid);
        isValid = (isValid == false || floorNamesUniqueStatus == false || unitNamesUniqueStatus == false ||
            floorUnitTypeDDStatus == false || floorUnitTypeCatDDStatus == false || noOfFloorsStatus == false ||
            floorsStatus == false || mergeGISIDValuesValidStatus == false || validGISIDStatus == false || mergeGISIDValuesValidStatus == false) ? false : true;
        return isValid;
    }

    function areInputValuesUnique(selector, mergedEle, msg) {
        var inputValues = [];
        let inputUniqueStatus = true;
        $(selector).each(function() {
            if (!$(this).hasClass(mergedEle)) {

                var value = $(this).val();
                if (inputValues.includes(value)) {
                    inputUniqueStatus = false;
                    if (value != '') {
                        ($('<span class="input-error flash-errors" style="color: red">' + msg + '</span>')
                            .insertAfter(this))
                    }
                    // return false; // Not unique
                }
                inputValues.push(value);
            }
        });
        return inputUniqueStatus;
    }

    function areMergeGISIDValuesValid(selector, msg) {
        var mergeIDStatus = true;
        let merge_ids = [];
        let inputUniqueStatus = true;
        $(selector).each(function() {

            var value = $(this).val();
            if (merge_ids.includes(value)) {
                inputUniqueStatus = false;
                if (value != '') {
                    ($('<span class="input-error flash-errors" style="color: red">GIS ID must be unique.</span>')
                        .insertAfter($(this).parent('.input-group')))
                }
                // return false; // Not unique
            }
            merge_ids.push(value);

        });
        let priorGisId = $('#gis_id').val();
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('surveyor/merge-gis-id-valid-search') }}",
            async: false,
            data: {
                merge_ids: merge_ids,
                prior_gis_id: priorGisId
            },
            success: function(response) {
                mergeIDStatus = response.status;
                let egis_ids = response.egis_ids;
                $('#create_property input[name="mgis_id[]"]').each(function() {
                    (egis_ids.includes(this.value)) ?
                    ($(this).addClass('is-invalid'),
                        $('<span class="input-error flash-errors" style="color: red">' + response.msg + '</span>')
                        .insertAfter($(this).parent('.input-group'))
                    ) :
                    '';
                });
            }
        });

        return mergeIDStatus;
    }
</script>
<script>
    @if(Session::has('message'))
    $(function() {
        $('#create_success').modal('show');
    })
    @endif
</script>
<script>
    // validate comma separated 10 digit contact numbers
    $(document).on('input', '.is-contact-no', function() {
        let currentEle = $(this);
        currentEle.val($(this).val().replace(/[^0-9,]/g, '').replace(/(\,,*?)\,,*/g, '$1'));
        let regex = /^(\d{10},)*\d{10}$/;
        (regex.test(currentEle.val())) ? (currentEle.val(), currentEle.removeClass('is-invalid')) : currentEle
            .addClass('');
    });

    //validate integer input values 
    $(document).on('input', '.is-numeric', function() {
        let currentEle = $(this);
        currentEle.val($(this).val().replace(/[^0-9]/g, ''));
    });

    //validate user name input values 
    $(document).on('input', '.is-person-name', function() {
        let currentEle = $(this);
        currentEle.val($(this).val()
            .replace(/[^a-zA-Z,.\s]/g, '')
            .replace(/(\,,*?)\,,*/g, '$1')
            .replace(/(\..*?)\..*/g, '$1')
            .replace(/(\s\s*?)\s\s*/g, '$1'));
    });

    function gisIDXhrError(xhr) {
        if (typeof xhr == 'object') {
            var json = JSON.parse(xhr.responseText);
            // let text = ((typeof(xhr.status) != "undefined" && xhr.status !== null) ? xhr.status : 'error-code') + " : " + ((typeof(json.message) != "undefined" && message !== null) ? json.message : '') + " error-message" + ", Please click on save or Try again Later";
            let message = "<p class='text-center text-success h4'>Message : " + xhr.responseJSON.message + "</p>";
            $('#gis_id').val('');
            $('#server-error-msg').html(message ? message : '');
            $('#server-error-modal').modal('show');
            if (!$('.global-loader-container').hasClass('d-none')) {
                toggleLoadingAnimation();
            }
        }

    }

    $(document).on("#server-error-modal .close", "#server-error-modal", function() {
        console.log("Modal closed");
        // Perform additional actions after the modal is closed
    });
    // $(".close").click(function() {
    //     $("#myModal").modal('hide');
    // });

    function throwXhrError(xhr) {
        // console.log(xhr)
        // alert(xhr.responseJSON.message)
        if (xhr.status != 422) {
            let message = (xhr.responseJSON.message != undefined) ? xhr.responseJSON.message : '';
            let line = (xhr.responseJSON.line != undefined) ? xhr.responseJSON.line : '';
            let filePath = (xhr.responseJSON.file != undefined) ? xhr.responseJSON.file : '';
            // var json = JSON.parse(xhr.responseText);
            $('#server-error-msg').html('<br> Message : ' + message + '<br> line : ' + line + '<br> file : ' + filePath);
            // let text = ((typeof(xhr.status) != "undefined" && xhr.status !== null) ? xhr.status : 'error-code') + " : " + ((typeof(message) != "undefined" && message !== null) ? message : '') + " error-message" + ", Please click on save or Try again Later";
            $('#server-error-modal').modal('show');
        }
        if (!$('.global-loader-container').hasClass('d-none')) {
            toggleLoadingAnimation();
        }

    }
</script>
@endpush