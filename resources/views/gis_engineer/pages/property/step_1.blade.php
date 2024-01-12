<form class="step-1 cus-property" action="{{ route('surveyor.property.store') }}" method="post" id="create_property" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                
                <div class="card-body ">
                    <div class="row">
                        <div class="col-xxl-8 col-md-12">
                            <div class="">
                                
                                <div onclick="getCordinates()" class="form-group picking row">
                                    <div class="col-auto mb-2">
                                        <input type="text" placeholder="Latitude" name="latitude"
                                            id="latitude" class="form-control controls ctfd-required"
                                            value="{{ old('latitude') }}" readonly>
                                        @error('latitude')
                                            <span class="input-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto mb-2">
                                        <input type="text" placeholder="Longitude" name="longitude"
                                            id="longitude" class="form-control controls ctfd-required"
                                            value="{{ old('longitude') }}" readonly>
                                        @error('longitude')
                                            <span class="input-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
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
                                <input type="text" name="gis_id" 
                                class="form-control req- ctfd-required is-number" 
                                id="gis_id" 
                                placeholder="EX:7255158845" 
                                value="{{ (isset($gis_id) && $gis_id != 'N/A') ? $gis_id : old('gis_id') }}"
                                @if(isset($gis_id))
                                    readonly
                                @endif
                                    >
                                @error('gis_id')
                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <label for="" class="form-label">Split GISID</label>
                            <div class="form-check">
                                <input class="form-check-input split-merge-gis" data-option_cnt="1" type="radio" value = "1" name="split_merge" id="split-gis">
                                <label class="form-check-label" for="split-gis">
                                    Split
                                </label>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <label for="" class="form-label">Merge GISID</label>
                            <div class="form-check">
                                <input class="form-check-input split-merge-gis" type="radio" data-option_cnt="4" value = "2" name="split_merge" id="merge-gis">
                                <label class="form-check-label" for="merge-gis">
                                    Merge
                                </label>
                            </div>
                        </div>
                        <div class="">
                            <!-- border border-5 rounded -->
                            <div class="split-merge-data-container "></div>
                            <div class="split-merge-container d-flex flex-column  "></div>
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
                                            <option value="{{ $category->id }}" data-blade-slug='{{str_replace(".","_", $category->blade_slug)}}'>{{ $category->cat_name }}</option>
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
                    <input type="hidden" class="" name="property_gcc" id="property_gcc" value="" >

                    <div class="col mt-3">
                        <div class="row remove-merge-ele d-none">
                            <div class="col">
                                <button type="button" class="btn btn-danger remove-merge">Reset Merge</button>
                            </div>
                        </div>
                    </div>
                    
                        
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-done" id="create_property_btn">Save</button>
                        <button type="button" id="nextBtn" class="btn btn-done btn-primary d-none" onclick="nextPrev(1)">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<!-- <form action="{{ route('surveyor.property.image.store') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
    @csrf
    <div>
        <h3>Upload Multiple Image By Click On Box</h3>
    </div>
</form> -->