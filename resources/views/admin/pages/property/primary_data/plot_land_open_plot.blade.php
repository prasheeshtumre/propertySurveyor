<div class="row plot-land-open-plot plot-land-fields-child">
	@include('admin.pages.property.primary_data.fields.city')
	@include('admin.pages.property.primary_data.fields.pincode')
	@include('admin.pages.property.primary_data.fields.plot_name')
	@include('admin.pages.property.primary_data.fields.plot_number')
	@include('admin.pages.property.primary_data.fields.area')
	@include('admin.pages.property.primary_data.fields.street_details')
	@include('admin.pages.property.primary_data.fields.colony_name')
	@include('admin.pages.property.primary_data.fields.owner_name')
	@include('admin.pages.property.primary_data.fields.contact_number')
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<input class="form-check-input" name="boundary_wall_availability" value="1" type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label" for="flexCheckDefault">
				Boundary Wall/Fencing available
			</label>

		</div>
	</div>

	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<input class="form-check-input" name="any_legal_litigation_board" value="1" type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label" for="flexCheckDefault">
				Any Legal Litigation board
			</label>
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<input class="form-check-input" name="ownership_claim_board" value="1" type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label" for="flexCheckDefault">
				Ownership claim board
			</label>
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<input class="form-check-input" name="bank_auction_board" value="1" type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label" for="flexCheckDefault">
				Bank auction board
			</label>
		</div>
	</div>
	<div class="col-xxl-3 col-md-3 mt-3">
		<div>
			<input class="form-check-input" name="for_sale_board" value="1" type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label" for="flexCheckDefault">
				For Sale/Lease Board
			</label>
		</div>
	</div>
</div>