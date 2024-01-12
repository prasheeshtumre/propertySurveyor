@extends('admin.layouts.main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
<style>
    .dt-buttons {
        display: none;
    }

    .dataTables_filter {
        display: none;
    }

    .search-icon {
        top: 7px !important;
    }

    .loader-circle-2 {
        position: absolute;
        width: 70px;
        height: 70px;
        top: 45%;
        left: 50%;
        display: inline-block;
    }

    .loader-circle-2:before,
    .loader-circle-2:after {
        content: "";
        display: block;
        position: absolute;
        border-width: 5px;
        border-style: solid;
        border-radius: 50%;
    }

    .loader-circle-2:before {
        width: 70px;
        height: 70px;
        border-bottom-color: #fbfbfb;
        border-right-color: #fbfbfb;
        border-top-color: transparent;
        border-left-color: transparent;
        animation: loader-circle-2-animation-2 1s linear infinite;
    }

    .loader-container {
        width: 100%;
        background-color: rgb(0 0 0 / 30%);
        height: 100%;
        position: absolute;
        z-index: 1;
    }

    .loader-circle-2:after {
        width: 40px;
        height: 40px;
        border-bottom-color: #fbfbfb;
        border-right-color: #fbfbfb;
        border-top-color: transparent;
        border-left-color: transparent;
        top: 22%;
        left: 22%;
        animation: loader-circle-2-animation 0.85s linear infinite;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        display: none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child {
        display: block;
    }

    span.select2-selection__choice__remove {
        display: none;
    }

    @keyframes loader-circle-2-animation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(-360deg);
        }
    }

    @keyframes loader-circle-2-animation-2 {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    ul.pagination {
        display: flex;
        justify-content: center !important;
        ;
    }

    @media screen and (max-width: 640px) {

        li.page-item {

            display: none;
        }

        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-child(3),
        .page-item:nth-last-child(2),
        .page-item:nth-last-child(3),
        .page-item:last-child,
        .page-item.active,
        .page-item.disabled {

            display: block;
        }

        .loader-circle-2 {
            left: 42% !important;
        }
    }

    .img-max {
        max-width: 210px
    }

    .body-reports {
        font-family: var(--vz-body-font-family) !important;
        font-size: var(--vz-body-font-size) !important;
    }

    .dtr-details li span {
        /*display: block !important; */
        margin-bottom: 5px !important;
    }

    .dtr-title {
        font-size: 14px !important;
        font-weight: 600 !important;
        max-width: 100% !important;

    }

    #filter-reset {
        background-color: #ff8989;
        border: 1px solid #ff8989;
        color: white;
        border-radius: 5px;
    }

    table.dataTable>tbody>tr.child ul.dtr-details>li {
        border-bottom: none !important;
        padding: 0.5em 0;
    }


    .btn-search {
        background: #662e93;
        color: white;
        border: 1px solid #662e93;
        border-radius: 3px;
    }

    .search-icon i {
        font-size: 14px;
        margin-top: 5px;
    }
</style>

