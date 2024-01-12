
<form action="{{ route('gis-engineer.property.update_details', [$property->id]) }}" id="update_property"  method="post" enctype="multipart/form-data">
    <!---->
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">

            <div class="card">

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-xl-12 col-md-12">
            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-xxl-3 col-md-4 mt-3">
                            <div>
                                <label for="" class="form-label">GIS ID</label>
                                <input type="text" name="gis_id" class="form-control" id=" "
                                    placeholder="EX: 7255158845" value="{{$property->gis_id}}" disabled>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 mt-3">
                            <div>
                                <label for="" class="form-label">Latitude</label>
                                <input type="text" name="" class="form-control" id=" "
                                    placeholder="EX: 7255158845" value="{{$property->latitude ?? ''}}" disabled>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-4 mt-3">
                            <div>
                                <label for="" class="form-label">Longitude</label>
                                <input type="text" name="" class="form-control" id=" "
                                    placeholder="EX: 7255158845" value="{{$property->longitude ?? ''}}" disabled>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <label for="" class="form-label">Merge GISID</label>
                            <div class="form-check">
                                <input class="form-check-input split-merge-gis" type="radio" data-option_cnt="{{5 - count($merges)}}" value = "2" name="split_merge" id="merge-gis">
                                <label class="form-check-label" for="merge-gis">
                                    Merge
                                </label>
                            </div>
                        </div>
                        <div class="">
                            <!-- border border-5 rounded -->
                            <div class="split-merge-data-container ">
                            @if(count($merges) > 0)
                                <span class="badge bg-success">This Property Merged with  {{implode(',', $merges)}}  GIS-ID's</span> 
                            @endif
                            </div>
                            <div class="split-merge-container d-flex flex-column  "></div>
                        </div>
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <div class="form-group">
                                <label for="" class="form-label">Category of the property <span
                                        class="errorcl">*</span></label>
                                <select class="form-select ctfd-required" name="category" id="category"  >
                                    <option value="" selected disabled>-Select Category-</option>
                                    @forelse($categories as $key=>$category)
                                        @if($category->parent_id == NULL)
                                            @if (old('category') == $category->id)
                                                <option value="{{ $category->id }}" selected> {{ $category->cat_name }}
                                                </option>
                                            @else
                                                <option  
                                                {{ ($property['cat_id'] == $category['id'] ? "selected":"") }} 
                                                @if(!in_array($property->cat_id, $edit_allowed_categories) && $property['cat_id'] != $category['id']) disabled @endif
                                                value="{{ $category->id }}">{{ $category->cat_name }}</option>
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
                        <div id="defined_block">
                            @include('admin.pages.property.'.$defined_blade, [ 'floors' => $floors])
                        </div>

                        <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="" >
                        <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor" value="" >
                        <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="" >
                        <input type="hidden" class="" name="unit_exist" id="unit-exist" value="" >
                        <input type="hidden" class="" name="property_id" id="property_id" value="{{$property->id}}" >
                        <input type="hidden" class="" name="property_gcc" id="property_gcc" value="" >
                        <input type="hidden" class="" name="" id="category_id" value="{{$property->cat_id}}" >
                        <div class="col-md-12 mb-3 {{$floor_visible_status ?? ''}}">
                        @include('admin.pages.property.edit_floor')
                        </div>
                        @if( $property->floors_merge_status == 1 || $property->units_merge_status == 1 )
                        <div class="col mt-3">
                            <div class="row remove-merge-ele">
                                <div class="col">
                                    <button type="button" class="btn btn-danger remove-merge">Reset Merge</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="col-xxl-12 col-md-12 mt-3">
                            <div>
                                <label for="" class="form-label">Remarks </label>
                                <textarea name="remarks" class="form-control" rows="3">{{$property->remarks}}</textarea>
                            </div>
                        </div>
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input p-ufs-ufr" @if($property->up_for_sale == 1) checked @endif type="checkbox" name="up_for_sale"
                                        id="property_ufs">
                                    <label class="form-check-label" for="property_ufs">
                                        up for Sale
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input p-ufs-ufr"  @if($property->up_for_rent == 1) checked @endif type="checkbox" name="up_for_rent"
                                        id="property_ufr">
                                    <label class="form-check-label" for="property_ufr">
                                        up for Rent
                                    </label>
                                </div>
                            </div>
                        <!--<input type="hidden" name="latitude" id="latitude">-->
                        <!--<input type="hidden" name="longitude" id="longitude">-->

                    </div>
                    {{--<div class="text-end mt-4">
                        <!--<button -->
                        <!--    class="btn btn-warning waves-effect waves-light w_100">Update</button>-->
                        <!-- id="update_property_btn"  -->
                            <button type="button" class="btn btn-primary " id="" onclick="nextPrev(1)"><span class="mdi mdi-sync me-2"></span> UPDATE</button>
                    </div>--}}
                </div>


            </div>

        </div>

    </div>
</form>