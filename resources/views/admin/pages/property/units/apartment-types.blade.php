@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <link href="{{ url('public/assets/css///unit-details.css') }}" rel="stylesheet" type="text/css" />
   
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
                        <h4 class="mb-sm-0">Add unit Apartment Type </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <form action="{{url('surveyor/property/add-unit-apartment-type')}}/{{$unit_id}}" method="post">
                                <div class="col-xxl-3 col-md-3  mt-3">
                                    <div class="form-group">
                                        <label for="" class="form-label"> Unit Apartment Type <span class="errorcl">*</span></label>
                                         {{-- {{ dd($apartment_types) }} --}}
                                        <select class="form-select ctfd-required" name="apartment_type">
                                            <option value="" selected="" disabled="">-Select Category-</option>
                                            @foreach ( $apartment_types as $item)
                                            <option value="{{$item->id}}" >{{$item->apartment_type_desc}}</option>
                                            @endforeach
                                            {{-- <option value="1" data-blade-slug="primary_data_commercial">Commercial</option> --}}
                                        </select>
                                        @error('apartment_type')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3  mt-3">
                                    <button type="submit" class="btn btn-warning waves-effect waves-light w_100"  id="create_property_btn">Save &amp; Continue</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- container-fluid -->
                </div>
            </div>
            <!-- End Page-content -->

        </div>




    </div> <!-- container-fluid -->
    </div>
    <!--End Page-content -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=9854565"></script>
    <script>
        // @foreach ($errors->all() as $error)
        // toastr.error("{{ $error }}")
        // @endforeach
        // @if (Session::has('message'))
        // toastr.success("{{ Session::get('message') }}")
        // @endif
    </script>





    {{-- <script src="{{ url('public/assets/js/property//hospitality_extra.js') }}"></script> --}}
@endpush
