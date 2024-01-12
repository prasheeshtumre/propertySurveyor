<li class="list-group-item">
	<span class="w-md-25">Area</span><strong class="px-1 atp-title--seperator">:</strong>
	{{ isset($isValidArea) && $isValidArea  ? ($property->area->name ?? 'N/A') : 'N/A' }}
</li>
