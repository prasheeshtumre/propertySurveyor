<input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
<input type="hidden" name="gis_id" id="gis_id" value="{{ $property->gis_id }}">
<input type="hidden" name="cat_id" id="cat_id" value="{{ $property->cat_id }}">
<input type="hidden" name="residential_type" id="residential_type" value="{{ $property->residential_type }}">
<input type="hidden" name="residential_sub_type" id="residential_sub_type"
    value="{{ $property->residential_sub_type }}">
<input type="hidden" name="block_tower_id" class="block_tower_val" value="{{ $block_tower_val ?? '' }}">
