<div class="card">
    <div class="card-body p-1">
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
                    <p class="add_txt">{{ $property->street_details ?? 'N/A' }}
                    </p>
                    <p class="add_loc">
                       <small><i class="fa-solid fa-location-dot"></i>
                            {{ $property->locality_name ?? 'N/A' }} 
                            </small>
                       </p>
                </div>
            </div>
 </a> 
        <div class="pt-2">
            @if ($propert_unit_sale_gated > 0)
                <div class="sale_txt"> For Sale ({{ $propert_unit_sale_gated }})</div>
            @endif
            @if ($propert_unit_rent_gated > 0)
                <div class="sale_txt"> For Rent ({{ $propert_unit_rent_gated }})</div>
            @endif

 <div class="forsale">
            @if (!empty($property->secondary_unit_data))
 <a target="_blank" class="toplink" href="{{ url('/') }}/surveyor/property/plot-land/unit_details/{{ $property->id }}">
                    <div class="row border-top align-items-center pt-2">
                        <div class=" col-md-5">
                            @if (!empty($property->secondary_unit_data))
                                @if (count($property->secondary_unit_data->unit_images) > 0)
                                    {{-- @forelse($property->secondary_unit_data->unit_images as $image) --}}
                                        <img src="{{ url('/') }}/public{{ $property->secondary_unit_data->unit_images[0]->file_path }}/{{ $property->secondary_unit_data->unit_images[0]->file_name }}" class="imgwidth">
                                    {{-- @empty
                                @endforelse --}}
                                @else
                                        <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg" class="imgwidth"> 
                                @endif
                            @endif
                        </div>
                        <div class="col-md-7 ps-0">
                                <div class="rr_price">
                                    &#8377;{{ $property->secondary_unit_data->expected_price ? $property->secondary_unit_data->expected_price : ($property->secondary_unit_data->expected_rent ? $property->secondary_unit_data->expected_rent : 'N/A') }}
                                </div>
                                <div><small>{{ $property->secondary_unit_data->plot_area ?? 'N/A' }} sq.
                                        ft.</small></div>
                                <div><small>{{ $property->locality_name ?? 'N/A' }}</small></div>
                           
                        </div>
                    </div >
                     </a>
            @endif

        </div>
    </div>
</div>
</div>
