@for($i= $start_index;$i<$count; $i++) <div class="row storey-blocks">
    <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
        <div>
            <label for="" class="form-label">Name of the Block {{$i+1}}<span class="errorcl">*</span></label>

            <input required type="text" name="block_name[]" class="form-control req- ctfd-required" id="block_name{{$i}}" placeholder="Name of the Block {{$i+1}}" value="">
        </div>
        <div class="ms-3 remove-storey-blocks d-none">
            <button class="btn btn-danger" type="button" id=""> <i class="fa-solid fa-minus"></i> </button>
        </div>
    </div>
    {{-- <span class="input-error flash-errors block_name{{$i}}" style="color: red"> </span> --}}
    </div>
    @endfor
