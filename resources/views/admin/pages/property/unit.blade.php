@for($i=$start_index;$i<$count; $i++)
<div class="row gx-2 mt-1 py-2 bg-light name_of_unit_child nouc-{{$floor_id}} uno{{$i}}-fno{{$floor_id}} storey-unit rounded border border-secondary">
    <div class="row dds_row">
        <div class="col-auto p-0 " style="visibility:hidden;">
            <input class="form-check-input unit-chk d-none unit-parent-{{$i}}-floor{{$floor_id}} mx-2 border border-info" name="unit_check{{$floor_id}}[{{$i}}]" data-floor_parent="{{$floor_id}}" data-parent="{{$i}}"  type="checkbox" value="{{$i}}" id="flexCheckDefault">
        </div>
        
        <div class="col-md-3 col-lg-3">
            <label for="inputPassword6" class="form-label">Name of Unit {{$i+1}}</label>
            <input type="text" name="nth_unit_name{{$floor_id}}[]" data-pid="{{$i}}" class="form-control form-control-sm unit-name ctfd-required" id="" fdprocessedid="gmudk6">
        </div>
        
       
        @if($c_id == 3)
        <div class="col-md-3 append-dd-to">
            <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>
            <select class="form-select form-select-sm cpdd-required select2-dd prop_category_dd" data-uid="{{$i}}" data-fid="{{$floor_id}}" name="uprop_category{{$floor_id}}[]" id="" d >
                <option disabled selected>-- select Property Type --</option>
                @forelse($prop_categories->take(2) as $prop_category)
                    <option value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
                @empty
                
                @endforelse
            </select>
        </div>
        @endif
        
        <div class="col-auto append-dd-to u-type">
            <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>
            <select class="form-select append-dd select2-dd futd un_unit_type_dd unit_ddopt" data-uid="{{$i}}" data-fid="{{$floor_id}}"
                name="uu_type{{$floor_id}}[]" id="" >
                <option selected="" disabled="">--Select Category--</option>
                @forelse($unit_categories as $unit_category)
                    <option  data-field="{{$unit_category->field_type}}" value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                @empty
                
                @endforelse
            </select>
        </div>
         <div class="col-md-3 col-lg-3 residential-unit-name-{{$floor_id}}{{$i}} d-none">
            <label for="inputPassword6" class="form-label"></label>
            <input type="text" id="" data-pid="{{$i}}" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">
        </div>
        
         <div class="col-md-3 col-lg-3 residential-unit-name d-none">
            <label for="inputPassword6" class="form-label"></label>
            <input type="text" id="" data-pid="{{$i}}" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">
        </div>
        
        
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 un_unit_occupied_type-{{$floor_id}}{{$i}} d-none">
            <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
            <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_unit_type_cat_dd is-searchable" name="unit_category{{$floor_id}}[{{$i}}]" id=""
                data-suid="1" data-pid="1" >
                <option selected="" disabled="">--Select Category--</option>
            </select>
        </div>
    
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 un_unit_occupied_type-{{$floor_id}}{{$i}} d-none">
            <label for="" class="form-label"> Sub Category </label>
            <select class="form-select append-dd dd-child select2-dd unit_ddopt is-searchable" name="unit_sub_category{{$floor_id}}[{{$i}}]" id="" data-suid="1" data-pid="1" >
            <option selected="" disabled="">--Select Sub Category--</option>
            </select>
        </div>
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 un_unit_occupied_type-{{$floor_id}}{{$i}} d-none">
            <label for="" class="form-label"> Enter Name/Brand </label>
            <select class="form-select append-dd dd-child select2-dd unit_ddopt ddopt_te" name="unit_brand{{$floor_id}}[{{$i}}]" id="" data-suid="1" data-pid="1" >
            <option selected="" disabled="">--Select Brand--</option>
            </select>
        </div>

        
        <div class="col-auto unit-tfd un_unit_vacant_type-{{$floor_id}}{{$i}} d-none">
            <label for="" class="form-label">Concerned Person Name</label>
            <input type="text" id="" data-pid="{{$i}}" name="person_name{{$floor_id}}[{{$i}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-person-name" aria-describedby="">
        </div>
        <div class="col-auto unit-tfd un_unit_vacant_type-{{$floor_id}}{{$i}} d-none">
            <label for="" class="form-label">Mobile</label>
            <input type="text" id="" data-pid="{{$i}}" name="mobile{{$floor_id}}[{{$i}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm  is-contact-no" aria-describedby="">
        </div>
    </div>
    
    <div class="row unit-parent__ufs-ufr">
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input unit-ufs-ufr"  type="checkbox" name="unit_up_for_sale{{$floor_id}}[{{$i}}]" id="up_for_sale">
              <label class="form-check-label" for="up_for_sale">
                up for Sale
              </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input unit-ufs-ufr" type="checkbox" name="unit_up_for_rent{{$floor_id}}[{{$i}}]" id="up_for_rent" >
              <label class="form-check-label" for="up_for_rent">
                up for Rent
              </label>
            </div>
        </div>
    </div>
                                
    
    <div class="row d-none">
        
        <div class="col-md-3 mt-2">
            <div class=" unit-merge-group" role="group" aria-label="Basic outlined example">
                <label  class="btn btn-sm btn-outline-primary merge_other_unit_lable" for="unit-check-{{$i}}-f{{$floor_id}}">
                  <!--<span class="mdi mdi-merge mdi-18px"></span>-->
                  Merge Units
                </label>
                <input type="checkbox" class="d-none merge_other_units" name=""  id="unit-check-{{$i}}-f{{$floor_id}}" data-suid="1" data-pid="1" >
              <label class="btn btn-sm btn-outline-primary save-unit-merge d-none">Save</label>
            </div>
        </div>

        
        <!--<div class="mt-2" style="display: flex;justify-content: start;align-items: end;">-->
        <!--    <div class="su-mous">-->
                <!--<label for="" class="form-label"> <span class="errorcl"></span> </label>-->
                <!--Merge with Other Units -->
        <!--        <label for="unit-check-{{$i}}-f{{$floor_id}}" class="form-control unit-merge-btn btn btn-sm btn-outline-primary mb-0"> <span class="mdi mdi-merge"></span></label>-->
        <!--        <input type="checkbox" class="d-none merge_other_units" name="" data-current="{{$i}}" data-current-floor="{{$floor_id}}" id="unit-check-{{$i}}-f{{$floor_id}}" data-suid="1" data-pid="1" >-->
        <!--    </div>-->
        <!--    <div class="col-auto d-none save-unit-merge-btn save-unit-merge-btn-{{$floor_id}}{{$i}}">-->
        <!--        <label for="" class="form-label"> <span class="errorcl"></span> </label>-->
        <!--        <button type="button" class="btn btn-sm btn-outline-primary save-unit-merge">save</button>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
    <span class="remove-storey-unit d-none">
    <span class="mdi mdi-close-circle mdi-18px"></span>
    </span>
</div>
@endfor