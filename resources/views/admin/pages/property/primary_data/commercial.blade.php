<div class="commercial">
    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks">
        <div>
            <label for="" class="form-label">Commercial Types </label>
            <select class="form-select get-category-fields ctfd-required propert-gcc" name="commercial_type" id="plot_land_types">
                <option disabled selected>-- Choose Commercial Type --</option>
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
</div>
<div class="category-fields-container cfc-content">

</div>