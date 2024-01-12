<div class="row plot-land-open-plot plot-land-fields-child">
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">city </label>
			<input type="text" name="" value="{{ $city->pincode->pincodeCity->city->name ?? ''}}" class="form-control" id="" disabled>
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Plot Name </label>
			<input value="{{$property->plot_name ?? ''}}" type="text" name="plot_name" class="form-control" id="">
		</div>
	</div>

	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Plot No</label>
			<input value="{{$property->plot_no ?? ''}}" type="text" name="plot_no" class="form-control" id="">
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<label for="" class="form-label ">Area </label>
		<div class="choose-suggestion-label-body">
			<input type="text" class="form-control input-select-suggestions area-select-suggestions " id="" placeholder="Search Area">
			<label for="" class="choose-suggestion-label" style=""> {{ isset($isValidArea) && $isValidArea  ? ($property->area->name ?? 'choose Option') : 'choose Option' }}<input type="hidden" value="{{ isset($isValidArea) && $isValidArea  ? ($property->area->id ?? 0) : 0 }}" name="area"></label>
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
			<input value="{{$property->street_details ?? ''}}" type="text" name="street_name" class="form-control ctfd-required" id="">
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
			<input value="{{$property->locality_name ?? ''}}" type="text" name="locality_name" class="form-control ctfd-required" id="">
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Owner Full Name </label>
			<input value="{{$property->owner_name ?? ''}}" type="text" name="owner_name" class="form-control is-person-name" id="">
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Contact No</label>
			<input value="{{$property->contact_no ?? ''}}" type="text" name="contact_no" class="form-control is-contact-no" id="">
		</div>
	</div>

</div>
<div class="col-xxl-3 col-md-3 mt-3">
	<div>

		<input class="form-check-input" name="boundary_wall_availability" @if($property->boundary_wall_availability == 1) checked @endif value="1" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			Boundary Wall/Fencing available
		</label>

	</div>
</div>

<div class="col-xxl-3 col-md-3 mt-3">
	<div>
		<input class="form-check-input" name="any_legal_litigation_board" @if($property->any_legal_litigation_board == 1) checked @endif value="1" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			Any Legal Litigation board
		</label>
	</div>
</div>
<div class="col-xxl-3 col-md-3 mt-3">
	<div>
		<input class="form-check-input" name="ownership_claim_board" @if($property->ownership_claim_board == 1) checked @endif value="1" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			Ownership claim board
		</label>
	</div>
</div>
<div class="col-xxl-3 col-md-3 mt-3">
	<div>
		<input class="form-check-input" name="bank_auction_board" @if($property->bank_auction_board == 1) checked @endif value="1" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			Bank auction board
		</label>
	</div>
</div>
<div class="col-xxl-3 col-md-3 mt-3">
	<div>
		<input class="form-check-input" name="for_sale_board" @if($property->for_sale_board == 1) checked @endif value="1" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			For Sale/Lease Board
		</label>
	</div>
</div>