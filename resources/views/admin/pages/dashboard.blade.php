@extends('admin.layouts.main')
@section('content')
    <style>
        .fs_22 {
            font-size: 35px !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    @if (Auth::user()->hasRole('surveyor'))
                        <div class="card">
                            <div class="card-header align-items-center ">
                                <div class="d-flex justify-content-end">

                                    <a href="{{ url('surveyor/basic_details') }}" type="button"
                                        class="btn btn-secondary custom-toggle add-property mx-2">
                                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add
                                            Property</span>
                                    </a>
                                    <a target="_blank" href="{{ route('surveyor.webgis') }}" type="button"
                                        class="btn btn-secondary custom-toggle add-property">
                                        <span class="icon-on"><i class="fa-solid fa-map-location-dot"></i> WebGIS</span>
                                    </a>

                                </div>
                            </div>
                            <!-- end card header -->

                        </div>
                    @endif
                </div>

            </div>

            @if (Auth::user()->hasRole('surveyor'))
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'today') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #ceefff;">

                                    <div class="d-flex align-items-end justify-content-between mt-0">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $today_data ?? '' }}">{{ $today_data ?? '' }}</span>
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data', 'today') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    Surveyed Today</p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div><!-- end col -->



                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'week') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="card-body" style="background-color: #F7C8E0;">

                                    <div class="d-flex align-items-end justify-content-between mt-0">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $this_week ?? '' }}">{{ $this_week ?? '' }}</span>
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data', 'week') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">Surveyed
                                                    This
                                                    Week
                                                </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->


                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'month') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #B5F1CC;">

                                    <div class="d-flex align-items-end justify-content-between mt-0">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $this_month ?? '' }}">{{ $this_month ?? '' }}</span>
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data', 'month') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">Surveyed
                                                    This
                                                    Month
                                                </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">

                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>


                                <div class="card-body" style="background-color: #FFF4E0;">

                                    <div class="d-flex align-items-end justify-content-between mt-0">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $property_count ?? '' }}">{{ $property_count ?? '' }}</span>
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    Total Surveyed</p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->







                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'for-sale') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #ceefff;">

                                    <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $for_sale ?? '' }}">{{ $for_sale ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data', 'for-sale') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    For Sale Properties</p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div><!-- end col -->



                    <div class="col-xl-3 col-md-6">

                        <!-- card -->
                        <div class="card card-animate overflow-hidden p-2">
                            <div class="position-absolute start-0" style="z-index: 0;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                    width="200" height="120">
                                    <style>
                                        .s0 {
                                            opacity: .05;
                                            fill: var(--vz-success)
                                        }
                                    </style>
                                    <path id="Shape 8" class="s0"
                                        d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                    </path>
                                </svg>
                            </div>
                            <div class="card-body" style="background-color: #F7C8E0;">

                                <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary">
                                            <span id="property-count" class="counter-value"
                                                data-target="{{ $for_rent ?? '' }}">{{ $for_rent ?? '' }}</span>
                                        </h4>
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-calendar-days fs_22"></i>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a id="property-url" href="{{ route('surveyor.filter-data', 'for-rent') }}">
                                            <p id="property-label"
                                                class="text-uppercase fw-bold text-dark text-truncate mb-0">For Rent
                                                Properties
                                            </p>
                                        </a>
                                    </div>

                                </div>


                            </div><!-- end card body -->
                        </div><!-- end card -->

                    </div>
                    <!-- end col -->


                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'vacant') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #B5F1CC;">

                                    <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary ">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $vacant ?? '' }}">{{ $vacant ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('surveyor.filter-data', 'vacant') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">Vacant
                                                    Properties
                                                </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('surveyor.filter-data', 'under-construction') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">

                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>


                                <div class="card-body" style="background-color: #FFF4E0;">

                                    <div class="d-flex align-items-center justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary ">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $under_construction ?? '' }}">{{ $under_construction ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url"
                                                href="{{ route('surveyor.filter-data', 'under-construction') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    Under Construction Properties</p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>

                    <!-- end col -->

                </div> <!-- end row-->
            @endif
            @if (Auth::user()->hasRole('gis-engineer'))
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('gis-engineer.properties', 'splits') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #ceefff;">

                                    <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $split_properties ?? '' }}">{{ $split_properties ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('gis-engineer.properties', 'splits') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    Split Properties </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div><!-- end col -->



                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('gis-engineer.properties', 'merged') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="card-body" style="background-color: #F7C8E0;">

                                    <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $merge_properties ?? '' }}">{{ $merge_properties ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url" href="{{ route('gis-engineer.properties', 'merged') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">Merge
                                                    Properties
                                                </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('gis-engineer.properties', 'completed') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="card-body" style="background-color: #B5F1CC;">

                                    <div class="d-flex align-items-end justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary ">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $completed_properties ?? '' }}">{{ $completed_properties ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url"
                                                href="{{ route('gis-engineer.properties', 'completed') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">Completed
                                                    Properties
                                                </p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('gis-engineer.properties', 'temporary-gis-id') }}">
                            <!-- card -->
                            <div class="card card-animate overflow-hidden p-2">

                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120"
                                        width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0"
                                            d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                        </path>
                                    </svg>
                                </div>


                                <div class="card-body" style="background-color: #FFF4E0;">

                                    <div class="d-flex align-items-center justify-content-between mt-0 mb-3">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary ">
                                                <span id="property-count" class="counter-value"
                                                    data-target="{{ $temporary_gis_properties ?? '' }}">{{ $temporary_gis_properties ?? '' }}</span>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-calendar-days fs_22"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <a id="property-url"
                                                href="{{ route('gis-engineer.properties', 'temporary-gis-id') }}">
                                                <p id="property-label"
                                                    class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                                    Update GIS IDs</p>
                                            </a>
                                        </div>

                                    </div>


                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </a>
                    </div>

                    <!-- end col -->
                </div> <!-- end row-->
            @endif
            <!--end row-->

        </div> <!-- container-fluid -->
    </div><!-- End Page-content -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".get-property-count").click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var type = this.getAttribute('data-value');
                    $.ajax({
                        url: "{{ route('dashboard.get-property-count') }}", // the route defined in step 1
                        method: 'post',
                        data: {
                            type: type
                        },
                        success: function(response) {
                            // handle the response from the server
                            // console.log(response);
                            $('#property-label').html(response.type);
                            $('#property-count').html(response.count);
                            var url = "{{ url('surveyor/property/reports') }}/" + response.key;
                            $('#property-url').attr("href", url);

                        },
                        error: function(xhr, status, error) {
                            // handle errors
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#shareButton").click(function() {
                    const message = "Hello, this is a WhatsApp message from my Laravel app!";
                    const encodedMessage = encodeURIComponent(message);
                    const whatsappLink = `https://api.whatsapp.com/send?text=${encodedMessage}`;

                    // Open WhatsApp link in a new window
                    window.open(whatsappLink, "_blank");
                });
            });
        </script>
    @endpush
@endsection
