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
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"> Blocks <span class="errorcl">*</span></label>
                                <select class="form-select ctfd-required" name="block" id="blocks">
                                    <option selected disabled>-Select block-</option>
                                </select>
                            </div>
                        </div>
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
                                
                            </div>
                        </div>


                    </div>

                    <input type="hidden" class="" name="merge_parent_floor_id" id="parent-floor" value="">
                    <input type="hidden" class="" name="merge_unit_parent_floor_id" id="unit-parent-floor"
                        value="">
                    <input type="hidden" class="" name="merge_parent_unit_id" id="parent-unit" value="">
                    <input type="hidden" class="" name="unit_exist" id="unit-exist" value="">
                    <input type="hidden" class="" name="property_id" value="{{ $property_id }}">
                </div>

            </div>
        </div>
    </div>
</form>
<!--end row-->
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
