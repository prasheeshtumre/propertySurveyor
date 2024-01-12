<div class="screen">
    <div class="row mt-3 mb-3">
        @include('admin.pages.property.units.includes.property_information')
    </div>

    <form class="unit-gallery-zone icm-zone">
        <div class="icm-file-list"></div>
        <input type="file" id="imageInput" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.image-gallery') }}">
        <div>
            <input type="hidden" name="property_id" value="{{ $property->id }}">
            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
            <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
            <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
            <!-- <h3 class="text-center">Upload Images</h3> -->
            <!-- <input type="hidden" name="prop_id" id="prop_id" value="215"> -->
        </div>
        <div class="row old-files-icm-lable-preview-group">

            <label for="imageInput" class="icm-zone-label col">Click here to upload  Gallery files</label>
        </div>

    </form>

    <form class="unit-amenity-zone icm-zone">
        <div class="icm-file-list"></div>
        <input type="file" id="icm-amenities" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.amenity-images') }}">
        <div>
            <input type="hidden" name="property_id" value="{{ $property->id }}">
            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
            <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
            <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
            <!-- <h3 class="text-center">Upload Images</h3> -->
            <!-- <input type="hidden" name="prop_id" id="prop_id" value="215"> -->
        </div>
        <div class="row old-files-icm-lable-preview-group">

            <label for="icm-amenities" class="icm-zone-label col">Click here to upload Amenity files</label>
        </div>
    </form>

    <form class="unit-interior-zone icm-zone">
        <div class="icm-file-list"></div>
        <input type="file" id="icm-interior" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.interior-images') }}">

        <div>
            <input type="hidden" name="property_id" value="{{ $property->id }}">
            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
            <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
            <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
            <!-- <h3 class="text-center">Upload Images</h3> -->
            <!-- <input type="hidden" name="prop_id" id="prop_id" value="215"> -->
        </div>
        <div class="row old-files-icm-lable-preview-group">

            <label for="icm-interior" class="icm-zone-label col">Click here to upload Interior files</label>
        </div>
    </form>

    <form class="unit-gallery-zone icm-zone">
        <div class="icm-file-list"></div>
        <input type="file" id="icm-floor-plan" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.floor-plan-images') }}">
        <div>
            <input type="hidden" name="property_id" value="{{ $property->id }}">
            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
            <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
            <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
            <!-- <h3 class="text-center">Upload Images</h3> -->
            <!-- <input type="hidden" name="prop_id" id="prop_id" value="215"> -->
        </div>
        <div class="row old-files-icm-lable-preview-group">

            <label for="icm-floor-plan" class="icm-zone-label col">Click here to upload Floor Plan files</label>
        </div>
    </form>

    <form class="unit-gallery-zone icm-zone">
        <div class="icm-file-list"></div>
        <input type="file" id="unit-video" class="files" multiple style="display: none;" data-action="{{ route('surveyor.property.unit-details.unit-videos') }}">
        <div>
            <input type="hidden" name="property_id" value="{{ $property->id }}">
            <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
            <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
            <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
            <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
            <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
            <!-- <h3 class="text-center">Upload Images</h3> -->
            <!-- <input type="hidden" name="prop_id" id="prop_id" value="215"> -->
        </div>
        <div class="row old-files-icm-lable-preview-group">

            <label for="unit-video" class="icm-zone-label col">Click Here to upload video files</label>
        </div>
    </form>

   

   


    <div class="card-footer">
        <div class="ms-auto text-end">
            <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
            <button type="submit" class="btn btn-done btn-primary nxt-btn" data-screen="2" id="step3">Next
                &nbsp;<i class="fa fa-arrow-right"></i></button>
        </div>
    </div>

</div>