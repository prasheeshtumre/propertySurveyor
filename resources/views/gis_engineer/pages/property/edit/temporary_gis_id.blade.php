@extends('admin.layouts.main')
@section('content')
@push('css')
    <link href="{{ asset('assets/css/property-primary-details.css') }}?v=34567" rel="stylesheet" type="text/css" />
@endpush
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Temporary GIS-ID Property Details</h4>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    

                <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('gis-engineer.property.update-details.temporary-gis-id', $property->id) }}" method="post"
                                >
                                @csrf
                                <div class="row">
                                    <label for=""><strong>Surveyor</strong> <span> : </span>{{$property->surveyor->name ?? 'N/A'}}</label>
                                </div>
                                <div class="row">
                                    <label for=""><strong>Current GIS-ID</strong> <span> : </span>{{$property->gis_id ?? 'N/A'}}</label>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">GIS ID </label>
                                            <input type="text" name="gis_id" class="form-control" id="" value="{{ old('gis_id') }}">
                                            @error('gis_id')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Pincode</label>
                                            <input type="text" name="pincode" class="form-control" id="" value="{{ old('pincode') }}">
                                            @error('pincode')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" @if(old('web_gis_status')) checked @endif type="checkbox" value="1" id="web-gis-status" name="web_gis_status">
                                            <label class="form-check-label" for="web-gis-status">
                                            updated in the WebGIS
                                            </label>
                                        </div>
                                        <p> 
                                            @error('web_gis_status')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$property->gis_id ?? ''}}" name="old_gis_id">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>      

                  
                </div>
            </div>
            <!-- end page title -->

            <!--end row-->

        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="gis_exists_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modamodal-md ">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="def-msg-pe">Property existed with this GIS id, Please Click here <a href="" id="edit_gis_id"></a> to add
                    Details</p>
                    <h5 id="ad-msg"><span ></span></h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="server-error-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger"></h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2 m-0">
                    <span id="server-error-msg">

                    </span>
                </div>
            </div>
        </div>
    </div>
   
       
   
    <script></script>
  
@endsection
@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <!-- <script src="{{ asset('assets/js/image-compression-helper.js') }}?v=23456"></script> -->
    <script src="{{ asset('assets/js/property/add-floors.js') }}?v=456789"></script>
    <script src="{{ asset('assets/js/property/add-images.js') }}?v=567654567876"></script>
    <script src="{{ asset('assets/js/property/split-merge.js') }}?v=7654"></script>
    <script src="{{ asset('assets/js/property/get-builder-sub-groups.js') }}?v=4"></script>
 
    <script src="{{ asset('assets/js/property/generate-temp-GISID.js') }}?v=5522"></script>
    @if(Session::has('success'))
        <script>
        $(function(){
            toastr.success("{{ Session::get('success') }}");
        });
        </script>
    @endif
@endpush
