<div class="row">

    @if(is_numeric(count($blocks)) && count($blocks) > 0)
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <label for="" class="form-label"> Select Block </label>
                <select class="form-select" name="project_status" id="project_status">
                    <option selected="">-Select Block-</option>
                    @forelse($blocks as $block)
                        <option value="{{$block->id}}">{{$block->block_name}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
        </div>
    @endif
    <input type="hidden" value="{{$property->id}}" name="property_id">
    <div class="col-xxl-3 col-md-3 mb-3">
        <div>
            <label for="" class="form-label"> Select Tower </label>
            <select class="form-select" name="project_status" id="project_status">
                <option selected="">-Select Tower-</option>
                @forelse($towers as $tower)
                    <option value="{{$tower->id}}">{{$tower->tower_name}}</option>
                @empty

                @endforelse
            </select>
        </div>
    </div>

    <div class="col-xxl-3 col-md-3 append-floors">
        <div>
            <label for="" class="form-label">No of Floors <span class="errorcl">*</span></label>
            <div class="input-group mb-3">
            <input type="text" class="form-control no_of_floors ctfd-required" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-success add-floor" type="button" id="button-addon2">Add Floors</button>
            </div>
            </div>
        </div>
    </div>

</div>