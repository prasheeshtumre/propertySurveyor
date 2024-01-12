<li class="list-group-item">
    <span class="w-md-25">City</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $city->pincode->pincodeCity->city->name ?? 'N/A' }}
</li>
<li class="list-group-item">
    <span class="w-md-25">Plot Name</span><strong class="px-1 atp-title--seperator">:</strong>
    {{ $property->plot_name ?? 'N/A' }}
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

<div class="row mt-4">
    @if ($property->boundary_wall_availability == 1)
    <div class="d-flex col-lg-4 col-md-12 py-2">
        <span class="mdi mdi-circle px-1 text-success"></span>
        <label class="form-check-label"> Boundary Wall/Fencing available </label>
    </div>
    @endif

    @if ($property->any_legal_litigation_board == 1)
    <div class="d-flex col-lg-4 col-md-12 py-2">
        <span class="mdi mdi-circle px-1 text-success"></span>
        <label class="form-check-label"> Any Legal Litigation board </label>
    </div>
    @endif

    @if ($property->ownership_claim_board == 1)
    <div class="d-flex col-lg-4 col-md-12 py-2">
        <span class="mdi mdi-circle px-1 text-success"></span>
        <label class="form-check-label"> Ownership claim board </label>
    </div>
    @endif


    @if ($property->bank_auction_board == 1)
    <div class="d-flex col-lg-4 col-md-12 py-2">
        <span class="mdi mdi-circle px-1 text-success"></span>
        <label class="form-check-label"> Bank auction board </label>
    </div>
    @endif

    @if ($property->for_sale_board == 1)
    <div class="d-flex col-lg-4 col-md-12 py-2">
        <span class="mdi mdi-circle px-1 text-success"></span>
        <label class="form-check-label"> For Sale/Lease Board </label>
    </div>
    @endif
</div>