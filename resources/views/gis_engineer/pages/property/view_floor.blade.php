<div class="">
    <div class="">
        <div class="">
            @forelse($floors as $floor_key=>$floor)
                <div class="accordion my-1" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{ $floor_key }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $floor_key }}" aria-expanded="<?php if ($floor_key == 0) {
                                    echo 'true';
                                } ?>"
                                aria-controls="collapseOne">
                                {{ $floor->floor_name ?? 'floor' . $floor_key + 1 }}
                            </button>
                        </h2>
                        <div id="collapseOne{{ $floor_key }}" class="accordion-collapse collapse show"
                            aria-labelledby="headingOne{{ $floor_key }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    @if ($floor->units > 0)
                                        @include('gis_engineer.pages.property.view_unit', [
                                            'units' => $units,
                                            'floor_Key' => $floor_key,
                                            'floor_id' => $floor->id,
                                        ])
                                    @endif
                                    @if ($floor->units == 0)

                                        @forelse($units as $key=>$f_unit)
                                            @if ($floor->id == $f_unit->floor_id)
                                                {{ $floor->unit_cat_type_id }}

                                                <div class="col-md-4">
                                                
                                                    <a  
                                                        

                                                        class="active activeCard {{$property->temp_gis_id_status == 0 || $property->temp_gis_id_status == 2 ? '' : 'gis-engineer-approval'}}" >

                                                        <div class="card">
                                                            <div class="card-body Unit_MainDetails  ">
                                                                @if ($floor->merge_parent_floor_id != null)
                                                                    <div class="card-header"><strong> Merged With Floor
                                                                            {{ $floor_index[$floor->merge_parent_floor_id] + 1 }}
                                                                        </strong></div>
                                                                @endif
                                                                @if (in_array($floor->id, $parent_floors))
                                                                    <div class="card-header"><strong> Parent Floor
                                                                        </strong></div>
                                                                @endif

                                                                <div class="">

                                                                    @if ($property->cat_id == 3)
                                                                        <div class="Unit_Details"><span>Property Type
                                                                            </span> :<span>
                                                                                @forelse($prop_categories->take(2) as $prop_category)
                                                                                    @if ($prop_category->id == $f_unit->unit_cat_type_id)
                                                                                        {{ $prop_category->cat_name }}
                                                                                    @endif
                                                                                @empty
                                                                                @endforelse
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    <div class="Unit_Details"><span>Unit name </span> :
                                                                        <span>{{ $floor->floor_name ?? 'floor' . $floor_key + 1 }}</span>
                                                                    </div>
                                                                    <div class="Unit_Details"><span>Unit Type </span>:
                                                                        <span>
                                                                            @forelse($unit_categories as $unit_category_type)
                                                                                @if ($unit_category_type->id == $f_unit->unit_type_id)
                                                                                    {{ $unit_category_type->name }}
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                        </span>
                                                                    </div>
                                                                    @if ($property->cat_id != 2 && $f_unit->unit_type_id == 2)
                                                                        @if (
                                                                            ($property->cat_id == 3 && $f_unit->unit_cat_type_id == 1 && $f_unit->unit_type_id == 2) ||
                                                                                in_array($property->cat_id, [1, 4, 5, 6]))
                                                                            <div class="Unit_Details"><span>Category
                                                                                </span>: <span>
                                                                                    @if ($f_unit->unit_cat_id != 0 && !empty($f_unit->unit_cat_id))
                                                                                        @forelse($unit_category_list as $unit_category)
                                                                                            @if ($f_unit->unit_cat_id == $unit_category->id)
                                                                                                {{ $unit_category->name }}
                                                                                            @endif
                                                                                        @empty
                                                                                        @endforelse
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="Unit_Details"><span>Sub-Category
                                                                                </span>: <span>
                                                                                    @if ($f_unit->unit_sub_cat_id != 0 && !empty($f_unit->unit_sub_cat_id))
                                                                                        @forelse($unit_sub_category_list as $unit_category)
                                                                                            @if ($f_unit->unit_sub_cat_id == $unit_category->id)
                                                                                                {{ $unit_category->name }}
                                                                                            @endif
                                                                                        @empty
                                                                                        @endforelse
                                                                                    @else
                                                                                        N/A
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="Unit_Details"><span>Brand
                                                                                </span> :<span>
                                                                                    @forelse($brands as $unit_category)
                                                                                        @if ($unit_category->parent_id == $f_unit->unit_sub_cat_id)
                                                                                            @if ($f_unit->unit_brand_id == $unit_category->id)
                                                                                                {{ $unit_category->name }}
                                                                                            @endif
                                                                                        @endif
                                                                                    @empty
                                                                                    @endforelse
                                                                                    @if ($f_unit->unit_brand_id == 0 && !empty($f_unit->brand_name))
                                                                                        {{ $f_unit->brand_name }}
                                                                                    @elseif((empty($f_unit->unit_brand_id) && empty($f_unit->brand_name)) || trim($f_unit->brand_name) == '')
                                                                                        N/A
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <div class="Unit_Details"><span>Concerned Person
                                                                            Name </span>:
                                                                        <span>{{ isset($f_unit->person_name) && !empty($f_unit->person_name) ? $f_unit->person_name : 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="Unit_Details"><span>Mobile Number
                                                                        </span>:
                                                                        <span>{{ isset($f_unit->mobile) && !empty($f_unit->mobile) ? $f_unit->mobile : 'N/A' }}</span>
                                                                    </div>
                                                                </div>
                                                                @if ($f_unit->up_for_sale == 1 || $f_unit->up_for_rent == 1)
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mt-1 mb-1">
                                                                        @if ($f_unit->up_for_sale == 1)
                                                                            <img src="{{ url('public/assets/images/for-sale.png') }}"
                                                                                class="img-fluid" style="width: 46px;">
                                                                        @endif
                                                                        @if ($f_unit->up_for_rent == 1)
                                                                            <img src="{{ url('public/assets/images/for-rent.png') }}"
                                                                                class="img-fluid" style="width: 46px;">
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @break
                                        @endif
                                    @empty
                                    @endforelse
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
</div>
