
@push('css')
<link href="{{ asset('assets/css/unit-details.css') }}?v=2369" rel="stylesheet" type="text/css" />
@endpush

<div class=" screen visible">
    <div class="card1">
        <div class="row mt-3 mb-3">
            <div class="col-md-4">
                <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
            </div>
            <div class="col-md-4">
                <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
            </div>
            <div class="col-md-4">
                <p><b>Address : </b> <span class="project-head"> {{$property->city}}</span></p>
            </div>
        </div>
        <input type="hidden" name="property_id" value="{{$property->id}}">
        <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
        <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
        <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
        <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
        <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
        <h4 class="mb-3">Property Details</h4>
        <label class="form-label required">Type of the office </label>
        <div class="row align-items-center mb-4">
            <div class="col-md-3">
                <div class="">
                    <select class="form-select" name="office_type" id="TypeOfOffice">
                        <option value="">Select Office Type</option>
                        @forelse($office_types as $sub_cat)
                        <option value="{{$sub_cat->id}}">{{$sub_cat->name}} </option>
                        @empty
                        @endforelse
                    </select>
                    <span id="erroffice_type"></span>
                </div>
            </div>
        </div>

        <label class=" form-label required">Add Area Details </label>
        <div class="row align-items-center mt-3 mb-3">
            <div class="col-md-4">
                <div class="box-bdr">
                    <div class="d-flex">
                        <div>
                            <input type="text" class="form-control form-control-b0 col-md-3 border-none" onkeypress="return isNumber(event)" name="carpet_area" id="CarpetArea" placeholder="carpet area">
                        </div>

                        <div class="ms-auto" style="">
                            <select class="form-select form-control-b0" name="carpet_area_unit">
                                @forelse($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mb-3"></div>

            <div class="col-md-4" id="BuiltUp" style="display:none">
                <div class=" box-bdr">
                    <div class="d-flex">
                        <div>
                            <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="buildup_area" onkeypress="return isNumber(event)" id="BuildupArea" placeholder="Add Built up area">
                        </div>
                        <div class="ms-auto" style="">
                            <select class="form-select form-control-b0" name="buildup_area_unit">
                                @forelse($units as $unit)
                                <option value=" {{$unit->id}}">{{$unit->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mb-3"></div>

            <div class="col-md-4" id="SuperBuiltUp" style="display:none">
                <div class="box-bdr">
                    <div class="d-flex">
                        <div>
                            <input type="text" class="form-control form-control-b0 col-md-3 border-none" onkeypress="return isNumber(event)" name="super_buildup_area" id="SuperBuildupArea" placeholder="Add Super Built up area">
                        </div>
                        <div class="ms-auto" style="">
                            <select class="form-select form-control-b0" name="super_buildup_area_unit">
                                @forelse($units as $unit)
                                <option value=" {{$unit->id}}">{{$unit->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="col-md-2">
                <a style="color: var(--vz-link-color);" id="ShowBuiltUp"> + Add Built up area</a>
            </div>

            <div class="col-md-3">
                <a style="color: var(--vz-link-color);" id="ShowSuperBuiltUp"> + Add Super Built up area</a>
            </div>
        </div>

        <label class="form-label required">Property Facing</label>
        <div class="row align-items-center mb-3">
            <div class="col-md-12 mb-3">
                <div class="radio-toolbar-text">
                    @forelse($property_facings as $prop_face)
                    <input type="radio" id="PropFace-{{$prop_face->id}}" name="property_facing" value="{{$prop_face->id}}">
                    <label for="PropFace-{{$prop_face->id}}">{{$prop_face->name}}</label>
                    @empty
                    @endforelse
                </div>
                <span id="errproperty_facing"></span>
            </div>
        </div>


        <div class="row align-items-center mb-3" id="MinNoOfSeats" style="display: none;">
            <label class="form-label required">Min no of seats<span style="color:red">*</span></label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="min_no_of_seats" id="" placeholder="Min no of seats">
            </div>
        </div>

        <div class="row align-items-center mb-3" id="MaxNoOfSeats">
            <label class="form-label required">Max no of seats <span style="color:red">*</span></label>

            <div class="col-md-4">
                <input type="text" class="form-control" name="max_no_of_seats" id="" placeholder="Max no of seats">
            </div>
        </div>

        <div class="row align-items-center mb-3" id="NoOfCabins">
            <label class="form-label required">No of Cabins<span style="color:red">*</span></label>

            <div class="col-md-4">
                <input type="text" class="form-control" name="no_of_cabins" id="" placeholder="No of Cabins">
            </div>
        </div>

        <div class="row align-items-center mb-3" id="MeetingRooms">
            <label class="form-label required">No of Meeting Rooms<span style="color:red">*</span></label>

            <div class="col-md-4">
                <input type="text" class="form-control" name="no_of_meeting_rooms" id="" placeholder="No of Meeting Rooms">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row align-items-center mb-3" id="Pantry">
            <label class="form-label required">Pantry <span style="color:red">*</span></label>

            <div class="col-md-12 mb-3">

                <div class="radio-toolbar-text">
                    @forelse($pantries as $pantry)
                    <input type="radio" id="pantry-{{$pantry->id}}" name="pantry" value="{{$pantry->id}}">
                    <label for="pantry-{{$pantry->id}}">{{$pantry->name}}</label>
                    @empty
                    @endforelse
                </div>
                <span id="errpantry"></span>
            </div>
        </div>



        <div class="row align-items-center mb-3" id="ConferenceRoom">
            <label class="form-label required">Conference Room<span style="color:red">*</span></label>

            <div class="col-md-12 mb-3">
                <div class="radio-toolbar-text">
                    @forelse($conf_rooms as $conf_room)
                    <input type="radio" id="conf_room-{{$conf_room->id}}" name="conference_room" value="{{$conf_room->id}}">
                    <label for="conf_room-{{$conf_room->id}}">{{$conf_room->name}}</label>
                    @empty
                    @endforelse
                </div>
                <span id="errconference_room"></span>
            </div>
        </div>


        <div class="row align-items-center mb-3" id="ReceptionArea">
            <label class=" form-label required">Reception Area</label>

            <div class="col-md-12 mb-3">
                <div class="col-md-12 mb-3">
                    <div class="radio-toolbar-text">
                        @forelse($receptions as $recep)
                        <input type="radio" id="reception-{{$recep->id}}" name="reception_area" value="{{$recep->id}}">
                        <label for="reception-{{$recep->id}}">{{$recep->name}}</label>
                        @empty
                        @endforelse
                    </div>
                    <span id="errreception_area"></span>
                </div>
            </div>
        </div>
        <div id="Facilitis">
            <label class="form-label " style="font-size: 15px;">Facilities Available </label> <br>
            <label class="form-label required">Furnishing</label>
            <div class="row align-items-center mb-3">
                <div class="col-md-12 mb-3">
                    <div class="col-md-12 mb-3">
                        <div class="radio-toolbar-text">
                            @forelse($furnishing as $furnish)
                            <input type="radio" id="furnishing-{{$furnish->id}}" name="furnishing" value="{{$furnish->id}}">
                            <label for="furnishing-{{$furnish->id}}">{{$furnish->name}}</label>
                            @empty
                            @endforelse
                        </div>
                        <span id="errfurnishing"></span>
                    </div>
                </div>
            </div>

            <label class="form-label required">Central Air Conditioning</label>
            <div class="row align-items-center mb-3">
                <div class="col-md-12 mb-3">
                    <div class="col-md-12 mb-3">
                        <div class="radio-toolbar-text">
                            @forelse($central_air_conditions as $central_air_cond)
                            <input type="radio" id="central_air_cond-{{$central_air_cond->id}}" name="central_air_conditions" value="{{$central_air_cond->id}}">
                            <label for="central_air_cond-{{$central_air_cond->id}}">{{$central_air_cond->name}}</label>
                            @empty
                            @endforelse
                        </div>
                        <span id="errcentral_air_conditions"></span>
                    </div>
                </div>
            </div>

            <label class="form-label required">Oxygen Dust</label>
            <div class="row align-items-center mb-3">
                <div class="col-md-12 mb-3">
                    <div class="col-md-12 mb-3">
                        <div class="radio-toolbar-text">
                            @forelse($oxygen_dust as $oxgn_dst)
                            <input type="radio" id="oxgn_dst-{{$oxgn_dst->id}}" name="oxygen_dust" value="{{$oxgn_dst->id}}">
                            <label for="oxgn_dst-{{$oxgn_dst->id}}">{{$oxgn_dst->name}}</label>
                            @empty
                            @endforelse
                        </div>
                        <span id="erroxygen_dust"></span>
                    </div>
                </div>
            </div>

            <label class="form-label required">UPS</label>
            <div class="row align-items-center mb-3">
                <div class="col-md-12 mb-3">
                    <div class="col-md-12 mb-3">
                        <div class="radio-toolbar-text">
                            @forelse($UPS as $upss)
                            <input type="radio" id="upss-{{$upss->id}}" name="ups" value="{{$upss->id}}">
                            <label for="upss-{{$upss->id}}">{{$upss->name}}</label>
                            @empty
                            @endforelse
                        </div>
                        <span id="errups"></span>
                    </div>
                </div>
            </div>

            <label class="form-label required">Fire Safety Measures</label>
            <div class="row">
                @forelse($fire_safety_masures as $measure)
                <div class="col-md-2 simplecheck mb-3">
                    <span><input type="checkbox" value="{{$measure->id}}" name="fire_safety_masure[]"> {{$measure->name}} </span>
                </div>
                @empty
                @endforelse
                <span id="errfire_safety_masure"></span>

            </div>

            <label class="form-label">No of Staircases</label>
            <div class="row align-items-start  mb-3">
                <div class="col-md-12 mb-3">
                    <div class="radio-toolbar" id="AppendStaricase">
                        <input type="radio" id="radio20" name="staircase" value="1">
                        <label for="radio20">1</label>
                        <input type="radio" id="radio21" name="staircase" value="2">
                        <label for="radio21">2</label>
                        <input type="radio" id="radio22" name="staircase" value="3">
                        <label for="radio22">3</label>
                        <input type="radio" id="radio23" name="staircase" value="4">
                        <label for="radio23">4</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <a style="color: var(--vz-link-color);" id="AddStaircase"> + Add other</a>
                </div>

                <div class="col-md-2">
                    <input type="text" style="display:none" class="form-control col-md-3" id="ExtraStaircase">
                </div>
                <div class="col-md-2" id="ShowStaircaseDone" style="display:none">
                    <button type="button" class="btn btn-done btn-primary" id="AddExtraStaircase">Done</button>
                </div>
                <span id="errstaircase"></span>

            </div>

            <label class="form-label required">Lifts</label>
            <div class="row align-items-center mb-3">
                <div class="col-md-12 mb-3">
                    <div class="radio-toolbar-text">
                        @forelse($lifts as $lift)
                        <input type="radio" id="lift-{{$lift->id}}" name="lift" value="{{$lift->id}}">
                        <label for="lift-{{$lift->id}}">{{$lift->name}}</label>
                        @empty
                        @endforelse
                    </div>
                    <span id="errlift"></span>
                </div>
            </div>
        </div>


        <label class="form-label required">Availability Status</label>
        <div class="row align-items-center mb-3">
            <div class="col-md-12 mb-3">
                <div class="radio-toolbar-text">
                    @forelse($availability_status as $avlbl_sts)
                    <input type="radio" id="avlbl_sts-{{$avlbl_sts->id}}" name="availability_status" value="{{$avlbl_sts->id}}">
                    <label for="avlbl_sts-{{$avlbl_sts->id}}">{{$avlbl_sts->name}}</label>
                    @empty
                    @endforelse
                </div>
                <span id="erravailability_status"></span>
            </div>
        </div>


        <div class="row mb-3" id="AgeOfProperty" style="display:none">
            <label class="form-label m-0 required">Age of Property <span style="color:red">*</span></label>
            <div class=" col-md-12">
                <div class="radio-toolbar-text">
                    @forelse($age_of_property as $property_age)
                    <input type="radio" id="property_age-{{$property_age->id}}" name="property_age" value="{{$property_age->id}}">
                    <label for="property_age-{{$property_age->id}}">{{$property_age->name}}</label>
                    @empty
                    @endforelse
                </div>
                <span id="errproperty_age"></span>
            </div>
        </div>

        <div class="row mb-3" id="PossesionBy" style="display:none">
            <label class="form-label m-0 required">Possesion by<span style="color:red">*</span></label>
            <div class="col-md-3  align-items-center mt-1">
                <input type="date" class="form-control " name="possesion_by" id="">
            </div>
        </div>

        <label class="form-label required">Owner's Preference</label>
        <div class="row align-items-center mb-3">
            <div class="col-md-3">
                <input type="text" placeholder="Owner's Preference" name="owners_preference" class="form-control">
            </div>
        </div>

        <div class="card-footer">
            <div class="ms-auto text-end">
                <!-- <button class="btn btn-done btn-primary nextBtn">Next &nbsp;<i class="fa fa-arrow-right"></i></button> -->
                <button class="btn btn-done btn-primary">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>