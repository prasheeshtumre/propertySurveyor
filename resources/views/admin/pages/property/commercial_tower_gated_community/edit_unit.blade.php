@php
    $u_key = 0;
@endphp
@forelse($units as $key=>$unit)

    @if ($floor_id == $unit->floor_id)
        <div
            class="row gx-2 mt-1 py-2 bg-light name_of_unit_child nouc-{{ $floor_Key }} uno{{ $u_key }}-fno{{ $floor_Key }} storey-unit rounded border border-secondary">
            <input type="hidden" class="" name="unit_id{{ $floor_Key }}[]" id=""
                data-uid="{{ $unit->id ?? 0 }}" value="{{ $unit->id ?? 0 }}">
            @if ($unit->merge_parent_unit_id != null)
                <div class="unit-mask"></div>
                <div class="row">
                    <div class="merged-notch">
                        <div class="unit-notch">
                            @php
                                $p_floor = $floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1;
                                $floor_index_sup = ['1' => 'st', '2' => 'nd', '3' => 'rd'];
                            @endphp
                            Merged With Unit in {{ $floor_index[$parent_unit_id[$unit->merge_parent_unit_id]] + 1 }}
                            <sup>{{ $p_floor > 3 ? 'th' : $floor_index_sup[$p_floor] }}</sup> Floor
                        </div>
                    </div>
                </div>
            @endif
            @if (in_array($unit->id, $parent_units))
                <div class="row">
                    <div class="merged-notch">
                        <div class="unit-notch ">
                            Parent Unit
                        </div>
                    </div>
                </div>
            @endif
            <div class="row dds_row">
                <div class="col-auto">
                    <!--other units parent unit : oup-unit-->
                    <input
                        class="form-check-input unit-chk d-none unit-parent-{{ $u_key }}-floor{{ $floor_Key }} mx-2 border border-info {{ in_array($unit->id, $parent_units) ? 'oup-unit' : '' }}"
                        name="unit_check{{ $floor_Key }}[{{ $u_key }}]" value="{{ $u_key }}"
                        data-floor_parent="{{ $floor_Key }}" data-parent="{{ $u_key }}" type="checkbox"
                        value="{{ $u_key }}" id="flexCheckDefault">
                </div>

                <div class="col-md-auto">
                    <label for="inputPassword6" class="form-label">Name of Unit {{ $u_key + 1 }}<span
                            class="errorcl">*</span></label>
                    <input type="text" value="{{ $unit->unit_name }}" name="nth_unit_name{{ $floor_Key }}[]"
                        data-pid="{{ $u_key }}" class="form-control form-control-sm unit-name" id="nth_unit_name{{$floor_Key}}{{$u_key}}"
                        fdprocessedid="gmudk6">
                </div>


            </div>

            {{-- <div class="row">
        <div class="col-md-3 mt-2">
            <div class=" unit-merge-group" role="group" aria-label="Basic outlined example">
                <label  class="btn btn-sm btn-outline-primary merge_other_unit_lable" for="unit-check-{{$u_key}}-f{{$floor_Key}}">
                  <!--<span class="mdi mdi-merge mdi-18px"></span>-->
                  Merge Units
                </label>
                <input type="checkbox" class="d-none merge_other_units" name="" data-uId="{{$unit->id ?? 0}}"  id="unit-check-{{$u_key}}-f{{$floor_Key}}" data-suid="1" data-pid="1" >
              <label class="btn btn-sm btn-outline-primary d-none save-unit-merge">Save</label>
            </div>
        </div>
    </div> --}}
            <span class="remove-storey-unit d-none" data-unit_id="{{ $unit->id }}">
                <span class="mdi mdi-minus-box-outline mdi-18px"></span>
            </span>
        </div>

        @php $u_key++; @endphp
    @endif
@empty
@endforelse
