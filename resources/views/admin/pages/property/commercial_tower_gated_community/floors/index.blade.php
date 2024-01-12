<form action="{{ route('store-gc-floors') }}" method="post" id="create_floors" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div id="defined_block"></div>
            <div class="">
                <div class="loader-container d-none">
                    <div class="loader-circle-2"></div>
                </div>
                <div class="card-body primary-block">

                    <div class="row">
                        {{-- <div class="col-xxl-3 col-md-3  mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"> Blocks <span class="errorcl">*</span></label>
                                <select class="form-select ctfd-required" name="block" id="blocks">
                                    <option selected disabled>-Select block-</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"> Towers <span class="errorcl">*</span></label>
                                <select class="form-select ctfd-required" name="tower" id="towers">
                                    <option selected disabled>-Select tower-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 mt-3 append-floors">
                            <div>
                                <label for="" class="form-label">No of Floors <span
                                        class="errorcl">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control no_of_floors ctfd-required"
                                        name="no_of_floors" placeholder="Enter No of Floors" aria-label=""
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success add-floor" type="button" id="button-addon2">Add
                                            Floors</button>
                                    </div>
                                </div>
                            </div>
                            <div class="append-units-all d-none">
                                <label for="" class="form-label">No of Units</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control no_of_unit_to_all_floors"
                                        name="no_of_unit_to_all_floors" placeholder="Enter No of Units" aria-label=""
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success add-units-to-all-floors" type="button"
                                            id="button-addon2">Add
                                            Units</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="">
                    <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor"
                        value="">
                    <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="">
                    <input type="hidden" class="" name="unit_exist" id="unit-exist" value="">
                    <input type="hidden" class="" name="property_id" value="{{ $property_id }}">

                    <div class=" text-end">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                            id="create_property_btn">Save</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light floors-next-btn">
                            Proceed</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
<!--end row-->
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
