<div class="card">
    <div class="card-body  p-1">
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
                    <p class="add_txt img-right-text">{{ $property->street_details ?? 'N/A' }}
                    </p>
                    <p class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                            {{ $property->locality_name ?? 'N/A' }}</small></p>
                    </p>
                </div>
            </div>

            <div class="pt-2">
                @if ($property->up_for_sale > 0)
                    <div class="sale_txt"> For Sale ({{ $property->up_for_sale }})</div>
                @endif
                @if ($property->up_for_rent > 0)
                    <div class="sale_txt"> For Rent ({{ $property->up_for_rent }})</div>
                @endif

                <div class="forsale" style="">
                    <a target="_blank" class="toplink"
                        href="{{ url('/') }}/surveyor/property/demolished/unit_details/{{ $property->id }}">
                        <div class="row border-top align-items-center pt-2">
                            @if (!empty($property->secondary_unit_data))
                                <div class="col-md-5">
                                    @if (count($property->secondary_unit_data->unit_images) > 0)
                                        {{-- @forelse($property->secondary_unit_data->unit_images as $image) --}}
                                        <a target="_blank"
                                            href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->id }}">
                                            @php
                                                $extension = pathinfo($units->secondary_unit_data->unit_images[0]->file_path . '/' . $units->secondary_unit_data->unit_images[0]->file_name, PATHINFO_EXTENSION);
                                            @endphp
                                            <img @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true)) src="{{ url('/') }}/public{{ $units->secondary_unit_data->unit_images[0]->file_path }}/{{ $units->secondary_unit_data->unit_images[0]->file_name }}" @else src="{{ asset('assets/images/svg/image-na.svg') }}" @endif
                                                onerror="this.onerror=null; this.src='{{ url('/') }}/public/assets/images/svg/image-na.svg'"
                                                class="img-fluid ri-pimg">
                                        </a>
                                        {{-- @empty
                                @endforelse --}}
                                    @else
                                        <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg"
                                            class="imgwidth">
                                    @endif
                                </div>
                                <div class="col-md-7 ps-0">
                                    <div class="rr_price">
                                        &#8377;{{ $property->secondary_unit_data->price ? $property->secondary_unit_data->price : 'N/A' }}
                                    </div>
                                    <div><small>{{ $property->secondary_unit_data->plot_area ?? 'N/A' }} sq.
                                            ft.</small></div>
                                    <div><small>{{ $property->locality_name ?? 'N/A' }}</small></div>

                                </div>
                            @endif
                        </div>
                    </a>
                </div>

            </div>
    </div>
</div>
