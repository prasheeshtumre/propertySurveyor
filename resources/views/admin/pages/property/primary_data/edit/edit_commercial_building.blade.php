<div class="commercial-parent">
	<div class="row  commercial-fields-child ">
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">city </label>
				<input type="text" name="" value="{{ $city->pincode->pincodeCity->city->name ?? ''}}" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Building Name </label>
				<input type="text" value="{{$property->building_name ?? ''}}" name="building_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No </label>
				<input type="text" value="{{$property->house_no ?? ''}}" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" value="{{$property->plot_no ?? ''}}" name="plot_no" class="form-control" id="">
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
				<input type="text" value="{{$property->street_details ?? ''}}" name="street_name" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
				<input type="text" value="{{$property->locality_name ?? ''}}" name="locality_name" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input type="text" value="{{$property->owner_name ?? ''}}" name="owner_name" class="form-control is-person-name" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" value="{{$property->contact_no ?? ''}}" name="contact_no" class="form-control is-contact-no" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
			<div>
				<label for="" class="form-label">No of Floors</label>
				<div class="input-group mb-3">
					<input type="text" class="form-control no_of_floors ctfd-required" value="{{$property->no_of_floors ?? ''}}" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
					<div class="input-group-append">
						<button class="btn btn-success add-floor" type="button" id="button-addon2">Add Floors</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>