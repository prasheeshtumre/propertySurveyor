@extends('admin.layouts.main')
@section('content')
<?php

use App\Models\SecondaryUnitLevelData; ?>
<!-- <link href="{{url('public/assets/css/unit-details.css?v=fghn')}}" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('assets/css/view-units.css') }}" rel="stylesheet" type="text/css" />
<style>
    p {

        margin-bottom: 0px;

    }

    .count-list,
    .check-list {
        margin: 0;
        padding: 0;
        width: 100%
    }

    .count-list li {
        list-style: none;
        float: left;
        padding: 14px;
        border: 1px solid #ddd;
        border-radius: 100px;
        margin: 5px;
        height: 36px;
        width: 36px;
        text-align: center;
        line-height: 10px;
        transition: 0.3s
    }

    .count-list li:hover {
        background: #f7ecff;
        border: solid 1px #000;
        transition: 0.3s;
        cursor: pointer;
    }

    .count-list li.active {
        background: #f7ecff;
        border: solid 1px #662e93;
        transition: 0.3s;
        color: #662e93
    }



    .check-list li {
        list-style: none;
        float: left;
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 100px;
        margin: 5px;
        text-align: center;
        line-height: 10px;
        transition: 0.3s
    }

    .check-list li:hover {
        background: #f7ecff;
        border: solid 1px #000;
        transition: 0.3s;
        cursor: pointer;
    }

    .check-list li.active {
        background: #f7ecff;
        border: solid 1px #662e93;
        transition: 0.3s;
        color: #662e93
    }


    .btn-primary {
        background: #662e93 !important;
        border: solid 1px #662e93;
    }



    .form-label {
        position: relative;
    }

    .required::after {
        content: '*';
        color: red;
        position: absolute;
        right: -10px;
    }

    .box-bdr {
        border: solid 1px #ddd;
        padding: 0px;
        border-radius: 6px;
    }

    .form-control-b0 {
        border: none !important;
    }

    .form-control,

    .form-select {
        /*            min-height: 50px*/
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-menu span {
        line-height: 24px;
        display: flex
    }

    input[type=checkbox] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }

    .input-step.step-primary button {
        background: #f7ecff;
        border: solid 1px #662e93;
        color: #662e93
    }

    .simplecheck span {
        line-height: 24px;
        display: flex
    }

    .screen {
        display: none;
    }

    .visible {
        display: block;
    }


    /*.progress-bar {*/
    /*  transition: width 0.3s ease-in-out;*/
    /*}*/
    .progress-bar {
        background-color: #deedf6 !important;
        color: black !important;
    }

    .progress-bar1 {
        background-color: #299cdb !important;
        color: white !important;
    }

    .progress-bar.active {

        background-color: #299cdb !important;
        color: white !important;
    }

    .progress-info .progress-bar::after {
        border-left-color: #7ed1ff !important;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">1RK Studio Apartments</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="container p-0 mb-3">
            <div class="mainDiiv">
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>GIS No</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->gis_id}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Locality Name</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->locality_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Address</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->street_details}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="page-header"><span>Property Details</span></h4>
            <div class="mainDiiv">
                <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1.svg')}}" class="img-fluid">
                    </div>
                        <div>
                            <div>
                            <p><strong>No of Bedrooms</strong></p>
                            </div>
                            <div class="extra-content">
                            <p>{{$secondary_level_unit_data->rooms ?? '-'}}</p>
                        </div>
                    </div>
                </div>
                    </div>
                <div class="">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                <p><strong>No of Bathrooms</strong></p>
                                </div>
                                <div class="extra-content">
                                <p>{{$secondary_level_unit_data->washrooms ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Property Facing</strong></p>
                            </div>
                            <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? '-'}}</p>
                        </div>
                    </div>
                </div>
                </div>
                    <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_4.svg')}}" class="img-fluid">
                    </div>
                        <div>
                            <div>
                            <p><strong>No of Balconies</strong></p>
                            </div>
                            <div class="extra-content">
                            <p>{{$secondary_level_unit_data->balconies ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Add Area Details</strong></p>
                        </div>
                            <div class="extra-content">
                        @if($secondary_level_unit_data->carpet_area)    <p>Carpet Area - {{$secondary_level_unit_data->carpet_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}</p> @endif
                        @if($secondary_level_unit_data->buildup_area)    <p>Built up Area - {{$secondary_level_unit_data->buildup_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}</p>@endif
                        @if($secondary_level_unit_data->super_buildup_area)   <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}</p>@endif
                        </div>
                    </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                        </div>
                                <div>
                                <div>
                                    <p><strong>Furnishing</strong></p>
                                </div>
                                <div class="extra-content">
                                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? '-'}}</p>
                                </div>
                                </div>
                    </div>
                </div>
                    <div class=" ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid">
                    </div>
                    <div >
                        <div>
                            <p><strong>Reserved Parking</strong></p>
                        </div>
                        <div class="extra-content">
                                <p>Covered Parking - {{$secondary_level_unit_data->covered_parking ?? '-'}}</p> 
                            <p>Open Parking -  {{$secondary_level_unit_data->open_parking ?? '-'}}</p>
                        </div>
                    </div>
                    </div>
                </div>
                    <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_8.svg')}}" class="img-fluid">
                    </div>
                        <div>
                            <div>
                                <p><strong>Other Rooms</strong></p>
                                
                            </div>
                                <div class="extra-content">

                                @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)

                                <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>

                                @empty
                                <p>-</p>
                                @endforelse

                                    
                                </div>
                        </div>
                    </div>
                </div>
                
                    <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_9.svg')}}" class="img-fluid">
                    </div>
                        <div>
                            <div>
                            <p><strong>Availability Status</strong></p>
                            </div>
                            <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                    </div>
                        <div>
                            <div>
                            <p><strong>Age of Property</strong></p>
                            </div>
                            <div class="extra-content">
                            <p>{{$secondary_level_unit_data->age_of_property ?? '-'}}</p>
                        </div>
                    </div>
                        </div>
                    </div>
                <div class="">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                <p><strong>Possession by</strong></p>
                                </div>
                                <div class="extra-content">
                                <p>{{$secondary_level_unit_data->possesion_by ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                    </div>
                
            </div>

            <hr class="pb-3">
            <h4 class="page-header"><span> Pricing & Other Details</span></h4>
            <div class="mainDiiv">
                    <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            @if($secondary_level_unit_data->pricing_details_for == 2)   <img src="{{url('public/assets/images/Layer_rent.svg')}}" class="img-fluid"> 
                            @else
                            <img src="{{url('public/assets/images/Layer_sale.svg')}}" class="img-fluid">
                            @endif
                           
                        </div>
                            <div>
                                <div>
                                <p><strong>Property Type</strong></p>
                                </div>
                                <div class="extra-content">
                                <p>@if($secondary_level_unit_data->pricing_details_for == 1) Sale @elseif($secondary_level_unit_data->pricing_details_for == 2) Rent @endif</p>
                            </div>
                        </div>
                    </div>
                        </div>
                    <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_Freehold.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                <p><strong>Ownership Details</strong></p>
                                </div>
                                <div class="extra-content">
                                <p>{{$secondary_level_unit_data->getOwnership->name ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                        </div>
                    @if($secondary_level_unit_data->pricing_details_for == 1)    
                    <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_PriceDetails.svg')}}" class="img-fluid">
                        </div>
                       
                        <div>
                            <div>
                                <p><strong>Price Details</strong></p>
                                <p>{{$secondary_level_unit_data->expected_price ?? '-'}} ({{$secondary_level_unit_data->price_per_sq_ft ?? '-'}} per Sft)</p>
                                </div>
                                <div class="extra-content">
                                  @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'22') as $rec)

                                    <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                                  @empty
                                  <p>-</p>
                                  @endforelse
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    @endif
                    @if($secondary_level_unit_data->pricing_details_for == 1)
                        <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_AdditionaPricing.svg')}}" class="img-fluid">
                        </div>
                            
                                <div>
                                    <div>
                                    <p><strong>Additional Pricing Details</strong></p>
                                        <p>{{$secondary_level_unit_data->mainteinance ?? '-'}}  ({{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->maintenance_period)}})</p>
                                    </div>
                                    <div class="extra-content">
                                        <p>Expected Rental - {{$secondary_level_unit_data->expected_rental ?? '-'}}</p>
                                        <p>Booking Amount - {{$secondary_level_unit_data->booking_amount ?? '-'}}</p>
                                        <p>Annual dues payble - {{$secondary_level_unit_data->annual_due_pay  ?? '-'}}</p>
                                        <p>Membership Charge - {{$secondary_level_unit_data->membership_charge  ?? '-'}}</p>
                                    </div> 
                                </div>
                             
                        </div>
                       
                    </div>
                    @endif   
                    @if($secondary_level_unit_data->pricing_details_for == 2)
                        <div class="   ">
                            <div class="viewbedrooms">
                                <div>
                                    <img src="{{url('public/assets/images/Layer_AdditionalRentDetails2.svg')}}" class="img-fluid">
                                </div>
                                    
                                        <div>
                                        <div>
                                            <p><strong>Rent Details</strong></p>
                                            <p>{{$secondary_level_unit_data->expected_rent ?? '-'}}</p>
                                        </div>
                                        <div class="extra-content">
                                            @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'17') as $rec)

                                                <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                                            @empty
                                            <p>-</p>
                                            @endforelse
                                        </div>
                                        </div>
                                    
                            </div>
                        </div>
                       
                        <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_PreferredAgreement.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Preferred Agreement Type</strong></p>
                            </div>
                                <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type)}}</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_AdditionalRentDetails2.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                <p><strong>Additional Rent Details</strong></p>
                                </div>
                                <div class="extra-content">
                                    <p>Maintenance  - {{$secondary_level_unit_data->maintenance_rent ?? '-'}}</p>
                                    <p>Booking Amount  - {{$secondary_level_unit_data->booking_amount_rent ?? '-'}}</p>
                                    <p>Annual dues payble  - {{$secondary_level_unit_data->annual_dues_rent ?? '-'}}</p>
                                    <p>Membership Charge  - {{$secondary_level_unit_data->membership_charge_rent ?? '-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="   ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_SecurityDeposit.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                    <p><strong>Security Deposit</strong></p>
                                    
                                </div>
                                    <div class="extra-content">
                                        @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'18') as $rec)

                                           <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                                        @empty
                                        <p>-</p>
                                        @endforelse
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="  ">
                        <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid">
                        </div>
                            <div>
                                <div>
                                <p><strong>Duration of the Agreement</strong></p>
                                </div>
                                <div class="extra-content">
                                <p>{{$secondary_level_unit_data->agreement_duration ?? '-'}}</p>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif  
                    
            </div>


            <hr class="pb-3">
            <h4 class="page-header"><span> Add Images</span></h4>

            <div class="mainDiiv">
                @forelse($secondary_level_unit_data->getImages($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id) as $rec)
                    <div class="img-container">
                        <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
                            <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>

        <a href="{{url('surveyor/property/unit_details/resedential/one-rk/edit')}}/{{$secondary_level_unit_data->unit_id}}">Edit</a>
    </div>

    <!-- End Page-content -->

    {{-- <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © ProperT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end  d-sm-block">
                        Design & Develop by <a href="https://vmaxindia.com/">VMAX</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}

</div>
@endsection
@push('scripts')


@endpush