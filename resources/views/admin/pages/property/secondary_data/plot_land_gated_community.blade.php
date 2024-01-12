<div class="card"  style="">
    <div class="card-body ">
        <div class="row residential-apartment-gated-community residential-fields-child">
            <input type="hidden" name="property_id" class="form-control" id="property_id" readonly value="{{ $get_property->id }}">
            <input type="hidden" name="gis_primary_id" class="form-control" id="gis_primary_id" readonly value="{{ $get_property->gis_id }}">
            <input type="hidden" name="cat_id" class="form-control" id="cat_id" readonly value="{{ $get_property->cat_id }}">
            <input type="hidden" name="residential_type" class="form-control" id="residential_type" readonly value="{{ $get_property->residential_type }}">
            <input type="hidden" name="residential_sub_type" class="form-control" id="residential_sub_type" readonly value="{{ $get_property->residential_sub_type }}">
    <div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<label for="" class="form-label">Category of the property</label>
			<input type="text"  class="form-control" id="" readonly value="{{ $get_property->category->cat_name }}">
		</div>
	</div>

		
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input type="text" name="project_name" class="form-control" id="" readonly value="{{ $get_property->project_name }}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
            <label for="" class="form-label"> Builder </label>
            <input type="text" name="builder_name" class="form-control" id="" readonly  value="{{ $get_property->getBuilderName->name }}">
        </div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control" id="" readonly value="{{$get_property->contact_no}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" name="house_no" class="form-control" id="" readonly value="{{$get_property->house_no}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id=""  readonly value="{{$get_property->plot_no}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No </label>
				<input type="text" name="street_name" class="form-control ctfd-required" id="" readonly value="{{$get_property->street_details}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input type="text" name="locality_name" class="form-control ctfd-required" id="" readonly value="{{$get_property->locality_name}}">
			</div>
		</div>
	</div>
	</div>
</div>