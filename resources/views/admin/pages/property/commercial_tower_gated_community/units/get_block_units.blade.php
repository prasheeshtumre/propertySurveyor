<div class="card d-nonse" id="add_towers" style="">
    <div class="card-body ">
        @if ($blocks->count() > 0)
            <div class="col-xxl-4 col-md-4 col-xs-5 mb-3 d-flex align-items-end">
                <div>
                    <label for="" class="form-label"> Number of Units </label>
                    <input type="text" class="form-control no_of_all_units" value="" name="no_of_all_units"
                        placeholder="Enter No of Units" aria-label="" aria-describedby="button-addon2"
                        onkeypress="return isNumber(event)">
                </div>
                <div class="" style="margin-left: -5px;">
                    <button class="btn btn-success add-units-to-all-blocks" type="button" id="button-addon2"> Add
                        Units</button>
                </div>
            </div>
        @endif
        @forelse($blocks as $key => $block)

            <div class="row append-blocks{{ $key }}">
                <div class="col-xxl-3 col-md-3 mb-3">
                    <div>
                        <label for="" class="form-label"> Block No.: {{ $key + 1 }} </label>
                        <input type="text" class="form-control blocks" value="{{ $block->block_name }}"
                            name="block_name{{ $key }}" placeholder="" readonly>
                        <input type="hidden" class="form-control blocks" value="{{ $block->id }}" name="block_id[]"
                            placeholder="" readonly>
                        <input type="hidden" class="form-control blocks" value="{{ count($blocks) }}"
                            name="total_blocks" placeholder="" readonly>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-4 col-xs-5 mb-3 d-flex align-items-end">
                    <div>
                        <label for="" class="form-label"> Number of Units </label>
                        <input type="text" class="form-control no_of_towers{{ $key }}"
                            value="{{ $block->towers->where('no_of_towers', '>', 0)->count() }}"
                            name="no_of_towers{{ $key }}" placeholder="Enter No of Units" aria-label=""
                            aria-describedby="button-addon2" onkeypress="return isNumber(event)">
                    </div>
                    <div class="" style="    margin-left: -5px;">
                        <button class="btn btn-success add-tower" type="button" id="button-addon2"
                            onclick="addTower('{{ $key }}','{{ $get_property->residential_type }}')"> Add
                            Units</button>
                    </div>
                </div>
                <span class="input-error flash-errors err_no_of_towers{{ $key }}" style="color: red"></span>

                @if ($block->towers->count() > 0)
                    @forelse($block->towers as $tower_key => $tower)
                        @if ($tower->no_of_towers > 0)
                            <div class="row storey{{ $key }}">
                                <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
                                    <div>
                                        <label for="" class="form-label">Name of the Unit
                                            {{ $tower_key + 1 }}<span class="errorcl">*</span></label>
                                        <input required="" type="text" name="tower_name{{ $key }}[]"
                                            class="form-control req- ctfd-required" id="tower_name{{ $key }}"
                                            placeholder="Name of the Unit 1" value="{{ $tower->tower_name }}"
                                            fdprocessedid="ot84pg">
                                        <input type="hidden" name="tower_id{{ $key }}[]"
                                            value="{{ $tower->id ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
        @empty
            <div class="row append-blocks0">
                <div class="col-xxl-4 col-md-3 mb-3 d-flex align-items-end">
                    <div>
                        <label for="" class="form-label"> Number of Units </label>
                        <input type="text" class="form-control no_of_towers0"
                            value="{{ $towers->where('no_of_towers', '>', 0)->count() }}" name="no_of_towers0"
                            placeholder="Enter No of Units" aria-label="" aria-describedby="button-addon2"
                            onkeypress="return isNumber(event)">
                    </div>
                    <div class="" style="margin-left: -5px;">
                        <button class="btn btn-success add-tower" type="button" id="button-addon2"
                            onclick="addTower('0','{{ $get_property->residential_type }}')"> Add
                            Units</button>
                    </div>
                </div>
            </div>
            @if ($towers->count() > 0)
                @forelse($towers as $tower_key => $tower)
                    @if ($tower->no_of_towers > 0)
                        <div class="row storey0">

                            <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
                                <div>
                                    <label for="" class="form-label">Name of the Unit
                                        {{ $tower_key + 1 }}<span class="errorcl">*</span></label>
                                    <!-- <input type="text"  class="form-control req- ctfd-required" id="" placeholder="Name of the Unit 1" value="{{ $tower->tower_name }}" fdprocessedid="ot84pg"> -->
                                    <input required="" type="text" name="tower_name0[]"
                                        class="form-control ctfd-required" id="tower_name{{ $tower_key }}"
                                        value="{{ $tower->tower_name }}" placeholder="Name of the Unit 1"
                                        value="">
                                    <input type="hidden" name="tower_id0[]" value="{{ $tower->id ?? '' }}">
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                @endforelse
            @endif
            <!--<span>No blocks found</span>-->
        @endforelse
        <div class="text-end">
            <button type="button" class="btn btn-md btn-primary save-towers" id="submitForm">Save</button>
            <button type="button" class="btn btn-md btn-primary  towers-to-floors-btn" data-block_type="units">
                Proceed</button>
            <button type="button" class="btn btn-md btn-primary save-towers d-none" id="submitForm"
                data-block_type="units">Save & Procced</button>
            <!--onclick="saveTowers()"-->
        </div>
    </div>
</div>
