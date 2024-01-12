  @php
      if ($property->cat_id == config('constants.RESIDENTIAL')) {
          $sub_type = $property->residential_type;
      } else {
          $sub_type = $property->plot_land_type;
      }
  @endphp

  <div class="card">
      <div class="card-body p-1">
          <div class="border-bottom pb-3">
              <a target="_blank" class="toplink" href="{{ route('surveyor.property.report_details', $property->id) }}">
                  <div class="row align-items-center">
                      <div class="col-md-5">
                          @if (count($property->images) > 0)
                              <img src="{{ asset('uploads/property/images/' . $property->images[0]->file_url) }}"
                                  class="imgwidth">
                          @else
                              <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg" class="imgwidth">
                          @endif
                      </div>
                      <div class="col-md-7 ps-0">
                          <p class="add_txt">{{ $property->project_name ?? 'N/A' }}</p>
                          <p class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                                  {{ $property->club_house_details ?? 'N/A' }}</small></p>
                          <p class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                                  {{ $property->locality_name }}</small></p>
                      </div>
                  </div>
              </a>
          </div>

          <div class="">
              @if ($propert_unit_sale_gated > 0)
                  <div class="sale_txt"> For Sale ({{ $propert_unit_sale_gated }})</div>
              @endif
              @if ($propert_unit_rent_gated > 0)
                  <div class="sale_txt"> For Rent ({{ $propert_unit_rent_gated }})</div>
              @endif
              <div class="forsale">
                  @forelse($property->secondary_unit_level_data as $units)
                      <a target="_blank" class="toplink"
                          href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->unit_id }}/{{ $sub_type }}">
                          <div class="row border-top align-items-center pt-2">
                              <div class="col-md-5">
                                  @if ($units)
                                      @if (count($units->unit_images) > 0)
                                          @php
                                              $extension = pathinfo($units->unit_images[0]->file_path . '/' . $units->unit_images[0]->file_name, PATHINFO_EXTENSION);
                                          @endphp
                                          <img @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true)) src="{{ url('/') }}/public{{ $units->unit_images[0]->file_path }}/{{ $units->unit_images[0]->file_name }}" @else src="{{ asset('assets/images/svg/image-na.svg') }}" @endif
                                              onerror="this.onerror=null; this.src='{{ url('/') }}/public/assets/images/svg/image-na.svg'"
                                              class="img-fluid ri-pimg">
                                      @else
                                          <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg"
                                              class="imgwidth">
                                      @endif
                                      {{-- @forelse($units->unit_images as $unit_images)
                                         <img src="{{ url('/') }}/public{{ $units->unit_images[0]->file_path }}/{{ $units->unit_images[0]->file_name }}" class="imgwidth">
                                   
                                 @empty
                                    
                                         <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg" class="imgwidth">
                                  
                                 @endforelse --}}
                                  @else
                                      <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg"
                                          class="imgwidth">
                                  @endif
                              </div>

                              <div class="col-md-7 ps-0">
                                  <div class="unit_dd">
                                      #{{ $units->plot_unit_name->tower_name ?? 'N/A' }}
                                  </div>
                                  <div class="rr_price">
                                      &#8377;{{ $units->expected_price ?? ($units->expected_rent ?? 'N/A') }}
                                  </div>
                                  <div><small>{{ $units->rooms ?? 'N/A' }} beds ·
                                          {{ $units->washrooms ?? 'N/A' }} baths </small></div>
                                  <div><small>{{ $units->carpet_area ?? ($units->buildup_area ?? ($units->super_buildup_area ?? 'N/A')) }}
                                          sq. ft.</small></div>

                              </div>
                          </div>
                      </a>
                  @empty
                  @endforelse
              </div>



          </div>

      </div>
  </div>
