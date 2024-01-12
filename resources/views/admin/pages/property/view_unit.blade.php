@php
    $u_key = 0;
@endphp
@forelse($units as $key=>$unit)
    @if ($floor_id == $unit->floor_id)
        <div class="col-md-4 mb-3 ">
           
            <a 
                @if($property->temp_gis_id_status == 0 || $property->temp_gis_id_status == 2)
                
                @endif
                href="{{ url('surveyor/property/unit_details') }}/{{ $unit->id }}"
                class="active activeCard h-100 card unit-card Unit_MainDetails p-3 {{ in_array($unit->id, $unit_detail_ids) ? 'details-found' : 'details-not-found' }}
                {{$property->temp_gis_id_status == 0 || $property->temp_gis_id_status == 2 ? '' : 'gis-engineer-approvall'}}">
                <div class="">
                    <div class="">
                        @if ($unit->merge_parent_unit_id != null)
                            <div class="card-header"><strong>

                                    @php
                                        $p_floor = $floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1;
                                        $floor_index_sup = ['1' => 'st', '2' => 'nd', '3' => 'rd'];
                                    @endphp
                                    Merged With Unit({{ $unit->unit_name ?? '' }}) in
                                    {{ $floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1 }}
                                    <sup>{{ $p_floor > 3 ? 'th' : $floor_index_sup[$p_floor] }}</sup> Floor
                                </strong></div>
                        @endif
                        @if (in_array($unit->id, $parent_units))
                            <div class="card-header"><strong> Parent Unit </strong></div>
                        @endif

                        <div class="">
                            @if ($property->cat_id == 3)
                                <div class="Unit_Details"><span>Property Type </span>: <span>
                                        @forelse($prop_categories->take(2) as $prop_category)
                                            @if ($prop_category->id == $unit->unit_cat_type_id)
                                                {{ $prop_category->cat_name ?? '' }}
                                            @endif
                                        @empty
                                        @endforelse
                                    </span>
                                </div>
                            @endif
                            <div class="Unit_Details"><span>Unit name </span> :<span>{{ $unit->unit_name ?? '-' }}</span>
                            </div>
                            <div class="Unit_Details"><span>Unit Type </span> :<span>
                                    @forelse($unit_categories as $unit_category_type)
                                        @if ($unit_category_type->id == $unit->unit_type_id)
                                            {{ $unit_category_type->name }}
                                        @endif
                                    @empty
                                    @endforelse
                                </span> </div>
                            @if ($property->cat_id != 2 && $unit->unit_type_id == 2)
                                @if (
                                    ($property->cat_id == 3 && $unit->unit_cat_type_id == 1 && $unit->unit_type_id == 2) ||
                                        in_array($property->cat_id, [1, 4, 5, 6]))
                                    @if ($unit->unit_type_id != 1)
                                        <div class="Unit_Details"><span>Category </span>: <span>

                                                @forelse($unit_category_list as $unit_category)
                                                    @if ($unit->unit_cat_id == $unit_category->id)
                                                        {{ $unit_category->name }}
                                                    @endif
                                                @empty
                                                @endforelse
                                            </span> </div>
                                        <div class="Unit_Details"><span>Sub-Category </span>: <span>
                                                @if ($unit->unit_sub_cat_id != 0 && !empty($unit->unit_sub_cat_id))
                                                    @forelse($unit_sub_category_list as $unit_category)
                                                        @if ($unit->unit_sub_cat_id == $unit_category->id)
                                                            {{ $unit_category->name }}
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                @else
                                                    N/A
                                                @endif
                                            </span> </div>
                                        <div class="Unit_Details"><span>Brand </span> :<span>
                                                @forelse($brands as $unit_category)
                                                    @if ($unit_category->parent_id == $unit->unit_sub_cat_id)
                                                        @if ($unit->unit_brand_id == $unit_category->id)
                                                            {{ $unit_category->name }}
                                                        @endif
                                                    @endif
                                                @empty
                                                @endforelse
                                                @if ($unit->unit_brand_id == 0)
                                                    {{ $unit->brand_name != '0' ? $unit->brand_name : 'N/A' }}
                                                @elseif(empty($unit->unit_brand_id) && $unit->brand_name == '')
                                                    N/A
                                                @endif
                                            </span> </div>
                                    @endif
                                @endif
                            @endif
                            @if ($unit->unit_type_id == 1 || $unit->up_for_sale == 1 || $unit->up_for_rent == 1)
                                <div class="Unit_Details"><span>Concerned Person Name </span>:
                                    <span>{{ isset($unit->person_name) && !empty($unit->person_name) ? $unit->person_name : 'N/A' }}</span>
                                </div>
                                <div class="Unit_Details"><span>Mobile Number </span>
                                    :<span>{{ isset($unit->mobile) && !empty($unit->mobile) ? $unit->mobile : 'N/A' }}</span>
                                </div>
                            @endif
                        </div>
                        @if ($unit->up_for_sale == 1 || $unit->up_for_rent == 1 
                            || $unit->rented == 1 || $unit->sold == 1 
                            )
                                <div
                                    class="d-flex align-items-center justify-content-between mt-1 mb-1">
                                    @if ($unit->up_for_sale == 1)
                                        <img src="{{ url('public/assets/images/for-sale.png') }}"
                                            class="img-fluid" style="width: 46px;">
                                    @endif
                                    @if ($unit->up_for_rent == 1)
                                        <img src="{{ url('public/assets/images/for-rent.png') }}"
                                            class="img-fluid" style="width: 46px;">
                                    @endif
                                    @if ($unit->rented == 1)
                                        <img src="{{ url('public/assets/images/rented.png') }}"
                                            class="img-fluid" style="width: 46px;">
                                    @endif
                                    @if ($unit->sold == 1)
                                        <img src="{{ url('public/assets/images/sold.png') }}"
                                            class="img-fluid" style="width: 46px;">
                                    @endif
                                </div>
                            @endif
                    </div>
                </div>
            </a>
        </div>

        @php $u_key++; @endphp
    @endif
@empty
@endforelse

<!-- Unit_MainDetails -->
