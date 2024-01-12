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
    </style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report Detailggggs</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-md-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xxl-3 col-md-2 mt-3">
                                    <div>
                                        <label for="" class="form-label">From Date</label>
                                        <input type="date" class="form-control filter_input" id="start_date"
                                            placeholder="From date">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-2 mt-3">
                                    <div>
                                        <label for="" class="form-label">To From</label>
                                        <input type="date" class="form-control filter_input" id="end_date"
                                            placeholder="From date">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label ">Category of the Property </label>
                                        <select class="form-select filter_dropdown" id="category">
                                            <option selected disabled>-Select Category-</option>
                                            @forelse($categories as $key=>$category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @empty
                                                {{-- <option>-no options are available-</option> --}}
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Type of the Property </label>
                                        <select class="form-select filter_dropdown" id="sub_category">
                                            <option selected disabled>-Select Category-</option>
                                            @forelse($sub_categories as $key=>$sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->title }}
                                                </option>
                                            @empty
                                                {{-- <option>-no options are available-</option> --}}
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 mt-3">
                                    <div>
                                        <label for="" class="form-label">House No </label>
                                        <input type="text" class="form-control filter_input" id="fltr_house_no">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Plot No </label>
                                        <input type="text" class="form-control filter_input" id="fltr_plot_no">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Street Name/No/Road No </label>
                                        <input type="text" class="form-control filter_input" id="fltr_street_name">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 mt-3">
                                    <div>
                                        <label for="" class="form-label">Colony/Locality Name </label>
                                        <input type="text" class="form-control filter_input" id="fltr_locality_name">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Owner Name </label>
                                        <input type="text" class="form-control filter_input" id="fltr_owner_name">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="" class="form-label">Contact No</label>
                                        <input type="text" class="form-control filter_input" id="fltr_contact_no">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 mt-3">
                                    <div>
                                        <label for="" class="form-label">GIS ID </label>
                                        <input type="text" class="form-control filter_input" id="fltr_gis_id">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary " id="filter-reset">Reset</button>
                                <button class="btn btn-primary " id="filter">Search</button>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-xl-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-1 ">
                                <!--<h5>Department Wise </h5>-->

                                <div>
                                    <button class="btn btn-warning btn-sm ms-1 export-btn" data-export="buttons-print"><i
                                            class="fa-solid fa-print"></i>
                                        Print</button>
                                    <button class="btn btn-secondary btn-sm ms-1 export-btn"
                                        data-export="buttons-excel"><i class="fa-solid fa-file-excel me-1"></i>
                                        Excel</button>
                                    <button class="btn btn-primary btn-sm ms-1 export-btn" data-export="buttons-pdf"> <i
                                            class="fa-regular fa-file-pdf me-1"></i>
                                        PDF</button>
                                    <button class="btn btn-info btn-sm ms-1 export-btn" data-export="buttons-csv"><i
                                            class="fa-solid fa-file-csv me-1"></i>
                                        CSV</button>
                                </div>
                                <div>
                                    <div class="form-group search-icon-main">
                                        <input type="search" placeholder="Search... " class="form-control"
                                            id="fltr_search">
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass fa-beat"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped dt-responsive nowrap data-table " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Date </th>
                                            <th>Time </th>
                                            <th>GIS ID</th>
                                            <th>Category of the property</th>
                                            <th>Type of property</th>
                                            <th>House No.</th>
                                            <th>Colony/Locality Name</th>
                                            <th>Owner Full Name</th>
                                            <th>Contact No</th>
                                            <th class="noExport">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

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
    <script>
        $(document).on('change', '#category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('admin/ajax/sub_categories') }}",
                success: function(response) {
                    $('#sub_category').empty();
                    $("#sub_category").append(
                        '<option selected disabled>--Select Type of Property--</option>');
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    }
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
        $(function() {
            var table = $('.data-table').DataTable({
                // pageLength: 20,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.property.ajax-get') }}",
                    data: function(d) {
                        d.status = $('#status').val(),
                            d.search = $('#fltr_search').val(),
                            d.gis = $('#fltr_gis_id').val(),
                            d.house_no = $('#fltr_house_no').val(),
                            d.locality_name = $('#fltr_locality_name').val(),
                            d.start_date = $('#start_date').val(),
                            d.end_date = $('#end_date').val(),
                            d.category = $('#category').val(),
                            d.sub_category = $('#sub_category').val(),
                            d.plot_no = $('#fltr_plot_no').val(),
                            d.street_name = $('#fltr_street_name').val(),
                            d.owner_name = $('#fltr_owner_name').val(),
                            d.contact_no = $('#fltr_contact_no').val(),
                            d.type = $('#type').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'gis_id',
                        name: 'gis_id'
                    },
                    {
                        data: 'cat',
                        name: 'cat'
                    },
                    {
                        data: 'sub_cat',
                        name: 'sub_cat'
                    },
                    {
                        data: 'house_no',
                        name: 'house_no'
                    },
                    {
                        data: 'locality_name',
                        name: 'locality_name'
                    },
                    {
                        data: 'owner_name',
                        name: 'owner_name'
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                // lBrtip
                dom: 'Blifrtip',
                lengthMenu: [
                    [10, 25, 100, -1],
                    [10, 25, 100, "All"]
                ],
                buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        // page: 'all',
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }],
                language: {
                    emptyTable: "No Properties available",
                    info: "Total Properties _END_",
                    // "info": "Total Properties _START_ _END_ _TOTAL_ ",
                },
            });
            // $('#fltr_search, #fltr_gis_id, #fltr_house_no, #fltr_locality_name, #start_date, #end_date, #category, #sub_category, #fltr_plot_no, #fltr_street_name, #fltr_owner_name, #fltr_contact_no')
            //     .change(
            //         function() {
            //             table.draw();
            //         });
            $('#fltr_search')
                .keyup(
                    function() {
                        table.draw();
                    });
            $('#filter-reset').on('click', function() {
                $('.filter_input').each(function() {
                    $(this).val('');
                });
                $('.filter_dropdown option:first').prop('selected', true).trigger("change");
                // $('.filter_input option:first').prop('selected', true);

                $('.data-table').DataTable().responsive.recalc();
                table.draw();
            })
            $('#filter')
                .click(
                    function() {
                        $('.data-table').DataTable().responsive.recalc();
                        // $.fn.dataTable.ext.errMode = 'throw';
                        table.draw();
                    });
        });

        // $(document).on('click', '#fltr_search', function() {
        //     $.fn.dataTable.ext.errMode = 'throw';
        //     table.draw();
        // });

        $(document).on('click', '.export-btn', function() {
            $('.' + $(this).data('export')).trigger('click');
        })

        $(document).on("change", "#start_date", function() {
            // debugger
            var date = $(this).val();
            $('#end_date').attr('min', date);
        });
    </script>
@endpush
