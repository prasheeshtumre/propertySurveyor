<li class="list-group-item">
    <span class="w-md-25">City</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $city->pincode->pincodeCity->city->name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">House No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->house_no ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Plot No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->plot_no ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Area</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ isset($isValidArea) && $isValidArea  ? ($property->area->name ?? 'N/A') : 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Street Name/No/Road No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->street_details ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Colony/Locality Name</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->locality_name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Pincode</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->propertyPincode->pincode_id ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Owner Full Name</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->owner_name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Contact No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->contact_no ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">No of Floors</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->no_of_floors ?? 'N/A' }}
</li>