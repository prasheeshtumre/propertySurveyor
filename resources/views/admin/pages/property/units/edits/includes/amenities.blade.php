  {{-- <form name="AmenitiesForm" method="POST">
      @csrf
      <input type="hidden" name="property_id" value="{{$property->id}}">
      <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
      <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
      <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
      <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
      <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
      <div class="screen ">
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
              <div class="card-body">
                  <div class="mt-4 mb-4">
                      <h4 class="mb-3">Amenities Details <small><i>(Optional)</i></small></h4>

                      <label class="form-label">Amenities</label>
                      <div class="row align-items-center mb-2">
                          @forelse($amenities as $amenity)
                          <div class="col-md-2 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="amenity[]" value="{{$amenity->id}}"> {{$amenity->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Society/Building features</label>
                      <div class="row align-items-center mb-2">
                          @forelse($Society_features as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="society_features[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Additional features</label>
                      <div class="row align-items-center mb-2">
                          @forelse($additional_features as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="additional_features[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Other features</label>
                      <div class="row align-items-center mb-2">
                          @forelse($other_features as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="other_features[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Water Source</label>
                      <div class="row align-items-center mb-2">
                          @forelse($water_source as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="water_source[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Overlooking</label>
                      <div class="row align-items-center mb-2">
                          @forelse($overlooking as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="overlooking[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>

                      <label class="form-label">Power Back up</label>
                      <div class="row align-items-center mb-2">
                          @forelse($power_backup as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="power_backup[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>


                      <label class="form-label">Type Of Flooring</label>
                      <div class="row align-items-center mb-2">
                          <div class="col-md-4 simplecheck mb-3">
                              <div class="form-group">
                                  <select class="form-select" name="floor_type">
                                      @forelse($flooring_type as $unit)
                                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                                      @empty
                                      @endforelse
                                  </select>
                              </div>
                          </div>
                      </div>

                      <label class="form-label">Width of Facing road</label>
                      <div class="col-md-4">
                          <div class="box-bdr">
                              <div class="d-flex">
                                  <div>
                                      <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="facing_road_width" placeholder="">
                                  </div>
                                  <div class="ms-auto" style="">
                                      <select class="form-select form-control-b0" name="facing_road_width_unit">
                                      @forelse($width_facing_road_units as $unit)
                                          <option value="{{$unit->id}}">{{$unit->name}}</option>
                                          @empty
                                          @endforelse
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>


                      <label class="form-label">Location Advantages</label>
                      <div class="row align-items-center mb-2">
                          @forelse($location_advantages as $loc_advantage)
                          <div class="col-md-3 simplecheck mb-3">
                              <span>
                                  <input type="checkbox" name="location_advantage[]" value="{{$loc_advantage->id}}"> {{$loc_advantage->name}}
                              </span>
                          </div>
                          @empty
                          @endforelse
                      </div>




                  </div>
              </div>

              <div class="card-footer">
                  <div class="ms-auto text-end">
                      <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                      <button type="submit" class="btn btn-done btn-primary">Submit </button>
                  </div>
              </div>
          </div>
      </div>
  </form> --}}
  <form name="AmenitiesForm" method="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{$property->id}}">
    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
    <div class="screen ">
        <div class="card1">
            <div class="row mt-3 mb-3">
                <div class="col-md-4">
                    <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                </div>
                <div class="col-md-4">
                    <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
                </div>
                <div class="col-md-4">
                    <p><b>Address : </b> <span class="project-head"> {{$property->street_details}}</span></p>
                </div>
            </div>
            <div class="card-body">
                <div class="mt-4 mb-4">
                    <h4 class="mb-3">Amenities Details <small><i>(Optional)</i></small></h4>

                    <label class="form-label">Amenities</label>
                    <div class="row align-items-center mb-2">
                        @forelse($amenities as $amenity)
                        <div class="col-md-2 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="amenity[]" value="{{$amenity->id}}" @if(in_array($amenity->id,$amenities_values)) checked @endif> {{$amenity->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Society/Building features</label>
                    <div class="row align-items-center mb-2">
                        @forelse($Society_features as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="society_features[]" value="{{$loc_advantage->id}}"  @if(in_array($loc_advantage->id,$Society_features_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Additional features</label>
                    <div class="row align-items-center mb-2">
                        @forelse($additional_features as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="additional_features[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$additional_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Other features</label>
                    <div class="row align-items-center mb-2">
                        @forelse($other_features as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="other_features[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$other_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Water Source</label>
                    <div class="row align-items-center mb-2">
                        @forelse($water_source as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="water_source[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$water_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Overlooking</label>
                    <div class="row align-items-center mb-2">
                        @forelse($overlooking as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="overlooking[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$overlooking_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <label class="form-label">Power Back up</label>
                    <div class="row align-items-center mb-2">
                        @forelse($power_backup as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="power_backup[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$powerbackup_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>


                    <label class="form-label">Type Of Flooring</label>
                    <div class="row align-items-center mb-2">
                        <div class="col-md-4 simplecheck mb-3">
                            <div class="form-group">
                                <select class="form-select" name="floor_type">
                                    <option value=""> --select--</option>
                                    @forelse($flooring_type as $unit)
                                    <option value="{{$unit->id}}" @if($secondary_level_unit_data->floor_type == $unit->id)  selected @endif>{{$unit->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <label class="form-label">Width of Facing road</label>
                    <div class="col-md-4">
                        <div class="box-bdr">
                            <div class="d-flex">
                                <div>
                                    <input type="text" class="form-control form-control-b0 col-md-3 border-none" oninput="validateNumericInput(event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" value="{{$secondary_level_unit_data->facing_road_width ?? ''}}" name="facing_road_width" placeholder="">
                                </div>
                                <div class="ms-auto" style="">
                                    <select class="form-select form-control-b0" name="facing_road_width_unit">
                                        @forelse($width_facing_road_units as $unit)
                                        <option value="{{$unit->id}}" @if($secondary_level_unit_data->facing_road_width_unit == $unit->id)  selected @endif>{{$unit->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <label class="form-label">Location Advantages</label>
                    <div class="row align-items-center mb-2">
                        @forelse($location_advantages as $loc_advantage)
                        <div class="col-md-3 simplecheck mb-3">
                            <span>
                                <input type="checkbox" name="location_advantage[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$location_advantages_values)) checked @endif> {{$loc_advantage->name}}
                            </span>
                        </div>
                        @empty
                        @endforelse
                    </div>




                </div>
            </div>

            <div class="card-footer">
                <div class="ms-auto text-end">
                    <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                    <button type="submit" class="btn btn-done btn-primary">Submit </button>
                </div>
            </div>
        </div>
    </div>
</form>