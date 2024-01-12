<div class="row">

    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks">
        <div>
            <label for="" class="form-label">Residential Category</label>

            <select class="form-select get_subcat_options ctfd-required" name="residential_type" id="residential_types">
                <option selected="" disabled="">-Select Residential Types-</option>
                @forelse($sub_categories as $key=>$category)
                <option value="{{ $category->id }}" {{ ($property->residential_type == $category->id ? "selected":"disabled") }}> {{ $category->cat_name }}</option>
                @empty

                @endforelse
            </select>
        </div>
    </div>


    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks">
        <div>
            <label for="" class="form-label">Residential Sub Category</label>

            <select class="form-select get-category-fields ctfd-required propert-gcc" name="residential_sub_type" id="residential_sub_types">
                <option selected="" disabled="">-Select Residential Sub Types-</option>
                @if($property->residential_sub_type)
                @forelse($categories as $key=>$category)
                @if($category->parent_id == $property->residential_type)
                <option value="{{ $category->id }}" {{ ($property->residential_sub_type == $category->id ? "selected":"disabled") }}> {{ $category->cat_name }}</option>
                @endif
                @empty

                @endforelse
                @endif
            </select>
        </div>
    </div>
</div>


<div class="category-fields-container  cfc-content">
    @foreach($categories as $category)
    @if($property->residential_sub_type == $category->id)
    @include('admin.pages.property.'.str_replace("primary_data.","primary_data.edit.edit_", $category->blade_slug))
    @endif
    @endforeach
</div>