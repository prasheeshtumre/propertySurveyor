@forelse($floors as $floor_key=>$floor)
    <div
        class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{ $floor_key }} rounded border border-dark">
        <input type="hidden" class="" name="floor_id[]" id="floor_id" value="{{ $floor->id ?? 0 }}">
        @if ($floor->merge_parent_floor_id != null)
            <div class="floor-mask"></div>
            <div class="row">
                <div class="merged-notch">
                    <div class="notch">
                        Merged With Floor {{ $floor_index[$floor->merge_parent_floor_id] + 1 }}
                    </div>
                </div>
            </div>
        @endif
        @if (in_array($floor->id, $parent_floors))
            <div class="row">
                <div class="merged-notch">
                    <div class="notch bg-dark">
                        Parent Floor
                    </div>
                </div>
            </div>
        @endif
        <div class="row dds_row floor-dds_row">
            <div class="col-auto p-0 h-100 w-10 ">
                <input
                    class="form-check-input @if ($floor->merge_parent_floor_id != null) edit_floor-chk @else floor-chk @endif  d-none floor-parent-{{ $floor_key }} mx-2 border border-dark {{ in_array($floor->id, $parent_floors) ? 'oup-floor' : '' }}"
                    data-parent="{{ $floor_key }}" type="checkbox" name="floor[]" value="{{ $floor_key }}"
                    id="flexCheckDefault">
            </div>

            <div class="col-auto storey-nou-child">
                <div>
                    <label for="" class="form-label">No of Units per Floor {{ $floor_key + 1 }}<span
                            class="errorcl">*</span></label>
                    <div class="input-group">
                        <input type="text" {{ in_array($floor->id, $parent_floors) ? 'readonly' : '' }}
                            value="{{ $floor->units }}" class="form-control form-control-sm no_of_units"
                            data-pid="{{ $floor_key }}" name="nth_unit[]" placeholder="0" aria-label=""
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-success add-unit" type="button"
                                data-floor_id="{{ $floor->id }}" id="button-addon2">Add Units</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div>
                    <label for="" class="form-label"> Floor Name {{ $floor_key + 1 }} <span
                            class="errorcl">*</span></label>
                    <div class="input-group" id="floor_name{{ $floor_key }}">
                        <input type="text" class="form-control form-control-sm"
                            value="{{ $floor->floor_name ?? '' }}" name="floor_name[]">
                    </div>
                </div>
            </div>
            @if ($floor->units === 0 || $floor->units === 1)
                @forelse($units as $key=>$f_unit)
                    @if ($floor->id == $f_unit->floor_id)
                    @break
                @endif
            @empty
            @endforelse
        @endif
    </div>




    <div class="unit-container">
        @if ($floor->units > 1)
            @include('admin.pages.property.secondary_data.edit_unit', [
                'units' => $units,
                'floor_Key' => $floor_key,
                'floor_id' => $floor->id,
            ])
        @endif
    </div>
</div>
@empty
@endforelse
