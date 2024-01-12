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
        .ser_re {
            background-color: #f3e4ff;
            padding: 5px 10px;
            border-radius: 5px;
        }


        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }

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

        /*.dtr-details {*/
        /*    display: flex !important;*/
        /*    column-gap: 3rem!important;*/
        /*    align-items: center !important;*/
        /*    border-bottom: 1px solid #ccc!important;*/
        /*    margin-bottom: 15px 0px !important;*/
        /*}*/
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
                        <h4 class="mb-sm-0">Gated Community Report Details</h4>
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
                                    <div class="col-xxl-3 col-md-2 mt-3 d-none">
                                        <div>
                                            <label for="" class="form-label">From Date</label>
                                            <input type="date" class="form-control filter_input" id="start_date"
                                                name="start_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-2 mt-3 d-none">
                                        <div>
                                            <label for="" class="form-label">To From</label>
                                            <input type="date" class="form-control filter_input" id="end_date"
                                                name="end_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3" id="builder-name-blk">
                                        <div>
                                            <label for="" class="form-label">Search By Builder</label>
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
                                    <div class="col-xxl-3 col-md-4 mt-3" id="project-blk">
                                        <div>
                                            <label for="" class="form-label" id="project-name-label">Project
                                                Name</label>
                                            <input type="text" class="form-control filter_input" id="fltr_project_name"
                                                name="project_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3" id="project-blk">
                                        <div>
                                            <label for="" class="form-label" id="project-name-label">Pin
                                                Code</label>
                                            <input type="text" class="form-control filter_input" id="fltr_pin_code"
                                                name="pincode">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">GIS ID </label>
                                            <input type="text" class="form-control filter_input" id="fltr_gis_id"
                                                name="gis_id">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label "> Type of Project </label>
                                            <select class="form-select filter_dropdown" id="type_of_project"
                                                name="type_of_project" style="font-size:14px;">
                                                <option value="">-Select Category of the property-</option>
                                                @forelse($type_of_projects as $key=>$category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="plot-lands-blk">
                                        <div>
                                            <label for="" class="form-label ">Plot Land Types</label>
                                            <select class="form-select " id="plot_land_types" name="plot_land_types">
                                                <option value="">-Select Plot Land Type-</option>
                                                <!--<option value="1">Commercial</option>-->
                                                <!--<option value="2">Residential</option>-->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="prop-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Property Types</label>
                                            <select class="form-select " id="fltr_property_type" name="property_type">
                                                <option value="">-Select Property Type-</option>
                                                <option value="1">Commercial</option>
                                                <option value="2">Residential</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="const-type-blk">
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

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="boards-blk">
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

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="res-type-blk">
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
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="res-sub-type-blk">
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

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide d-none" id="plot-name-blk">
                                        <div>
                                            <label for="" class="form-label" id="plot-name-label">Plot
                                                Name</label>
                                            <input type="text" class="form-control filter_input" id="fltr_plot_name"
                                                name="plot_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide d-none" id="building-blk">
                                        <div>
                                            <label for="" class="form-label" id="build-name-label">Building
                                                Name</label>
                                            <input type="text" class="form-control filter_input"
                                                id="fltr_building_name" name="building_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide d-none" id="house-blk">
                                        <div>
                                            <label for="" class="form-label">House No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_house_no"
                                                name="house_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="plot-blk">
                                        <div>
                                            <label for="" class="form-label">Plot No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_plot_no"
                                                name="plot_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="street-blk">
                                        <div>
                                            <label for="" class="form-label">Street Name/No/Road No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_street_name"
                                                name="street_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3 filters-hide d-none" id="colony-blk">
                                        <div>
                                            <label for="" class="form-label">Colony/Locality Name </label>
                                            <input type="text" class="form-control filter_input"
                                                id="fltr_locality_name" name="locality_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="owner-blk">
                                        <div>
                                            <label for="" class="form-label">Owner</label>
                                            <input type="text" class="form-control filter_input" id="fltr_owner_name"
                                                name="owner_name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="contact-blk">
                                        <div>
                                            <label for="" class="form-label">Contact No</label>
                                            <input type="text" class="form-control filter_input" id="fltr_contact_no"
                                                name="contact_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none">
                                        <div>
                                            <label for="" class="form-label">No of Floors</label>
                                            <input type="text" name="no_of_floors" class="form-control filter_input"
                                                id="fltr_no_of_floors">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none">
                                        <div>
                                            <label for="" class="form-label">No of Units</label>
                                            <input type="text" class="form-control filter_input" name="no_of_units"
                                                id="fltr_no_of_units">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="unit-type-blk">
                                        <div>
                                            <label for="" class="form-label ">Unit Type</label>
                                            <select class="form-select filter_dropdown select2-dd" id=""
                                                name="unit_type">
                                                <option value="">-Select unit type-</option>
                                                @forelse($unit_categories as $key=>$value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="brand-cat-blk">
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
                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="brand-sub-cat-blk">
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

                                    <div class="col-xxl-3 col-md-3 mt-3 filters-hide d-none" id="brand-blk">
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
                                    <!--<div class="col-xxl-3 col-md-3 mt-3">-->
                                    <!--    <div>-->
                                    <!--        <label for="" class="form-label">Community Name</label>-->
                                    <!--        <input type="text" class="form-control filter_input" id="fltr_community" name="community">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <div class="text-end mt-3">
                                    <button type="button" class="btn btn-primary btn-sm"
                                        id="filter-reset">Reset</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="filter"> <i
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
                            <div class="d-flex justify-content-between align-items-center mb-1 row ">
                                <!--<h5>Department Wise </h5>-->

                                <div class="col-md-12 col-lg-8">
                                    <a class="btn btn-warning btn-sm ms-1 d-none"><i class="fa-solid fa-print"></i>
                                        Print</a>
                                    <a class="btn btn-secondary btn-sm ms-1 " id="export_excel" data-format="xlsx"
                                        href="{{ route('surveyor.export.gated_community_report') }}"><i
                                            class="fa-solid fa-file-excel me-1"></i>
                                        Excel</a>
                                    <a class="btn btn-primary btn-sm ms-1 d-none" id="export_pdf" data-format="pdf"
                                        href="{{ route('surveyor.export.gated_community_report') }}"><i
                                            class="fa-regular fa-file-pdf me-1"></i> PDF</a>
                                    <a class="btn btn-warning btn-sm ms-1 " id="export_csv" data-format="csv"
                                        href="{{ route('surveyor.export.gated_community_report') }}"><i
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
                                @include('admin.pages.property.reports.gated_property_pagination', [
                                    'properties' => $properties,
                                    'category_type' => $request->type_of_project,
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
                let fileName = 'gated_properties.' + format;
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                let formatAppend = append + "format=" + format + "&";
                let finalURL = url + formatAppend + $("#searchform").serialize();
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
                        toggleLoadingAnimation();
                        $("#pagination_data").html(response);
                        $('.data-table').DataTable({
                            dom: 'Brt',
                            "pageLength": 50
                        })
                    }
                });
                // $.get(finalURL, function(data) {
                //     $("#pagination_data").html(data);
                //     // $('.data-table').DataTable().clear();
                //     // $('.data-table').DataTable().destroy();
                //     $('.data-table').DataTable({
                //         dom: 'Brt',
                // "pageLength": 50
                //     })
                // });
                return false;
            });

            var table = $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
            });
        });

        $(document).on('click', '#filter-reset', function() {
            toggleLoadingAnimation();
            var url = "{{ route('surveyor.gated-reports') }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append;
            var selectedValue = $('#type_of_project').val();

            $('.filter_input').each(function() {
                $(this).val('');
            });
            $('.filter_dropdown').val("").trigger("change")
            $('.filter_dropdown option:first').prop('selected', true).trigger("change");
            // $("#type_of_project  option[value=" + selectedValue + "]").prop('selected', true).trigger("change");
            // $("#type_of_project").val('7').trigger("change");
            // $('.filters-hide').hide();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('#filter').trigger('click');
                $('.data-table').DataTable({
                    dom: 'Brt',
                    "pageLength": 50
                })
                toggleLoadingAnimation();
            });
            return false;
        });

        $(document).ready(function() {
            $('#filter').trigger('click');
        });

        $(document).on('click', '#filter', function() {
            toggleLoadingAnimation();
            var url = "{{ route('surveyor.gated-reports') }}";
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
            toggleLoadingAnimation();
            var url = "{{ route('surveyor.gated-reports') }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#searchform").serialize() + "&search=" + $('#fltr_search').val();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt',
                    "pageLength": 50
                })
                toggleLoadingAnimation();
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
        });
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


            $('#fltr_property_type').change(function() {
                if ($(this).val() == '1') {
                    $('.filters-hide').show();
                    $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#const-type-blk")
                        .hide();
                } else if ($(this).val() == '2') {
                    $('.filters-hide').hide();
                    $("#res-sub-type-blk,#res-type-blk,#prop-type-blk").show();
                }
            });
            $('#plot_land_types').change(function() {
                if ($(this).val() == '13') {
                    $('.filters-hide').hide();
                    $("#plot-lands-blk,#plot-name-blk,#street-blk,#colony-blk,#owner-blk,#contact-blk,#boards-blk")
                        .show();
                } else if ($(this).val() == '14') {
                    $('.filters-hide').hide();
                    $("#plot-lands-blk,#plot-blk,#street-blk,#colony-blk,#contact-blk,#contact-blk,#house-blk,#builder-name-blk,#project-blk")
                        .show();

                }
            });
            $('#fltr_construction_type').change(function() {
                if ($(this).val() == '1') {
                    $('.filters-hide').show();
                    $("#res-sub-type-blk,#project-blk,#res-type-blk,#owner-blk,#boards-blk,#plot-lands-blk,#plot-name-blk,#prop-type-blk")
                        .hide();
                } else if ($(this).val() == '2') {
                    $('.filters-hide').hide();
                    $("#res-sub-type-blk,#res-type-blk,#const-type-blk").show();
                } else if ($(this).val() == '3') {
                    $('.filters-hide').hide();
                    $("#project-blk,#builder-name-blk,#contact-blk,#const-type-blk,#house-blk,#plot-blk,#street-blk,#colony-blk")
                        .show();
                }
            });


        });


        $('#show-entries').change(function() {
            var entryVal = $(this).val();
            var url = "{{ route('surveyor.gated-reports') }}";
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
@endpush
