<li class="list-group-item">
    <span class="w-md-25">City</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $city->pincode->pincodeCity->city->name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Project Name</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->project_name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Builder / Builder Sub Groups</span><strong class="px-1 atp-title--seperator">:</strong>
    <div class="d-flex flex-column">
        @forelse($property->builders as $builder)
        <b>{{$builder->name}}</b>
        <ul>
            @forelse($builder->sub_groups as $builderSubGroup)
            <li>{{$builderSubGroup->name}}</li>
            @empty
            <!-- <li>Not Available</li> -->
            @endforelse
        </ul>
        @empty
        @endforelse
    </div>
</li>
<!-- <li class="list-group-item">
    <span class="w-md-25">Builder Sub Group</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->subBuilder->name ?? 'N/A' }}
</li> -->
<li class="list-group-item">
    <span class="w-md-25">Construction Partner</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->constructionPartner->name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">House No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->house_no ?? 'N/A' }}
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
    <span class="w-md-25">Contact No</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->contact_no ?? 'N/A' }}
</li>
@if (Auth::user()->hasRole('surveyor'))
<div class="col-xxl-3 col-md-3 mt-3">
    <div>
        <a class="btn btn-outline-success" href="{{ url('surveyor/property/gated-community-details/' . $property->id) }}">
            <div class="d-flex justify-content-center align-items-center">
                <span class="mdi mdi-chevron-double-right mdi-18px"></span>
                <span class="text-dark">View Gated Community Details</span>
            </div>
        </a>
    </div>
</div>
@endif