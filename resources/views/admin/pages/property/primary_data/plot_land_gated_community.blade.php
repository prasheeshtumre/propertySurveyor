<div class="row plot-land-gated-community plot-land-fields-child">
	@include('admin.pages.property.primary_data.fields.city')
	@include('admin.pages.property.primary_data.fields.pincode')
	@include('admin.pages.property.primary_data.fields.project_name', ['mandatory' => true])
	@include('admin.pages.property.primary_data.fields.builder')
	@include('admin.pages.property.primary_data.fields.builder_sub_group')
	@include('admin.pages.property.primary_data.fields.construction_partner')
	@include('admin.pages.property.primary_data.fields.contact_number')
	@include('admin.pages.property.primary_data.fields.house_number')
	@include('admin.pages.property.primary_data.fields.plot_number')
	@include('admin.pages.property.primary_data.fields.area')
	@include('admin.pages.property.primary_data.fields.street_details')
	@include('admin.pages.property.primary_data.fields.colony_name')
</div>