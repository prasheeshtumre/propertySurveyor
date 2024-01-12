
<li class="list-group-item">
	<span class="w-md-25">Commercial Type </span><strong class="px-1 atp-title--seperator">:</strong>  {{$property->CommercialName->cat_name ?? 'N/A'}}
</li>

@foreach($categories as $category)
    @if($property->commercial_type == $category->id)
        @include('admin.pages.property.'.str_replace("primary_data.","primary_data.view_", $category->blade_slug))
    @endif
@endforeach
