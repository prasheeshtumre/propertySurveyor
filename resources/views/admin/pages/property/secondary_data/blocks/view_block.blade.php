<div class="card-body ">
    <div class="row  append-blocks">
        <div class="col-xxl-3 col-md-3 mb-3 ">
            <div>
                <label for="" class="form-label">No of Blocks<span class="errorcl">*</span> </label>
                <div class="input-group ">
                    <input type="text" class="form-control no_of_blocks" value="{{ $blocks->count() ?? 0 }}"
                        name="no_of_blocks" placeholder="Enter No of Blocks" aria-label=""
                        aria-describedby="button-addon2" onkeypress="return isNumber(event)">
                    <div class="input-group-append">
                        <button class="btn btn-success add-block" type="button" id="button-addon2">Add Blocks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse($blocks as $key => $block)
        <div class="row storey-blocks">
            <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
                <div>
                    <label for="" class="form-label">Name of the Block {{ $key + 1 }}<span
                            class="errorcl">*</span></label>

                    <input type="text" name="block_name[]" class="form-control req- ctfd-required"
                        id="block_name{{ $key }}" placeholder="" value="{{ $block->block_name ?? '' }}"
                        fdprocessedid="qk69ij">
                    <input type="hidden" name="block_id[]" value="{{ $block->id ?? '' }}">
                </div>
                <div class="ms-3 remove-storey-blocks1 d-none">
                    <button class="btn btn-danger" type="button" id=""> <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            <span class="input-error flash-errors block_name{{ $key }}" style="color: red"> </span>
        </div>
    @empty
    @endforelse
    <div class="text-end">
        <button type="button" class="btn btn-md btn-primary" id="submitForm" onclick="saveBlocks()">Save</button>
        <button type="button" class="btn btn-md btn-primary  blocks-to-towers-btn">
            Proceed</button>
        <button type="button" class="btn btn-md btn-primary d-none" id="submitForm" onclick="saveBlocks()">Save & Proceed
        </button>
    </div>
</div>
