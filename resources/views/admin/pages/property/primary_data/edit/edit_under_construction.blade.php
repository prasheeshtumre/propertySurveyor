<div class="under-construction cfc-content">

	<div class="row under-construction-pfrm under-construction-fields-child">

		<div class="col-xxl-3 col-md-3 mt-3 ">
			<div>
				<label for="" class="form-label">under construction Types</label>
				<select class="form-select ctfd-required " name="under_construction_type" id="">
					<option selected="" disabled="">-Select under construction Types-</option>
					@forelse($prop_categories->take(3) as $prop_category)
					<option value="{{$prop_category->id}}" @if($property->under_construction_type == $prop_category->id) selected @endif>{{$prop_category->cat_name}}</option>
					@empty
					@endforelse
				</select>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">city </label>
				<input type="text" name="" value="{{ $city->pincode->pincodeCity->city->name ?? ''}}" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input type="text" value="{{$property->project_name}}" name="project_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label"> Builder </label>
			<div class="">
				<input type="text" class="form-control select-suggestions edit builder-dd" autocomplete="off" placeholder="Search Builder">
				<div class="autocomplete-dropdown autocomplete-dropdown-1"></div>
				<div class="suggestion-lables">
					@forelse($property->builders as $builder)
					<span class="badge bg-success" data-id="{{$builder->id ?? 0}}">{{$builder->name ?? ''}}
						<input type="hidden" name="builder[]" value="{{$builder->id ?? 0}}">
						<span class="badge bg-danger btn remove-suggestion-label">-</span>
					</span>
					@empty
					@endforelse
				</div>
			</div>
		</div>

		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label"> Builder Sub Groups </label>
			<div class="">
				<input type="text" class="form-control builder-sub-group-select-suggestions builder-sub-group-dd" autocomplete="off" placeholder="Search Builder Sub Group">
				<div class="builder-sub-group-autocomplete-dropdown" style="display: none;">
					@include('admin.pages.builder_sub_group.partials.suggestions',['suggestions' => $builderSubGroupsuggestions, 'builderSubGroupIds' => $builderSubGroupIds])
				</div>
				<div class="builder-sub-group__suggestion-lables">
					@forelse($property->builderSubGroups as $builder)
					<span class="badge bg-success pbsg-{{$builder->builder_id ?? 0}}" data-id="{{$builder->id ?? 0}}">{{$builder->name ?? ''}}
						<input type="hidden" name="builder_sub_group[]" value="{{$builder->id ?? 0}}">
						<span class="badge bg-danger btn remove-sub-group__suggestion-label ">-</span>
					</span>
					@empty
					@endforelse
				</div>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label ">Construction Partner</label>
				<div class="choose-suggestion-label-body">
					<input type="text" class="form-control input-select-suggestions construction-partner-select-suggestions" id="" placeholder="Search Construction partner">
					<label for="" class="choose-suggestion-label" style="">{{$property->constructionPartner->name ?? 'choose Option'}}<input type="hidden" value="{{$property->constructionPartner->id ?? ''}}" name="construction_partner"></label>
				</div>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" value="{{$property->contact_no}}" class="form-control is-contact-no" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" name="house_no" class="form-control" id="" value="{{$property->house_no}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="" value="{{$property->plot_no}}">
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
				<input type="text" name="street_name" class="form-control ctfd-required" id="" value="{{$property->street_details}}">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
				<input type="text" name="locality_name" value="{{$property->locality_name}}" class="form-control ctfd-required" id="">
			</div>
		</div>

	</div>

</div>