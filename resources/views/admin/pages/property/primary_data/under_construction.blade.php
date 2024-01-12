<div class="under-construction category-fields-container` cfc-content">

	<div class="row under-construction-pfrm under-construction-fields-child ">
		<div class="col-xxl-3 col-md-3 mt-3 ">
			<div>
				<label for="" class="form-label">under construction Types<span class="errorcl">*</span></label>
				<select class="form-select ctfd-required" name="under_construction_type" id="">
					<option selected="" disabled="">-Select under construction Types-</option>
					@forelse($prop_categories->take(3) as $prop_category)
					<option value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
					@empty
					@endforelse
				</select>
			</div>
		</div>
		@include('admin.pages.property.primary_data.fields.city')
		@include('admin.pages.property.primary_data.fields.pincode')
		@include('admin.pages.property.primary_data.fields.project_name')
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

</div>