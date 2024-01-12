@for($i= $start_index;$i<$count; $i++)
<div class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{$i}} rounded border border-dark">
    <div class="row dds_row floor-dds_row">
        
        <div class="col-auto p-0 h-100 w-10 ">
            <input class="form-check-input floor-chk d-none floor-parent-{{$i}} mx-2 border border-dark" data-parent="{{$i}}" type="checkbox" name="floor[]" value="{{$i}}" id="flexCheckDefault">
        </div>

        <div class="col-md-2 storey-nou-child">
		    <div>
				<label for="" class="form-label">No of Units per Floor {{$i+1}}<span class="errorcl">*</span></label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm no_of_units" data-pid="{{$i}}" name="nth_unit[]" placeholder="0" aria-label="" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-success add-unit" type="button"  id="button-addon2">Add Units</button>
                  </div>
                </div>
            </div>
            
        </div>
        <div class="col-auto">
		    <div>
				<label for="" class="form-label"> Floor Name <span class="errorcl">*</span></label>
                <div class="">
                  <input type="text" class="form-control form-control-sm ctfd-required"  name="floor_name[]" >
                </div>
            </div>
        </div>
        
        @if($c_id == 3)
        <div class="col-md-3 append-dd-to">
            <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>
            <select class="form-select form-select-sm select2-dd prop_category_dd" data-suid="1" data-pid="1" name="prop_category[{{$i}}]" id="" >
                <option disabled selected>-- select Category --</option>
                @forelse($prop_categories->take(2) as $prop_category)
                    <option value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
                @empty
                    
                @endforelse
            </select>
        </div>
        @endif
        
        <div class="col-auto append-dd-to u-type">
            <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>
            <select class="form-select append-dd select2-dd floor_unit_type_dd futd floor_ddopt" data-fid="{{$i}}"  name="unit_type[{{$i}}]" id="" >
                <option selected="" disabled="">--Select Category--</option>
                @forelse($unit_categories as $unit_category)
                    <option data-field="{{$unit_category->field_type}}" value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                @empty
                
                @endforelse
            </select>
        </div>
         <div class="col-md-3 col-lg-3 residential-floor-name-{{$i}} d-none">
            <label for="inputPassword6" class="form-label"></label>
            <input type="text" id="" data-pid="{{$i}}" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">
        </div>
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-{{$i}} d-none">
            <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
            <select class="form-select append-dd dd-child select2-dd floor_ddopt floor_unit_type_cat_dd is-searchable" name="fu_category[{{$i}}]" id="" >
            </select>
        </div>
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-{{$i}} d-none">
            <label for="" class="form-label"> Sub Category </label>
            <select class="form-select append-dd dd-child select2-dd floor_ddopt is-searchable" name="fu_sub_category[{{$i}}]" id=""  >
            </select>
        </div>
        <div class="  col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-{{$i}} d-none">
            <label for="" class="form-label"> Enter Name/Brand </label>
           
                <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te" name="floor_brand[{{$i}}]" id="" data-suid="1" data-pid="1" >
                </select>
                <!--data-bs-toggle="modal" data-bs-target="#add-brand-model"-->
                
            
        </div>
    
        
        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$i}} d-none">
            <label for="" class="form-label">Concerned Person Name</label>
            <input type="text" id="" data-pid="{{$i}}" name="person_name[{{$i}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-person-name" aria-describedby="">
        </div>
        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$i}} d-none">
            <label for="" class="form-label">Mobile</label>
            <input type="text" id="" data-pid="{{$i}}" name="mobile[{{$i}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-contact-no" aria-describedby="">
        </div>
    </div>
    <div class="row floor-parent__ufs-ufr">
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input floor-ufs-ufr" type="checkbox" name="floor_up_for_sale[{{$i}}]" id="up_for_sale">
              <label class="form-check-label" for="up_for_sale">
                up for Sale
              </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input floor-ufs-ufr" type="checkbox" name="floor_up_for_rent[{{$i}}]" id="up_for_rent" >
              <label class="form-check-label" for="up_for_rent">
                up for Rent
              </label>
            </div>
        </div>
    </div>
                                
    <div class="row d-none">
        
        <div class="mt-2" style="
                                display: flex;
                                justify-content: start;
                                align-items: end;
                            ">
            {{--<div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-sm btn-primary">
                  <!--<span class="mdi mdi-merge mdi-18px"></span>-->
                  Merge Floors
                </button>
              <button type="button" class="btn btn-sm btn-outline-primary">Save</button>
            </div>--}}
            
            <div class="">
                <!--<label for="" class="form-label">  <span class="errorcl"></span> </label>-->
                <!--Merge with Other Floors-->
                <label for="floor-check-{{$i}}" class="form-control floor-merge-btn btn btn-sm btn-outline-success mb-0"> 
                <!--<span class="mdi mdi-merge"></span></label>-->
                Merge Floors
                <input type="checkbox" class="d-none merge_other_floors" name="" data-current="{{$i}}" id="floor-check-{{$i}}" data-suid="1" data-pid="1" >
            </div>
            
            <div class="d-none  save-merge-btn save-merge-btn-{{$i}}">
                <label for="" class="form-label">  <span class="errorcl"></span> </label>
                <button type="button" class="btn btn-sm btn-outline-success save-floor-merge">save</button>
            </div>
            
        </div>
    </div>
    
    <div class="unit-container">
        
    </div>
    
    <span class="remove-storey d-none">
    <span class="mdi mdi-close-circle mdi-18px"></span>
       <!-- <span class="mdi mdi-minus-box-outline mdi-18px"></span> -->
    </span>
    
</div>
@endfor