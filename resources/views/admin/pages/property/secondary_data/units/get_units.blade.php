@for ($i = $start_index; $i < $count; $i++)
    @php
        $default_unit_name++;
    @endphp
    <div class="row storey{{ $id }}">
        <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
            <div>
                <label for="" class="form-label">Name of the Unit {{ $i + 1 }} <span
                        class="errorcl">*</span></label>
                <input required type="text" name="tower_name{{ $id }}[]"
                    class="form-control req- ctfd-required" id="tower_name{{ $i }}"
                    placeholder="Name of the Unit {{ $i + 1 }}" value="{{ $default_unit_name }}">
                {{-- onkeypress="return isNumber(event)" --}}
            </div>
            <div class="ms-3 remove-storey{{ $id }} d-none remove-tower" id="{{ $id }}">
                <button class="btn btn-danger" type="button"> <i class="fa-solid fa-minus"></i> </button>
            </div>
        </div>
    </div>
@endfor
