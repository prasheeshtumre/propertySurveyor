@extends('admin.layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    </style>
    <div class="page-content">

        <div class="container-fluid ">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report Details</h4>
                    </div>
                </div>
            </div>

            <!-- end page title -->
            <form id="searchform" name="searchform">
                <div class="row ">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-xxl-3 col-md-2 mt-3">
                                        <div>
                                            <label for="" class="form-label">From Date</label>
                                            <input type="date" class="form-control filter_input" id="start_date"
                                                name="start_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-2 mt-3">
                                        <div>
                                            <label for="" class="form-label">To Date</label>
                                            <input type="date" class="form-control filter_input" id="end_date"
                                                name="end_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">GIS ID </label>
                                            <input type="text" class="form-control filter_input" id="fltr_gis_id"
                                                name="gis_id">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Pincode </label>
                                            <input type="text" class="form-control filter_input" id="fltr_pincode_id"
                                                name="pincode">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label "> Select Type </label>
                                            <select class="form-select filter_dropdown" id="sale_rent" name="sale_rent">
                                                <option value="">-Select Type-</option>
                                                <option value="1">For Sale</option>
                                                <option value="2">For Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label "> Category of the Property </label>
                                            <select class="form-select filter_dropdown" id="category" name="category">
                                                <option value="">-Select Category of the property-</option>
                                                @forelse($categories as $key=>$category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="row filters-hide" id="plot-lands-blk">-->
                                    <!--    <div id="defined_block">-->
                                    <!--    </div>-->
                                    <!--</div>  -->

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="plot-lands-blk">
                                        <div>
                                            <label for="" class="form-label ">Plot Land Types</label>
                                            <select class="form-select " id="plot_land_types" name="plot_land_types">
                                                <option value="">-Select Plot Land Type-</option>
                                                <!--<option value="1">Commercial</option>-->
                                                <!--<option value="2">Residential</option>-->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="prop-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Property Types</label>
                                            <select class="form-select " id="fltr_property_type" name="property_type">
                                                <option value="">-Select Property Type-</option>
                                                <option value="1">Commercial</option>
                                                <option value="2">Residential</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="const-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Construction Types</label>
                                            <select class="form-select " id="fltr_construction_type"
                                                name="construction_type">
                                                <option value="">-Select Property Type-</option>
                                                <option value="1">Commercial</option>
                                                <option value="2">Residential</option>
                                                <option value="3">Multi-unit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="boards-blk">
                                        <div>
                                            <label for="" class="form-label ">Boards Types</label>
                                            <select class="form-select " id="fltr_boards" name="boards[]" multiple>
                                                <option value="" disabled>-Select Boards-</option>
                                                <option value="1">Boundary Wall/Fencing available</option>
                                                <option value="2">Any Legal Litigation board</option>
                                                <option value="3">Ownership claim board</option>
                                                <option value="4">Bank auction board</option>
                                                <option value="5">For Sale/Lease Board</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="res-type-blk">
                                        <div>
                                            <label for="" class="form-label">Residential Types</label>
                                            <select class="form-select filter_dropdown get_subcat_options"
                                                id="fltr_residential_category" name="residential_category">
                                                <option value="">-Select Residential Type-</option>
                                                @forelse($residential as $key=>$category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="res-sub-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Residential Sub Types</label>
                                            <select class="form-select filter_dropdown get-category-options"
                                                id="fltr_residential_sub_category" name="residential_sub_category">
                                                <option value="">-Select Residential Sub Type-</option>
                                                @forelse($residential as $category)
                                                    @forelse($category->children as $children)
                                                        <option value="{{ $children->id }}">{{ $category->cat_name }} |
                                                            {{ $children->cat_name }}</option>

                                                    @empty
                                                    @endforelse
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide" id="project-blk">
                                        <div>
                                            <label for="" class="form-label" id="project-name-label">Project
                                                Name</label>
                                            <input type="text" class="form-control filter_input"
                                                id="fltr_project_name" name="project_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide" id="plot-name-blk">
                                        <div>
                                            <label for="" class="form-label" id="plot-name-label">Plot
                                                Name</label>
                                            <input type="text" class="form-control filter_input" id="fltr_plot_name"
                                                name="plot_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide" id="building-blk">
                                        <div>
                                            <label for="" class="form-label" id="build-name-label">Building
                                                Name</label>
                                            <input type="text" class="form-control filter_input"
                                                id="fltr_building_name" name="building_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide" id="house-blk">
                                        <div>
                                            <label for="" class="form-label">House No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_house_no"
                                                name="house_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="plot-blk">
                                        <div>
                                            <label for="" class="form-label">Plot No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_plot_no"
                                                name="plot_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="street-blk">
                                        <div>
                                            <label for="" class="form-label">Street Name/No/Road No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_street_name"
                                                name="street_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide" id="colony-blk">
                                        <div>
                                            <label for="" class="form-label">Colony/Locality Name </label>
                                            <input type="text" class="form-control filter_input"
                                                id="fltr_locality_name" name="locality_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="owner-blk">
                                        <div>
                                            <label for="" class="form-label">Owner full name</label>
                                            <input type="text" class="form-control filter_input" id="fltr_owner_name"
                                                name="owner_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="builder-name-blk">
                                        <div>
                                            <label for="" class="form-label">Builder Full Name</label>
                                            <select class="form-select filter_dropdown select2-dd" id="fltr_builder_name"
                                                name="builder_name">
                                                <option value="">-Select Builder-</option>
                                                @forelse($builders as $key=>$builder)
                                                    <option value="{{ $builder->id }}">{{ $builder->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="contact-blk">
                                        <div>
                                            <label for="" class="form-label">Contact No</label>
                                            <input type="text" class="form-control filter_input" id="fltr_contact_no"
                                                name="contact_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide">
                                        <div>
                                            <label for="" class="form-label">No of Floors</label>
                                            <input type="text" name="no_of_floors" class="form-control filter_input"
                                                id="fltr_no_of_floors">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide">
                                        <div>
                                            <label for="" class="form-label">No of Units</label>
                                            <input type="text" class="form-control filter_input" name="no_of_units"
                                                id="fltr_no_of_units">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="unit-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Unit Type</label>
                                            <select class="form-select filter_dropdown select2-dd" id="unit_type_id"
                                                name="unit_type_id">
                                                <option value="">-Select unit type-</option>
                                                @forelse($unit_categories as $key=>$value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="brand-cat-blk">
                                        <div>
                                            <label for="" class="form-label ">Category</label>
                                            <select class="form-select filter_dropdown select2-dd"
                                                id="fltr_brand_category" name="brand_category">
                                                <option value="">-Select Brand Category-</option>
                                                @forelse($brand_parent_categories as $key=>$brand_parent_category)
                                                    <option value="{{ $brand_parent_category->id }}">
                                                        {{ $brand_parent_category->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="brand-sub-cat-blk">
                                        <div>
                                            <label for="" class="form-label ">Sub-category</label>
                                            <select class="form-select filter_dropdown select2-dd"
                                                id="fltr_brand_sub_category" name="brand_sub_category">
                                                <option value="">-Select sub category-</option>
                                                @forelse($brand_sub_categories as $key=>$brand_sub_category)
                                                    <option value="{{ $brand_sub_category->id }}">
                                                        {{ $brand_sub_category->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide" id="brand-blk">
                                        <div>
                                            <label for="" class="form-label ">Brand</label>
                                            <select class="form-select filter_dropdown select2-dd" id="fltr_brand_id"
                                                name="brand_id">
                                                <option value="">-Select Brand-</option>
                                                @forelse($brands as $key=>$brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="button" class="btn btn-primary btn-sm"
                                        id="filter-reset">Reset</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="filter"><i
                                            class="fa fa-search"></i> Search</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </form>

            <div class="row ">

                <div class="col-xl-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-1 row">
                                <!--<h5>Department Wise </h5>-->

                                <div class="col-md-12 col-lg-8">
                                    <a class="btn btn-warning btn-sm ms-1 d-none"><i class="fa-solid fa-print"></i>
                                        Print</a>
                                    <a class="btn btn-secondary btn-sm ms-1 d-none" id="export_excel" data-format="xlsx"
                                        href="{{ route('ajax.export.excel', $type) }}"><i
                                            class="fa-solid fa-file-excel me-1"></i>
                                        Excel</a>
                                    <a class="btn btn-primary btn-sm ms-1 d-none" id="export_pdf" data-format="pdf"
                                        href="{{ route('ajax.export.excel', $type) }}"><i
                                            class="fa-regular fa-file-pdf me-1"></i> PDF</a>
                                    <a class="btn btn-warning btn-sm ms-1 d-none" id="export_csv" data-format="csv"
                                        href="{{ route('ajax.export.excel', $type) }}"><i
                                            class="fa-solid fa-file-csv me-1"></i>
                                        CSV</a>
                                </div>
                                <div class="col-md-12 col-lg-4 mt-2">
                                    <div class="form-group search-icon-main">
                                        <input type="search" placeholder="Search... " class="form-control"
                                            id="fltr_search">
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass fa-beat"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="dataTables_length" id="DataTables_Table_0_length"></div>
                            <div class="table-responsive" id="pagination_data">
                                @include('gis_engineer.property_pagination', [
                                    'properties' => $properties,
                                    'category_type' => $category_type,
                                    'property_count' => $property_count,
                                ])
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!--end row-->

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
    </script>

    <script>
        $(document).ready(function() {
            $(document).on("click", "#export_excel ,#export_csv, #export_pdf", function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                let format = $(this).attr("data-format");
                let fileName = 'properties.' + format;
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                let formatAppend = append + "format=" + format + "&";
                let finalURL = url + formatAppend + $("#searchform").serialize();
                let fltr_search = $('#fltr_search').val();
                finalURL = finalURL + "&search=" + fltr_search;
                $.ajax({
                    type: "GET",
                    url: finalURL,
                    xhrFields: {
                        responseType: 'blob' // Set the response type to 'blob' to handle binary data (Excel file)
                    },
                    success: function(data) {
                        // Create a Blob object from the response data
                        var blob = new Blob([data], {
                            // type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            type: 'application/octet-stream'
                        });

                        // Create a temporary URL for the Blob object
                        var url = window.URL.createObjectURL(blob);

                        // Create a link element and trigger the download
                        var link = document.createElement('a');
                        link.href = url;
                        link.download =
                            fileName; // Set the desired filename for the downloaded file
                        link.click();

                        // Clean up the temporary URL after download
                        window.URL.revokeObjectURL(url);
                        toggleLoadingAnimation();
                    },
                    error: function() {
                        // Handle errors or non-200 responses
                        console.error('Error occurred while generating Excel file.');
                    }
                });

            });

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".pagination a,#search_btn", function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                //get url and make final url for ajax 
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                // console.log(url);
                let finalURL = url + append + $("#searchform").serialize();
                //set to current url
                // alert(finalURL);
                // console.log(finalURL);
                // window.history.pushState({}, null, finalURL);
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

        $(document).on('click', '#filter-reset', function() {
            toggleLoadingAnimation();
            var url = "{{ route('gis-engineer.properties', $type) }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append;
            var selectedValue = $('#category').val();

            $('.filter_input').each(function() {
                $(this).val('');
            });
            $('.filter_dropdown').val("").trigger("change");
            $('.filter_dropdown option:first').prop('selected', true).trigger("change");
            // $("#category  option[value=" + selectedValue + "]").prop('selected', true).trigger("change");
            $('.filters-hide').hide();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt',
                    "pageLength": 50
                })
                toggleLoadingAnimation();
            });
            return false;
        });

        $(document).on('click', '#filter', function() {
            toggleLoadingAnimation();
            var url = "{{ route('gis-engineer.properties', $type) }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#searchform").serialize();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt',
                    "pageLength": 50
                })
                toggleLoadingAnimation();
            });
            return false;
        });
        $('#fltr_search').keyup(function() {
            var url = "{{ route('gis-engineer.properties', $type) }}";
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

    <script>
        $(document).ready(function() {
            $('#generate-pdf-btn').click(function() {
                // generatePDF();
            });
        });
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
                $('#brand-cat-blk,#brand-sub-cat-blk,#brand-blk,#project-blk,#building-blk,#builder-name-blk,#owner-blk,#prop-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk')
                    .hide();
                if (selectValue2 == 10 || selectValue2 == 12) {
                    $('#project-blk,#builder-name-blk').show();
                    $('#unit-type-blk').hide();
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
                // $('.filter_input').each(function() {
                //     $(this).val('');
                // });
                // $('.filter_dropdown').val("").trigger("change")

                $('#fltr_construction_type').val('');
                $('#fltr_property_type').val('');
                $('#unit_type_id').val("").trigger("change");
                $('#fltr_residential_category').val("");
                $('#fltr_residential_sub_category').val("");

                var selectedValue = $(this).val();
                $('.filters-hide').show();
                if (selectedValue == '1') {
                    $("#res-sub-type-blk,#project-blk,#res-type-blk,#prop-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk,#builder-name-blk")
                        .hide();
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
                        url: "{{ route('ajax.get-defined-options') }}",
                        data: {
                            c_id: selectedValue
                        },
                        success: function(response) {
                            $('#plot_land_types').empty();
                            $("#plot_land_types").append(
                                '<option selected value="">-Select Plot Land Type-</option>'
                            );
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
                    $("#project-blk,#builder-name,#contact-blk,#house-blk,#plot-blk,#street-blk,#colony-blk")
                        .show();
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
                    $("#res-sub-type-blk,#project-blk,#res-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk,#builder-name-blk")
                        .hide();
                } else if ($(this).val() == '2') {
                    $('.filters-hide').hide();
                    $("#res-sub-type-blk,#res-type-blk,#prop-type-blk").show();
                }
            });
            $('#plot_land_types').change(function() {
                if ($(this).val() == '13') {
                    $('.filters-hide').hide();
                    $("#plot-lands-blk,#plot-name-blk,#street-blk,#colony-blk,#owner-blk,#contact-blk,#boards-blk,#plot-blk")
                        .show();
                } else if ($(this).val() == '14') {
                    $('.filters-hide').hide();
                    $("#plot-lands-blk,#plot-blk,#street-blk,#colony-blk,#contact-blk,#contact-blk,#house-blk,#builder-name-blk,#project-blk,#plot-name-blk")
                        .show();

                }
            });

            // $('#fltr_construction_type').change(function() {
            //     if ($(this).val() == '1') {
            //         $('.filters-hide').show();
            //         $("#res-sub-type-blk,#project-blk,#res-type-blk,#prop-type-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#builder-name-blk")
            //             .hide();
            //     } else if ($(this).val() == '2') {
            //         $('.filters-hide').hide();
            //         $("#res-sub-type-blk,#res-type-blk,#const-type-blk").show();
            //     } else if ($(this).val() == '3') {
            //         $('.filters-hide').hide();
            //         $("#project-blk,#builder-name-blk,#contact-blk,#const-type-blk,#house-blk,#plot-blk,#street-blk,#colony-blk")
            //             .show();
            //     }
            // });


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
                url: "{{ route('ajax.get-sub-residential') }}",
                success: function(response) {
                    $('#plot_land_types').empty();
                    if (response.length == 0) {
                        $("#plot_land_types").append(
                            '<option selected value="" >--Select Category--</option>');
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
            var url = "{{ route('gis-engineer.properties', $type) }}";
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
        });
    </script>
    <script>
        $(document).on('change', '#fltr_brand_category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ route('ajax.get-brand-sub-category') }}",
                success: function(response) {
                    $('#fltr_brand_sub_category').empty();
                    $('#fltr_brand_sub_category').append(
                        "<option value=''>-Select sub category-</option>");
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#fltr_brand_sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.name
                            }))
                        })
                    }
                }
            })
        });
        $(document).on('change', '#fltr_brand_sub_category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ route('ajax.get-brand-sub-category') }}",
                success: function(response) {
                    $('#fltr_brand_id').empty();
                    $('#fltr_brand_id').append(
                        "<option value=''>-Select Brand-</option>");
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#fltr_brand_id').append($("<option/>", {
                                value: value.id,
                                text: value.name
                            }))
                        })
                    }
                }
            })
        });
        $(document).on('change', '#fltr_residential_category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ route('ajax.get-sub-residential') }}",
                success: function(response) {
                    $('#fltr_residential_sub_category').empty();
                    $('#fltr_residential_sub_category').append(
                        "<option value=''>-Select Residential Sub Type-</option>");
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#fltr_residential_sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.cat_name
                            }))
                        })
                    }
                }
            })
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
        });
    </script>
@endpush
