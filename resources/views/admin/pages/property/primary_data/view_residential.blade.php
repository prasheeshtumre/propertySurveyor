<li class="list-group-item">
	<span class="w-md-25">Residential Category</span><strong class="px-1 atp-title--seperator">:</strong>  {{$property->residential_category->cat_name ?? 'N/A'}}
</li>
<li class="list-group-item">
	<span class="w-md-25">Residential Sub Category</span><strong class="px-1 atp-title--seperator">:</strong>  {{$property->residential_sub_category->cat_name ?? 'N/A'}}
</li>

@foreach($categories as $category)
    @if($property->residential_sub_type == $category->id)
        @include('admin.pages.property.'.str_replace("primary_data.","primary_data.view_", $category->blade_slug))
    @endif
@endforeach
