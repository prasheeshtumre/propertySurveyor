
<li class="list-group-item">
	<span class="w-md-25">Plot Land Type </span><strong class="px-1 atp-title--seperator">:</strong>  {{$property->GetPropertyName->cat_name ?? 'N/A'}}
</li>

@foreach($categories as $category)
    @if($property->plot_land_type == $category->id)
        @include('admin.pages.property.'.str_replace("primary_data.","primary_data.view_", $category->blade_slug))
    @endif
@endforeach
