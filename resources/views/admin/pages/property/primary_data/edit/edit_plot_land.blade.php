<div class="plot-land">
    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks">
        <div>
            <label for="" class="form-label">Plot Land Types <span class="errorcl">*</span></label>
            <select class="form-select get-category-fields ctfd-required propert-gcc" name="plot_land_type" id="plot_land_types">
                <option disabled selected>-- Choose Plot Land Type --</option>
                @forelse($sub_categories as $key=>$category)

                <option value="{{ $category->id }}" @if($property->plot_land_type == $category->id) selected @endif> {{ $category->cat_name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
</div>
<div class="category-fields-container cfc-content">
    @foreach($categories as $category)
    @if($property->plot_land_type == $category->id)
    @include('admin.pages.property.'.str_replace("primary_data.","primary_data.edit.edit_", $category->blade_slug))
    @endif
    @endforeach
</div>