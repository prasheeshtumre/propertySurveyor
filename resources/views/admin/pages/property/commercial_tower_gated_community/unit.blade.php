@for ($i = $start_index; $i < $count; $i++)
    @php
        $default_unit_name++;
    @endphp
    <div
        class="row gx-2 mt-1 py-2 bg-light name_of_unit_child nouc-{{ $floor_id }} uno{{ $i }}-fno{{ $floor_id }} storey-unit rounded border border-secondary">
        <div class="row dds_row">
            <div class="col-auto p-0 ">
                <input
                    class="form-check-input unit-chk d-none unit-parent-{{ $i }}-floor{{ $floor_id }} mx-2 border border-info"
                    name="unit_check{{ $floor_id }}[{{ $i }}]" data-floor_parent="{{ $floor_id }}"
                    data-parent="{{ $i }}" type="checkbox" value="{{ $i }}" id="flexCheckDefault">
            </div>

            <div class="col-md-3 col-lg-3">
                <label for="inputPassword6" class="form-label">Name of Unit {{ $i + 1 }}<span
                        class="errorcl">*</span></label>
                <input type="text" name="nth_unit_name{{ $floor_id }}[]" data-pid="{{ $i }}"
                    class="form-control form-control-sm unit-name"
                    id="nth_unit_name{{ $floor_id }}{{ $i }}" value="{{ $default_unit_name }}">
            </div>
        </div>
        <span class="remove-storey-unit d-none">
            <span class="mdi mdi-minus-box-outline mdi-18px"></span>
        </span>
    </div>
@endfor
