 <div class="basic-details-item-list">
        <div class="basic-details-single-list">
            <div class="basic-details-single-item-icon">
                <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-es-20px">
            </div>
            <div>
                <p><strong>GIS No</strong> </p>
                <p><span>{{ $property->gis_id }}</span></p> 
            </div>
        </div>
        <div class="basic-details-single-list">
            <div class="basic-details-single-item-icon">
                <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-es-20px">
            </div>
            <div>
                <p><strong>Locality Name</strong> </p>
                <p><span>{{ $property->locality_name }}</span> </p>
            </div>
        </div>
        <div class="basic-details-single-list">
            <div class="basic-details-single-item-icon">
                <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-es-20px">
            </div>
            <div>
                <p><strong>Address</strong> </p>
                <p><span>{{ $property->street_details }}</span> </p>
            </div>
        </div>
 </div>

 