<div class="page-content body-reports">

    <div class="container-fluid ">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">GIS-ID's Bulk upload</h4>
                </div>
            </div>
        </div>

        <!-- end page title -->

        <div class="row ">
            <div class="col-xl-12 col-md-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('gis-engineer.geo-ids-import.store')}}" id="bulk-upload-frm" class="" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            @if (Session::has('success'))
                            <!-- <div class="row">
                                <div class="col-md-8 col-md-offset-1">
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5>{!! Session::get('success') !!}</h5>
                                    </div>
                                </div>
                            </div> -->
                            @endif
                            <div class="form-group row">
                                <div class="col-md-3    ">
                                    <label for="bulk-gis-excel-file" class="btn btn-secondary">Choose File Here</label>
                                    <input type="file" name="file" id="bulk-gis-excel-file" class="d-none form-control">
                                    <p id="selected-file"></p>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success">Upload</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 col-lg-12">
                                    <a href="{{asset('uploads/gis_engineer/bulk-geo-ids-sample.csv')}}">Download Sample CSV file</a>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-3 col-lg-12">
                               @if (count($errors) > 0)
                                <!-- Button trigger modal -->
                                <span class="text-danger btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                View error Log Details.
                                </span>
                                @endif
                                    @if(Session::has('duplicate_errors'))
                                    <span class="text-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    View error Log Details
                                    </span>
                                    @endif
                               </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row ">

            <div class="col-xl-12 col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1 row ">
                            <!--<h5>Department Wise </h5>-->

                            <div class="col-md-12 col-lg-8">

                            </div>
                            <div class="col-md-12 col-lg-4 mt-2">
                                <div class="form-group search-icon-main">
                                    <input type="search" placeholder="Search... " class="form-control" id="fltr_search">
                                    <div class="search-icon">
                                        <i class="fa-solid fa-magnifying-glass fa-beat"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="dataTables_length" id="DataTables_Table_0_length"></div>

                        <div class="table-responsive " id="pagination_data">
                            @include('gis_engineer.pages.geo_ids.pagination', [
                            'geo_id_logs' => $geo_id_logs,
                            ])
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!--end row-->

       

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Error Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(Session::has('duplicate_errors'))
                        @forelse(Session::get('duplicate_errors') as $error)
                            <p>{{$error}}</p> 
                        @empty 
                        @endforelse
                @endif

                @if (count($errors) > 0)
                    @foreach($errors->all() as $error)
                       <p>{{ $error }}</p> 
                    @endforeach
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
        </div>

    </div> <!-- container-fluid -->
</div><!-- End Page-content -->






@if (request()->get('type'))
<input type="hidden" value="{{ request()->get('type') }}" id="type">
@endif
@endsection

@push('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2-dd').select2();
    });

    $(function() {
        // $('#pagination_data').removeClass('d-none');
        // $('.loader-container').addClass('d-none');
    })
</script>

<script type="text/javascript">
    $(function() {
        $(document).on("click", ".pagination a,#search_btn", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            let append = url.indexOf("?") == -1 ? "?" : "&";
            let finalURL = url + append + $("#searchform").serialize();
            $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    $("#pagination_data").html(response);
                    $('.data-table').DataTable({
                        dom: 'Brt',
                        "pageLength": 50
                    })
                }
            });
            return false;
        });

        var table = $('.data-table').DataTable({
            dom: 'Brt',
            "pageLength": 50
        });
    });

    $(document).on('click', '#filter-reset', function() {
        var url = "{{ url('surveyor/property/reports') }}";
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append;
        var selectedValue = $('#category').val();

        $('.filter_input').each(function() {
            $(this).val('');
        });
        $('.filter_dropdown').val("").trigger("change")
        $('.filter_dropdown option:first').prop('selected', true).trigger("change");
        $("#category  option[value=" + selectedValue + "]").prop('selected', true).trigger("change");
        // $('.filters-hide').hide();

        $.get(finalURL, function(data) {
            $("#pagination_data").html(data);
            $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            })
        });
        return false;
    });

    $(document).on('click', '#filter', function() {

        var url = "{{ url('surveyor/property/reports') }}";
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + $("#searchform").serialize();

        $.get(finalURL, function(data) {
            $("#pagination_data").html(data);
            $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            })
        });
        return false;
    });
    $('#fltr_search').keyup(function() {
        var url = "{{ url('surveyor/property/reports') }}";
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + $("#searchform").serialize() + "&search=" + $('#fltr_search').val();

        $.get(finalURL, function(data) {
            $("#pagination_data").html(data);
            $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            })
        });
    });

    $(document).on('click', '.export-btn', function() {
        $('.' + $(this).data('export')).trigger('click');
    })

    $(document).on("change", "#start_date", function() {
        // debugger
        var date = $(this).val();
        $('#end_date').attr('min', date);
    });

    function generate() {
        var doc = new pdfjsLib.getDocument();
        doc.fromHTML(document.querySelector('#output'), 15, 15, {
            'width': 170,
            'elementHandlers': function() {
                return true;
            }
        });
        doc.save('test.pdf');
    }
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.cmd', function() {
            $.ajax({
                type: "GET",
                url: "{{ url('surveyor/property/pdf/export') }}",
                success: function(response) {
                    var doc = new jsPDF();
                    var specialElementHandlers = {
                        '#editor': function(element, renderer) {
                            return true;
                        }
                    };

                    doc.fromHTML(response, 15, 15, {
                        'width': 700,
                        'elementHandlers': specialElementHandlers
                    });
                    doc.save('sample_file.pdf');

                }
            });

        });
    }); <
    !--
