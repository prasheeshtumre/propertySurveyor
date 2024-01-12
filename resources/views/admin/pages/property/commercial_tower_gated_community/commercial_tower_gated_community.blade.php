 <div class="row residential-apartment-gated-community residential-fields-child">
     <div class="row residential-apartment-gated-community residential-fields-child">
         @include('admin.pages.property.commercial_tower_gated_community.includes.property_basic_details')
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Category of the property</label>
                 <input type="text" class="form-control" id="" readonly disabled
                     value="{{ $get_property->category->cat_name ?? '' }}">
             </div>
         </div>

         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Commercial Type</label>
                 <input type="text" class="form-control" id="" readonly disabled
                     value="{{ $get_property->CommercialName->cat_name ?? '' }}">
             </div>
         </div>

         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Project Name</label>
                 <input type="text" name="project_name" class="form-control" id="" readonly disabled
                     value="{{ $get_property->project_name ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <label for="" class="form-label"> Builder </label>
             <input type="text" name="builder_name" class="form-control" id="" readonly disabled
                 value="{{ $get_property->getBuilderName->name ?? '' }}">
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <label for="" class="form-label"> Builder Sub Group</label>
             <input type="text" name="subBuilder_name" class="form-control" id="" readonly disabled
                 value=" {{ $get_property->subBuilder->name ?? 'N/A' }}">
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Contact No</label>
                 <input type="text" name="contact_no" class="form-control" id="" readonly disabled
                     value="{{ $get_property->contact_no ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">House No</label>
                 <input type="text" name="house_no" class="form-control" id="" readonly disabled
                     value="{{ $get_property->house_no ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Plot No</label>
                 <input type="text" name="plot_no" class="form-control" id="" readonly disabled
                     value="{{ $get_property->plot_no ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Street Name/No/Road No </label>
                 <input type="text" name="street_name" class="form-control ctfd-required" id="" readonly
                     disabled value="{{ $get_property->street_details ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Colony/Locality Name</label>
                 <input type="text" name="locality_name" class="form-control ctfd-required" id="" readonly
                     disabled value="{{ $get_property->locality_name ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">Website Address</label>
                 <input type="text" name="website_address" class="form-control" id=""
                     value="{{ $get_property->website_address ?? '' }}">
             </div>
         </div>
         <div class="col-xxl-3  col-md-12 mt-3 d-none">
             <div>
                 <label for="" class="form-label">Club House Details</label>
                 <textarea class="form-control" name="club_house_details" id="" rows="3">{{ $get_property->club_house_details ?? '' }}</textarea>
             </div>
         </div>
         <div class="col-xxl-3 col-md-3 mt-3">
             <div>
                 <label for="" class="form-label">No of Units</label>
                 <input type="text" name="no_of_units" class="form-control" id=""
                     value="{{ $get_property->no_of_units ?? '' }}">
             </div>
         </div>

     </div>
 </div>
