<div class="demolished">

	<div class="row demolished demolished-fields-child">
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">city </label>
				<input type="text" name="" value="{{ $city->pincode->pincodeCity->city->name ?? ''}}" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" value="{{$property->house_no ?? ''}}" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="" value="{{$property->plot_no ?? ''}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label ">Area </label>
			<div class="choose-suggestion-label-body">
				<input type="text" class="form-control input-select-suggestions area-select-suggestions " id="" placeholder="Search Area">
				<label for="" class="choose-suggestion-label" style=""> {{ isset($isValidArea) && $isValidArea  ? ($property->area->id ?? 'choose Option') : 'choose Option' }}<input type="hidden" value="{{ isset($isValidArea) && $isValidArea  ? ($property->area->name ?? 0) : 0 }}" name="area"></label>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
				<input type="text" name="street_name" class="form-control ctfd-required" id="" value="{{$property->street_details ?? ''}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
				<input type="text" name="locality_name" class="form-control ctfd-required" id="" value="{{$property->locality_name ?? ''}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control is-contact-no" id="" value="{{$property->contact_no ?? ''}}">
			</div>
		</div>

	</div>

</div>