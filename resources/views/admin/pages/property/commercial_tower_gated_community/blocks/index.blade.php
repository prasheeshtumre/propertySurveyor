<div class="mt-3">
    <div class="accordion" id="accordionExample">

        {{-- <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    BlocksTowers
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{route('create-blocks')}}" method="post" name="create_blocks" id="create_blocks">
                        @csrf
                        <input type="hidden" name="property_id" class="form-control" readonly value="{{ $property->id }}">
                        <input type="hidden" name="gis_primary_id" class="form-control" id="gis_primary_id" readonly value="{{ $property->gis_id }}">
                        <input type="hidden" name="cat_id" class="form-control" id="cat_id" readonly value="{{ $property->cat_id }}">
                        <input type="hidden" name="residential_type" class="form-control" id="residential_type" readonly value="{{ $property->residential_type }}">
                        <input type="hidden" name="residential_sub_type" class="form-control" id="residential_sub_type" readonly value="{{ $property->residential_sub_type }}">
                        <div id="add_view_block"></div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Towers
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('commercial-tower.create-towers') }}" method="post" name="create_towers"
                        id="create_towers">
                        @csrf
                        @include('admin.pages.property.commercial_tower_gated_community.includes.property_basic_details')
                        <div id="add_view_tower"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="floors-tab">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Floors
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="floors-tab"
                data-bs-parent="#accordionExample">
                <div class="accordion-body  p-0  ">
                    <div class="card-body primary-block">

                        <div id="add_view_floor"></div>

                        <!-- <div class="text-end mt-4">
                                <input type="submit" class="btn btn-md btn-primary" value="Save &amp; Procced">
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
