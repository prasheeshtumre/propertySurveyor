@extends('admin.layouts.main')
@section('content')
    <style>
          .errorcl {
            color: red;
        }

        .apart-images img {
            padding: 4px !important;
        }

        .image-area {
            position: relative;
            /* width: 50%; */
            margin: 20px;
            background: #333;
            border-radius: 5px;
        }

        .image-area img {
            max-width: 100%;

            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        #files-preview {
            border: 2px dashed gray;
            background: lightgray;
            /* visibility: hidden; */

        }
        .loader-circle-2 {
            position: absolute;
            width: 70px;
            height: 70px;
            top: 45%;
            left: 45%;
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
        .loader-container{
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
        	animation: loader-circle-2-animation 0.85s linear  infinite;
        }
        span.remove-storey, span.remove-storey-unit {
            position: absolute;
            top: 3%;
            left: 97%;
            width: 20px;
            cursor:pointer;
        }
        .merged-notch {
        	 position: relative;
        	 margin: -8px auto;
        	 height: 40px;
        	 z-index: 3;
        }
        .unit-notch{
            position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: rgba(53, 119, 241);
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);
                
        }
         .notch {
        	position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: #222;
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);
        }
         .notch::before, .notch::after {
        	 content: '';
        	 position: absolute;
        	 top: 0;
        	 left: -7px;
        	 width: 14px;
        	 height: 7px;
        	 background-size: 50% 100%;
        	 background-repeat: no-repeat;
        	 background-image: radial-gradient(circle at 0 100%, transparent 6px, #222 7px);
        }
         .notch::after {
        	 left: 100%;
        	 margin-right: corner-sizepx;
        	 background-image: radial-gradient(circle at 100% 100%, transparent 6px, #222 7px);
        }
        .unit-notch::before, .unit-notch::after {
        	 content: '';
        	 position: absolute;
        	 top: 0;
        	 left: -7px;
        	 width: 14px;
        	 height: 7px;
        	 background-size: 50% 100%;
        	 background-repeat: no-repeat;
        	 background-image: radial-gradient(circle at 0 100%, transparent 6px, #222 7px);
        }
         .unit-notch::after {
        	 left: 100%;
        	 margin-right: corner-sizepx;
        	 background-image: radial-gradient(circle at 100% 100%, transparent 6px, #222 7px);
        }
        .floor-mask{
            position: absolute;
            background-color: rgba(255, 255, 255, .5);
            height: 100%;
            width: 99%;
            z-index: 3;
        }
        .storey-unit {
            position: relative;
        }
        .unit-mask {
            position: absolute;
            height: 90%;
            background-color: rgba(255, 255, 255, .5);
            z-index: 1;
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
        @media only screen and (max-width: 600px) { 
            span.remove-storey, span.remove-storey-unit {
                position: absolute;
                top: 1%;
                left: 92%;
                width: 20px;
                cursor: pointer;
            }

                    .unit-notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 0px 10px;
                height: 27px;
                background-color: rgba(53, 119, 241);
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                min-width: 70%;
                text-align: center;
            }
            .notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 4px 33px;
                height: 27px;
                background-color: #222;
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                width: 70%;
                text-align: center;
            }
        }
      
    </style>

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
            <!-- end page title -->
            <form action="{{ route('surveyor.property.store') }}" method="post" id="create_property" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">
                            
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 d-flex align-items-end">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id" placeholder="EX:7255158845" value="" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="ms-3">
                                            <button class="btn btn-success search_gis" type="button" id="btn-search-gis-id">Search</button>
                                        </div>
                                    </div>
                                </div>@extends('admin.layouts.main')
@section('content')
    <style>
          .errorcl {
            color: red;
        }

        .apart-images img {
            padding: 4px !important;
        }

        .image-area {
            position: relative;
            /* width: 50%; */
            margin: 20px;
            background: #333;
            border-radius: 5px;
        }

        .image-area img {
            max-width: 100%;

            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        #files-preview {
            border: 2px dashed gray;
            background: lightgray;
            /* visibility: hidden; */

        }
        .loader-circle-2 {
            position: absolute;
            width: 70px;
            height: 70px;
            top: 45%;
            left: 45%;
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
        .loader-container{
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
        	animation: loader-circle-2-animation 0.85s linear  infinite;
        }
        span.remove-storey, span.remove-storey-unit {
            position: absolute;
            top: 3%;
            left: 97%;
            width: 20px;
            cursor:pointer;
        }
        .merged-notch {
        	 position: relative;
        	 margin: -8px auto;
        	 height: 40px;
        	 z-index: 3;
        }
        .unit-notch{
            position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: rgba(53, 119, 241);
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);
                
        }
         .notch {
        	position: absolute;
            top: 0;
            left: 50%;
            color: #fff;
            padding: 4px 33px;
            height: 27px;
            background-color: #222;
            border-radius: 0 0 28px 28px;
            transform: translateX(-50%);
        }
         .notch::before, .notch::after {
        	 content: '';
        	 position: absolute;
        	 top: 0;
        	 left: -7px;
        	 width: 14px;
        	 height: 7px;
        	 background-size: 50% 100%;
        	 background-repeat: no-repeat;
        	 background-image: radial-gradient(circle at 0 100%, transparent 6px, #222 7px);
        }
         .notch::after {
        	 left: 100%;
        	 margin-right: corner-sizepx;
        	 background-image: radial-gradient(circle at 100% 100%, transparent 6px, #222 7px);
        }
        .unit-notch::before, .unit-notch::after {
        	 content: '';
        	 position: absolute;
        	 top: 0;
        	 left: -7px;
        	 width: 14px;
        	 height: 7px;
        	 background-size: 50% 100%;
        	 background-repeat: no-repeat;
        	 background-image: radial-gradient(circle at 0 100%, transparent 6px, #222 7px);
        }
         .unit-notch::after {
        	 left: 100%;
        	 margin-right: corner-sizepx;
        	 background-image: radial-gradient(circle at 100% 100%, transparent 6px, #222 7px);
        }
        .floor-mask{
            position: absolute;
            background-color: rgba(255, 255, 255, .5);
            height: 100%;
            width: 99%;
            z-index: 3;
        }
        .storey-unit {
            position: relative;
        }
        .unit-mask {
            position: absolute;
            height: 90%;
            background-color: rgba(255, 255, 255, .5);
            z-index: 1;
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
        @media only screen and (max-width: 600px) { 
            span.remove-storey, span.remove-storey-unit {
                position: absolute;
                top: 1%;
                left: 92%;
                width: 20px;
                cursor: pointer;
            }

                    .unit-notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 0px 10px;
                height: 27px;
                background-color: rgba(53, 119, 241);
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                min-width: 70%;
                text-align: center;
            }
            .notch {
                position: absolute;
                top: 0;
                left: 50%;
                color: #fff;
                padding: 4px 33px;
                height: 27px;
                background-color: #222;
                border-radius: 0 0 28px 28px;
                transform: translateX(-50%);
                width: 70%;
                text-align: center;
            }
        }
      
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Basic Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic  Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('surveyor.property.store') }}" method="post" id="create_property" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">
                            
                            <div class="card-body ">
                                <div class="row">

                                    <div class="col-xxl-6 col-md-6">

                                        <div class="">
                                          
                                            <div onclick="getCordinates()" class="form-group picking row">

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Latitude" name="latitude"
                                                        id="latitude" class="form-control controls ctfd-required"
                                                        value="{{ old('latitude') }}">
                                                    @error('latitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Longitude" name="longitude"
                                                        id="longitude" class="form-control controls ctfd-required"
                                                        value="{{ old('longitude') }}">
                                                    @error('longitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-info " type="button">
                                                        <label style="cursor:pointer; margin-bottom:0px;">
                                                            <span class="mdi mdi-crosshairs-gps  "></span>
                                                            Pick my Location
                                                        </label>
                                                    </button>
                                                </div>


                                            </div>
                                            

                                            <!-- Search input -->


                                            <!-- Google map -->
                                            <div id="map"></div>

                                            <!-- Display geolocation data -->
                                           
                                        </div>
                                        <span class="geo-loc-error" style="color: red"></span>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="loader-container d-none">
                                <div class="loader-circle-2"></div>
                            </div>
                            <div class="card-body primary-block">

                                <div class="row">

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id"
                                                placeholder="EX:7255158845" value="{{ old('gis_id') }}"
                                                onkeypress="return isNumber(event)">
                                            @error('gis_id')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Category of the property <span
                                                    class="errorcl">*</span></label>
                                            <select class="form-select ctfd-required" name="category" id="category">
                                                <option value="" selected disabled>-Select Category-</option>
                                                @forelse($categories as $key=>$category)
                                                    @if (old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected> {{ $category->cat_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endif

                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                            @error('category')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks"  >
                                        <div>
                                            <label for="" class="form-label">Residential Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_types">
                                                <option selected="" disabled="">-Select Residential Types-</option>
                                                <option value="apartment">Apartment</option>
			                                    <option value="independent-house">Independent House/Villa</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks" id="" >
                                        <div>
                                            <label for="" class="form-label">Residential Sub Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_sub_types">
                                                <option selected="" disabled="">-Select Residential Sub Types-</option>
                                    			<option value="residential-apartment-stand-alone" class="residential-child apartment-child d-none">Stand-alone Apartment</option>
                                    			<option value="residential-apartment-gated-community" class="residential-child apartment-child d-none">Gated Community</option>
                                    			<option value="residential-independent-house-individual-house" class="residential-child independent-house-child d-none" >Individual House </option>
                                    			<option value="residential-independent-house-gated-community" class="residential-child independent-house-child d-none">Gated Community </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none plot_land_blks"  >
                                        <div>
                                            <label for="" class="form-label">Plot Land Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="plot_land_type" id="plot_land_types">
                                                
                                               
                                            </select>
                                        </div>
                                    </div>
                           

                                </div>
                                
                                <div id="defined_block"></div>
                                
                                <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="" >
                                <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor" value="" >
                                <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="" >
                                <input type="hidden" class="" name="unit_exist" id="unit-exist" value="" >
                                <input type="hidden" class="" name="property_id" id="property_id" value="" >
                                <div class="col-xxl-6 col-md-6 mt-3">
                                    <div class="row remove-merge-ele d-none">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger remove-merge">Reset Merge</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="files" class="form-label">
                                            Capture Property Images 
                                            <span
                                                class="errorcl">*</span></label>
                                        <div class="d-flex justify-content-center flex-column " >
                                            <input type="file" name="files[]" id="files" class="form-control"
                                                multiple placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Capture Property Images</span></label>
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
                                          <input class="form-check-input" type="checkbox" name="up_for_sale" id="up_for_sale">
                                          <label class="form-check-label" for="up_for_sale">
                                            up for Sale
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="up_for_rent" id="up_for_rent" >
                                          <label class="form-check-label" for="up_for_rent">
                                            up for Rent
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-xxl-12 col-md-12 mt-3">
                                    <div>
                                        <label for="" class="form-label">Remarks </label>
                                        <textarea name="remarks" class="form-control" rows="3" value="{{ old('remarks') }}"></textarea>
                                    </div>
                                </div>
                                
                                
                                 
                                <div class="text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-warning waves-effect waves-light w_100" id="create_property_btn">Submit</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="create_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Added Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-brand-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Brand </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('surveyor.brand.store') }}" method="post" class="add-brand-frm" >
          <div class="modal-body">
                 <input type="text" value="" id="brand_parent_id" name="parent_id" class="" >
                <div class="row">
                    <div class="col-auto ">
                        <label for="" class="form-label">Concerned Person Name</label>
                        <input type="text" value="" name="brand_name" class="form-control form-control-sm" >
                    </div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<script>
</script>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
	
	<script >
	    $(document).ready(function() {
            $('.select2-dd').select2();
            $("input:text").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            
            $('#mySelect2').select2({
              ajax: {
                url: 'https://api.github.com/orgs/select2/repos',
                data: function (params) {
                  var query = {
                    search: params.term,
                    type: 'public'
                  }
            
                  // Query parameters will be ?search=[term]&type=public
                  return query;
                }
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
            

        });
	</script>
   
    <script>
      var floorNames = [];
        $(document).on('keyup', "input[name=nth_floor_name]", function(){
            floorNames = [];
            $("input[name=nth_floor_name]").each(function(i){
                floorNames.push({"id": i, "text" : $(this).val()});
            });
            console.log(floorNames);
            $(".commercial-select2").empty();
            $.each( floorNames, function( key, value ) {
                $(".commercial-select2").append('<option value="5">'+value.text+'</option>');
            });
            //  $(".js-select2").append('<option value="5">Twitter</option>');
        });
        
        $(".commercial-select2").select2({
			closeOnSelect : false,
			placeholder : "select units",
			allowHtml: true,
			allowClear: true,
		});

         $(document).on('change', '#category', function(e) {
            let id = $(this).val();
            let category_type = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {c_id:id},
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
                    if(response.length == 0){
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
                data: {c_id:id},
                success: function(response) {
                    $('.category-fields-container').html(response);
                    $('.select2-dd').select2();
                }
            });
        });
         
        $(document).on('change', '#comm_type_of_unit', function(){
            ($(this).val() == 1) ? $('.floor-chk').removeClass('d-none') : $('.floor-chk').addClass('d-none') ;
            ($(this).val() == 2) ? $('.unit-chk').removeClass('d-none') : $('.unit-chk').addClass('d-none') ;
        });
        
        $(document).on('change', '#comm_type_of_unit_child_dd', function(){
            let dependentDdown = $(this).val();
            dependentDdown = dependentDdown.toLowerCase();
            (dependentDdown == 'occupied') ? $('.commercial-'+dependentDdown+'-child').removeClass('d-none') : $('.commercial-tou-name-children').addClass('d-none') ;
        });
        

        
        // generate floors using add floor button
        $(document).on('click', ".add-floor", function(){
            let currentStoreyCount = $('.storey').length;
            let count = ($('.no_of_floors').val() == '') ? 0 : parseInt($('.no_of_floors').val());
            // alert(count)
            if(count < 1){
                toastr.error('please enter valid floor count');
                return false
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
            let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalFloors = '';
            $('.loader-container').removeClass('d-none');
            
            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getFloors(start index, finalCount)
            totalFloors = getFloors(currentStoreyCount, finalCount);
            (currentStoreyCount > 0 ) 
            ? (
                $(totalFloors).insertAfter($(".storey:last-child"))
                ) 
            : $(totalFloors).insertAfter( $(this).closest(".append-floors") );
            $(".remove-storey").each(function(){
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
            })
            $(".remove-storey").last().removeClass('d-none');
            $('.floor_unit_type_dd').select2();
            $('.no_of_floors').val($('.storey').length);

            
        });
        
        // add units for floor
         $(document).on('click', ".add-unit", function(){
            let pId = $(".storey").index($(this).closest('.storey'));
            let floorIdOc = $(this).data('floor_id');
            floorIdOc = (floorIdOc == undefined) ? 0: floorIdOc;
            // alert(floorIdOc);
            // get no of units count
            let count = $(this).closest('.storey-nou-child').find('.no_of_units').val();
            // generate units only if no of units value is greater than 1
            let currentStoreyUnitCount = $(this).closest('.storey').find('.storey-unit').length;
            // let finalCount = (currentStoreyUnitCount > count ) ? currentStoreyCount - count : count ;
            let totalCount = parseInt(currentStoreyUnitCount) + parseInt(count);
            if(count > 1 || currentStoreyUnitCount > 1){
                // alert('start : '+currentStoreyUnitCount+'totalCount : '+ totalCount)
                let totalFloors = getUnits(currentStoreyUnitCount, totalCount, pId, floorIdOc);
                // append units html to respective floor
                (currentStoreyUnitCount > 0 ) 
                ? $(totalFloors).insertAfter($(this).closest('.floor-dds_row').nextAll('.unit-container').first().find('.storey-unit').last())
                : $(this).closest('.floor-dds_row').nextAll('.unit-container').first().html(totalFloors);
               $(".remove-storey-unit").addClass('d-none');
                $('.storey').each(function(){
                    $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                    let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                    $(this).find('.no_of_units').val(currentStoreyUnitLength)
                });
                $(this).closest('.floor-dds_row').find('.append-dd-to').addClass('d-none');
                $(this).closest('.storey').find('.unit-tfd').addClass('d-none');
            }else{
                ($('#category').val() == 3) 
                ?($(this).closest('.floor-dds_row').find('.append-dd-to').andSelf().slice(0,2).removeClass('d-none'))
                :($(this).closest('.floor-dds_row').find('.append-dd-to').first().removeClass('d-none'));
                $(this).closest('.storey').find('.storey-unit').remove();
                // $(this).closest('.storey').find('.unit-tfd').removeClass('d-none');
            }
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none')
            })
            setTimeout(()=>{
              ($('.floor-parent-'+pId).prop('checked') === true)
                ? ($('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',true))
                : $('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',false);
              }, 600);
              $('.un_unit_type_dd').select2();
              
        });
        
        // delete floor
        $(document).on('click', ".remove-storey", function(){
            let storey_id = ($(this).data('floor_id') != undefined) ? $(this).data('floor_id') : 0;
            if(storey_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_floor') }}",
                    data:{ floor_id : storey_id},
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
        $(document).on('click', ".remove-storey-unit", function(){
            let storey_unit_id = ($(this).data('unit_id') != undefined) ? $(this).data('unit_id') : 0;
            if(storey_unit_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_unit') }}",
                    data:{ unit_id : storey_unit_id},
                    success: function(response) {
                        // $('.storey').remove();
                        // let floors = getPropertyFloors(response.data.id)
                    }
                });
            }
            let currentStoreyUnits =  $(this).parent().closest('.unit-container').find('.storey-unit');
            // $(this).parent().closest('.storey').find('.add-unit').trigger('click');
            (currentStoreyUnits.length == 2) ? currentStoreyUnits.remove() : $(this).parent().remove();
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                $(this).find('.no_of_units').val(currentStoreyUnitLength)
            });
            
        });
        
        $(document).on('click', ".floor-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey').find('.floor-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        $(document).on('click', ".unit-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey-unit').find('.unit-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey-unit').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        
        //  append  unit drop-down optioins to floors and units
        $(document).on('change', '.floor_ddopt, .unit_ddopt', function(){
            //to get and enable or display next unit drop-down element parenet block
            let next_parent_element = $(this).closest('.append-dd-to').nextAll('.append-dd-to').first();
            let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
            let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
            let current_block_other_text_elements = $(this).closest('.append-dd-to').nextAll('.brand-tfd');
            // to get next occured unit drop-down 
            let fieldType = $(this).find(':selected').data('field');
            let fieldOtherType = $(this).find(':selected').data('others')
            let next_ddopt_child = ($(this).hasClass('floor_ddopt')) 
            ? next_parent_element.find('.floor_ddopt')
            : next_parent_element.find('.unit_ddopt');
            // let uType = $(this).val() = 2;
            let cat_id = $(this).val();
            let propertyId = $('#property_id').val();
            let prop_cat = $(this).parent().closest('.dds_row').find('.prop_category_dd').first().val();
            // alert(prop_cat)
             $.ajax({
                type: "GET",
                data: {
                    cat_id: cat_id, property_id : propertyId
                },
                url: "{{ url('get_unit_categories') }}",
                success: function(response) {

                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) 
                    ? (next_parent_element.addClass('d-none'))
                    :next_parent_element.removeClass('d-none');
                    ($('#category').val() == 3)
                    ?(prop_cat == 1)? next_parent_element.removeClass('d-none'): (next_parent_element.addClass('d-none'))
                    :'';
                    
                    $(next_ddopt_child).empty();
                    if(response.data.length == 0){
                        // $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                    }
                    
                    if (response.data) {
                        if(fieldType == 'select'){
                            $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            $(current_block_text_elements).addClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            // $(current_block_dd_elements).removeClass('d-none');
                        }
                        else if(fieldType == 'text'){
                            $(current_block_text_elements).removeClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            $(current_block_dd_elements).addClass('d-none');
                            
                            // $.each(response, function(key, value) {
                          
                            // });
                        }
                        //this will get hit ater first dd change
                        else if(fieldType == undefined){
                             $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            
                            $.each(response.other_options, function(key, value) {
                                next_ddopt_child.append($("<option></option>").attr({"value": value.brand_name, "data-others": 'others' }).text(value.brand_name));
                            });
                            
                        }
                        if(fieldOtherType == 'others'){
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
        $(document).on('click', '.add-fbrand', function(e){
            e.preventDefault();
            $(this).closest('.storey').find('.brand-tfd').first().removeClass('d-none')
        })
        
        $(document).on('click', '.merge_other_units', function(){
            if($(this).prop('checked') === true){
                $(this).parent().closest('.unit-container').addClass('active-unit-merge');
                $(this).addClass('active');
                $(this).parent().find('.merge_other_unit_lable').removeClass('btn-outline-primary');
                $(this).parent().find('.merge_other_unit_lable').addClass('btn-primary');
                $('.merge_other_units').each(function(){
                  if(!$(this).hasClass('active')) { $(this).prop('disabled', true) }else{ $(this).prop('disabled', false)}
                });
                $('.unit-container').each(function(){
                  if(!$(this).hasClass('active-unit-merge')) { $(this).find('.unit-chk').removeClass('d-none') }else{ $(this).find('.unit-chk').addClass('d-none') }
                });
                
                $('.oup-unit').addClass('d-none');
                
                // unit-parent-floor
                let index = -1;
                let currentUnitIndex = 0;
                $(this).parent().closest('.unit-container').find('.merge_other_units').each(function(){
                    index++;
                    if($(this).hasClass('active')){
                        currentUnitIndex = index;
                    }
                })
                let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
                // alert(currentFloorIndex);
                // alert(currentUnitIndex);
                $('#unit-parent-floor').val(currentFloorIndex);
                
                ($(this).data('uid') != undefined) ? ($('#parent-unit').val($(this).data('uid')), $('#unit-exist').val(1)) : ($('#parent-unit').val(currentUnitIndex), $('#unit-exist').val(0));
            
                $(this).parent('.unit-merge-group').find('.save-unit-merge').removeClass('d-none');
                
                // current storey unit input validations
                // $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                let reqElements = $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                reqElements.each(function(){
                    $(this).not(':hidden').addClass('req-validate');
                })
            }
            if($(this).prop('checked') === false){
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
        
        $(document).on('click', '.merge_other_floors', function(){
            let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
           
            $('.floor-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $('.unit-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $(this).parent().find('.floor-merge-btn').removeClass('btn-outline-primary');
            $(this).parent().find('.floor-merge-btn').addClass('btn-primary');
            
            if($(this).prop('checked') === true){
                
                ($(this).data('fid') != undefined) ? $('#parent-floor').val($(this).data('fid')) : $('#parent-floor').val(currentFloorIndex) ;
                
                
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
            
            if($(this).prop('checked') === false){
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
        $(document).on('click', '.floor-chk', function(){
            if($(this).prop('checked') === true){
                $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.floor-dds_row').find('.no_of_units').val(0);
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',true);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',true);
                
            }else{
                // $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',false);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',false);
            }
            
        });
        
        $(document).on('click', '.unit-chk', function(){
            ($(this).prop('checked') === true)
            ? (
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',true)
               )
            :(
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',false)
              )
            ;
            
        });
        

        function getFloors(startIndex, count){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_sd_floors') }}",
                data:{c_id : c_id, count : count, start_index : startIndex},
                success: function(response) {
                    temp_floors = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            
            return temp_floors;
        }
        $(document).on('click', '.remove-merge',function(e){
            remove_merge();
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
            
        });
        
        function remove_merge(){
            $('.loader-container').removeClass('d-none');
            var temp_floors =null;
            let c_id = $('#category').val();
            let property_id = $('#property_id').val();

            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('remove_merge') }}",
                data:{c_id : c_id, property_id : property_id},
                success: function(response) {
                    $('.loader-container').addClass('d-none');
                    $('.storey').remove();
                    let floors = getPropertyFloors(property_id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                }
            });
        }
        
        function getUnits(startIndex, count, floor_id, floorIdOc){
            var temp_units =null;
            let c_id = $('#category').val();
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async:false,
                url: "{{ url('get_units') }}",
                data:{c_id : c_id,count :count, floor_id : floor_id, start_index : startIndex, property_id : propertyId, floor_idoc : floorIdOc},
                success: function(response) {
                    temp_units = response;
                }
            });
            
            return temp_units;
        }
        
        function getPropertyFloors(property_id){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_edit_floors') }}",
                data:{c_id : c_id ,property_id : property_id},
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
        
        $(document).on('click', '.save-floor-merge', function(e){
            $('.loader-container').removeClass('d-none');
            // setTimeout(function(){
            //     $('.loader-container').addClass('d-none');
            // }, 1000);
            // toastr.success('Floors Merged Successfully');
            // 
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_floor_merge') }}"  : $('#create_property').attr('action') ;
            saveProperty(save_floor_merge_url);
        });
        
        $(document).on('click', '.save-unit-merge', function(e){
            $('.loader-container').removeClass('d-none');
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_unit_merge') }}"  : $('#create_property').attr('action') ;
            // saveProperty(save_floor_merge_url);
             $.ajax({
                url: save_floor_merge_url, 
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
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    $('.remove-merge-ele').removeClass('d-none')
                    
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
                        });
                    } 
                    }
            });

        });
        
        function saveProperty(save_merge_url){
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
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    $('.remove-merge-ele').removeClass('d-none');
                    
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
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
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
              // Will return ['granted', 'prompt', 'denied']
              (result.state == 'denied') ? $('.geo-loc-error').html('Please Enable Your Location.') :'';
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
        
        
        
        $(document).on('click','#create_property_btn', function(e){
            e.preventDefault(); // Prevent default form submission
            var isValid = validateForm();

            if (isValid) {
                // Form is valid, submit the form
                $('#create_property').submit();
            }
            
        });
        
        function validateForm() {
            $('.flash-errors').remove();
            var isValid = true;
            $('.ctfd-required').each(function() {
                var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
                if ( value === ''  || value === null) {
                    isValid = false;
                    // 
                    ($(this).hasClass('no_of_floors')) 
                    ?($('<span class="input-error flash-errors" style="color: red">this field is required.</span>').insertAfter($(this).parent('.input-group')))
                    :($('<span class="input-error flash-errors" style="color: red">this field is required.</span>').insertAfter(this),$(this).addClass('is-invalid'));
                    
                    ;
                } else {
                    $(this).removeClass('is-invalid');
                }
                $('.is-invalid:first').focus();
            });
            return isValid;
        }
        
        //  
    </script>
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
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
    </script>
   
    @endpush

                            </div>


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="loader-container d-none">
                                <div class="loader-circle-2"></div>
                            </div>
                            <div class="card-body primary-block">

                                <div class="sd-floor-fields">
                                </div>
                                <div class="row">

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id"
                                                placeholder="EX:7255158845" value="{{ old('gis_id') }}"
                                                onkeypress="return isNumber(event)">
                                            @error('gis_id')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Category of the property <span
                                                    class="errorcl">*</span></label>
                                            <select class="form-select ctfd-required" name="category" id="category">
                                                <option value="" selected disabled>-Select Category-</option>
                                                @forelse($categories as $key=>$category)
                                                    @if (old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected> {{ $category->cat_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endif

                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                            @error('category')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks"  >
                                        <div>
                                            <label for="" class="form-label">Residential Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_types">
                                                <option selected="" disabled="">-Select Residential Types-</option>
                                                <option value="apartment">Apartment</option>
			                                    <option value="independent-house">Independent House/Villa</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks" id="" >
                                        <div>
                                            <label for="" class="form-label">Residential Sub Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_sub_types">
                                                <option selected="" disabled="">-Select Residential Sub Types-</option>
                                    			<option value="residential-apartment-stand-alone" class="residential-child apartment-child d-none">Stand-alone Apartment</option>
                                    			<option value="residential-apartment-gated-community" class="residential-child apartment-child d-none">Gated Community</option>
                                    			<option value="residential-independent-house-individual-house" class="residential-child independent-house-child d-none" >Individual House </option>
                                    			<option value="residential-independent-house-gated-community" class="residential-child independent-house-child d-none">Gated Community </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none plot_land_blks"  >
                                        <div>
                                            <label for="" class="form-label">Plot Land Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="plot_land_type" id="plot_land_types">
                                                
                                               
                                            </select>
                                        </div>
                                    </div>
                           

                                </div>
                                
                                <div id="defined_block"></div>
                                
                                <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="" >
                                <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor" value="" >
                                <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="" >
                                <input type="hidden" class="" name="unit_exist" id="unit-exist" value="" >
                                <input type="hidden" class="" name="property_id" id="property_id" value="5" >
                                <div class="col-xxl-6 col-md-6 mt-3">
                                    <div class="row remove-merge-ele d-none">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger remove-merge">Reset Merge</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-3 col-md-3 mt-3">
                                    <div>
                                        <label for="files" class="form-label">
                                            Capture Property Images 
                                            <span
                                                class="errorcl">*</span></label>
                                        <div class="d-flex justify-content-center flex-column " >
                                            <input type="file" name="files[]" id="files" class="form-control"
                                                multiple placeholder=" " style="display:none;">
                                                <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Capture Property Images</span></label>
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
                                          <input class="form-check-input" type="checkbox" name="up_for_sale" id="up_for_sale">
                                          <label class="form-check-label" for="up_for_sale">
                                            up for Sale
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="up_for_rent" id="up_for_rent" >
                                          <label class="form-check-label" for="up_for_rent">
                                            up for Rent
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-xxl-12 col-md-12 mt-3">
                                    <div>
                                        <label for="" class="form-label">Remarks </label>
                                        <textarea name="remarks" class="form-control" rows="3" value="{{ old('remarks') }}"></textarea>
                                    </div>
                                </div>
                                
                                
                                 
                                <div class="text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-warning waves-effect waves-light w_100" id="create_property_btn">Submit</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="create_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Added Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-brand-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Brand </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('surveyor.brand.store') }}" method="post" class="add-brand-frm" >
          <div class="modal-body">
                 <input type="text" value="" id="brand_parent_id" name="parent_id" class="" >
                <div class="row">
                    <div class="col-auto ">
                        <label for="" class="form-label">Concerned Person Name</label>
                        <input type="text" value="" name="brand_name" class="form-control form-control-sm" >
                    </div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<script>
</script>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
	
	<script >
	    $(document).ready(function() {
            $('.select2-dd').select2();
            $("input:text").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            
            $('#mySelect2').select2({
              ajax: {
                url: 'https://api.github.com/orgs/select2/repos',
                data: function (params) {
                  var query = {
                    search: params.term,
                    type: 'public'
                  }
            
                  // Query parameters will be ?search=[term]&type=public
                  return query;
                }
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
            

        });
	</script>
   
    <script>
      var floorNames = [];
        $(document).on('keyup', "input[name=nth_floor_name]", function(){
            floorNames = [];
            $("input[name=nth_floor_name]").each(function(i){
                floorNames.push({"id": i, "text" : $(this).val()});
            });
            console.log(floorNames);
            $(".commercial-select2").empty();
            $.each( floorNames, function( key, value ) {
                $(".commercial-select2").append('<option value="5">'+value.text+'</option>');
            });
            //  $(".js-select2").append('<option value="5">Twitter</option>');
        });
        
        $(".commercial-select2").select2({
			closeOnSelect : false,
			placeholder : "select units",
			allowHtml: true,
			allowClear: true,
		});

         $(document).on('change', '#category', function(e) {
            let id = $(this).val();
            let category_type = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {c_id:id},
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
                    if(response.length == 0){
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
                data: {c_id:id},
                success: function(response) {
                    $('.category-fields-container').html(response);
                    $('.select2-dd').select2();
                }
            });
        });
         
        $(document).on('change', '#comm_type_of_unit', function(){
            ($(this).val() == 1) ? $('.floor-chk').removeClass('d-none') : $('.floor-chk').addClass('d-none') ;
            ($(this).val() == 2) ? $('.unit-chk').removeClass('d-none') : $('.unit-chk').addClass('d-none') ;
        });
        
        $(document).on('change', '#comm_type_of_unit_child_dd', function(){
            let dependentDdown = $(this).val();
            dependentDdown = dependentDdown.toLowerCase();
            (dependentDdown == 'occupied') ? $('.commercial-'+dependentDdown+'-child').removeClass('d-none') : $('.commercial-tou-name-children').addClass('d-none') ;
        });
        

        
        // generate floors using add floor button
        $(document).on('click', ".add-floor", function(){
            let currentStoreyCount = $('.storey').length;
            let count = ($('.no_of_floors').val() == '') ? 0 : parseInt($('.no_of_floors').val());
            // alert(count)
            if(count < 1){
                toastr.error('please enter valid floor count');
                return false
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
            let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalFloors = '';
            $('.loader-container').removeClass('d-none');
            
            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getFloors(start index, finalCount)
            totalFloors = getFloors(currentStoreyCount, finalCount);
            (currentStoreyCount > 0 ) 
            ? (
                $(totalFloors).insertAfter($(".storey:last-child"))
                ) 
            : $(totalFloors).insertAfter( $(this).closest(".append-floors") );
            $(".remove-storey").each(function(){
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
            })
            $(".remove-storey").last().removeClass('d-none');
            $('.floor_unit_type_dd').select2();
            $('.no_of_floors').val($('.storey').length);

            
        });
        
        // add units for floor
         $(document).on('click', ".add-unit", function(){
            let pId = $(".storey").index($(this).closest('.storey'));
            let floorIdOc = $(this).data('floor_id');
            floorIdOc = (floorIdOc == undefined) ? 0: floorIdOc;
            // alert(floorIdOc);
            // get no of units count
            let count = $(this).closest('.storey-nou-child').find('.no_of_units').val();
            // generate units only if no of units value is greater than 1
            let currentStoreyUnitCount = $(this).closest('.storey').find('.storey-unit').length;
            // let finalCount = (currentStoreyUnitCount > count ) ? currentStoreyCount - count : count ;
            let totalCount = parseInt(currentStoreyUnitCount) + parseInt(count);
            if(count > 1 || currentStoreyUnitCount > 1){
                // alert('start : '+currentStoreyUnitCount+'totalCount : '+ totalCount)
                let totalFloors = getUnits(currentStoreyUnitCount, totalCount, pId, floorIdOc);
                // append units html to respective floor
                (currentStoreyUnitCount > 0 ) 
                ? $(totalFloors).insertAfter($(this).closest('.floor-dds_row').nextAll('.unit-container').first().find('.storey-unit').last())
                : $(this).closest('.floor-dds_row').nextAll('.unit-container').first().html(totalFloors);
               $(".remove-storey-unit").addClass('d-none');
                $('.storey').each(function(){
                    $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                    let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                    $(this).find('.no_of_units').val(currentStoreyUnitLength)
                });
                $(this).closest('.floor-dds_row').find('.append-dd-to').addClass('d-none');
                $(this).closest('.storey').find('.unit-tfd').addClass('d-none');
            }else{
                ($('#category').val() == 3) 
                ?($(this).closest('.floor-dds_row').find('.append-dd-to').andSelf().slice(0,2).removeClass('d-none'))
                :($(this).closest('.floor-dds_row').find('.append-dd-to').first().removeClass('d-none'));
                $(this).closest('.storey').find('.storey-unit').remove();
                // $(this).closest('.storey').find('.unit-tfd').removeClass('d-none');
            }
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none')
            })
            setTimeout(()=>{
              ($('.floor-parent-'+pId).prop('checked') === true)
                ? ($('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',true))
                : $('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',false);
              }, 600);
              $('.un_unit_type_dd').select2();
              
        });
        
        // delete floor
        $(document).on('click', ".remove-storey", function(){
            let storey_id = ($(this).data('floor_id') != undefined) ? $(this).data('floor_id') : 0;
            if(storey_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_floor') }}",
                    data:{ floor_id : storey_id},
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
        $(document).on('click', ".remove-storey-unit", function(){
            let storey_unit_id = ($(this).data('unit_id') != undefined) ? $(this).data('unit_id') : 0;
            if(storey_unit_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_unit') }}",
                    data:{ unit_id : storey_unit_id},
                    success: function(response) {
                        // $('.storey').remove();
                        // let floors = getPropertyFloors(response.data.id)
                    }
                });
            }
            let currentStoreyUnits =  $(this).parent().closest('.unit-container').find('.storey-unit');
            // $(this).parent().closest('.storey').find('.add-unit').trigger('click');
            (currentStoreyUnits.length == 2) ? currentStoreyUnits.remove() : $(this).parent().remove();
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                $(this).find('.no_of_units').val(currentStoreyUnitLength)
            });
            
        });
        
        $(document).on('click', ".floor-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey').find('.floor-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        $(document).on('click', ".unit-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey-unit').find('.unit-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey-unit').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        
        //  append  unit drop-down optioins to floors and units
        $(document).on('change', '.floor_ddopt, .unit_ddopt', function(){
            //to get and enable or display next unit drop-down element parenet block
            let next_parent_element = $(this).closest('.append-dd-to').nextAll('.append-dd-to').first();
            let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
            let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
            let current_block_other_text_elements = $(this).closest('.append-dd-to').nextAll('.brand-tfd');
            // to get next occured unit drop-down 
            let fieldType = $(this).find(':selected').data('field');
            let fieldOtherType = $(this).find(':selected').data('others')
            let next_ddopt_child = ($(this).hasClass('floor_ddopt')) 
            ? next_parent_element.find('.floor_ddopt')
            : next_parent_element.find('.unit_ddopt');
            // let uType = $(this).val() = 2;
            let cat_id = $(this).val();
            let propertyId = $('#property_id').val();
            let prop_cat = $(this).parent().closest('.dds_row').find('.prop_category_dd').first().val();
            // alert(prop_cat)
             $.ajax({
                type: "GET",
                data: {
                    cat_id: cat_id, property_id : propertyId
                },
                url: "{{ url('get_unit_categories') }}",
                success: function(response) {

                    next_parent_element.removeClass('d-none');
                    ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) 
                    ? (next_parent_element.addClass('d-none'))
                    :next_parent_element.removeClass('d-none');
                    ($('#category').val() == 3)
                    ?(prop_cat == 1)? next_parent_element.removeClass('d-none'): (next_parent_element.addClass('d-none'))
                    :'';
                    
                    $(next_ddopt_child).empty();
                    if(response.data.length == 0){
                        // $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                    }
                    
                    if (response.data) {
                        if(fieldType == 'select'){
                            $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            $(current_block_text_elements).addClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            // $(current_block_dd_elements).removeClass('d-none');
                        }
                        else if(fieldType == 'text'){
                            $(current_block_text_elements).removeClass('d-none');
                            $(current_block_other_text_elements).addClass('d-none');
                            $(current_block_dd_elements).addClass('d-none');
                            
                            // $.each(response, function(key, value) {
                          
                            // });
                        }
                        //this will get hit ater first dd change
                        else if(fieldType == undefined){
                             $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                            $.each(response.data, function(key, value) {
                                next_ddopt_child.append($("<option/>", {
                                    value: value.id,
                                    text: value.name
                                }));
                            });
                            
                            $.each(response.other_options, function(key, value) {
                                next_ddopt_child.append($("<option></option>").attr({"value": value.brand_name, "data-others": 'others' }).text(value.brand_name));
                            });
                            
                        }
                        if(fieldOtherType == 'others'){
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
        $(document).on('click', '.add-fbrand', function(e){
            e.preventDefault();
            $(this).closest('.storey').find('.brand-tfd').first().removeClass('d-none')
        })
        
        $(document).on('click', '.merge_other_units', function(){
            if($(this).prop('checked') === true){
                $(this).parent().closest('.unit-container').addClass('active-unit-merge');
                $(this).addClass('active');
                $(this).parent().find('.merge_other_unit_lable').removeClass('btn-outline-primary');
                $(this).parent().find('.merge_other_unit_lable').addClass('btn-primary');
                $('.merge_other_units').each(function(){
                  if(!$(this).hasClass('active')) { $(this).prop('disabled', true) }else{ $(this).prop('disabled', false)}
                });
                $('.unit-container').each(function(){
                  if(!$(this).hasClass('active-unit-merge')) { $(this).find('.unit-chk').removeClass('d-none') }else{ $(this).find('.unit-chk').addClass('d-none') }
                });
                
                $('.oup-unit').addClass('d-none');
                
                // unit-parent-floor
                let index = -1;
                let currentUnitIndex = 0;
                $(this).parent().closest('.unit-container').find('.merge_other_units').each(function(){
                    index++;
                    if($(this).hasClass('active')){
                        currentUnitIndex = index;
                    }
                })
                let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
                // alert(currentFloorIndex);
                // alert(currentUnitIndex);
                $('#unit-parent-floor').val(currentFloorIndex);
                
                ($(this).data('uid') != undefined) ? ($('#parent-unit').val($(this).data('uid')), $('#unit-exist').val(1)) : ($('#parent-unit').val(currentUnitIndex), $('#unit-exist').val(0));
            
                $(this).parent('.unit-merge-group').find('.save-unit-merge').removeClass('d-none');
                
                // current storey unit input validations
                // $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                let reqElements = $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                reqElements.each(function(){
                    $(this).not(':hidden').addClass('req-validate');
                })
            }
            if($(this).prop('checked') === false){
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
        
        $(document).on('click', '.merge_other_floors', function(){
            let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
           
            $('.floor-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $('.unit-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $(this).parent().find('.floor-merge-btn').removeClass('btn-outline-primary');
            $(this).parent().find('.floor-merge-btn').addClass('btn-primary');
            
            if($(this).prop('checked') === true){
                
                ($(this).data('fid') != undefined) ? $('#parent-floor').val($(this).data('fid')) : $('#parent-floor').val(currentFloorIndex) ;
                
                
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
            
            if($(this).prop('checked') === false){
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
        $(document).on('click', '.floor-chk', function(){
            if($(this).prop('checked') === true){
                $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.floor-dds_row').find('.no_of_units').val(0);
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',true);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',true);
                
            }else{
                // $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',false);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',false);
            }
            
        });
        
        $(document).on('click', '.unit-chk', function(){
            ($(this).prop('checked') === true)
            ? (
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',true)
               )
            :(
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',false)
              )
            ;
            
        });
        
        $(document).on('click', '.search_gis', function(e) {
            let gis_id = $('#gis_id').val();
            $.ajax({
                type: "GET",
                url: "{{ url('secondary_details/search/gis') }}",
                data: {gis_id:gis_id},
                success: function(response) {
                    $('.sd-floor-fields').html(response);
                    
                }
            });
            
        });

        function getFloors(startIndex, count){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('secondary_details/get_floors') }}",
                data:{c_id : c_id, count : count, start_index : startIndex},
                success: function(response) {
                    temp_floors = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            
            return temp_floors;
        }
        $(document).on('click', '.remove-merge',function(e){
            remove_merge();
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
            
        });
        
        function remove_merge(){
            $('.loader-container').removeClass('d-none');
            var temp_floors =null;
            let c_id = $('#category').val();
            let property_id = $('#property_id').val();

            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('remove_merge') }}",
                data:{c_id : c_id, property_id : property_id},
                success: function(response) {
                    $('.loader-container').addClass('d-none');
                    $('.storey').remove();
                    let floors = getPropertyFloors(property_id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                }
            });
        }
        
        function getUnits(startIndex, count, floor_id, floorIdOc){
            var temp_units =null;
            let c_id = $('#category').val();
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async:false,
                url: "{{ url('get_units') }}",
                data:{c_id : c_id,count :count, floor_id : floor_id, start_index : startIndex, property_id : propertyId, floor_idoc : floorIdOc},
                success: function(response) {
                    temp_units = response;
                }
            });
            
            return temp_units;
        }
        
        function getPropertyFloors(property_id){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_edit_floors') }}",
                data:{c_id : c_id ,property_id : property_id},
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
        
        $(document).on('click', '.save-floor-merge', function(e){
            $('.loader-container').removeClass('d-none');
            // setTimeout(function(){
            //     $('.loader-container').addClass('d-none');
            // }, 1000);
            // toastr.success('Floors Merged Successfully');
            // 
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_floor_merge') }}"  : $('#create_property').attr('action') ;
            saveProperty(save_floor_merge_url);
        });
        
        $(document).on('click', '.save-unit-merge', function(e){
            $('.loader-container').removeClass('d-none');
            let save_floor_merge_url = ($('#property_id').val() != '') ? "{{ url('save_unit_merge') }}"  : $('#create_property').attr('action') ;
            // saveProperty(save_floor_merge_url);
             $.ajax({
                url: save_floor_merge_url, 
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
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    $('.remove-merge-ele').removeClass('d-none')
                    
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
                        });
                    } 
                    }
            });

        });
        
        function saveProperty(save_merge_url){
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
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    $('.remove-merge-ele').removeClass('d-none');
                    
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
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
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
              // Will return ['granted', 'prompt', 'denied']
              (result.state == 'denied') ? $('.geo-loc-error').html('Please Enable Your Location.') :'';
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
        
        
        
        $(document).on('click','#create_property_btn', function(e){
            e.preventDefault(); // Prevent default form submission
            var isValid = validateForm();

            if (isValid) {
                // Form is valid, submit the form
                $('#create_property').submit();
            }
            
        });
        
        function validateForm() {
            $('.flash-errors').remove();
            var isValid = true;
            $('.ctfd-required').each(function() {
                var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
                if ( value === ''  || value === null) {
                    isValid = false;
                    // 
                    ($(this).hasClass('no_of_floors')) 
                    ?($('<span class="input-error flash-errors" style="color: red">this field is required.</span>').insertAfter($(this).parent('.input-group')))
                    :($('<span class="input-error flash-errors" style="color: red">this field is required.</span>').insertAfter(this),$(this).addClass('is-invalid'));
                    
                    ;
                } else {
                    $(this).removeClass('is-invalid');
                }
                $('.is-invalid:first').focus();
            });
            return isValid;
        }
        
        //  
    </script>
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
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
    </script>
   
    @endpush
