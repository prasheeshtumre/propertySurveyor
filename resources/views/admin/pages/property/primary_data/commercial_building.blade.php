<div class="commercial-parent">
	<div class="row  commercial-fields-child ">
		@include('admin.pages.property.primary_data.fields.city')
		@include('admin.pages.property.primary_data.fields.pincode')
		@include('admin.pages.property.primary_data.fields.building_name')
		@include('admin.pages.property.primary_data.fields.house_number')
		@include('admin.pages.property.primary_data.fields.plot_number')
		@include('admin.pages.property.primary_data.fields.area')
		@include('admin.pages.property.primary_data.fields.street_details')
		@include('admin.pages.property.primary_data.fields.colony_name')
		@include('admin.pages.property.primary_data.fields.owner_name')
		@include('admin.pages.property.primary_data.fields.contact_number')
		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
			<div>
				<label for="" class="form-label">No of Floors <span class="errorcl">*</span></label>
				<div class="input-group ">
					<input type="text" class="form-control no_of_floors ctfd-required is-numeric" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
					<div class="input-group-append">
						<button class="btn btn-success add-floor" type="button" id="button-addon2">Add Floors</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>