<div class="card d-nonse" id="add_towers" style="">
    <div class="card-body ">
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

                <div class="col-xxl-4 col-md-3 mb-3 d-flex align-items-end">
                    <div>
                        <label for="" class="form-label"> Number of Towers </label>
                        <input type="text" class="form-control no_of_towers{{ $key }}"
                            value="{{ $block->towers->where('no_of_towers', '>', 0)->count() }}"
                            name="no_of_towers{{ $key }}" placeholder="Enter No of Towers" aria-label=""
                            aria-describedby="button-addon2" onkeypress="return isNumber(event)">

                    </div>
                    <div class="" style="    margin-left: -5px;">
                        <button class="btn btn-success add-tower" type="button" id="button-addon2"
                            onclick="addTower('{{ $key }}','{{ $get_property->residential_type }}')"> Add
                            Towers</button>
                    </div>
                </div>
                <span class="input-error flash-errors err_no_of_towers{{ $key }}" style="color: red"></span>

            </div>
            @if ($block->towers->count() > 0)
                @php
                    $sno = 0;
                @endphp
                @forelse($block->towers as $tower_key => $tower)
                    @if ($tower->no_of_towers > 0)
                        <div class="row storey{{ $key }}">

                            <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
                                <div>
                                    <label for="" class="form-label">Name of the Tower
                                        {{ $sno + 1 }}<span class="errorcl">*</span></label>
                                    <!-- <input type="text"  class="form-control req- ctfd-required" id="" placeholder="Name of the Unit 1" value="{{ $tower->tower_name }}" fdprocessedid="ot84pg"> -->
                                    <input required="" type="text" name="tower_name{{ $key }}[]"
                                        class="form-control ctfd-required"
                                        id="tower_name{{ $key }}{{ $sno }}"
                                        value="{{ $tower->tower_name }}" placeholder="Name of the Tower 1"
                                        value="" fdprocessedid="65v7dp">
                                    <input type="hidden" name="tower_id{{ $key }}[]"
                                        value="{{ $tower->id ?? '' }}">
                                </div>
                            </div>
                        </div>
                        @php
                            $sno++;
                        @endphp
                    @endif
                @empty
                @endforelse
            @endif
        @empty
            <div class="row append-blocks0">
                <div class="col-xxl-4 col-md-3 mb-3 d-flex align-items-end">
                    <div>
                        <label for="" class="form-label"> Number of Towers </label>
                        <input type="text" class="form-control no_of_towers0"
                            value="{{ $towers->where('no_of_towers', '>', 0)->count() }}" name="no_of_towers0"
                            placeholder="Enter No of Towers" aria-label="" aria-describedby="button-addon2"
                            onkeypress="return isNumber(event)">
                    </div>
                    <div class="" style="margin-left: -5px;">
                        <button class="btn btn-success add-tower" type="button" id="button-addon2"
                            onclick="addTower('0','{{ $get_property->residential_type }}')"> Add
                            Towers</button>
                    </div>
                </div>
            </div>
            @if ($towers->count() > 0)
                @forelse($towers as $tower_key => $tower)
                    @if ($tower->no_of_towers > 0)
                        <div class="row storey0">

                            <div class="col-xxl-3 col-md-3 mb-3  d-flex align-items-end">
                                <div>
                                    <label for="" class="form-label">Name of the Tower
                                        {{ $tower_key + 1 }}<span class="errorcl">*</span></label>
                                    <!-- <input type="text"  class="form-control req- ctfd-required" id="" placeholder="Name of the Unit 1" value="{{ $tower->tower_name }}" fdprocessedid="ot84pg"> -->
                                    <input required="" type="text" name="tower_name0[]"
                                        class="form-control ctfd-required" id="tower_name{{ $tower_key }}"
                                        value="{{ $tower->tower_name }}" placeholder="Name of the Tower 1"
                                        value="" fdprocessedid="65v7dp">
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
            <button type="button" class="btn btn-md btn-primary  towers-to-floors-btn" data-block_type="towers">
                Proceed</button>
            <button type="button" class="btn btn-md btn-primary save-towers d-none" id="submitForm"
                data-block_type="towers">Save & Proceed </button>
            <!--onclick="saveTowers()"-->
        </div>
    </div>
</div>
