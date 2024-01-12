<div class="residential-parent">
    <div class="row">
        <div class="col-xxl-3 col-md-3  mt-3  residential_blks">
            <div>
                <label for="" class="form-label">Residential Types <span class="errorcl">*</span></label>
                <select class="form-select get_subcat_options ctfd-required" name="residential_type" id="residential_types">
                    <option selected="" disabled="">-Select Residential Types-</option>
                    @forelse($sub_categories as $key=>$category)
                    @if(isset($parent_prop_cat) && $parent_prop_cat == $category->parent_id)
                    <option value="{{ $category->id }}"> {{ $category->cat_name }}</option>
                    @elseif(!isset($parent_prop_cat))
                    <option value="{{ $category->id }}"> {{ $category->cat_name }}</option>
                    @endif

                    @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3  mt-3  residential_blks " id="">
            <div>
                <label for="" class="form-label">Residential Sub Types <span class="errorcl">*</span></label>
                <select class="form-select get-category-fields ctfd-required propert-gcc" name="residential_sub_type" id="residential_sub_types">
                    <option selected="" disabled="">-Select Residential Sub Types-</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="category-fields-container cfc-content">

</div>