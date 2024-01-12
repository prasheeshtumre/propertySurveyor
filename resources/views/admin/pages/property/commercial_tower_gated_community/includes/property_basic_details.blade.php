<input type="hidden" name="property_id" class="form-control" id="property_id" readonly value="{{ $property->id ?? '' }}">
<input type="hidden" name="gis_primary_id" class="form-control" id="gis_primary_id" readonly
    value="{{ $property->gis_id ?? '' }}">
<input type="hidden" name="cat_id" class="form-control" id="cat_id" readonly value="{{ $property->cat_id ?? '' }}">
<input type="hidden" name="residential_type" class="form-control" id="residential_type" readonly
    value="{{ $property->residential_type ?? '' }}">
<input type="hidden" name="residential_sub_type" class="form-control" id="residential_sub_type" readonly
    value="{{ $property->residential_sub_type ?? '' }}">
