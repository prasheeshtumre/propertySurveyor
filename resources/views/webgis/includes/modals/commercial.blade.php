<div class="card ">
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
                    <p class="add_txt mb-0">{{ $property->street_details }} </p>
                    <p class="add_loc mb-0"><small><i class="fa-solid fa-location-dot"></i>
                            {{ $property->locality_name }}</small>
                    </p>
                </div>
            </div>
        </a>



        <div class="">
            @if ($propert_unit_sale->floor_units->count() > 0)
                <div class="sale_txt"> For Sale
                    ({{ $propert_unit_sale->floor_units->where('is_single', '0')->count() == 0 ? $propert_unit_sale->floor_units->count() : $propert_unit_sale->floor_units->where('is_single', '0')->count() }})
                </div>
            @endif
            @if ($propert_unit_rent->floor_units->count())
                <div class="sale_txt"> For Rent
                    ({{ $propert_unit_rent->floor_units->where('is_single', '0')->count() == 0 ? $propert_unit_rent->floor_units->count() : $propert_unit_rent->floor_units->where('is_single', '0')->count() }})
                </div>
            @endif

            <div class="forsale">

                @forelse($property->floor_units as $units)
                    <div class="row border-top align-items-center pt-2">
                        <div class=" col-md-5">
                            @if ($units->secondary_unit_data)
                                @if (count($units->secondary_unit_data->unit_images) > 0)
                                    <a target="_blank"
                                        href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->id }}">
                                        @php
                                            $extension = pathinfo($units->secondary_unit_data->unit_images[0]->file_path . '/' . $units->secondary_unit_data->unit_images[0]->file_name, PATHINFO_EXTENSION);
                                        @endphp
                                        <img @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true)) src="{{ url('/') }}/public{{ $units->secondary_unit_data->unit_images[0]->file_path }}/{{ $units->secondary_unit_data->unit_images[0]->file_name }}" @else src="{{ asset('assets/images/svg/image-na.svg') }}" @endif
                                            onerror="this.onerror=null; this.src='{{ url('/') }}/public/assets/images/svg/image-na.svg'"
                                            class="img-fluid ri-pimg">
                                    </a>
                                @else
                                    <a target="_blank"
                                        href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->id }}">
                                        <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg"
                                            class="imgwidth">
                                    </a>
                                @endif
                            @else
                                <a target="_blank"
                                    href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->id }}">
                                    <img src="{{ url('/') }}/public/assets/images/svg/image-na.svg"
                                        class="imgwidth">
                                </a>
                            @endif
                        </div>

                        <div class="col-md-7 ps-0">
                            <a target="_blank"
                                href="{{ url('/') }}/surveyor/property/unit_details/{{ $units->id }}">
                                <div class="unit_dd">
                                    {{ $units->unit_name == '' ? $units->property_floor_map->floor_name : $units->unit_name }}
                                </div>
                                <div class="rr_price">
                                    &#8377;{{ $units->secondary_unit_data->expected_price ?? ($units->secondary_unit_data->expected_rent ?? 'N/A') }}
                                </div>
                                <div><small>{{ $property->category->cat_name ?? 'N/A' }}</small></div>
                                <div><small>{{ $units->secondary_unit_data->carpet_area ?? ($units->secondary_unit_data->buildup_area ?? ($units->secondary_unit_data->super_buildup_area ?? 'N/A')) }}
                                        sq. ft.</small></div>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>

    </div>
