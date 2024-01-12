@if (
    $secondary_level_unit_data->property_cat_id != '6' &&
        ($property->cat_id != '4' || $property->plot_land_type != '13'))
    @php
        $exclude_amenity_arr = [14, 13, 22, 17];
        $amenity_cnt = 0;
    @endphp

    @forelse($unit_data->unit_amenities->unique('amenity_id') as $amenity)
        @if (!in_array($amenity->amenity_id, $exclude_amenity_arr))
            <div class="list-single-main-item fl-wrap " style="@if ($loop->iteration >= 4) display:none; @endif">
                <div class="list-single-main-item-title">
                    <h3>{{ $amenity->amenity->name }}</h3>
                </div>
                <div class="list-single-main-item_content fl-wrap">
                    <div class="listing-features ">
                        <ul>
                            @forelse($unit_data->unit_amenities as $amenity_option)
                                @if ($amenity->amenity_id == $amenity_option->amenity_id)
                                    <li><a href="#">
                                            <img src="{{ url('public/assets/' . $amenity_option->unit_amenity_option->icon_path) }}"
                                                class="img-fluid">
                                            {{ $amenity_option->unit_amenity_option->name }}</a></li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                @php $amenity_cnt++; @endphp
            </div>
        @endif
    @empty
        <!-- <p class="text-center">Amenities Not Available.</p> -->
    @endforelse



    <div class="list-single-main-item fl-wrap ">
        @if (!empty($secondary_level_unit_data->floorType->name))
            @php $amenity_cnt++; @endphp
            <div class="list-single-main-item-title">
                <h3>Type Of Flooring</h3>
            </div>
            <div class="list-single-main-item_content fl-wrap">
                <div class="listing-features ">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="{{ url('public/assets/' . $secondary_level_unit_data->floorType->icon_path) }}"
                                    class="img-fluid">
                                {{ $secondary_level_unit_data->floorType->name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        @if (!empty($secondary_level_unit_data->facing_road_width))
            @php $amenity_cnt++; @endphp
            <div class="list-single-main-item-title">
                <h3>Width of Facing road</h3>
            </div>
            <div class="list-single-main-item_content fl-wrap">
                <div class="listing-features ">
                    <div class="listing-features ">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ url('public/assets/images/Layer_1300Meters.svg') }}" class="img-fluid">
                                    {{ $secondary_level_unit_data->facing_road_width }} Feet
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if ($amenity_cnt == 0)
        <p class="text-center">Amenities Not Available.</p>
    @endif

@endif

@if (isset($unit_data->unit_amenities) && $amenity_cnt > 4)
    <a href="#" id="loadMore">Load More </a>
    <a href="#" id="showLess" style="display: none;">Load Less</a>
@endif
