<style>
    .btn-save {
       background: #ef5656 !important;
    color: white !important;
    font-size: 16px !important;
    }
</style>


@extends('admin.layouts.main')
@section('content')


    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Towers/Units</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                <div class="row">
                    <div class="col-xl-12 col-md-12">
<!--APARTMENT Category-->
                        <div class="card"  style="">
                            
                            <div class="card-body ">
                                   <div class="row">
                                    <div class="col-xxl-3 col-md-3 d-flex align-items-end">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req- ctfd-required" id="gis_id" placeholder="EX:7255158845" value="" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="ms-3">
                                            <button class="btn btn-success" type="button" id="btn-search-gis-id">Search</button>
                                        </div>
                                    </div>
                                </div>
                           </div> 
                            </div> 
                            <form action="{{route('create-towers')}}" method="post" name="create_blocks" id="create_blocks">
                            @csrf
                                <div id="defined_block"></div>
                                <div id="defined_block_tower"></div>
                            </form>
                             
                           
                                </div> 
                                  </div> 
                                    </div> 
                                      </div> 

 @push('scripts')
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    	
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
    
       <script>
         $(document).on('click', '#btn-search-gis-id', function(e) {
                let gis_id = $("#gis_id").val();
                if(gis_id == ''){
                     toastr.error('Please enter GIS ID');
                     return false
                }else{
                    $.ajax({
                        type: "GET",
                        url: "{{ url('get_secondary_defined_block') }}",
                        data: {gis_id:gis_id},
                        success: function(response) {
                            if(response.status === false){
                                toastr.error(response.message);
                                $('#defined_block').empty();
                                $('#add_towers').addClass('d-none');
                            }else{
                                $('#defined_block').html(response);
                                $('#add_towers').removeClass('d-none');
                                $.ajax({
                                    type: "GET",
                                    url: "{{ url('get-block-towers') }}",
                                    data: {gis_id:gis_id},
                                    success: function(response) {
                                        if(response.status === false){
                                            toastr.error(response.message);
                                            $('#defined_block_tower').empty();
                                            $('#add_towers').addClass('d-none');
                                        }else{
                                            $('#defined_block_tower').html(response);
                                            $('#add_towers').removeClass('d-none');
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
                
            });
     </script>
     <script>
           // generate blocks using add block button
        // $(document).on('click', ".add-tower", function(){
        function addTower(id,residential_type){
            let currentStoreyCount = $('.storey'+id).length;
            let count = ($('.no_of_towers'+id).val() == '') ? 0 : parseInt($('.no_of_towers'+id).val());
            if(count < 1){
                toastr.error('Please enter valid count');
                return false;
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
            // let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalBlocks = '';
            $('.loader-container').removeClass('d-none');
            
            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getBlocks(start index, finalCount)
            totalBlocks = getTowers(currentStoreyCount, finalCount,id,residential_type);
            (currentStoreyCount > 0 ) 
            ? (
                $(totalBlocks).insertAfter($(".storey"+id+":last"))
                ) 
            : $(totalBlocks).insertAfter( ".append-blocks"+id);
            $(".remove-storey"+id).each(function(){
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
            })
            $(".remove-storey"+id).last().removeClass('d-none');
            // $('.block_unit_type_dd').select2();
            $('.no_of_towers'+id).val($('.storey'+id).length);
        // });
        }
        
        function getTowers(startIndex, count,id,residential_type){
            var temp_blocks =null;
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get-towers') }}",
                data:{count : count, start_index : startIndex,id:id,residential_type:residential_type},
                success: function(response) {
                    temp_blocks = response;
                    $('.loader-container').addClass('d-none');
                }
            });
            return temp_blocks;
        }
        
    // delete block
        $(document).on('click', ".remove-tower", function(){
            let id = $(this).attr('id');
            $(this).parent().parent().remove();
            $(".remove-storey"+id).last().removeClass('d-none');
            let currentStoreyLength = $('.storey'+id).length;
            $('.no_of_towers'+id).val(currentStoreyLength);
        });
        
     </script>
     <script>
          function saveBlocks(){
            $.ajax({
                url: "{{route('create-towers')}}", 
                type: 'POST',
                dataType: 'json',
                data: $('#create_blocks').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.loader-container').addClass('d-none');
                    toastr.success(response.data.message);
                    setTimeout(function(){
                        location.reload();
                    },3000);
                    // $('#create_property').attr('action', response.data.action_url);
                    // $('#property_id').val(response.data.id);
                    // $('.storey').remove();
                    // let floors = getPropertyFloors(response.data.id)
                    // $(floors).insertAfter(".append-floors")
                    // $('.select2-dd').select2();
                    // $('.remove-merge-ele').removeClass('d-none');
                    
                    // $(".remove-storey").last().removeClass('d-none');
                    // let currentStoreyLength = $('.storey').length;
                    // $('.no_of_floors').val(currentStoreyLength);
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').empty();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            const key_name = key.split('.');
                            console.log('.err_'+key_name[0]+key_name[1]);
                            $('.err_'+key_name[0]+key_name[1]).text('This field is required.');
                            // $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
                        });
                    } 
                    // else 
                    }
                // }
            });
        }
     </script>
        @endpush


@endsection