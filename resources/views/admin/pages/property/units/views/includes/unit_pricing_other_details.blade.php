  @php use App\Models\SecondaryUnitLevelData; @endphp
  <div class="mainDiiv">
  </div>
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
          <button class="nav-link active pricing-nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false" tabindex="-1"><b>Pricing Details</b></button>
      </li>
      <li class="nav-item" role="presentation">
          <button class="nav-link pricing-nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true"><b>Price History</b></button>
      </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="pricing-other-details-list">
              <div class=" pricing-other-details-item ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_rent.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Property Type</strong></p>
                          </div>
                          <div class="extra-content">
                              @if ($secondary_level_unit_data->pricing_details_for != null)
                              <p>{{ $secondary_level_unit_data->pricing_details_for == '1' ? 'Sale' : ($secondary_level_unit_data->pricing_details_for == 2 ? 'Rent' : ($secondary_level_unit_data->pricing_details_for == 3 ? 'Rented' : 'Sold')) }}
                              </p>
                              @else
                              <p>N/A</p>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
              @if ($secondary_level_unit_data->pricing_details_for == '1')
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_Freehold.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Ownership Details</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOwnership($secondary_level_unit_data->ownership)->name ?? 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              @endif
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_PriceDetails.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>{{ $secondary_level_unit_data->pricing_details_for == config('constants.FOR_SALE') || $secondary_level_unit_data->pricing_details_for == config('constants.SOLD') ? 'Price Details' : 'Rent Details' }}</strong>
                              </p>
                              <p>
                                  @if ($secondary_level_unit_data->pricing_details_for != null)
                                  {{ $secondary_level_unit_data->pricing_details_for == config('constants.FOR_SALE') || $secondary_level_unit_data->pricing_details_for == config('constants.SOLD') ? $secondary_level_unit_data->expected_price : $secondary_level_unit_data->expected_rent }}
                                  @if (
                                  $secondary_level_unit_data->pricing_details_for == config('constants.FOR_SALE') ||
                                  $secondary_level_unit_data->pricing_details_for == config('constants.SOLD'))
                                  ({{ $secondary_level_unit_data->price_per_sq_ft }} Rs./Sq.Ft)
                                  @endif
                                  @else
                                  N/A
                                  @endif
                              </p>
                          </div>
                          <div class="extra-content">
                              @if ($secondary_level_unit_data->pricing_details_for == '1')
                              @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'22') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) }}</p>
                              @empty
                              @endforelse
                              @else
                              @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'17') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) }}</p>
                              @empty
                              @endforelse
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">

                      @if (
                      $secondary_level_unit_data->pricing_details_for == config('constants.FOR_SALE') ||
                      $secondary_level_unit_data->pricing_details_for == config('constants.FOR_RENT'))
                      <div>
                          <img src="{{ url('public/assets/images/Layer_AdditionaPricing.svg') }}" class="img-fluid img-mobile" style="">
                      </div>
                      <div>
                          <div>
                              <p><strong>{{ $secondary_level_unit_data->pricing_details_for == config('constants.FOR_SALE') ||
                                  $secondary_level_unit_data->pricing_details_for == config('constants.SOLD')
                                      ? 'Additional Pricing Details'
                                      : 'Additional Rent Details' }}
                                  </strong></p>
                          </div>
                          <div class="extra-content">
                              <p>Maintenance :
                                  {{ $secondary_level_unit_data->pricing_details_for == '1'
                                          ? ($secondary_level_unit_data->mainteinance ?? 'N/A')
                                          : ($secondary_level_unit_data->maintenance_rent ?? 'N/A') }}
                                  ({{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->maintenance_period) ?? 'N/A' }})
                              </p>
                              @if ($secondary_level_unit_data->pricing_details_for == '1')
                              <p>Expected Rental :
                                  {{ $secondary_level_unit_data->pricing_details_for == '1'
                                              ? ($secondary_level_unit_data->expected_rental ?? 'N/A')
                                              : ($secondary_level_unit_data->expected_rent ?? 'N/A') }}
                              </p>
                              @endif
                              <p>Booking Amount :
                                  {{ $secondary_level_unit_data->pricing_details_for == '1'
                                          ? ($secondary_level_unit_data->booking_amount  ?? 'N/A')
                                          : ($secondary_level_unit_data->booking_amount_rent  ?? 'N/A') }}
                              </p>
                              <p>Annual dues payble :
                                  {{ $secondary_level_unit_data->pricing_details_for == '1'
                                          ? ($secondary_level_unit_data->annual_due_pay  ?? 'N/A')
                                          : ($secondary_level_unit_data->annual_dues_rent  ?? 'N/A') }}
                              </p>
                              <p>Membership Charge :
                                  {{ $secondary_level_unit_data->pricing_details_for == '1'
                                          ? ($secondary_level_unit_data->membership_charge  ?? 'N/A')
                                          : ($secondary_level_unit_data->membership_charge_rent  ?? 'N/A') }}
                              </p>
                          </div>
                      </div>
                      @endif
                      @if (
                      $secondary_level_unit_data->pricing_details_for == config('constants.RENTED') ||
                      $secondary_level_unit_data->pricing_details_for == config('constants.SOLD'))
                      <div>
                          <img src="{{ url('public/assets/images/Layer_11.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <p><strong>{{ $secondary_level_unit_data->pricing_details_for == config('constants.RENTED') ? 'Rented Date' : 'Sold Date' }}
                              </strong></p>
                          <p>{{ Carbon\Carbon::parse($secondary_level_unit_data->rented_date)->format('d-m-Y') ?? '00:00:00' }}
                          </p>
                      </div>
                      @endif
                  </div>
              </div>
              @if ($secondary_level_unit_data->pricing_details_for == '2')
              <div class="pricing-other-details-item   ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_PreferredAgreement.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Preferred Agreement Type</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) : 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Duration of the Agreement</strong></p>
                          </div>
                          <div class="extra-content">
                              <p>{{ $secondary_level_unit_data->agreement_duration ? $secondary_level_unit_data->agreement_duration : 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Months of Notice</strong></p>
                          </div>
                          <div class="extra-content">
                              <!-- <p>None</p> -->
                              <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) : 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              @endif
              @if (
              $secondary_level_unit_data->pricing_details_for == '1' ||
              $secondary_level_unit_data->pricing_details_for == '2' ||
              $secondary_level_unit_data->pricing_details_for == '3' ||
              $secondary_level_unit_data->pricing_details_for == '4' ||
              ($secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1') ||
              ($property->cat_id == '2' && $property->residential_type == '7' && $property->residential_sub_type == '9'))
              <div class="pricing-other-details-item  ">
                  <div class="viewbedrooms">
                      <div>
                          <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                      </div>
                      <div>
                          <div>
                              <p><strong>Remarks On Property</strong></p>
                          </div>
                          <div class="extra-content">
                              <!-- <p>None</p> -->
                              <p>{{ $secondary_level_unit_data->remark ? $secondary_level_unit_data->remark : 'N/A' }}
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              @endif
          </div>
      </div>
      <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="card card-body">
              <table class="unit-price-logs-table" style="">
                  <thead>
                      <tr style="background-color: #e2d7eb;">
                          <th>Date</th>
                          @if ($secondary_level_unit_data->sale_status != 0)
                          <th>Type</th>
                          @endif
                          <th>Event</th>
                          <th>Price</th>
                          @if ($secondary_level_unit_data->pricing_details_for == 1 || $secondary_level_unit_data->pricing_details_for == 4)
                          <th>Price/Sqft</th>
                          @endif
                      </tr>
                  </thead>
                  <tbody>
                      @forelse($unit_price_logs as $unit_price_log)
                      <tr>
                          <td>{{ Carbon\Carbon::parse($unit_price_log->date)->format('d-m-Y') }}</td>
                          @if ($secondary_level_unit_data->sale_status != 0)
                          <td>{{ config('constants.SALE_STATUS.' . $unit_price_log->sale_status) }}</td>
                          @endif
                          <td>{{ config('constants.UNIT_PRICE_LOG_STATUS.' . (int) $unit_price_log->pricing_details_for ?? 0) }}
                          </td>
                          <td>{{ $unit_price_log->price }}</td>
                          @if ($secondary_level_unit_data->pricing_details_for == 1 || $secondary_level_unit_data->pricing_details_for == 4)
                          <td>
                              {{ $unit_price_log->sqft }}
                              {{-- {{ round(abs(empty($unit_price_log->sqft) || $unit_price_log->sqft == 0 ? 1 : $unit_price_log->sqft), 2) }} --}}
                          </td>
                          @endif
                      </tr>
                      @empty
                      @endforelse
                  </tbody>
              </table>
          </div>
      </div>
  </div>