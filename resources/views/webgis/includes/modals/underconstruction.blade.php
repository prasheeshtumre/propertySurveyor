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
                    <p class="add_txt">
                      {{ $property->street_details ?? 'N/A' }}
                    </p>
                    <p class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                            {{ $property->locality_name ?? 'N/A' }}</small></p>
                </div>
            </div>
        </div>
        <div class="pt-2">
            @if ($property->up_for_sale > 0)
                <div class="sale_txt"> For Sale ({{ $property->up_for_sale }})</div>
            @endif
            @if ($property->up_for_rent > 0)
                <div class="sale_txt"> For Rent ({{ $property->up_for_rent }})</div>
            @endif
           <div class="forsale">
               <a target="_blank" class="toplink" href="{{ route('surveyor.property.report_details', $property->id) }}">
                <div class="row border-top align-items-center pt-2">
                    <div class="col-md-5">
                        @if (count($property->images) >= 1)
                            {{-- @forelse($property->images as $image) --}}
                                <img src="{{ url('/') }}/public/uploads/property/images/{{ $property->images[0]->file_url }}" class="imgwidth">
                           
                            {{-- @empty
                                @endforelse --}}
                        @else
                                <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg" class="imgwidth">
                            
                        @endif
                    </div>
                    <div class="col-md-7 ps-0">
                        
                            <div class="unit_dd">{{ $property->project_name ?? 'N/A' }}</div>
                            <div class="unit_dd">{{ $property->getBuilderName->name ?? 'N/A' }}</div>
                            <div><small>{{ $property->locality_name ?? 'N/A' }}</small></div>
                       
                    </div>
                </div>
                 </a>
            </div>
        </div>
    </div>
</div>
