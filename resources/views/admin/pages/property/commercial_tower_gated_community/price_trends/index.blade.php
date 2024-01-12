<form method="post" name="" id="price-trends-frm">
    @csrf
    <div class="row">
        <div class="col-xxl-3 col-md-3  mt-3"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type" type="radio" name="price_trends_type" checked
                    id="project-price-trends" data-project_status="{{ $property->projectStatus->name ?? '' }}"
                    value="1">
                <label class="form-check-label" for="project-price-trends"> Project </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3  mt-3"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type" type="radio" name="price_trends_type"
                    id="tower-price-trends" value='2'>
                <label class="form-check-label" for="tower-price-trends">
                   Tower
                </label>
            </div>
        </div>
    </div>
    <div class="row border-bottom pt-3 pb-3"> <input type="hidden" name="pt_project_status"
            value="{{ $property->project_status ?? '' }}">
        <div class="col-xxl-3 col-md-3 mt-3 price-trends-tower-cell" style="display: none;">
            <input type="hidden" name="pt_tower_status" id="pt_tower_status"
                value="{{ $property->project_status ?? '' }}">
            <div>
                <label for="" class="form-label ">
                    Select Tower
                    <span class="errorcl">*</span>
                </label>
                <select class="form-select filter_dropdown price-trends-tower" id="" name="tower">
                    <option selected="" value="">-Select-</option>
                    @forelse($towers as $tower)
                        <option value="{{ $tower->id }}" data-project_status="{{ $tower->towerStatus->name ?? '' }}"
                            data-project_status_id="{{ $tower->tower_status ?? '' }}">
                            {{ $tower->tower_name }}
                    </option> @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div>
                <label for="" class="form-label ">Status of the Tower<span class="errorcl">*</span></label>
                <input required type="text" id="price-trends-tower-status" class="form-control"
                    name="status_of_project" value="{{ $property->projectStatus->name ?? '' }}" readonly>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Date<span class="errorcl">*</span></label> <input
                    type="date" name="date" class="form-control" value=""> </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Price in Sq.fts<span class="errorcl">*</span></label> <input
                    type="text" name="price" class="form-control" value=""
                    onkeypress="return isNumber(event)"> </div>
        </div>
        <div class="col-md-12">
            <div class="text-end mt-3"> <input type="submit" class="btn btn-md btn-primary" value="Save"> </div>
        </div>
    </div>
</form>

<form method="post" name="" id="edit-price-trends-frm" class="d-none">
    @csrf
    <div class="row">
        <div class="col-xxl-3 col-md-3  mt-3" id="pt_project_radio"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type project-price-trends-edit" type="radio"
                    name="price_trends_type" id="project-price-trends">
                <label class="form-check-label" for="project-price-trends"> Project </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3  mt-3" id="pt_tower_radio"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type tower-price-trends-edit" type="radio"
                    name="price_trends_type" id="tower-price-trends">
                <label class="form-check-label" for="tower-price-trends">
                    Tower
                </label>
            </div>
        </div>
    </div>
    <div class="row border-bottom pt-3 pb-3">
        <input type="hidden" name="pt_project_status" id="pt_project_status" value="">
        <div class="col-xxl-3 col-md-3 mt-3 price-trends-tower-cell" style="display: none;">
            <input type="hidden" name="pt_tower_status" id="pt_tower_status-edit" value="">
            <div>
                <label for="" class="form-label ">
                   Select Tower
                </label>
                <select required class="form-select filter_dropdown price-trends-tower" id="tower_id"
                    name="tower">
                    <option selected="" disabled="">-Select-</option>
                    @forelse($towers as $tower)
                        <option value="{{ $tower->id }}"
                            data-project_status="{{ $tower->towerStatus->name ?? '' }}"
                            data-project_status_id="{{ $tower->tower_status ?? '' }}">
                            {{ $tower->tower_name }}
                    </option> @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Status of the Project</label> <input required
                    type="text" id="projectStatus" class="form-control" value="" disabled> </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Date</label>
                <input required id="ptdate" type="date" name="date" class="form-control" value="">
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Price in Sq.fts</label>
                <input required type="text" name="price" class="form-control" value="" id="ptprice"
                    onkeypress="return isNumber(event)">
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-end mt-3">
                <input type="submit" class="btn btn-md btn-primary" value="Update">
                <input type="hidden" class="" value="" id="ptid" name="ptid">
            </div>
        </div>
    </div>
</form>
<div class="table-responsive " id="pagination_data">
    @include('admin.pages.property.commercial_tower_gated_community.price_trends.price_trends_paginate', [
        'price_trends' => $price_trends,
    ])
</div>
