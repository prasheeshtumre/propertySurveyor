<style>
    .btn-save {
       background: #ef5656 !important;
    color: white !important;
    font-size: 16px !important;
    }
    span.remove-storey, span.remove-storey-unit {
    position: absolute;
    top: 2.5%;
    left: 96.5%;
    width: 20px;
    cursor: pointer;
}
span.remove-storey, span.remove-storey-unit {
    position: absolute;
    top: 2.5%;
    left: 96.5%;
    width: 20px;
    cursor: pointer;
}
.brder_round {
    position: relative;
}
.brder_round  {
        border: 1px solid #000;
    border-radius: 3px;
    margin: 10px 0px;
       padding: 0px 10px;
}
.brder_round .row {
       
    margin: 10px 0px;
    padding: 10px;
}
.brder_round .newbg-row {
    border: 1px solid #3577f1;
    border-radius: 3px;
    padding: 15px 0px;
    background:#f3f6f9;
}
</style>


@extends('admin.layouts.main')
@section('content')
<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Amenities Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic  Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                <!--APARTMENT Category-->
                        <div class="card"  style="">
                            <form action="{{route('serach_by_gis_post')}}" method="post">
                                @csrf
                            <div class="card-body ">
                                   <div class="row">
                                    <div class="col-xxl-3 col-md-3 d-flex align-items-end">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID<span class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id" placeholder="EX:7255158845"
                                            value="" onkeypress="return isNumber(event)">
                                            @error('gis_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                     
                                        <div class="ms-3">
                                            <input type="submit" value="Submit" class="btn btn-success add-floor">
                                            <!--<button class="btn btn-success add-floor" type="button" id="btn-search-gis-id">Search</button>-->
                                        </div>
                                    </div>
                                </div>
                           </div>
                           </form>
                            </div> 
                           <form action="{{route('add_amminities_post')}}" method="post" style="display:none;">
                               @csrf
                           <div class="card"  style="">
                            <div class="card-body">
                                  <div class="mb-3 mb-3">
                                    <h4 class="mb-3">Amenities Details <small></small></h4>
                                    <label class="form-label small-heading">Amenities</label>
                                    <div class="row align-items-center mb-2">
                                        @foreach($amenities_options as $amenities)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="amenities[]" value="{{$amenities->id}}"> {{$amenities->name}}
                                                <input type="hidden" name="amenities_id" value="{{$amenities->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>

                                    <label class="form-label small-heading">Property Features</label>
                                    <div class="row align-items-center mb-2">
                                        @foreach($property_features_options as $property_features)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="property_features[]" value="{{$property_features->id}}"> {{$property_features->name}}
                                                <input type="hidden" name="propery_features_id" value="{{$property_features->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>

                                    <label class="form-label small-heading">Society/Building features</label>
                                    <div class="row align-items-center mb-2">
                                       @foreach($society_building_features_options as $building_features_options)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="building_features[]" value="{{$building_features_options->id}}"> {{$building_features_options->name}}
                                                <input type="hidden" name="building_features_id" value="{{$property_features->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>

                                    <label class="form-label small-heading">Additional Features</label>
                                    <div class="row align-items-center mb-2">
                                        @foreach($additional_features_options as $additional)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="additional_features[]" value="{{$additional->id}}"> {{$additional->name}}
                                                <input type="hidden" name="additional_id" value="{{$additional->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    <label class="form-label small-heading">Overlooking</label>
                                    <div class="row align-items-center mb-2">
                                         @foreach($overlooking_options as $overlooking)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="overlooking_features[]" value="{{$overlooking->id}}"> {{$overlooking->name}}
                                                <input type="hidden" name="overlooking_id" value="{{$overlooking->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    <label class="form-label small-heading">Other Features</label>
                                    <div class="row align-items-center mb-2">
                                           @foreach($other_features_options as $other_features)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="other_features[]" value="{{$other_features->id}}"> {{$other_features->name}}
                                                <input type="hidden" name="other_features_id" value="{{$other_features->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    <label class="form-label small-heading">Power Back up</label>
                                    <div class="row align-items-center mb-2">
                                        @foreach($power_backup_options as $power_backup)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="power_backup[]" value="{{$power_backup->id}}"> {{$power_backup->name}}
                                                <input type="hidden" name="power_backup_id" value="{{$power_backup->secondary_features_id}}">
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>

                                    <label class="form-label">Width of Facing road</label>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4">
                                            <div class="box-bdr">
                                                <div class="row d-flex">
                                                    <div class="col-md-7 mb-3">
                                                        <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="width_of_road" id="" placeholder="Width of Facing road">
                                                    </div>
                                                    <div class="col-md-5 mb-3 ms-auto" style="border-left: solid 1px #ddd">
                                                        <select class="form-select form-control-b0" name="width_facing_road">
                                                            <option value="">Select</option>
                                                            <option value="Feet">Feet</option>
                                                            <option value="Meter">Meter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <label class="form-label">Location Advantages</label>
                                    <div class="row align-items-center mb-2">
                                    @foreach($location_advantages_options as $location_advantages)
                                        <div class="col-md-2 simplecheck mb-3">
                                            <span>
                                                <input type="checkbox" name="location_advantage[]" value="{{$location_advantages->id}}"> {{$location_advantages->name}}
                                                <input type="hidden" name="location_advantage_id" value="{{$location_advantages->secondary_features_id}}">
                                            </span>
                                        </div>
                                    @endforeach
                                    </div>
                                    
                                  <div class="text-end">
                                        <button class="btn btn-md btn-save">Save </button>
                                    </div>
                                </div>
                                 </form>
                           </div>
                           
                           
                             </div> 
                           
                                </div> 
                                  </div> 
                                    </div> 
                                      </div> 
                                    
 



@endsection
@push('scripts')
    @if(Session::has('success'))
        <script>
        $(function(){
            toastr.success("{{ Session::get('success') }}");
        });
        </script>
    @endif
        @if(Session::has('error'))
        <script>
        $(function(){
            toastr.error("{{ Session::get('error') }}");
        });
        </script>
    @endif
@endpush