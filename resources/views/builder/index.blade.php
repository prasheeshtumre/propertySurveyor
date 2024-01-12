@extends('admin.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Builders</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{url('surveyor/builder/store')}}" method="post" id="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card-body">

                        <div class="row">
				 
				            <div class="col-xl-12 col-md-12">
            					<div class="card">
            					 
            					<!--<div class="card-body">-->
            					<!--	<div class="row">-->
            					<!--	    <div class="row gx-2 mt-3 py-2 align-items-center">-->
                 <!--                           <div class="col-auto"><label for="inputPassword6" class="form-label">Builder Name</label></div>-->
                 <!--                           <div class="col-md-4 col-lg-4">-->
                 <!--                               <input type="text" id="" data-pid="2" name="name" data-parent-cat="commercial" class="form-control" aria-describedby="">-->
                 <!--                           </div>-->
                	<!--					    <div class="col-auto">-->
                	<!--					        <span id="" class="form-text">	-->
            					<!--	                @error('name')-->
                 <!--                                       <span class="input-error" style="color: red">{{ $message }}</span>-->
                 <!--                                   @enderror-->
                 <!--                               </span>-->
                 <!--                           </div>-->
                 <!--                           <div class="col-auto"><button type="submit" class="btn btn-primary   waves-light w_100"><i class="fa fa-check"></i> Submit</button></div>-->
            					<!--	    </div>-->
            					<!--	</div>-->
            					<!--</div>	-->
            					
            						 
            						
            						</div>	
            				
            					</div> 
						
    					</div>

                       

                    </div>

                </div>
            </form>
             <div class="row">
				 
				            <div class="col-xl-12 col-md-12">
            					<div class="card">
            					 
            					
            					<div class="card-body">
            				
            						<table class="table table-striped dt-responsive nowrap data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Builder Name </th>
                                                <th>Created on</th>
                                                <!--<th class="noExport">Action</th>-->
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            @forelse($builders as $builder)
                                                <tr>
                                                    <td>{{ $loop->iteration ?? '' }}</td>
                                                    <td>{{ $builder->name ?? '' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($builder->created_at)->format('Y-m-d') }}</td>
                                                     
                                                    <!--<td class="noExport">-->
                                                    <!--    <button class="btn btn-sm btn-primary" type="button" >Edit</button>-->
                                                    <!--</td>-->
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No Builders Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    
                                    </table>
                                    <div id="pagination">
                                       
                                    </div>
            					</div>	
            						 
            						
            						</div>	
            				
            					</div> 
						
    					</div>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
    <script>
        $(document).on('change', '#category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('surveyor/ajax/sub_categories') }}",
                success: function(response) {
                    
                    $('#sub_category').empty();
                    if(response.length == 0){
                        $("#sub_category").append('<option selected >--Select Type of property--</option>');
                    }
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    }
                    
                }
            });
        });
        $(function(){
             let table = new DataTable('.data-table');
            // var table = $('.data-table').DataTable({
            //     dom: 'Brt'
            // });
        })
        
        $(document).on('click', '.picklocation', function(e) {
            $.ajax({
                type: "GET",
                url: "{{ url('user_loc_details') }}",
                success: function(response) {
                    $('#city').val(response.cityName);
                    console.log(response.cityName)
                }
            });
        });

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                  
                var files = e.target.files,
                    filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            $(this).parent(".image-area").remove();
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

        function getCordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    $('#latitude').val(lat);
                    $('#longitude').val(lon);

                });
            } else {
                toastr.error("Geolocation is not supported by this browser.");
            }
        }

        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hidden.bs.modal', function() {
            // location.reload();
        });
        
        $(document).on('submit','#create_property', function(){

        })
        
    </script>
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
    </script>
   
    <script>
    
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"
        async defer></script>
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush