@forelse($floors as $floor_key=>$floor)

<div class="row existing_floor gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{$floor_key}} rounded border border-dark">

    <input type="hidden" class="" name="floor_id[]" id="floor_id" value="{{$floor->id ?? 0}}">

    @if($floor->merge_parent_floor_id != NULL)

    <div class="floor-mask"></div>

        <div class="merged-notch">

            <div class="notch">
            @php 
                $pf_floor = $floor_index[$floor->merge_parent_floor_id] + 1;
                $floor_index_sup = ['1' => 'st', '2' => 'nd', '3'=>'rd'];
              @endphp
               Merged With {{ $floor_index[$floor->merge_parent_floor_id] + 1 }} <sup>{{($pf_floor > 3) ? 'th' : $floor_index_sup[$pf_floor]}}</sup> Floor ({{$floor->floor_name ?? ''}})
              

            </div>

        </div>

    @endif

    @if(in_array($floor->id, $parent_floors))

        <div class="merged-notch">

            <div class="unit-notch bg-dark">

                Parent Floor

            </div>

        </div>

    @endif

    <div class="row dds_row floor-dds_row">

        <div class="col-auto p-0 h-100 w-10 ">

            <input class="form-check-input @if($floor->merge_parent_floor_id != NULL) edit_floor-chk @else floor-chk @endif  d-none floor-parent-{{$floor_key}} mx-2 border border-dark {{in_array($floor->id, $parent_floors) ? 'oup-floor' : '' }}" data-parent="{{$floor_key}}" type="checkbox" name="floor[]" value="{{$floor->id ?? 0}}" id="flexCheckDefault">

        </div>



        <div class="col-md-2 storey-nou-child">

            <div>

                <label for="" class="form-label">No of Units per Floor {{$floor_key+1}}<span class="errorcl">*</span></label>

                <div class="input-group">

                    <input type="text" {{in_array($floor->id, $parent_floors) ? 'readonly' : '' }} value="{{$floor->units}}" class="form-control form-control-sm no_of_units" data-pid="{{$floor_key}}" name="nth_unit[]" placeholder="0" aria-label="" aria-describedby="button-addon2">

                    <div class="input-group-append">

                        <button class="btn btn-sm btn-success add-unit" type="button" data-floor_id="{{$floor->id}}" id="button-addon2">Add Units</button>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-auto">

            <div>

                <label for="" class="form-label"> Floor Name <span class="errorcl">*</span></label>

                <div class="">

                    <input type="text" class="form-control form-control-sm @if($floor->merge_parent_floor_id != NULL) merged-floor-name @endif ctfd-required" value="{{$floor->floor_name ?? ''}}" name="floor_name[]">

                </div>

            </div>

        </div>

        @if($floor->units === 0 || $floor->units === 1)

        @forelse($units as $key=>$f_unit)

        @if($floor->id == $f_unit->floor_id)
        
            @if( $property_cat_id == 3)

            <div class="col-md-3 append-dd-to">

                <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>

                <select class="form-select select2-dd prop_category_dd" data-suid="1" data-pid="1" name="prop_category[{{$floor_key}}]" id="">

                    @if(empty($f_unit->unit_cat_type_id))<option selected="" disabled="">-Select Category-</option>@endif
                    @forelse($prop_categories->take(2) as $prop_category)
                        <option value="{{$prop_category->id}}" @if($f_unit->unit_cat_type_id == $prop_category->id) selected @endif >{{$prop_category->cat_name}}</option>
                    @empty

                    @endforelse

                </select>

            </div>

            @endif



        <div class="col-auto append-dd-to u-type">

            <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>

            <select class="form-select append-dd select2-dd futd floor_unit_type_dd floor_ddopt" data-fid="{{$floor_key}}" name="unit_type[{{$floor_key}}]" id="">

                @if(empty($f_unit->unit_type_id))

                    <option selected="" disabled="">--Select Category--</option>

                    @forelse($unit_categories as $unit_category_type)

                    <option data-field="{{$unit_category_type->field_type}}" value="{{$unit_category_type->id}}">{{$unit_category_type->name}}</option>

                    @empty

                    @endforelse

                @else
                    <option selected="" disabled="">--Select Category--</option>
                    @forelse($unit_categories as $unit_category_type)



                    <option data-field="{{$unit_category_type->field_type}}" @if($unit_category_type->id == $f_unit->unit_type_id) selected @endif value="{{$unit_category_type->id}}">{{$unit_category_type->name}}</option>



                    @empty



                    @endforelse

                @endif



            </select>

        </div>

        <div class="col-md-3 col-lg-3 residential-floor-name-{{$floor_key}} d-none">

            <label for="inputPassword6" class="form-label"></label>

            <input type="text" id="" data-pid="{{$floor_key}}" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">

        </div>
        @if($property_cat_id != 2 && $f_unit->unit_type_id == 2 )       
            @if(($property_cat_id == 3 && $f_unit->unit_cat_type_id == 1 && $f_unit->unit_type_id == 2) || in_array($property_cat_id, [1,4,5,6]))
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-{{$floor_key}}">

                    <label for="" class="form-label"> Category<span class="errorcl">*</span></label>

                    <select class="form-select append-dd dd-child select2-dd floor_ddopt floor_unit_type_cat_dd is-searchable" name="fu_category[{{$floor_key}}]" id="">

                        @if(empty($f_unit->unit_cat_id) || $f_unit->unit_cat_id == 0)

                            <option selected="" disabled="">-Select Category-</option>

                            @forelse($unit_category_list as $unit_category)

                            <option data-field="select" value="{{$unit_category->id}}">{{$unit_category->name}}</option>

                            @empty



                            @endforelse

                        @elseif($f_unit->unit_cat_id !== 0)

                            @forelse($unit_category_list as $unit_category)

                                

                                    <option data-field="select" @if($f_unit->unit_cat_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>

                                

                            @empty



                            @endforelse

                        @endif

                        <!-- <option selected="" disabled="">-Select Category- {{$f_unit->unit_cat_id}}</option> -->

                    </select>

                </div>

                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-{{$floor_key}} ">

                    <label for="" class="form-label"> Sub Category </label>

                    <select class="form-select append-dd dd-child select2-dd floor_ddopt is-searchable" name="fu_sub_category[{{$floor_key}}]" id="">

                        @if(empty($f_unit->unit_sub_cat_id) || $f_unit->unit_sub_cat_id == 0)

                            <option selected="" disabled="">-Select Category-</option>

                        @endif

                            @forelse($unit_sub_category_list as $unit_category)

                                @if($unit_category->parent_id == $f_unit->unit_cat_id)
                                    <option data-field="select" @if($f_unit->unit_sub_cat_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                                @endif

                            @empty



                            @endforelse

                        



                    </select>

                </div>

                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-{{$floor_key}} @if(empty($f_unit->unit_sub_cat_id)) d-none @endif">

                    <label for="" class="form-label"> Enter Name/Brand  </label>

                    <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te" name="floor_brand[{{$floor_key}}]" id="" data-suid="1" data-pid="1">
                        @if(empty($f_unit->unit_brand_id) || empty($f_unit->brand_name))<option selected="" disabled="">-Select Brand-</option>@endif
                        @if($f_unit->unit_brand_id == 0 && !empty($f_unit->brand_name))
                            <option data-field=""  selected value="{{$f_unit->brand_name}}">{{$f_unit->brand_name}}</option> 
                        @endif

                        @forelse($brands as $unit_category)
                            @if($unit_category->parent_id == $f_unit->unit_sub_cat_id)
                                <option data-field="{{$unit_category->field_type}}" @if($f_unit->unit_brand_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}t</option>
                            @endif
                        @empty
                        @endforelse

                

                    </select>



                </div>
                @else 
       
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                    <select class="form-select append-dd dd-child select2-dd floor_unit_type_cat_dd floor_ddopt is-searchable" name="fu_category[{{$floor_key}}]" id="" >
                    </select>
                </div>
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                    <label for="" class="form-label"> Sub Category </label>
                    <select class="form-select append-dd dd-child select2-dd floor_ddopt is-searchable" name="fu_sub_category[{{$floor_key}}]" id=""  >
                    </select>
                </div>
                <div class="  col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                    <label for="" class="form-label"> Enter Name/Brand  </label>
                    
                        <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te " name="floor_brand[{{$floor_key}}]" id="" data-suid="1" data-pid="1" >
                        </select>
                        <!--data-bs-toggle="modal" data-bs-target="#add-brand-model"-->
                        
                    
                </div>
                
            @endif
        @else 
        
            <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                    <select class="form-select append-dd dd-child select2-dd floor_unit_type_cat_dd floor_ddopt is-searchable" name="fu_category[{{$floor_key}}]" id="" >
                    </select>
                </div>
                <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                    <label for="" class="form-label"> Sub Category </label>
                    <select class="form-select append-dd dd-child select2-dd floor_ddopt is-searchable" name="fu_sub_category[{{$floor_key}}]" id=""  >
                    </select>
                </div>
                <div class="  col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-{{$floor_key}} d-none">
                    <label for="" class="form-label"> Enter Name/Brand  </label>
                    
                        <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te " name="floor_brand[{{$floor_key}}]" id="" data-suid="1" data-pid="1" >
                        </select>
                        <!--data-bs-toggle="modal" data-bs-target="#add-brand-model"-->
                        
                    
                </div>
        
        @endif



        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$floor_key}} @if($f_unit->unit_type_id == 1 || $f_unit->up_for_sale == 1 || $f_unit->up_for_rent == 1 ) @else d-none @endif">

            <label for="" class="form-label">Concerned Person Name</label>

            <input type="text" value="{{$f_unit->person_name}}" id="" data-pid="{{$floor_key}}" name="person_name[{{$floor_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm   is-person-name" aria-describedby="">

        </div>

        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$floor_key}} @if($f_unit->unit_type_id == 1 || $f_unit->up_for_sale == 1 || $f_unit->up_for_rent == 1) @else d-none @endif">

            <label for="" class="form-label">Mobile</label>

            <input type="text" value="{{$f_unit->mobile}}" id="" data-pid="{{$floor_key}}" name="mobile[{{$floor_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-contact-no" aria-describedby="">

        </div>

        <div class="row floor-parent__ufs-ufr">

            <div class="col-xxl-3 col-md-3 mt-3">

                <div class="form-check">

                    <input class="form-check-input floor-ufs-ufr" @if($f_unit->up_for_sale == 1) checked @endif type="checkbox" name="floor_up_for_sale[{{$floor_key}}]" id="up_for_sale">

                    <label class="form-check-label" for="up_for_sale">

                        up for Sale

                    </label>

                </div>

            </div>

            <div class="col-xxl-3 col-md-3 mt-3">

                <div class="form-check">

                    <input class="form-check-input floor-ufs-ufr" @if($f_unit->up_for_rent == 1) checked @endif type="checkbox" name="floor_up_for_rent[{{$floor_key}}]" id="up_for_rent">

                    <label class="form-check-label" for="up_for_rent">

                        up for Rent

                    </label>

                </div>

            </div>

        </div>

        @break

        @endif

        @empty

        @endforelse

        @endif

    </div>







    <div class="row">



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

                <label for="floor-check-{{$floor_key}}" class="form-control floor-merge-btn btn btn-sm btn-outline-success mb-0">

                    <!--<span class="mdi mdi-merge"></span></label>-->

                    Merge Floors

                    <input type="checkbox" data-fid="{{$floor->id}}" class="d-none @if($floor->merge_parent_floor_id != NULL) edit_merge_other_floors @else merge_other_floors @endif " name="" data-current="{{$floor_key}}" id="floor-check-{{$floor_key}}" data-suid="1" data-pid="1">

            </div>

            <div class="d-none  save-merge-btn save-merge-btn-{{$floor_key}}">

                <label for="" class="form-label"> <span class="errorcl"></span> </label>

                <button type="button" class="floor-unit-merge-btn btn btn-sm btn-outline-success save-floor-merge">save</button>

            </div>



        </div>



    </div>



    <div class="unit-container">

        @if($floor->units > 1)

        @include('admin.pages.property.edit_unit', ['units' => $units, 'floor_Key' => $floor_key , 'floor_id' => $floor->id])

        @endif

    </div>



    <!-- <span class="remove-storey d-none" data-floor_id="{{$floor->id}}">

    <span class="mdi mdi-close-circle mdi-18px"></span>

    </span> -->



</div>

@empty

@endforelse