@php
$u_key = 0;
@endphp
@forelse($units as $key=>$unit)
@if($floor_id == $unit->floor_id)
@php
print_r($unit->parent)
@endphp
<div class="row existing_unit gx-2 mt-1 py-2 bg-light name_of_unit_child nouc-{{$floor_Key}} uno{{$u_key}}-fno{{$floor_Key}} storey-unit rounded border border-secondary">
    <input type="hidden" class="" name="unit_id{{$floor_Key}}[]" id="" data-uid="{{$unit->id ?? 0}}" value="{{$unit->id ?? 0}}" >
    @if($unit->merge_parent_unit_id != NULL)
    <div class="unit-mask"></div>
    <div class="row">
        <div class="merged-notch">
          <div class="unit-notch">
          @php 
                $p_floor = $floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1;
                $floor_index_sup = ['1' => 'st', '2' => 'nd', '3'=>'rd'];
              @endphp
               Merged With Unit({{$unit->unit_name ?? ''}}) in {{$floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1}} <sup>{{($p_floor > 3) ? 'th' : $floor_index_sup[$p_floor]}}</sup> Floor 
          </div>
        </div>
    </div>
    @endif
    @if(in_array($unit->id, $parent_units))
        <div class="row">
            <div class="merged-notch">
              <div class="unit-notch bg-success">
                 Parent Unit
              </div>
            </div>
        </div>
    @endif
    <div class="row dds_row">
        <div class="col-auto">
            <!--other units parent unit : oup-unit-->
            <input class="form-check-input unit-chk d-none unit-parent-{{$u_key}}-floor{{$floor_Key}} mx-2 border border-info {{in_array($unit->id, $parent_units) ? 'oup-unit' : '' }}"  name="unit_check{{$floor_Key}}[{{$u_key}}]" value="{{$u_key}}" data-floor_parent="{{$floor_Key}}" data-parent="{{$u_key}}"  type="checkbox" value="{{$u_key}}" id="flexCheckDefault">
        </div>
        
        <div class="col-md-auto">
            <label for="inputPassword6" class="form-label">Name of Unit {{$u_key + 1}} <span class="errorcl">*</span></label>
            <input type="text" value="{{$unit->unit_name}}" name="nth_unit_name{{$floor_Key}}[{{$u_key}}]" data-pid="{{$u_key}}" class="form-control form-control-sm unit-name ctfd-required @if($unit->merge_parent_unit_id != NULL) merged-unit-name @endif" id="" fdprocessedid="gmudk6">
        </div>
        
        @if( $property_cat_id == 3)
        <div class="col-md-3 append-dd-to">
            <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>
            <select class="form-select  select2-dd prop_category_dd" data-uid="{{$u_key}}" data-fid="{{$floor_Key}}" name="uprop_category{{$floor_Key}}[{{$u_key}}]" id="" d >
            @if(empty($unit->unit_cat_type_id))<option selected="" disabled="">-Select Category-</option>@endif    
            @forelse($prop_categories->take(2) as $prop_category)
                    <option  @if($unit->unit_cat_type_id == $prop_category->id) selected @endif value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
                @empty
                    
                @endforelse
            </select>
        </div>
        @endif
        
        <div class="col-auto append-dd-to u-type">
            <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>
            <select class="form-select append-dd select2-dd futd un_unit_type_dd unit_ddopt" data-uid="{{$u_key}}" data-fid="{{$floor_Key}}"
                name="uu_type{{$floor_Key}}[{{$u_key}}]" id="" >
                <option selected="" disabled="">--Select Category--</option>
                @forelse($unit_categories as $unit_category_type)
                    <option  data-field="{{$unit_category_type->field_type}}" @if($unit_category_type->id == $unit->unit_type_id) selected @endif value="{{$unit_category_type->id}}">{{$unit_category_type->name}}</option>
                @empty
                
                @endforelse
            </select>
        </div>
        
        @if($property_cat_id != 2 && $unit->unit_type_id == 2)
            @if(($property_cat_id == 3 && $unit->unit_cat_type_id == 1 && $unit->unit_type_id == 2) || in_array($property_cat_id, [1,4,5,6]))
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}} @if($unit->unit_type_id == 2) @else d-none @endif">
                    <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                    <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_unit_type_cat_dd is-searchable" name="unit_category{{$floor_Key}}[{{$u_key}}]" id=""
                        data-suid="1" data-pid="1" >
                        @if(empty($unit->unit_cat_id))<option selected="" disabled="">-Select Category-</option>@endif
                        @forelse($unit_category_list as $unit_category)
                            <option data-field="{{$unit_category->field_type}}" @if($unit->unit_cat_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}} @if($unit->unit_type_id == 2) @else d-none @endif">
                    <label for="" class="form-label"> Sub Category </label>
                    <select class="form-select append-dd dd-child select2-dd unit_ddopt is-searchable" name="unit_sub_category{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                    @if(empty($unit->unit_sub_cat_id))<option selected="" disabled="">-Select Sub Category-</option>@endif    
                    @forelse($unit_sub_category_list as $unit_category)
                            @if($unit_category->parent_id == $unit->unit_cat_id)
                            <option data-field="{{$unit_category->field_type}}" @if($unit->unit_sub_cat_id == $unit_category->id)  selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                            @endif
                        @empty
                        
                        @endforelse
                    </select>
                </div>
                
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}} @if(empty($unit->unit_sub_cat_id)) d-none @endif @if($unit->unit_type_id == 2) @else d-none @endif">
                    <label for="" class="form-label"> Enter Name/Brand </label>
                    <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_ddopt ddopt_te" name="unit_brand{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                        @if(empty($unit->unit_brand_id) || $unit->brand_name == '') <option selected disabled="">-Select Brand-</option> @endif 
                        @if($unit->unit_brand_id == 0)
                            <option data-field=""  selected value="{{$unit->brand_name}}">{{$unit->brand_name}}</option> 
                        @endif

                        @forelse($brands as $unit_category)
                            @if($unit_category->parent_id == $unit->unit_sub_cat_id)
                                <option data-field="{{$unit_category->field_type}}" @if($unit->unit_brand_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                            @endif
                        @empty
                        @endforelse
                    </select>
                </div>
                
                @else 
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}} d-none ">
                        <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_unit_type_cat_dd is-searchable" name="unit_category{{$floor_Key}}[{{$u_key}}]" id=""
                            data-suid="1" data-pid="1" >
                        </select>
                    </div>
                
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}}  d-none ">
                        <label for="" class="form-label"> Sub Category </label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt is-searchable" name="unit_sub_category{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                            
                        </select>
                    </div>
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}}  d-none ">
                        <label for="" class="form-label"> Enter Name/Brand </label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_ddopt ddopt_te" name="unit_brand{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                        
                        </select>
                    </div>
            @endif
        @else
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}} d-none ">
                        <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_unit_type_cat_dd is-searchable" name="unit_category{{$floor_Key}}[{{$u_key}}]" id=""
                            data-suid="1" data-pid="1" >
                        </select>
                    </div>
                
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}}  d-none ">
                        <label for="" class="form-label"> Sub Category </label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt is-searchable" name="unit_sub_category{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                            
                        </select>
                    </div>
                    <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 un_unit_occupied_type-{{$floor_Key}}{{$u_key}}  d-none ">
                        <label for="" class="form-label"> Enter Name/Brand </label>
                        <select class="form-select append-dd dd-child select2-dd unit_ddopt floor_ddopt ddopt_te" name="unit_brand{{$floor_Key}}[{{$u_key}}]" id="" data-suid="1" data-pid="1" >
                        
                        </select>
                    </div>
        
        @endif

        <div class="col-auto unit-tfd un_unit_vacant_type-{{$floor_Key}}{{$u_key}} @if($unit->unit_type_id == 1 || $unit->up_for_sale == 1 || $unit->up_for_rent == 1 ) @else d-none @endif">
            <label for="" class="form-label">Concerned Person Name</label>
            <input type="text" value="{{$unit->person_name}}" id="" data-pid="{{$u_key}}" name="person_name{{$floor_Key}}[{{$u_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-person-name" >
        </div>
        <div class="col-auto unit-tfd un_unit_vacant_type-{{$floor_Key}}{{$u_key}} @if($unit->unit_type_id == 1 || $unit->up_for_sale == 1 || $unit->up_for_rent == 1 ) @else d-none @endif">
            <label for="" class="form-label">Mobile</label>
            <input type="text" value="{{$unit->mobile}}" id="" data-pid="{{$u_key}}" name="mobile{{$floor_Key}}[{{$u_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-contact-no" >
        </div>
    </div>
    
    <div class="row unit-parent__ufs-ufr">
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input unit-ufs-ufr" type="checkbox" name="unit_up_for_sale{{$floor_Key}}[{{$u_key}}]" id="up_for_sale{{$floor_Key}}-{{$u_key}}" @if($unit->up_for_sale == 1) checked @endif >
              <label class="form-check-label" for="up_for_sale{{$floor_Key}}-{{$u_key}}">
                up for Sale
              </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div class="form-check">
              <input class="form-check-input unit-ufs-ufr" type="checkbox" name="unit_up_for_rent{{$floor_Key}}[{{$u_key}}]" id="up_for_rent{{$floor_Key}}-{{$u_key}}" @if($unit->up_for_rent == 1) checked @endif >
              <label class="form-check-label" for="up_for_rent{{$floor_Key}}-{{$u_key}}">
                up for Rent
              </label>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3 mt-2">
            <div class=" unit-merge-group" role="group" aria-label="Basic outlined example">
                <label  class="btn btn-sm btn-outline-primary merge_other_unit_lable" for="unit-check-{{$u_key}}-f{{$floor_Key}}">
                  <!--<span class="mdi mdi-merge mdi-18px"></span>-->
                  Merge Units
                </label>
                <input type="checkbox" class="d-none merge_other_units" name="" data-uId="{{$unit->id ?? 0}}"  id="unit-check-{{$u_key}}-f{{$floor_Key}}" data-suid="1" data-pid="1" >
              <label class="btn btn-sm btn-outline-primary d-none save-unit-merge">Save</label>
            </div>
        </div>
    </div>
     <span class="remove-storey-unit d-none" data-unit_id="{{$unit->id}}">
     <span class="mdi mdi-close-circle mdi-18px"></span>
    </span>
</div>
@php $u_key++; @endphp
@endif
@empty
@endforelse