</script>-->
<script>
    $(document).ready(function() {
        $('#generate-pdf-btn').click(function() {
            // generatePDF();
        });
    });
    @if (Session::has('success'))
        $(function() {
           toastr("{{Session::get('success')}}")
        })
    @endif
</script>

<script>
    $(document).ready(function() {
        $('.filters-hide').hide();
        $('#fltr_residential_category').change(handleDropdownChange);
        $('#fltr_residential_sub_category').change(handleDropdownChange);

        function resedential() {
            var selectedValue = $('#category').val();
            var selectValue1 = $('#fltr_residential_category').val();
            var selectValue2 = $('#fltr_residential_sub_category').val();
            var selectValue3 = $('#fltr_property_type').val();
            $('.filters-hide').show();
            $('#brand-cat-blk,#brand-sub-cat-blk,#brand-blk,#project-blk,#building-blk,#builder-name-blk,#owner-blk,#prop-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk').hide();
            if (selectValue2 == 10 || selectValue2 == 12) {
                $('#project-blk,#builder-name-blk').show();
            } else if (selectValue2 == 9) {
                $('#project-blk,#builder-name-blk').hide();
                $('#building-blk,#owner-blk').show();
                $('#build-name-label').html('Apartment Name')
            } else if (selectValue2 == 11) {
                $('#project-blk,#builder-name-blk').hide();
                $('#building-blk,#owner-blk').show();
                $('#build-name-label').html('Building Name')
            }
        }

        function handleDropdownChange() {
            var selectedValue = $('#category').val();
            var selectValue1 = $('#fltr_residential_category').val();
            var selectValue2 = $('#fltr_residential_sub_category').val();
            var selectValue3 = $('#fltr_property_type').val();
            var selectValue4 = $('#fltr_construction_type').val();
            if (selectedValue == '2' && selectValue1 !== '' && selectValue2 !== '') {

                resedential();
            }
            if (selectedValue == '3' && selectValue3 == '2' && selectValue1 !== '' && selectValue2 !== '') {
                resedential();
                $("#prop-type-blk").show();
            }
            if (selectedValue == '5' && selectValue4 == '2' && selectValue1 !== '' && selectValue2 !== '') {
                resedential();
                $("#const-type-blk").show();
            }
        }

        $('#category').change(function() {
            var selectedValue = $(this).val();
            $('.filters-hide').show();
            if (selectedValue == '1') {
                $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#prop-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk").hide();
            }
            if (selectedValue == '2') {
                $('.filters-hide').hide();
                $("#res-sub-type-blk,#res-type-blk").show();
            }
            if (selectedValue == '3') {
                $('.filters-hide').hide();
                $("#prop-type-blk").show();
            }
            if (selectedValue == '4') {

                $.ajax({
                    type: "GET",
                    url: "{{ url('get_defined_options') }}",
                    data: {
                        c_id: selectedValue
                    },
                    success: function(response) {
                        $('#plot_land_types').empty();
                        response.forEach(function(item) {
                            var option = document.createElement("option");
                            option.value = item.id;
                            option.text = item.cat_name;
                            $('#plot_land_types').append(option);
                        });

                        //   $('#defined_block').html(response); 
                    }
                });

                // $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#prop-type-blk,#brand-cat-blk,#brand-sub-cat-blk,#brand-blk,#unit-type-blk,#building-blk,#const-type-blk").hide();
                $('.filters-hide').hide();
                $("#plot-lands-blk").show();
            }
            if (selectedValue == '5') {
                $('.filters-hide').hide();
                $("#const-type-blk").show();
            }
            if (selectedValue == '6') {
                $('.filters-hide').hide();
                $("#contact-blk,#house-blk,#plot-blk,#street-blk,#colony-blk").show();

            }
        });
        $('#fltr_property_type').change(function() {
            if ($(this).val() == '1') {
                $('.filters-hide').show();
                $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk").hide();
            } else if ($(this).val() == '2') {
                $('.filters-hide').hide();
                $("#res-sub-type-blk,#res-type-blk,#prop-type-blk").show();
            }
        });
        $('#plot_land_types').change(function() {
            if ($(this).val() == '13') {
                $('.filters-hide').hide();
                $("#plot-lands-blk,#plot-name-blk,#street-blk,#colony-blk,#owner-blk,#contact-blk,#boards-blk").show();
            } else if ($(this).val() == '14') {
                $('.filters-hide').hide();
                $("#plot-lands-blk,#plot-blk,#street-blk,#colony-blk,#contact-blk,#contact-blk,#house-blk,#builder-name-blk,#project-blk").show();

            }
        });
        $('#fltr_construction_type').change(function() {
            if ($(this).val() == '1') {
                $('.filters-hide').show();
                $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#prop-type-blk").hide();
            } else if ($(this).val() == '2') {
                $('.filters-hide').hide();
                $("#res-sub-type-blk,#res-type-blk,#const-type-blk").show();
            } else if ($(this).val() == '3') {
                $('.filters-hide').hide();
                $("#project-blk,#builder-name-blk,#contact-blk,#const-type-blk,#house-blk,#plot-blk,#street-blk,#colony-blk").show();
            }
        });


    });

    // dependant resedential dropdowns
    $(document).on('change', '.get_subcat_options', function(e) {
        let c_id = $(this).val();
        $('.get-category-options').empty();
        $('.get-category-options').append(new Option('Select Category', ''));
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
                        $('.get-category-options').append($("<option/>", {
                            value: value.id,
                            text: value.cat_name
                        }));
                    });
                }
            }
        });
    });

    $('#show-entries').change(function() {
        var entryVal = $(this).val();
        var url = "{{ url('surveyor/property/reports') }}";
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + $("#searchform").serialize() + "&length=" + entryVal;

        $.get(finalURL, function(data) {
            $("#pagination_data").html(data);
            $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            })
        });
    });

    $(document).ready(function() {
        $('#fltr_boards').select2({
            templateResult: function(data) {
                if (!data.id) {
                    return data.text;
                }

                var selected = $(data.element).prop('selected');
                var checkbox = '<input type="checkbox" ' + (selected ? 'checked' : '') + '/>';
                return $('<span>' + checkbox + ' ' + data.text + '</span>');
            },
            templateSelection: function(data, container) {
                var selectedCount = $('#fltr_boards :selected').length;
                return selectedCount + ' selected';
            }
        });

        $(document).on('submit', '#bulk-upload-frm', function(e){
            e.preventDefault();
            var fileInput = $('#bulk-gis-excel-file')[0];
            if (fileInput.files.length === 0) {
                toastr.warning('Please select a file.');
                return;
            }

            var allowedMimeTypes = ['text/csv', 'text/plain'];
            var fileType = fileInput.files[0].type;

            if (allowedMimeTypes.indexOf(fileType) === -1) {
                toastr.warning('File must be a CSV or TXT file.');
            } else {
                // If the file is of the correct MIME type, submit the form
                this.submit();
            }
        })
    });

    $(document).on('change', '#bulk-gis-excel-file', function(){
        const selectedFile = $(this).prop('files')[0];

        // Get the name of the selected file
        const fileName = selectedFile.name;
        // alert(fileName)
        $('#selected-file').html(fileName);
    })
</script>

    @if(Session::has('success'))
        <script>
        $(function(){
            toastr.success("{{ Session::get('success') }}");
        });
        </script>
    @endif

    @if(Session::has('header_error'))
        <script>
        $(function(){
            toastr.warning("{{ Session::get('header_error') }}");
        });
        </script>
    @endif

@endpush