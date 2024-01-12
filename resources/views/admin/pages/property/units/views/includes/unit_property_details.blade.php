  @php use App\Models\SecondaryUnitLevelData; @endphp
  <!-- Office View -->
  @if (
      $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.OFFICE') &&
          ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
              $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1Noofopenside.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Type of the office</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->office_type) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>


          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1AreaDetails.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->office_type == '83')
              <div class=" ">
                  <div class=" viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1Minnoofseats.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Min no of seats</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->min_no_of_seats }}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class=" ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1Maxnoofseats.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Max no of seats</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->max_no_of_seats }}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class=" ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1NoofCabins.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>No of Cabins</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->no_of_cabins }}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class=" ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1NoofMeetingRooms.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>No of Meeting Rooms</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->no_of_meeting_rooms }}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1Pantry.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Pantry</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->pantry) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>


              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1ConerenceRoom.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Conference Room</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->conference_room) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1ReceptionArea.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Reception Area</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->reception_area) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1ReceptionArea.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Central Air Condition</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->central_air_conditions) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Furnishing Options </strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing) ?? 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
                  <div class="mt-1 ">
                      <div class="bg-white clearfix p-3">
                          <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                          </p>
                          <div class="furlist">
                              <div class="">
                                  <div class="MainFurnisshed furnished-semi-furnished-list">
                                      @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                          <div class="semiFurnied furnished-semi-furnished-item">
                                              <div class="me-1">
                                                  <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                      class="">

                                              </div>
                                              <div class="mt-1">
                                                  <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                      ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                      : 'N/A' }}</small>
                                                  <!-- <br> -->
                                                  <span
                                                      class="fs-furnished-item-count">{{ $rec->value ? ':' . $rec->value : '' }}</span>
                                              </div>

                                          </div>
                                      @empty
                                      @endforelse
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @endif



              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1OxygenDust.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Oxygen Dust</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->oxygen_dust) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1UPS.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>UPS</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->ups) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1FireSafetyMeasures.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Fire Safety Measures</strong></p>
                          </div>
                          <div class="extra-content">

                              @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'8') as $rec)
                                  <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) }}</p>
                              @empty
                                  <p>N/A</p>
                              @endforelse
                          </div>
                      </div>
                  </div>
              </div>
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>No of Staircases</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->staircase ? $secondary_level_unit_data->staircase : '0' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_1Lift.svg') }}" class="img-fluid"
                              style="    width: 25px;">
                      </div>
                      <div>
                          <div>
                              <p><strong>Lifts</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->lifts) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->age_of_property != '')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->possesion_by != '')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possesion by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Owner's Preference</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->owners_preference }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Retail View -->
  @elseif(
      $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.RETAIL') &&
          ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
              $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Shop facade size</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Width :
                              {{ $secondary_level_unit_data->enterance_width ? $secondary_level_unit_data->enterance_width : 'N/A' }}
                              {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->enterance_width_unit) }}
                          </p>
                          <p>Height :
                              {{ $secondary_level_unit_data->ceiling_height ? $secondary_level_unit_data->ceiling_height : 'N/A' }}
                              {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->ceiling_height_unit) }}
                          </p>
                          <!-- <p>100 Mt</p> -->
                      </div>
                  </div>
              </div>
          </div>

          <div class=" ">
              <div class=" viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Wash Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->washrooms) }}
                          </p>
                          @if ($secondary_level_unit_data->washrooms == '84')
                              <p>Private : {{ $secondary_level_unit_data->priavate_washrooms }}</p>
                              <p>Shared : {{ $secondary_level_unit_data->shared_washrooms }}</p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Located Near</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->located_near) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->located_near) : 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class=" ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Parking Type</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->parking_type) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->age_of_property != '')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->possesion_by != '')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif

      </div>

      <!-- Storage View  -->
  @elseif(
      $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.STORAGE_INDUSTRY') &&
          ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
              $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->no_of_bathrooms }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->age_of_property != '')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->possesion_by != '')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif

      </div>

      <!-- Other COMMERCIAL View  -->
  @elseif(
      $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.OTHER_COMMERCIAL') &&
          ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
              $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @else
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>

      <!-- for recidential && 1RK -->
  @elseif(
      ($secondary_level_unit_data->property_cat_id == config('constants.RESIDENTIAL') ||
          $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')) &&
          $unit_data->apartment_id &&
          $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.ONE_RK_APARTMENT'))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bedrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->washrooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_4.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Balconies</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->balconies ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Furnishing Options</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
              <div class=" ">
                  <div class="bg-white clearfix p-3">
                      <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                      </p>
                      <div class="furlist">
                          <div class="">
                              <div class="MainFurnisshed furnished-semi-furnished-list">
                                  @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                      <div class="semiFurnied furnished-semi-furnished-item">
                                          <div class="me-1">
                                              <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                  class="">

                                          </div>
                                          <div class="mt-1">
                                              <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                  ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                  : 'N/A' }}</small>
                                              <!-- <br> -->
                                              <span
                                                  class="fs-furnished-item-count">{{ $rec->value ? ':' . $rec->value : '' }}</span>
                                          </div>

                                      </div>
                                  @empty
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>
      
      <div>
        <div class=" ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Reserved Parking</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Covered Parking - {{ $secondary_level_unit_data->covered_parking ?? 'N/A' }}</p>
                        <p>Open Parking - {{ $secondary_level_unit_data->open_parking ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{ url('public/assets/images/Layer_8.svg') }}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Other Rooms</strong></p>

                    </div>
                    <div class="extra-content">

                        @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                            <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A' }}
                            </p>

                        @empty
                            <p>-</p>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{ url('public/assets/images/Layer_9.svg') }}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Availability Status</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @if ($secondary_level_unit_data->availability_status == '23')
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Age of Property</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($secondary_level_unit_data->availability_status != '23')
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Possession by</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{ $secondary_level_unit_data->possesion_by }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
      </div>


      <!-- for  Hospitality  -->
    @elseif(
      $secondary_level_unit_data->unit_cat_id == config('constants.FLOOR_UNIT_CATEGORY.HOSPITALITY_HOTEL') &&
          ($secondary_level_unit_data->property_cat_id == config('constants.COMMERCIAL') ||
              $secondary_level_unit_data->property_cat_id == config('constants.MULTI_UNIT')))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Washrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->washrooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Balconies</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->balconies }}</p>

                      </div>
                  </div>
              </div>
          </div>

          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Other Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ?? 'N/A' }}
                              </p>
                          @empty
                              <p>N/A</p>
                          @endforelse
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Furnishing Options</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
              <div class=" ">
                  <div class="bg-white clearfix p-3 br-5">
                      <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                      </p>
                      <div class="furlist">
                          <div class="">
                              <div class="d-flex align-items-center MainsemiFurn">
                                  @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                      <div class="semiFurnied">
                                          <div class="me-1">
                                              <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                  class="">

                                          </div>
                                          <div class="mt-1">
                                              <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                  ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                  : 'N/A' }}</small>
                                              <!-- <br> -->
                                              {{ $rec->value ? ':' . $rec->value : '' }}
                                          </div>
                                      </div>
                                  @empty
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class=" ">
              <div class=" viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status </strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) ?? 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->availability_status != '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possesion by</strong></p>
                          </div>
                          <div class="extra-content">
                              {{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>

      <!-- for  Plot/Land  -->
  @elseif(
      $property->cat_id == config('constants.PLOT_LAND') &&
          $property->plot_land_type == config('constants.OPEN_PLOT_LAND'))
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1AddAreaDetails.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->plot_area)
                              <p>Plot Area - {{ $secondary_level_unit_data->plot_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->plot_area_units) }}
                              </p>
                          @endif

                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/GroupPropertyDimensions.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Dimensions</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Length of plot - {{ $secondary_level_unit_data->plot_length ?? 'N/A' }} Ft</p>
                          <p>width of plot - {{ $secondary_level_unit_data->plot_breadth ?? 'N/A' }} Ft</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1FloorsAllowedforConstruction.svg') }}"
                          class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Floors Allowed for Construction</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Floors Allowed for Construction -
                              {{ $secondary_level_unit_data->floors_allowed ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1No ofopenside.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of open side</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->no_of_open_side ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- for Serviced Apartments  -->
  @elseif(
      ($property->cat_id == config('constants.RESIDENTIAL') &&
          $property->residential_type == config('constants.APARTMENT') &&
          $property->residential_sub_type == config('constants.STAND_ALONE_APARTMENT') &&
          $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.STAND_ALONE_APARTMENT')) ||
          $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.SERVICED_APARTMENT') ||
          $property->residential_sub_type == config('constants.GATED_COMMUNITY_APARTMENT') ||
          ($property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
              $property->residential_sub_type == config('constants.GATED_COMMUNITY_VILLA')) ||
          ($property->cat_id == config('constants.PLOT_LAND') &&
              $property->plot_land_type == config('constants.GATED_COMMUNITY_PLOT_LAND')))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bedrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->washrooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_4.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Balconies</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->balconies ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Other Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A' }}
                              </p>
                          @empty
                              <p>-</p>
                          @endforelse
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Furnishing Options</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
              <div class=" ">
                  <div class="bg-white clearfix p-3">
                      <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                      </p>
                      <div class="furlist">
                          <div class="">
                              <div class="MainFurnisshed furnished-semi-furnished-list">
                                  @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                      <div class="semiFurnied furnished-semi-furnished-item">
                                          <div class="me-1">
                                              <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                  class="">

                                          </div>
                                          <div class="mt-1">
                                              <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                  ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                  : 'N/A' }}</small>
                                              <!-- <br> -->
                                              <span
                                                  class="fs-furnished-item-count">{{ $rec->value ? ':' . $rec->value : '' }}</span>
                                          </div>

                                      </div>
                                  @empty
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class=" ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Reserved Parking</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Covered Parking - {{ $secondary_level_unit_data->covered_parking }}</p>
                          <p>Open Parking - {{ $secondary_level_unit_data->open_parking }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->availability_status != '23')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>
  @elseif(
      $property->cat_id == config('constants.RESIDENTIAL') &&
          $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
          $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bedrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->washrooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_4.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Balconies</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->balconies ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Other Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A' }}
                              </p>
                          @empty
                              <p>-</p>
                          @endforelse
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Furnishing Options</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
              <div class=" ">
                  <div class="bg-white clearfix p-3">
                      <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                      </p>
                      <div class="furlist">
                          <div class="">
                              <div class="MainFurnisshed furnished-semi-furnished-list">
                                  @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                      <div class="semiFurnied furnished-semi-furnished-item">
                                          <div class="me-1">
                                              <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                  class="">

                                          </div>
                                          <div class="mt-1">
                                              <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                  ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                  : 'N/A' }}</small>
                                              <!-- <br> -->
                                              <span
                                                  class="fs-furnished-item-count">{{ $rec->value ? ':' . $rec->value : '' }}</span>
                                          </div>

                                      </div>
                                  @empty
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class=" ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Reserved Parking</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Covered Parking - {{ $secondary_level_unit_data->covered_parking }}</p>
                          <p>Open Parking - {{ $secondary_level_unit_data->open_parking }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->availability_status != '23')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>

      <!-- for villa  -->
  @elseif($secondary_level_unit_data->property_cat_id == config('constants.DEMOLISHED'))
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->plot_area)
                              <p>Plot Area - {{ $secondary_level_unit_data->plot_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->plot_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->carpet_area != '')
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="">
              <div class="viewbedroomsText">
                  <div class="widthImage">
                      <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}"
                          class="img-fluid" style="width:50px;">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Discription</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->property_description }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1PreviousUse.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Previous Use </strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->previous_use }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1CurrentUse.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Current Use</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->current_use }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class=" ">
          <div class="viewbedrooms">
              <div>
                  <img src="{{ url('public/assets/images/Layer_PriceDetails.svg') }}" class="img-fluid">
              </div>
              <div>
                  <div>
                      <p><strong>Price</strong></p>
                  </div>
                  <div class="extra-content">
                      <p>{{ $secondary_level_unit_data->price }}
                      </p>
                  </div>
              </div>
          </div>
      </div>
  @elseif(
      $property->cat_id == config('constants.MULTI_UNIT') &&
          ($unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.STAND_ALONE_APARTMENT') ||
              $unit_data->apartment_id == config('constants.FLOOR_UNIT_CATEGORY.SERVICED_APARTMENT')))
      <div class="mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bedrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->washrooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_4.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Balconies</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->balconies ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Other Rooms</strong></p>
                      </div>
                      <div class="extra-content">
                          @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A' }}
                              </p>
                          @empty
                              <p>-</p>
                          @endforelse
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Furnishing Options</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->furnishing_option == '41' || $secondary_level_unit_data->furnishing_option == '42')
              <div class=" ">
                  <div class="bg-white clearfix p-3">
                      <p><b>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A' }}</b>
                      </p>
                      <div class="furlist">
                          <div class="">
                              <div class="MainFurnisshed furnished-semi-furnished-list">
                                  @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                      <div class="semiFurnied furnished-semi-furnished-item">
                                          <div class="me-1">
                                              <img src="{{ url('public/assets/' . SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon) }}"
                                                  class="">

                                          </div>
                                          <div class="mt-1">
                                              <small>{{ SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)
                                                  ? SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name
                                                  : 'N/A' }}</small>
                                              <!-- <br> -->
                                              <span
                                                  class="fs-furnished-item-count">{{ $rec->value ? ':' . $rec->value : '' }}</span>
                                          </div>

                                      </div>
                                  @empty
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          <div class=" ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Reserved Parking</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>Covered Parking - {{ $secondary_level_unit_data->covered_parking }}</p>
                          <p>Open Parking - {{ $secondary_level_unit_data->open_parking }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->availability_status != '23')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>
  @else
      {{-- <div class=" mainDiiv">
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_1.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bedrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->rooms ?? 'N/A' }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_2.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>No of Bathrooms</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->no_of_bathrooms ?? ($secondary_level_unit_data->washrooms ?? 'N/A') }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          @if ($secondary_level_unit_data->age_of_property != '')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
          @if ($secondary_level_unit_data->possesion_by != '')
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div> --}}
      <div class="mainDiiv">
          <div class="">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_5.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Add Area Details</strong></p>
                      </div>
                      <div class="extra-content">
                          @if ($secondary_level_unit_data->carpet_area)
                              <p>Carpet Area - {{ $secondary_level_unit_data->carpet_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->buildup_area)
                              <p>Built up Area - {{ $secondary_level_unit_data->buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit) }}
                              </p>
                          @endif
                          @if ($secondary_level_unit_data->super_buildup_area)
                              <p>Super Built up Area - {{ $secondary_level_unit_data->super_buildup_area }}
                                  {{ SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit) }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_3.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Property Facing</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_6.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Availability Status</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status) }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          @if ($secondary_level_unit_data->availability_status == '23')
              <div class="  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_10.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Age of Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @else
              <div class="">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Possession by</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->possesion_by)->format('d-m-Y') ?? '00:00:00' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          @endif
      </div>
  @endif
