@extends('admin.layouts.main')
@push('css')
    <link href="{{ asset('assets/css/gated-community-details.css') }}?v=2345" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icm_zone_ui.css') }}?v=14" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <style>
        .addpuls {
            background: #662e93;
            padding: 10px 10px;
            border-radius: 3px;
            color: white;
            font-size: 14px;
            margin-left: 5px;
            position: relative;
            top: 7px;
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


        .btn-anima::before,
        .btn-anima::after {
            position: absolute;
            content: "";
        }


        .comp-repo-file-name {
            position: absolute;
            bottom: 0%;
            padding: 2px 16px;
            width: 150px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .comp-repo-file-name:hover {
            overflow: visible;
            z-index: 1;
            background-color: #808080e0;
            width: auto;
            border-radius: 8px;
        }

        .comp-repo-file-name:hover+div {
            margin-top: 20px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Commercial Tower Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <!--APARTMENT Category-->
                    <div class="card" style="">
                        <div class="card-body ">
                            <div class="row align-items-end">
                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <div>
                                        <label for="" class="form-label">GIS ID :
                                            {{ $get_property->gis_id }}</label>
                                        <input type="text" name="gis_id" class="form-control req- ctfd-required d-none"
                                            id="gis_id" placeholder="" value="{{ $get_property->gis_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="add_gated_community_details">
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
                                        aria-controls="pills-profile" aria-selected="false">Towers / Floors</button>
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
                                        aria-controls="pills-compliances" aria-selected="false"
                                        data-url={{ route('commercial-tower.compliances.index') }}>Compliances</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-reposotories-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-reposotories" type="button" role="tab"
                                        aria-controls="pills-reposotories" aria-selected="false"
                                        data-url={{ route('commercial-tower.repositories.index') }}>Repositories</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-price-trends-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-price-trends" type="button" role="tab"
                                        aria-controls="pills-price-trends" aria-selected="false">Price Trends</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <form method="post" name="general_details" id="general_details">
                                        <div id="defined_gis_block">
                                            @include('admin.pages.property.' . $general_detail_blade_slug)
                                        </div>
                                        <div class="row mt-3"></div>
                                        <div class=" align-items-center mb-2">
                                            <div class="col-md-12">
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-md btn-primary"
                                                        onclick="updateGeneralDetails()">Save</button>
                                                    <button type="button"
                                                        class="btn btn-md btn-primary  blocks-next-btn">
                                                        Proceed</button>
                                                    <button type="button" class="btn btn-md btn-primary d-none"
                                                        onclick="updateGeneralDetails()">Save &amp; Proceed</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <!--Add Blocks/Floors Tab-->
                                    <div id="defined_block_tab"></div>
                                </div>

                                <div class="tab-pane fade" id="pills-property-status" role="tabpanel"
                                    aria-labelledby="pills-property-status-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <!--Add Blocks/Floors Tab-->
                                    <form method="post" id="project-status-frm">
                                        @csrf
                                        <div class="row ">
                                            <div class="col-xxl-3 col-md-3 mt-3 append-filter-fields">
                                                <div>
                                                    <label for="" class="form-label">Status of the Project<span
                                                            class="errorcl">*</span></label>
                                                    <select class="form-select project-status" name="project_status"
                                                        id="" data-type="project">
                                                        <option value="">-Status of the Project-</option>
                                                        @forelse($project_status as $key=>$val)
                                                            <option value="{{ $val->id }}"
                                                                data-def_psddop_name="field-options-s0" data-level="0"
                                                                data-disabled_opt="{{ $val->options_self_validated }}"
                                                                class="disable-psof-{{ $val->id }}">
                                                                {{ $val->name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div>
                                                    <div class="text-end">
                                                        <button type="submit"
                                                            class="btn btn-md btn-primary">Save</button>
                                                        <button type="button"
                                                            class="btn btn-md btn-primary project-status-step">Proceed</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <div class="col-xxl-12 col-md-12 mt-3 project-status-history">

                                    </div>



                                </div>

                                <div class="tab-pane fade" id="pills-amenities" role="tabpanel"
                                    aria-labelledby="pills-amenities-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <div id="amenities_defined_block_tab"></div>
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
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <div id="complainces_defined_tab_content" class="m-2"></div>
                                </div>
                                <div class="tab-pane fade" id="pills-reposotories" role="tabpanel"
                                    aria-labelledby="pills-reposotories-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <div class="accordion mt-3" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="project-repository-capsule">
                                                <button class="accordion-button repositories-accordion" type="button"
                                                    data-block-id="project-repositories" data-bs-toggle="collapse"
                                                    data-bs-target="#project-repositories" aria-expanded="true"
                                                    aria-controls="project-repositories">
                                                    Project Repository
                                                </button>
                                            </h2>
                                            <div id="project-repositories" class="accordion-collapse collapse show"
                                                aria-labelledby="project-repository-capsule"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="">
                                                        <!-- project repositories -->
                                                        <div class="project-repositories-body"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item d-none">
                                            <h2 class="accordion-header" id="bt-repository-capsule">
                                                <button class="accordion-button collapsed repositories-accordion"
                                                    type="button" data-block-id="bt-repositories"
                                                    data-bs-toggle="collapse" data-bs-target="#bt-repositories"
                                                    aria-expanded="false" aria-controls="bt-repositories">
                                                    Tower Repository
                                                </button>
                                            </h2>
                                            <div id="bt-repositories" class="accordion-collapse collapse"
                                                aria-labelledby="bt-repository-capsule"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="bt-repositories-body"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-price-trends" role="tabpanel"
                                    aria-labelledby="pills-price-trends-tab">
                                    <div class="tab-content-header">
                                        @include('admin.pages.property.secondary_data.tab_content_header')
                                    </div>
                                    <!--Add Blocks/Floors Tab-->
                                    <div id="price-trends-defined-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
    <link href="{{ asset('assets/css/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/property/commercialTower/image-compression-helper.js') }}?v=154"></script>
    <script src="{{ asset('assets/js/property/commercialTower/rera-hmda-image-compression-helper.js') }}?v=7555544g">
    </script>
    <script src="{{ asset('assets/js/property/commercialTower/compliances.js') }}?v=78"></script>
    <script src="{{ asset('assets/js/property/commercialTower/repository.js') }}?v=44"></script>


    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        $(document).on('change', '.price-trends-tower', function() {
            let currntTowerStage = $(this).find(':selected').data('project_status');
            let currntTowerStageId = $(this).find(':selected').data('project_status_id');
            $('#price-trends-tower-status').val(currntTowerStage);
            $('#pt_tower_status').val(currntTowerStageId);
        });

        $(document).on('change', '#project_expected_date_of_start', function() {
            let project_expected_date_of_start = $(this).val();
            $('#project_expected_date_of_completion').attr('min', project_expected_date_of_start);
        });

        $(document).on('change', '#tower_expected_date_of_start', function() {
            let tower_expected_date_of_start = $(this).val();
            $('#tower_expected_date_of_completion').attr('min', tower_expected_date_of_start);
        });
    </script>
    <script>
        $(document).on('click', '.save-next', function() {
            let blockType = $(this).data('block-type');
            let parentTab = $(this).data('parent-tab');
            let nextTab = $('#' + parentTab).parent().nextAll('.nav-link').first();
            $(nextTab).trigger('click');
        });

        // $(function(e) {

        //     $.ajax({
        //         type: "GET",
        //         url: "{{ url('surveyor/property/gated-community-details/general_details') }}",
        //         data: {
        //             gis_id: "{{ $property->gis_id }}"
        //         },
        //         success: function(response) {

        //             $('.tab-content-header').html(response);

        //         }
        //     });
        // });
        // get gis id
        // $(document).on('click', '#btn-search-gis-id', function(e) {
        //     toggleLoadingAnimation();
        //     let gis_id = $("#gis_id").val();
        //     if (gis_id == '') {
        //         toggleLoadingAnimation();
        //         toastr.error('Please enter GIS ID');
        //         return false
        //     } else {

        //         $.ajax({
        //             type: "GET",
        //             url: "{{ url('get_secondary_defined_block') }}",
        //             data: {
        //                 gis_id: gis_id
        //             },
        //             success: function(response) {
        //                 if (response.status === false) {
        //                     toggleLoadingAnimation();
        //                     toastr.error(response.message);
        //                     $('#defined_gis_block').empty();
        //                     $('#add_gated_community_details').addClass('d-none');
        //                 } else {
        //                     toggleLoadingAnimation();

        //                     $('#defined_gis_block').html(response);
        //                     $('#add_gated_community_details').removeClass('d-none');


        //                     getTabContentHeader();
        //                 }

        //             }
        //         });
        //     }

        // });

        function getTabContentHeader() {
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ url('/get-gcd-tab-content-header') }}",
                data: {
                    property_id: propertyId
                },
                success: function(response) {

                    $('.tab-content-header').html(response);

                }
            });
        }

        $(document).on('change', '.project-status', function() {
            let currentElement = $(this);
            let type = $(this).data('type');
            let catId = $(this).val();
            let propertyId = $('#property_id').val();
            let constructionStage = 0;
            catId = ($(this).hasClass('psdd-options')) ? 0 : catId;
            // let constructionStage = ($(this).hasClass('construction-stages')) ? ($(this).val()) : '' ;
            //self options validation
            let disableOptions = $(this).find(':selected').data('disabled_opt');
            if (typeof disableOptions === 'string') {
                disableOptions = disableOptions.split(',');
                disableOptions.map(function(v, i) {
                    $(".disable-psof-" + v).prop('disabled', true)
                })
            } else {
                $(".disable-psof-" + disableOptions).prop('disabled', true)
            }
            if ($(this).hasClass('construction-stages')) {
                constructionStage = $(this).val();
                catId = 0;
            }
            let currntLevel = $(this).find(':selected').data('level');
            currntLevel = currntLevel;
            let className = $(this).find(':selected').data('def_psddop_name');

            for (let index = currntLevel; index <= 3; index++) {
                $('.field-options-s' + index).remove();
            }
            let appendTo = $('.append-filter-fields').last();
            let isTowerDD = $(this).hasClass('towers-dd') ? true : false;

            let towerId = (isTowerDD) ? $(this).val() : null;
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.project-status.project-status-fields') }}",
                data: {
                    type: type,
                    status_id: catId,
                    property_id: propertyId,
                    class_name: className,
                    construction_stage: constructionStage
                },
                success: function(response) {

                    $(response).insertAfter(appendTo);
                    if (isTowerDD) {
                        disableTowerStatusOptions(towerId);
                    }

                }
            });
        })

        function disableTowerStatusOptions(towerId) {
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                data: {
                    property_id: propertyId,
                    tower_id: towerId,
                },
                url: "{{ route('commercial-tower.tower-status.disabled-options') }}",
                success: function(response) {
                    // disabled_options
                    if (response.disabled_options != undefined) {
                        let disabledOptions = response.disabled_options;
                        $('.tower-status-dd option').each(function() {
                            let currentOption = ($(this).val() != '') ? parseInt($(this).val()) : 0;
                            if (disabledOptions.includes(currentOption)) {
                                $(this).prop('disabled', true)
                            }
                        })
                    }
                }
            });
        }

        // get blocks tab
        $(document).on('click', '#pills-profile-tab', function(e) {
            toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.blocks.index') }}",
                data: {
                    property_id: property_id
                },
                success: function(response) {
                    if (response.status === false) {
                        toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#defined_block_tab').empty();
                    } else {
                        $('#defined_block_tab').html(response);
                        toggleLoadingAnimation();
                        $('#headingTwo').trigger('click');
                        // $.ajax({
                        //     type: "GET",
                        //     url: "{{ route('view-block') }}",
                        //     data: {
                        //         property_id: property_id
                        //     },
                        //     success: function(response) {
                        //         if (response.status === false) {
                        //             toggleLoadingAnimation();
                        //             toastr.error(response.message);
                        //             $('#add_view_block').empty();
                        //         } else {
                        //             toggleLoadingAnimation();
                        //             $('#add_view_block').html(response);
                        //         }
                        //     }
                        // });
                    }

                }
            });
        });


        // blocks
        $(document).on('click', '#headingOne', function(e) {
            toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('view-block') }}",
                data: {
                    property_id: property_id
                },
                success: function(response) {
                    if (response.status === false) {
                        toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#add_view_block').empty();
                    } else {
                        toggleLoadingAnimation();
                        $('#add_view_block').html(response);
                        $('#add_view_tower').empty();
                    }

                }
            });
        });

        //towers / Units
        $(document).on('click', '#headingTwo', function(e) {
            toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.get-block-towers') }}",
                data: {
                    property_id: property_id
                },
                success: function(response) {
                    if (response.status === false) {
                        toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#add_view_tower').empty();
                    } else {
                        toggleLoadingAnimation();
                        $('#add_view_tower').html(response);
                        $('#add_view_block').empty();
                    }

                }
            });
        });

        //towers / Units
        $(document).on('click', '#floors-tab', function(e) {
            // toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            let gisId = $("#gis_id").val();
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.floors.index') }}",
                data: {
                    property_id: property_id,
                    gis_id: gisId
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
                        $('#add_view_block').empty();
                        $('#add_view_tower').empty();
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



        //save project status information
        $(document).on('submit', '#project-status-frm', function(e) {
            e.preventDefault();
            let propertyId = $('#property_id').val();
            toggleLoadingAnimation();
            $.ajax({
                url: "{{ route('commercial-tower.project-status.store-project-status') }}",
                type: "POST",
                data: $(this).serialize() + '&property_id=' + propertyId,
                success: function(response) {
                    toastr.success(response.message);
                    $('.project-status-history').html(response.statusList)
                    $('.flash-errors').remove();

                    $('.append-filter-fields').slice(1).remove();
                    var project_status_options = $(".project-status option");
                    project_status_options.each(function() {
                        $(this).prop('selected', false)
                    });
                    if (response.disabled_options != undefined) {
                        let disabledOptions = response.disabled_options;
                        $('.project-status option').each(function() {
                            let currentOption = ($(this).val() != '') ? parseInt($(this)
                                .val()) : 0;
                            if (disabledOptions.includes(currentOption)) {
                                $(this).prop('disabled', true)
                            }
                        })
                    }
                    toggleLoadingAnimation();
                },
                error: function(xhr) {

                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('<span class="input-error flash-errors" style="color: red">' +
                                value[0] +
                                '</span>').insertAfter('input[name=' + key + ']');
                            $('<span class="input-error flash-errors" style="color: red">' +
                                value[0] +
                                '</span>').insertAfter('select[name=' + key + ']');

                            toastr.error(value[0]);
                        });
                    }
                    toggleLoadingAnimation();
                },
            });
        });

        $(document).on('click', '.project-status-step', function(e) {
            $('#pills-amenities-tab').trigger('click');
        });


        //pills-price-trends-tab
        $(document).on('click', '#pills-price-trends-tab', function(e) {
            e.preventDefault();
            toggleLoadingAnimation();
            getPriceTrendsBlock();
        });

        // get defined price trends fields
        function getPriceTrendsBlock() {
            let property_id = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.price-trends.index') }}",
                data: {
                    property_id: property_id
                },
                success: function(response) {
                    if (response.status === false) {
                        toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#add_view_tower').empty();
                    } else {
                        toggleLoadingAnimation();
                        $('#price-trends-defined-block').html(response);
                        $('#add_view_block').empty();
                    }

                },
                error: function(response) {
                    toggleLoadingAnimation();
                },
            });
        }

        $(function() {
            $(document).on("click", ".pagination a,#search_btn", function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                let propertyId = $('#property_id').val();
                //get url and make final url for ajax 
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                // console.log(url);
                let finalURL = url + append + 'property_id=' + propertyId;
                //set to current url
                // alert(finalURL);
                // console.log(finalURL);
                // window.history.pushState({}, null, finalURL);
                $.ajax({
                    type: "GET",
                    url: finalURL,
                    secure: true,
                    success: function(response) {
                        toggleLoadingAnimation();
                        $("#pagination_data").html(response);
                        $('.data-table').DataTable({
                            dom: 'Brt',
                            "pageLength": 50
                        })
                    },
                    error: function(xhr) {
                        toggleLoadingAnimation();
                    }
                });
                return false;
            });

            var table = $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            });
        });

        //save project status information
        $(document).on('submit', '#price-trends-frm', function(e) {
            e.preventDefault();
            let propertyId = $('#property_id').val();
            toggleLoadingAnimation();
            $.ajax({
                url: "{{ route('commercial-tower.price-trends.store') }}",
                type: "POST",
                data: $(this).serialize() + '&property_id=' + propertyId,
                success: function(response) {
                    toastr.success(response.message);
                    getPriceTrendsBlock();
                },
                error: function(xhr) {

                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('<span class="input-error flash-errors" style="color: red">' +
                                value[0] +
                                '</span>').insertAfter('input[name=' + key + ']');
                            $('<span class="input-error flash-errors" style="color: red">' +
                                value[0] +
                                '</span>').insertAfter('select[name=' + key + ']');

                            toastr.error(value[0]);
                        });
                    }
                    toggleLoadingAnimation();
                },
            });
        });

        //edit update project status information
        $(document).on('submit', '#edit-price-trends-frm', function(e) {
            e.preventDefault();
            let propertyId = $('#property_id').val();
            toggleLoadingAnimation();
            $.ajax({
                url: "{{ route('commercial-tower.price-trends.update') }}",
                type: "POST",
                data: $(this).serialize() + '&property_id=' + propertyId,
                success: function(response) {
                    toastr.success(response.message);
                    getPriceTrendsBlock();
                },
                error: function(response) {
                    toggleLoadingAnimation();
                },
            });
        });

        //edit project status information
        $(document).on('click', '.edit-price-trends', function() {
            let towerId = $(this).data('tower_id');
            if (towerId == '0') {
                $(".tower-price-trends-edit").removeAttr('checked');
                $("#pt_project_radio").removeAttr('class', 'd-none');
                $("#pt_tower_radio").attr('class', 'd-none');
                $(".project-price-trends-edit").attr('checked', 'checked');
                $('.project-price-trends-edit').trigger('click');

            } else {
                $(".project-price-trends-edit").removeAttr('checked');
                $("#pt_tower_radio").removeAttr('class', 'd-none');
                $("#pt_project_radio").attr('class', 'd-none');
                $(".tower-price-trends-edit").attr('checked', 'checked');
                $('.tower-price-trends-edit').trigger('click');

            }

            $('#price-trends-frm').addClass('d-none');
            $('#edit-price-trends-frm').removeClass('d-none');
            $("#tower_id").val($(this).data('tower_id'));
            $("#projectStatus").val($(this).data('project_status'));
            $("#pt_project_status").val($(this).data('project_status_id'));
            $("#towerStatus").val($(this).data('tower_status'));
            $("#pt_tower_status-edit").val($(this).data('tower_status_id'));
            $("#ptdate").val($(this).data('ptdate'));
            $("#ptprice").val($(this).data('ptprice'));
            $("#ptid").val($(this).data('ptid'));

        });

        //amenities 
        $(document).on('click', '#pills-amenities-tab', function(e) {
            toggleLoadingAnimation();
            let property_id = $('#property_id').val();
            $.ajax({
                type: "GET",
                url: "{{ route('commercial-tower.amenities.index') }}",
                data: {
                    property_id: property_id
                },
                success: function(response) {
                    if (response.status === false) {
                        toggleLoadingAnimation();
                        toastr.error(response.message);
                        $('#defined_block_tab').empty();
                    } else {
                        toggleLoadingAnimation();
                        $('#amenities_defined_block_tab').html(response);
                        $('#defined_block_tab').empty();

                    }

                }
            });
        });
        $(document).on('submit', '#amenities-frm', function(e) {
            e.preventDefault();
            toggleLoadingAnimation();
            // alert('checking...');
            $.ajax({
                url: "{{ route('commercial-tower.amenities.store-amenities') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    toggleLoadingAnimation();
                    toastr.success(response.message);

                    // setTimeout(function() { 
                    //    window.location.reload();
                    // }, 1000);
                },
                error: function(response) {},
            });
        });
        $(document).on('click', '.amenities-next-btn', function(e) {
            $('#pills-compliances-tab').trigger('click');
        });
        
        $(document).on('click', '.blocks-next-btn', function(e) {
            $('#pills-profile-tab').trigger('click');
        });
    </script>

    <!--save  General details tab-->
    <script>
        function updateGeneralDetails() {
            toggleLoadingAnimation();
            $.ajax({
                url: "{{ route('commercial-tower.update-general-details') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#general_details').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toggleLoadingAnimation();
                    $('.loader-container').addClass('d-none');
                    $('.flash-errors').remove();
                    toastr.success(response.data.message);
                    // $('#pills-profile-tab').click();
                    // setTimeout(function(){
                    //     location.reload();
                    // },3000);
                },
                error: function(xhr) {
                    toggleLoadingAnimation();
                    $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('<span class="input-error flash-errors" style="color: red">' + value[0] +
                                '</span>').insertAfter('input[name=' + key + ']');
                            $('<span class="input-error flash-errors" style="color: red">' + value[0] +
                                '</span>').insertAfter('select[name=' + key + ']');
                        });
                    }
                }
            });
        }
    </script>

    <!-- get block name-->
    <script>
        // generate blocks using add block button
        $(document).on('click', ".add-block", function() {
            let currentStoreyCount = $('.storey-blocks').length;
            let count = ($('.no_of_blocks').val() == '') ? 0 : parseInt($('.no_of_blocks').val());
            if (count < 1) {
                toastr.error('Please enter valid block count');
                return false;
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count);
            // let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalBlocks = '';
            $('.loader-container').removeClass('d-none');

            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getBlocks(start index, finalCount)
            totalBlocks = getBlocks(currentStoreyCount, finalCount);
            (currentStoreyCount > 0) ?
            (
                $(totalBlocks).insertAfter($(".storey-blocks:last"))
            ) :
            $(totalBlocks).insertAfter($(this).closest(".append-blocks"));
            $(".remove-storey-blocks").each(function() {
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none'): '';
            })
            $(".remove-storey-blocks").last().removeClass('d-none');
            // $('.block_unit_type_dd').select2();
            $('.no_of_blocks').val($('.storey-blocks').length);
        });

        function getBlocks(startIndex, count) {
            var temp_blocks = null;
            $.ajax({
                type: "GET",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('get_blocks') }}",
                data: {
                    count: count,
                    start_index: startIndex
                },
                success: function(response) {
                    temp_blocks = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            return temp_blocks;
        }

        // delete block
        $(document).on('click', ".remove-storey-blocks", function() {
            $(this).parent().parent().remove();
            $(".remove-storey-blocks").last().removeClass('d-none');
            let currentStoreyLength = $('.storey-blocks').length;
            $('.no_of_blocks').val(currentStoreyLength);
        });
    </script>

    <script>
        $(document).on('click', '.blocks-to-towers-btn', function(e) {
            $('#headingTwo').trigger('click');
            $('#collapseOne').removeClass('show');
            $('#collapseTwo').addClass('show');
        });

        $(document).on('click', '.towers-to-floors-btn', function(e) {
            let currentEle = $(this).data('block_type');
            (currentEle == 'towers') ? ($('#floors-tab .accordion-button').click()) : '';
            (currentEle == 'units') ? ($('#pills-property-status-tab').trigger('click')) :
            '';
        });
    </script>

    <!-- Save blocks-->
    <script>
        function saveBlocks() {
            let isValid = validateFields('create_blocks');
            if (isValid) {
                toggleLoadingAnimation();

                $.ajax({
                    url: "{{ route('create-blocks') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: $('#create_blocks').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.flash-errors').empty();
                        toggleLoadingAnimation();
                        $('.loader-container').addClass('d-none');
                        toastr.success(response.data.message);
                        $('.flash-errors').remove();
                        $('#headingOne').trigger('click');
                        // $('#headingTwo').click();
                        // $('#collapseOne').removeClass('show');
                        // $('#collapseTwo').addClass('show');
                        // setTimeout(function(){
                        //     location.reload();
                        // },3000);
                    },
                    error: function(xhr) {
                        $('.loader-container').addClass('d-none');
                        if (xhr.status === 422) {
                            $('.flash-errors').empty();
                            var errors = xhr.responseJSON.errors;
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                const key_name = key.split('.');
                                // $('.' + key_name[0] + key_name[1]).text(value);
                                $('<span class="input-error flash-errors" style="color: red">' + value +
                                    '</span>').insertAfter('#' + key_name[0] + key_name[1]);

                                toastr.error(value);
                            });

                        }
                        toggleLoadingAnimation()
                    }
                });
            }
        }
    </script>


    <!-- get tower name-->
    <script>
        // $(document).on('click', ".add-tower", function(){
        function addTower(id, residential_type) {
            let currentStoreyCount = $('.storey' + id).length;
            let count = ($('.no_of_towers' + id).val() == '') ? 0 : parseInt($('.no_of_towers' + id).val());
            if (count < 1) {
                toastr.error('Please enter valid count');
                return false;
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count);
            // let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalBlocks = '';
            $('.loader-container').removeClass('d-none');

            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getBlocks(start index, finalCount)
            totalBlocks = getTowers(currentStoreyCount, finalCount, id, residential_type);
            (currentStoreyCount > 0) ?
            (
                $(totalBlocks).insertAfter($(".storey" + id + ":last"))
            ) :
            $(totalBlocks).insertAfter(".append-blocks" + id);
            $(".remove-storey" + id).each(function() {
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none'): '';
            })
            $(".remove-storey" + id).last().removeClass('d-none');
            // $('.block_unit_type_dd').select2();
            $('.no_of_towers' + id).val($('.storey' + id).length);
            // });
        }

        function getTowers(startIndex, count, id, residential_type) {
            var temp_blocks = null;
            $.ajax({
                type: "GET",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('commercial-tower.get-towers') }}",
                data: {
                    count: count,
                    start_index: startIndex,
                    id: id,
                    residential_type: residential_type
                },
                success: function(response) {
                    temp_blocks = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            return temp_blocks;
        }

        // delete block
        $(document).on('click', ".remove-tower", function() {
            let id = $(this).attr('id');
            $(this).parent().parent().remove();
            $(".remove-storey" + id).last().removeClass('d-none');
            let currentStoreyLength = $('.storey' + id).length;
            $('.no_of_towers' + id).val(currentStoreyLength);
        });
    </script>
    <!--Save Towers-->
    <script>
        $(document).on('click', '.save-towers', function() {
            let isValid = validateFields('create_towers');
            if (isValid) {
                toggleLoadingAnimation();
                // let currentEle = $(this).data('block_type');
                $.ajax({
                    url: $('#create_towers').attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: $('#create_towers').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toggleLoadingAnimation();
                        toastr.success(response.data.message);
                        // $('.flash-errors').remove();
                        // (currentEle == 'towers') ? ($('#floors-tab .accordion-button').click()) : '';
                        // (currentEle == 'units') ? ($('#pills-property-status-tab').trigger('click')) :
                        // '';
                        // $('#create_towers').attr('action', "{{ route('update-towers') }}");
                        $('#headingTwo').trigger('click');
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) {
                            $('.flash-errors').empty();
                            var errors = xhr.responseJSON.errors;
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                const key_name = key.split('.');
                                // console.log('.err_' + key_name[0] + key_name[1]);
                                // $('.err_' + key_name[0] + key_name[1]).text(
                                //     'This field is required.');
                                $('<span class="input-error flash-errors" style="color: red">' +
                                    value + '</span>').insertAfter('#' + key_name[
                                    0] + key_name[1]);
                                toastr.error(value);
                            });
                            toggleLoadingAnimation()
                        }
                        // else 
                    }
                    // }
                });
            }
        });
    </script>

    <!-- add floors scripts starts -->
    <script>
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
                    $(".append-units-all").addClass('d-none');
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
            let propertyId = $('#property_id').val();
            let floors = getPropertyFloors(propertyId)
            $(floors).insertAfter(".append-floors");
            enableFloorsRemoveAction()
        });
        var floorNames = [];
        $(document).on('keyup', "input[name=nth_floor_name]", function() {
            floorNames = [];
            $("input[name=nth_floor_name]").each(function(i) {
                floorNames.push({
                    "id": i,
                    "text": $(this).val()
                });
            });
            // console.log(floorNames);
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
            let id = $(this).val();
            let category_type = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {
                    c_id: id
                },
                success: function(response) {
                    $('#defined_block').html(response);
                    $('#plot_land_types').empty();

                    $('.select2-dd').select2();
                }
            });

        });

        $(document).on('change', '.get_subcat_options', function(e) {
            let c_id = $(this).val();
            $('.get-category-fields').empty();
            $('.get-category-fields').append(new Option('Select Category', ''));
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('surveyor/ajax/sub_categories') }}",
                success: function(response) {
                    $('#plot_land_types').empty();
                    if (response.length == 0) {
                        $("#plot_land_types").append('<option selected >--Select Category--</option>');
                    }
                    if (response) {
                        $.each(response, function(key, value) {
                            $('.get-category-fields').append($("<option/>", {
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
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {
                    c_id: id
                },
                success: function(response) {
                    $('.category-fields-container').html(response);
                    $('.select2-dd').select2();
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


        // generate floors using add floor button
        $(document).on('click', ".add-floor", function() {
            let currentStoreyCount = $('.storey').length;
            let count = ($('.no_of_floors').val() == '') ? 0 : parseInt($('.no_of_floors').val());
            // alert(count)
            if (count < 1) {
                toastr.error('please enter valid floor count');
                return false
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count);
            let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalFloors = '';
            $('.loader-container').removeClass('d-none');

            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getFloors(start index, finalCount)
            totalFloors = getFloors(currentStoreyCount, finalCount);
            (currentStoreyCount > 0) ?
            (
                $(totalFloors).insertAfter($(".storey").last())
            ) :
            $(totalFloors).insertAfter($(this).closest(".append-floors"));
            $(".remove-storey").each(function() {
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none'): '';
            })
            $(".remove-storey").last().removeClass('d-none');
            $('.floor_unit_type_dd').select2();
            $('.no_of_floors').val($('.storey').length);

        });


        // add units to all floor on single click
        $(document).on("click", ".add-units-to-all-floors", function() {
            toggleLoadingAnimation();
            let no_of_unit_to_all_floors = $('.no_of_unit_to_all_floors').val();
            $('.add-unit').each(function(index) {
                var currentElement = $(this);
                setTimeout(function() {
                    // alert();
                    $('.no_of_units').val(no_of_unit_to_all_floors);
                    currentElement.trigger('click');
                }, 2000 * index);
            });

            setTimeout(function() {
                toggleLoadingAnimation();
            }, $('.add-unit').length * 2000);

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
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
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
            (currentStoreyUnits.length == 2) ? currentStoreyUnits.remove(): $(this).parent().remove();
            $('.storey').each(function() {
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass(
                    'd-none');
                let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                $(this).find('.no_of_units').val(currentStoreyUnitLength)
            });
            $(".remove-storey").last().removeClass('d-none');

        });

        $(document).on('click', ".floor-ufs-ufr", function() {
            let ufsUfrLength = $(this).closest('.storey').find('.floor-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey').find('.floor_unit_type_dd').first().val();
            if ($(this).prop('checked') == true) {
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
            // alert(prop_cat)
            $.ajax({
                type: "GET",
                data: {
                    cat_id: cat_id,
                    property_id: propertyId
                },
                url: "{{ url('get_unit_categories') }}",
                success: function(response) {
                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) ?
                    (next_parent_element.addClass('d-none')) :
                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 3) ?
                    (prop_cat == 1) ? next_parent_element.removeClass('d-none'): (next_parent_element
                        .addClass('d-none')): '';

                    $(next_ddopt_child).empty();
                    if (response.data.length == 0) {
                        // $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                    }

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
                            // $(current_block_dd_elements).removeClass('d-none');
                        } else if (fieldType == 'text') {
                            $(current_block_text_elements).removeClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            $(current_block_dd_elements).addClass('d-none');

                            // $.each(response, function(key, value) {

                            // });
                        }
                        //this will get hit ater first dd change
                        else if (fieldType == undefined) {
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
                        tags: true
                    });

                }
            });

        });

        // add custom brand
        $(document).on('click', '.add-fbrand', function(e) {
            e.preventDefault();
            $(this).closest('.storey').find('.brand-tfd').first().removeClass('d-none')
        })

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
                })
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

            if ($(this).prop('checked') === true) {

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

        function getFloors(startIndex, count) {
            var temp_floors = null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('commercial-tower.get-ct-floors') }}",
                data: {
                    c_id: c_id,
                    count: count,
                    start_index: startIndex
                },
                success: function(response) {
                    temp_floors = response;
                    $(".append-units-all").removeClass('d-none');
                    $('.loader-container').addClass('d-none');
                }
            });

            return temp_floors;
        }
        $(document).on('click', '.remove-merge', function(e) {
            remove_merge();
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);

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
                    $('.loader-container').addClass('d-none');
                    $('.storey').remove();
                    let floors = getPropertyFloors(property_id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();

                    $('.storey').each(function() {
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit')
                            .removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                }
            });
        }

        function getUnits(startIndex, count, floor_id, floorIdOc) {
            var temp_units = null;
            let c_id = $('#category').val();
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: false,
                url: "{{ route('commercial-tower.get-ct-units') }}",
                data: {
                    c_id: c_id,
                    count: count,
                    floor_id: floor_id,
                    start_index: startIndex,
                    property_id: propertyId,
                    floor_idoc: floorIdOc
                },
                success: function(response) {
                    temp_units = response;
                }
            });

            return temp_units;
        }

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
                url: "{{ route('commercial-tower.get-edit-commercial-tower-floors') }}",
                data: {
                    c_id: c_id,
                    property_id: property_id,
                    block_id: blockId,
                    tower_id: towerId
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
            // setTimeout(function(){
            //     $('.loader-container').addClass('d-none');
            // }, 1000);
            // toastr.success('Floors Merged Successfully');
            // 
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_sd_floor_merge') }}" : $(
                '#create_floors').attr('action');
            saveProperty(save_floor_merge_url);
        });

        $(document).on('click', '.save-unit-merge', function(e) {
            $('.loader-container').removeClass('d-none');
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_sd_unit_merge') }}" : $(
                '#create_floors').attr('action');
            // saveProperty(save_floor_merge_url);
            $.ajax({
                url: save_floor_merge_url,
                type: 'POST',
                dataType: 'json',
                data: $('#create_floors').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.loader-container').addClass('d-none');
                    $('#create_floors').attr('action', response.data.action_url);
                    $('#property_id').val(response.data.id);
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    $('.remove-merge-ele').removeClass('d-none')

                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);

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

        function saveProperty(save_merge_url) {
            $.ajax({
                url: save_merge_url,
                type: 'POST',
                dataType: 'json',
                data: $('#create_floors').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.loader-container').addClass('d-none');
                    $('#create_floors').attr('action', response.data.action_url);
                    $('#property_id').val(response.data.id);
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    // $('.remove-merge-ele').removeClass('d-none');

                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);

                },
                error: function(xhr) {
                    $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('<span class="input-error flash-errors" style="color: red">' + value[0] +
                                '</span>').insertAfter('input[name=' + key + ']');
                        });
                    }
                    // else 
                }
                // }
            });
        }

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

            // Swal.fire({
            //     position: 'top-end',
            //     title: 'Geolocation is not supported by this browser.',
            //     // timer: 1500
            //     timer: 2000,
            //     showCancelButton: false,
            //     showConfirmButton: false
            // })


        }
        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hiddebs.modal', function() {
            // location.reload();
        });



        $(document).on('click', '#create_property_btn', function(e) {
            e.preventDefault(); // Prevent default form submission
            var isValid = validateForm();
            if (isValid) {
                toggleLoadingAnimation()
                $.ajax({
                    url: "{{ route('commercial-tower.store-ct-floors') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: $('#create_floors').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toggleLoadingAnimation()
                        toastr.success(response.data.message);
                        $('.loader-container').addClass('d-none');
                        $('#create_floors').attr('action', response.data.action_url);
                        $('#property_id').val(response.data.id);
                        $('.storey').remove();
                        let floors = getPropertyFloors(response.data.id)
                        $(floors).insertAfter(".append-floors")
                        $('.select2-dd').select2();
                        $('.remove-merge-ele').removeClass('d-none');

                        $(".remove-storey").last().removeClass('d-none');
                        let currentStoreyLength = $('.storey').length;
                        $('.no_of_floors').val(currentStoreyLength);
                        if (currentStoreyLength > 0) {
                            $(".append-units-all").removeClass('d-none');
                        } else {
                            $('.append-units-all').addClass('d-none');
                        }


                    },
                    error: function(xhr) {
                        $('.loader-container').addClass('d-none');
                        if (xhr.status === 422) {
                            $('.flash-errors').remove();
                            var errors = xhr.responseJSON.errors;
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                const key_name = key.split('.');
                                $('.' + key_name[0] + key_name[1]).text(value);
                                $('<span class="input-error flash-errors" style="color: red">' +
                                    value + '</span>').insertAfter('#' + key_name[0] +
                                    key_name[1]);
                                toastr.error(value);
                            });
                            toggleLoadingAnimation();
                        }
                        // else 
                    }
                    // }
                });
                // Form is valid, submit the form
                // $('#create_property').submit();
            }

        });

        $(document).on('click', '.floors-next-btn', function(e) {
            $('#pills-property-status-tab').trigger('click');
            getPojectStatusHistory();
        });
        $(document).on('click', '.floors-next-btn,#pills-property-status-tab', function(e) {
            getPojectStatusHistory();
        });
        $(document).on('click', '#pills-property-status-tab', function(e) {
            $('.project-status option').each(function() {
                $(this).prop('disabled', false);
            })
        });

        $(document).on('click', '#pills-property-status-tab', function(e) {
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                data: {
                    property_id: propertyId
                },
                url: "{{ route('commercial-tower.project-status.disabled-options') }}",
                success: function(response) {
                    // disabled_options
                    if (response.disabled_options != undefined) {
                        let disabledOptions = response.disabled_options;
                        $('.project-status option').each(function() {
                            let currentOption = ($(this).val() != '') ? parseInt($(this)
                                .val()) : 0;
                            if (disabledOptions.includes(currentOption)) {
                                $(this).prop('disabled', true)
                            }
                        })
                    }
                }
            });
        });


        function getPojectStatusHistory() {
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                data: {
                    property_id: propertyId
                },
                url: "{{ route('commercial-tower.project-status.project-status-history') }}",
                success: function(response) {
                    $('.project-status-history').html(response.statusList)
                }
            });
        }

        function validateForm() {
            $('.flash-errors').remove();
            var isValid = true;
            $('.ctfd-required').each(function() {
                var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
                if (value === '' || value === null) {
                    isValid = false;
                    // 
                    ($(this).hasClass('no_of_floors')) ?
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter($(this).parent('.input-group'))) :
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter(this), $(this).addClass('is-invalid'));

                    ;
                } else {
                    $(this).removeClass('is-invalid');
                }
                $('.is-invalid:first').focus();
            });
            return isValid;
        }

        function validateFields(formId) {
            // $('#' +formId + '.flash-errors').remove();
            var isValid = true;
            // return  $('#' +formId + ' .ctfd-required').length;

            // let inputFields = $('#'+formId+' .ctfd-required');
            $('#' + formId + ' .ctfd-required').each(function() {
                var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
                if (value === '' || value === null) {
                    isValid = false;
                    ($(this).hasClass('no_of_floors')) ?
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter($(this))) :
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter(this), $(this).addClass('is-invalid'));;
                } else {
                    $(this).removeClass('is-invalid');
                }
                $('.is-invalid:first').focus();
            });
            return isValid;
        }

        function enableFloorsRemoveAction() {
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
            if (currentStoreyLength > 0) {
                $(".append-units-all").removeClass('d-none');
            } else {
                $('.append-units-all').addClass('d-none');
            }
        }

        //  floors scripts ends
    </script>

    <script>
        $(document).ready(function() {
            var selectedFiles = [];
            if (window.File && window.FileList && window.FileReader) {

                $(document).on("change", ".file-input", function(e) {
                    var inputName = $(this).attr("name");

                    if (!selectedFiles.hasOwnProperty(inputName)) {
                        selectedFiles[inputName] = [];
                    }

                    var file_id = $(this).attr("id");

                    var files = e.target.files;
                    var filesPreview = $(this).closest(".file-input-wrapper").find(".files-preview");
                    var maxSizeInBytes = 5242880; // 5MB
                    var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                    var videoExtensions = ["mp4", "avi", "mov"];
                    var pdfExtensions = ["pdf"];

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var fileSize = file.size;
                        var fileExtension = file.name.split(".").pop().toLowerCase();
                        let fileName = file.name;
                        // if (fileSize > maxSizeInBytes) {
                        //     alert("File size exceeds the allowed limit of 5MB.");
                        //     continue;
                        // }

                        // if (!allowedExtensions.includes(fileExtension) && !videoExtensions.includes(fileExtension) && !pdfExtensions.includes(fileExtension)) {
                        //     alert("Invalid file extension. Only JPG, JPEG, PNG, GIF, PDF, and video files are allowed.");
                        //     continue;
                        // }

                        var fileReader = new FileReader();

                        fileReader.onload = (function(file, fileExtension, fileName) {
                            return function(e) {
                                var imageThumb;
                                if (allowedExtensions.includes(fileExtension)) {
                                    imageThumb = $("<img>").addClass("imageThumb").attr("src", e
                                        .target.result).attr("width", "130");
                                } else if (videoExtensions.includes(fileExtension)) {
                                    imageThumb = $("<i>").addClass("fas fa-video").css({
                                        "font-size": "100px",
                                        "color": "white",
                                        "padding": "10px"
                                    });
                                } else if (pdfExtensions.includes(fileExtension)) {
                                    imageThumb = $("<i>").addClass("fas fa-file-pdf").css({
                                        "font-size": "100px",
                                        "color": "white",
                                        "padding": "10px"
                                    });
                                }

                                var removeButton = $("<span id='" + file_id + "'>").addClass(
                                    "remove-image btn remove").html("&#215;");
                                var imageArea = $("<span>").addClass("image-area rounded")
                                    .append(imageThumb).append("<br>").append(removeButton)
                                    .append(
                                        '<p class="text-white text-center comp-repo-file-name">' +
                                        fileName + '</p>');

                                filesPreview.append(imageArea);

                                // Add the file to the selectedFiles array
                                // selectedFiles.push(file);
                                selectedFiles[inputName].push(file);
                                let id = $("#" + file_id);
                                id.val("");

                                removeButton.click(function() {

                                    let id = $("#" + file_id);
                                    id.val("");

                                    // Get the index of the clicked remove button
                                    var index = $(this).parent().index();

                                    // Remove the corresponding file from selectedFiles array
                                    selectedFiles[inputName].splice(index, 1);

                                    // Remove the file preview area
                                    $(this).parent().remove();
                                });

                                // $(".remove-image").click(function() {
                                //     // Get the index of the clicked remove button
                                //     var index = $(this).parent().index();
                                //     // Remove the corresponding file from selectedFiles array
                                //     selectedFiles.splice(index, 1);

                                //     // Remove the file preview area
                                //     $(this).parent().remove();
                                //     // $(this).closest(".image-area").remove();

                                // });

                            };
                        })(file, fileExtension, fileName);

                        fileReader.readAsDataURL(file);
                    }
                });

            } else {
                alert("Your browser doesn't support to File API")
            }

           

        });
    </script>
    <script>
        function toggleGhmcDiv(radioButton) {
            var div = document.getElementById("hideGhmc");
            if (radioButton.value === "1") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
                $('#ghmc_approval_file').val('');
                $('.ghmcRemove').empty();

            }
        }

        function toggleCommDiv(radioButton) {
            var div = document.getElementById("hideComm");
            if (radioButton.value === "1") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
                $('#commenc_file').val('');
                $('.commRemove').empty();
            }
        }
    </script>

   
    <script>
        $(document).on('click', '.repositories-next-btn', function() {
            $('#pills-price-trends-tab').trigger('click');
            $('#pills-price-trends-tab').tab('show');
        });

        // compliences and repositories scripts ends

        $(document).on('click', '.price_trends_type', function() {
            let currentEleType = $(this).attr('id');
            if (currentEleType == 'tower-price-trends') {
                $('.price-trends-tower-cell').show();
                $('#price-trends-tower-status').val('');
                $('.price-trends-tower-cell').find('input, select').prop('disabled', false);
            } else if (currentEleType == 'project-price-trends') {
                let projectStatus = $(this).data('project_status');
                $('.price-trends-tower-cell').hide();
                $('#price-trends-tower-status').val(projectStatus);
                $('.price-trends-tower-cell').find('input, select').prop('disabled', true);

            }
        })
    </script>
@endpush
