@for ($i = $start_index; $i < $count; $i++)
    <div class="row storey{{ $id }}">
        <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
            <div>
                <label for="" class="form-label">Name of the Tower {{ $i + 1 }}<span
                        class="errorcl">*</span></label>
                <input required type="text" name="tower_name{{ $id }}[]"
                    class="form-control req- ctfd-required" id="tower_name{{ $id }}{{ $i }}"
                    placeholder="Name of the Tower {{ $i + 1 }}" value="">
                {{-- onkeypress="return isNumber(event)" --}}
            </div>
            <div class="ms-3 remove-storey{{ $id }} d-none remove-tower" id="{{ $id }}">
                <button class="btn btn-danger" type="button"> <i class="fa-solid fa-minus"></i> </button>
            </div>
        </div>
    </div>
@endfor
