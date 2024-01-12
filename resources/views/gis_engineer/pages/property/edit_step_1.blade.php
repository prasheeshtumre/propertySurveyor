<form class="step-1" action="{{ route('surveyor.property.update_details', [$property->id]) }}" method="post" id="create_property" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                
                {{--<div class="card-body ">
                    <div class="row">
                        <div class="col-xxl-6 col-md-12">
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
                </div>--}}

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
                                <label for="" class="form-label"> GIS ID <span
                                        class="errorcl">*</span></label>
                                <input type="text" name="gis_id" class="form-control is-number" id="gis_id"
                                    placeholder="EX:7255158845" value="{{ $property->gis_id ?? '' }}" disabled
                                    >
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
                                        @if($category->parent_id == NULL)
                                            @if (old('category') == $category->id)
                                                <option value="{{ $category->id }}" selected> {{ $category->cat_name }}
                                                </option>
                                            @else
                                                <option  {{ ($property['cat_id'] == $category['id'] ? "selected":"") }} value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                            @endif
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
                        
                    
                
                    </div>
                    
                    <div id="defined_block">
                        @include('admin.pages.property.'.$defined_blade, [ 'floors' => $floors])
                    </div>
                    
                    <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="" >
                    <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor" value="" >
                    <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="" >
                    <input type="hidden" class="" name="unit_exist" id="unit-exist" value="" >
                    <input type="hidden" class="" name="property_id" id="property_id" value="{{ $property->property_id ?? '' }}" >
                    <input type="hidden" class="" name="property_gcc" id="property_gcc" value="" >

                    @include('admin.pages.property.edit_floor')

                    <div class="col-xxl-6 col-md-6 mt-3">
                        <div class="row remove-merge-ele d-none">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger remove-merge">Reset Merge</button>
                            </div>
                        </div>
                    </div>
                    
                        
                    <div class="text-center mt-4">
                        <button type="submit"
                            class="btn btn-warning waves-effect waves-light w_100" id="create_property_btn">Save & Continue</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
