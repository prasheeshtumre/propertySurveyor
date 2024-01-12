
<form method="post" name="" id="price-trends-frm" >
    @csrf
    <div class="row border-bottom pt-3 pb-3">
        <div class="col-xxl-3 col-md-3 mt-3">
            <div>
                <label for="" class="form-label ">Select Tower</label>
                <select class="form-select filter_dropdown" id="" name="tower">
                <option selected="" disabled="">-Select Tower-</option>
                    @forelse($towers as $tower)
                        <option value="{{$tower->id}}" data-project_status="">{{$tower->tower_name}}</option>
                    @empty 

                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div>
                <label for="" class="form-label ">Status of the Project</label>
                <input type="text" class="form-control"  value="" disabled>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div>
                <label for="" class="form-label ">Date</label>
                <input type="date" name="date" class="form-control" value="" >
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div>
                <label for="" class="form-label ">Price in Sq.fts</label>
                <input type="text" name="price" class="form-control" value="" onkeypress="return isNumber(event)">
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-end mt-3">
                <input type="submit" class="btn btn-md btn-primary" value="Save">
            </div>
        </div>
    </div>
</form>

<div class="table-responsive d-none" id="pagination_data">
                                @include('admin.pages.property.property_pagination', [
                                    'properties' => $properties,
                                ])
                            </div>