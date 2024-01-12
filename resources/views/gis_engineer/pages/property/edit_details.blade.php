@extends('admin.layouts.main')
@section('content')
@push('css')
    <link href="{{ asset('assets/css/property-primary-details.css') }}?v=23" rel="stylesheet" type="text/css" />
@endpush
<style>
   
</style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Basic Details</h4>
                    </div>
                </div>
            </div>
            <div id="signUpForm" class="card">
                <!-- start step indicators -->
                <!-- <div class="form-header d-flex mb-4">
                    <span class="stepIndicator">Account Setup</span>
                    <span class="stepIndicator">Social Profiles</span>
                    <span class="stepIndicator">Personal Details</span>
                </div> -->
                <div class="progress progress-step-arrow progress-info">
                    <a href="javascript:void(0);" class="progress-bar active" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property Details</a>
                    <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Images</a>
                </div>
                <!-- end step indicators -->
            
                <!-- step one -->
                <div class="step">
                    @include('gis_engineer.pages.property.edit_details_form')
                </div>
            
                <!-- step two -->
                <div class="step">
                    <div class="row">
                        <div class="col-xxl-12 col-md-12 mt-3">
                            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap">
                                @if(count($property->images) > 0)
                                    @foreach ($property->images as $image)
                                    {{--<a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                        <img src="{{ asset('uploads/property/images/' . $image->file_url) }}" class="img-fluid">
                                        <span class="remove-image btn remove" data-imgid="{{$image->id}}" data-href="{{url('surveyor/property/image/destroy/' .$image->id )}}" style="display: inline;">×</span>
                                    </a>--}}
                                    @php 
                                        $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);

                                    @endphp
                                    
                                    <!-- https://proper-t.co/testing.survey.propert/public/assets/images/svg/default-pdf.svg -->
                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                                        <span class="image-area rounded" id="pimg{{$image->id}}">
                                            <img class="imageThumb" width="130" src="{{ asset('uploads/property/images/' . $image->file_url) }}" title="undefined">
                                            <br>
                                        </span>
                                    @elseif($extension == 'pdf')
                                        <span class="image-area rounded" id="pimg{{$image->id}}">
                                            <img class="imageThumb" width="130" src="{{ asset('assets/images/svg/default-pdf.svg') }}" title="undefined">
                                            <br>
                                        </span>
                                    @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                                    
                        <div class="col-md-12 mt-2">
                            <form action="{{ route('surveyor.property.image.dropzone.store') }}" method="post"
                                name="file" files="true" enctype="multipart/form-data" class="dropzone"
                                id="image-upload">
                                @csrf
                                <div>
                                    <!-- <h3 class="text-center">Upload Images</h3> -->
                                    <input type="hidden" name="prop_id" id="prop_id" value="{{$property->id}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             
                <!-- start previous / next buttons -->
                <div class="form-footer d-flex justify-content-center my-4">
                    <div class="">
                        <span  id="update_property_btn" class="btn btn-done btn-primary">Save</span>
                        <button type="button" id="prevBtn" class="btn btn-done btn-primary" onclick="nextPrev(-1)"><i class="fa fa-arrow-left"></i>&nbsp; Previous</button>
                        <button type="button" id="nextBtn" class="btn btn-done btn-primary" onclick="nextPrev(1)">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- end previous / next buttons -->
            </form>
            <!-- end page title -->
          
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/property/add-images.js') }}?v=34567897654"></script>
    <script src="{{ asset('assets/js/property/split-merge.js') }}?v=6543"></script>
    <script src="{{ asset('assets/js/property/get-builder-sub-groups.js') }}?v=4"></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          $('#update_property_btn').show();
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
            $('#update_property_btn').hide();
          } else {
            document.getElementById("nextBtn").innerHTML = "Next &nbsp;<i class='fa fa-arrow-right'></i>";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }
        
        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("step");
            // Exit the function if any field in the current tab is invalid:
            //   if (n == 1 && !validateForm()) return false;
            var isValid = validateForm();
            if (isValid == false) return false;
            const list = [...document.querySelectorAll('.progress-bar')];
            const active = document.querySelector('.progress-bar.active');
            if(list.indexOf(active) == (x.length - 1)){
                
            }
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
       
            x[currentTab - n].style.display = "block";
            // ... the form gets submitted:
          
          
            if (isValid) {
                // Form is valid, submit the form
                $('#update_property').submit();
            }
            return false;
          }
          else{
            // x[currentTab - n].style.display = "block";
             // Otherwise, display the correct tab:
            showTab(currentTab);
          }
         
        }
        
        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("progress-bar");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
        </script>
	<script >
        
	    $(document).ready(function() {

            initiateSelectDD()
            // $('input:text').myCustomFunction();

            $("input:text").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            
            $('#mySelect2').select2({
              ajax: {
                url: 'https://api.github.com/orgs/select2/repos',
                data: function (params) {
                  var query = {
                    search: params.term,
                    type: 'public'
                  }
            
                  // Query parameters will be ?search=[term]&type=public
                  return query;
                }
              }
            });
            
            $('#uploadBtn').click(function(e) {
                e.preventDefault();
        
                var formData = new FormData($('#myForm')[0]);
        
                $.ajax({
                    url: '/upload',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(error);
                    }
                });
            });

            $(document).on('click','.p-ufs-ufr', function(){
                
                if($(this).prop('checked') == true){
                    $('.p-ufs-ufr').each( function(){
                        // $(this).closest('.p-ufs-ufr').prop('checked', false);
                        $(this).prop('checked', false);
                        
                    })
                }
                $(this).prop('checked', true);
            })
            
            $(document).on('click', '.save-file-uploads', function(){
                var formData = new FormData();
                var files = $('input[name="files[]"]')[0].files;

                for (var i = 0; i < files.length; i++) {
                    formData.append('files[]', files[i]);
                }
                toggleFileLoadingAnimation();
                $.ajax({
                    url: "{{route('surveyor.property.image.store')}}",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        toggleFileLoadingAnimation();
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        toggleFileLoadingAnimation();
                        console.error(error);
                    }
                });
            });

            // $(document).on('click', ".remove-image", function(e) {
            //     let currentEle = $(this).parent(".image-area");
            //     $.ajax({
            //         type: "GET",
            //         url: $(this).data('href'),
            //         success: function(response) {
            //             console.log(response)
            //             toastr.success(response.message);
            //             currentEle.remove();
            //         }
            //     });
            // });

        });
	</script>
   
    <script>
      var floorNames = [];
        $(document).on('keyup', "input[name=nth_floor_name]", function(){
            floorNames = [];
            $("input[name=nth_floor_name]").each(function(i){
                floorNames.push({"id": i, "text" : $(this).val()});
            });
            console.log(floorNames);
            $(".commercial-select2").empty();
            $.each( floorNames, function( key, value ) {
                $(".commercial-select2").append('<option value="5">'+value.text+'</option>');
            });
            //  $(".js-select2").append('<option value="5">Twitter</option>');
        });
        
        $(".commercial-select2").select2({
			closeOnSelect : false,
			placeholder : "select units",
			allowHtml: true,
			allowClear: true,
		});

         $(document).on('change', '#category', function(e) {
            let id = $(this).val();
            let category_type = $(this).attr('id');
            let propertyId = $('#property_id').val();
            let categoryId = $('#category_id').val();
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {c_id : id, mode : 'edit', property_id : propertyId, category_id : categoryId},
                success: function(response) {
                    $('#defined_block').html(response.defined_block);
                    $('.select2-dd').select2();
                }
            });
            initiateSelectDD();
        });
        $(document).on('click', '.propert-gcc', function(){
            let propertGcc = $(this).val();
            $('#property_gcc').val(propertGcc);

        })
        
        $(document).on('change', '.get_subcat_options', function(e) {
            let c_id = $(this).val();
            $('.get-category-fields').empty();

            $('.get-category-fields').append(new Option('Select Category', ''));
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('surveyor/ajax/sub_categories') }}",
                success: function(response) {
                    $('#plot_land_types').empty();
                    if(response.length == 0){
                        $("#plot_land_types").append('<option selected >--Select Category--</option>');
                    }
                    if (response) {
                        $.each(response, function(key, value) {
                            $('.get-category-fields').append($("<option/>", {
                                value: value.id,
                                text: value.cat_name
                            }));
                        });
                    }
                }
            });
            
        });
        
        // $('.get-category-fields')
        
        $(document).on('change', '.get-category-fields', function(e) {
         let id = $(this).val();
            let category_type = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_defined_block') }}",
                data: {c_id:id},
                success: function(response) {
                    $('.category-fields-container').html(response.defined_block);
                    $('.select2-dd').select2();
                }
            });
        });
         
        $(document).on('change', '#comm_type_of_unit', function(){
            ($(this).val() == 1) ? $('.floor-chk').removeClass('d-none') : $('.floor-chk').addClass('d-none') ;
            ($(this).val() == 2) ? $('.unit-chk').removeClass('d-none') : $('.unit-chk').addClass('d-none') ;
        });
        
        $(document).on('change', '#comm_type_of_unit_child_dd', function(){
            let dependentDdown = $(this).val();
            dependentDdown = dependentDdown.toLowerCase();
            (dependentDdown == 'occupied') ? $('.commercial-'+dependentDdown+'-child').removeClass('d-none') : $('.commercial-tou-name-children').addClass('d-none') ;
        });
        

        
        // generate floors using add floor button
        $(document).on('click', ".add-floor", function(){
            let currentStoreyCount = $('.storey').length;
            let count = ($('.no_of_floors').val() == '') ? 0 : parseInt($('.no_of_floors').val());
            // alert(count)
            if(count < 1){
                toastr.error('please enter valid floor count');
                return false
            }
            let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
            let totalCount = parseInt(currentStoreyCount) + parseInt(count);
            let str = '';
            var totalFloors = '';
            $('.loader-container').removeClass('d-none');
            
            // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
            //getFloors(start index, finalCount)
            totalFloors = getFloors(currentStoreyCount, finalCount);
            (currentStoreyCount > 0 ) 
            ? (
                $(totalFloors).insertAfter($(".storey").last())
                ) 
            : $(totalFloors).insertAfter( $(this).closest(".append-floors") );
            $(".remove-storey").each(function(){
                (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
            })
            $(".remove-storey").last().removeClass('d-none');
            $('.floor_unit_type_dd').select2();
            $('.no_of_floors').val($('.storey').length);
            initiateSelectDD()
            
        });
        
        // add units for floor
         $(document).on('click', ".add-unit", function(){
            let pId = $(".storey").index($(this).closest('.storey'));
            let floorIdOc = $(this).data('floor_id');
            floorIdOc = (floorIdOc == undefined) ? 0: floorIdOc;
            // alert(floorIdOc);
            // get no of units count
            let count = $(this).closest('.storey-nou-child').find('.no_of_units').val();
            // generate units only if no of units value is greater than 1
            let currentStoreyUnitCount = $(this).closest('.storey').find('.storey-unit').length;
            // let finalCount = (currentStoreyUnitCount > count ) ? currentStoreyCount - count : count ;
            let totalCount = parseInt(currentStoreyUnitCount) + parseInt(count);
            if(count > 1 || currentStoreyUnitCount > 1){
                // alert('start : '+currentStoreyUnitCount+'totalCount : '+ totalCount)
                let totalFloors = getUnits(currentStoreyUnitCount, totalCount, pId, floorIdOc);
                // append units html to respective floor
                (currentStoreyUnitCount > 0 ) 
                ? $(totalFloors).insertAfter($(this).closest('.floor-dds_row').nextAll('.unit-container').first().find('.storey-unit').last())
                : $(this).closest('.floor-dds_row').nextAll('.unit-container').first().html(totalFloors);
               $(".remove-storey-unit").addClass('d-none');
                $('.storey').each(function(){
                    $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                    let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                    $(this).find('.no_of_units').val(currentStoreyUnitLength)
                });
                $(this).closest('.floor-dds_row').find('.append-dd-to').addClass('d-none');
                $(this).closest('.floor-dds_row').find('.floor-ufs-ufr').prop('checked', false);
                // $(this).closest('.storey').find('.unit-tfd').addClass('d-none');
            }else{
                ($('#category').val() == 3) 
                ?($(this).closest('.floor-dds_row').find('.append-dd-to').andSelf().slice(0,2).removeClass('d-none'))
                :($(this).closest('.floor-dds_row').find('.append-dd-to').first().removeClass('d-none'));
                $(this).closest('.storey').find('.storey-unit').remove();
                // $(this).closest('.storey').find('.unit-tfd').removeClass('d-none');
            }
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none')
            })
            setTimeout(()=>{
              ($('.floor-parent-'+pId).prop('checked') === true)
                ? ($('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',true))
                : $('.nouc-'+pId).find('.unit-name, .unit-chk, textarea, button, select').prop('disabled',false);
              }, 600);
              initiateSelectDD()
              
        });
        
        // delete floor
        $(document).on('click', ".remove-storey", function(){
            let storey_id = ($(this).data('floor_id') != undefined) ? $(this).data('floor_id') : 0;
            if(storey_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_floor') }}",
                    data:{ floor_id : storey_id},
                    success: function(response) {
                        // $('.storey').remove();
                        // let floors = getPropertyFloors(response.data.id)
                    }
                });
            }
            
            $(this).parent().remove();
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
        });
        
        // delete unit
        $(document).on('click', ".remove-storey-unit", function(){
            let storey_unit_id = ($(this).data('unit_id') != undefined) ? $(this).data('unit_id') : 0;
            if(storey_unit_id != 0){
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('remove_unit') }}",
                    data:{ unit_id : storey_unit_id},
                    success: function(response) {
                        // $('.storey').remove();
                        // let floors = getPropertyFloors(response.data.id)
                    }
                });
            }
            let currentStoreyUnits =  $(this).parent().closest('.unit-container').find('.storey-unit');
            // $(this).parent().closest('.storey').find('.add-unit').trigger('click');
            (currentStoreyUnits.length == 2) ? currentStoreyUnits.remove() : $(this).parent().remove();
            $('.storey').each(function(){
                $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                $(this).find('.no_of_units').val(currentStoreyUnitLength)
            });
            
        });
        
        $(document).on('click', ".floor-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey').find('.floor-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.floor-parent__ufs-ufr').find('.floor-ufs-ufr').not($(this)).prop('checked', false);
                $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey').find('.floor-dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        $(document).on('click', ".unit-ufs-ufr", function(){
            let ufsUfrLength = $(this).closest('.storey-unit').find('.unit-ufs-ufr').filter(':checked').length;
            let unitType = $(this).closest('.storey-unit').find('.floor_unit_type_dd').first().val();
            if($(this).prop('checked') == true){
                $(this).closest('.unit-parent__ufs-ufr').find('.unit-ufs-ufr').not($(this)).prop('checked', false);
                $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').removeClass('d-none');
            }else{
                (ufsUfrLength == 0) ? $(this).closest('.storey-unit').find('.dds_row').first().find('.unit-tfd').addClass('d-none'): '';
            }
        });
        
        //  append  unit drop-down optioins to floors and units
        $(document).on('change', '.floor_ddopt, .unit_ddopt', function(){
            //to get and enable or display next unit drop-down element parenet block
            let next_parent_element = $(this).closest('.append-dd-to').nextAll('.append-dd-to').first();
            let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
            let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
            let current_block_other_text_elements = $(this).closest('.append-dd-to').nextAll('.brand-tfd');
            // to get next occured unit drop-down 
            let fieldType = $(this).find(':selected').data('field');
            let fieldOtherType = $(this).find(':selected').data('others')
            let next_ddopt_child = ($(this).hasClass('floor_ddopt')) 
            ? next_parent_element.find('.floor_ddopt')
            : next_parent_element.find('.unit_ddopt');
            // let uType = $(this).val() = 2;
            let cat_id = $(this).val();
            let propertyId = $('#property_id').val();
            let prop_cat = $(this).parent().closest('.dds_row').find('.prop_category_dd').first().val();
            // alert(prop_cat)
             $.ajax({
                type: "GET",
                data: {
                    cat_id: cat_id, property_id : propertyId
                },
                url: "{{ url('get_unit_categories') }}",
                success: function(response) {
                    if(cat_id != null){
                        next_parent_element.removeClass('d-none');
                        ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) 
                        ? (next_parent_element.addClass('d-none'))
                        :next_parent_element.removeClass('d-none');
                        ($('#category').val() == 3)
                        ?(prop_cat == 1)? next_parent_element.removeClass('d-none'): (next_parent_element.addClass('d-none'))
                        :'';
                        
                        $(next_ddopt_child).empty();
                        //if(response.data.length == 0){
                            // $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                        //}
                        
                        if (response.data) {
                            if(fieldType == 'select'){
                                $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                                $.each(response.data, function(key, value) {
                                    next_ddopt_child.append($("<option/>", {
                                        value: value.id,
                                        text: value.name
                                    }));
                                });
                                $(current_block_text_elements).addClass('d-none');
                                $(current_block_other_text_elements).addClass('d-none');
                                // $(current_block_dd_elements).removeClass('d-none');
                            }
                            else if(fieldType == 'text'){
                                $(current_block_text_elements).removeClass('d-none');
                                $(current_block_other_text_elements).addClass('d-none');
                                $(current_block_dd_elements).addClass('d-none');
                                
                                // $.each(response, function(key, value) {
                            
                                // });
                            }
                            //this will get hit ater first dd change
                            else if(fieldType == undefined || fieldType == ''){
                                $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                                $.each(response.data, function(key, value) {
                                    next_ddopt_child.append($("<option/>", {
                                        value: value.id,
                                        text: value.name
                                    }));
                                });
                                
                                $.each(response.other_options, function(key, value) {
                                    next_ddopt_child.append($("<option></option>").attr({"value": value.brand_name, "data-others": 'others' }).text(value.brand_name));
                                });
                                
                            }
                            if(fieldOtherType == 'others'){
                                $(current_block_other_text_elements).removeClass('d-none');
                            }
                            
                        }

                        initiateSelectDD()
                    }

                }
            });
            
        });

        $(document).on('change', '.prop_category_dd', function(){
            let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
            let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
            
            $(current_block_text_elements).each(function(){
                $(this).addClass('d-none');
            });

            $(current_block_dd_elements).each(function(){
                if(!$(this).hasClass('u-type')){
                    $(this).addClass('d-none');
                }else{
                    let currentDD = $(this).find('.futd');
                    // let currentDD = $(this).find('.futd');
                    $(currentDD).val("--Select Category--").trigger("change");
                }
            });
        });
       
        // add custom brand
        $(document).on('click', '.add-fbrand', function(e){
            e.preventDefault();
            $(this).closest('.storey').find('.brand-tfd').first().removeClass('d-none')
        })
        
        $(document).on('click', '.merge_other_units', function(){
            if($(this).prop('checked') === true){
                $(this).parent().closest('.unit-container').addClass('active-unit-merge');
                $(this).addClass('active');
                $(this).parent().find('.merge_other_unit_lable').removeClass('btn-outline-primary');
                $(this).parent().find('.merge_other_unit_lable').addClass('btn-primary');
                $('.merge_other_units').each(function(){
                  if(!$(this).hasClass('active')) { $(this).prop('disabled', true) }else{ $(this).prop('disabled', false)}
                });
                $('.unit-container').each(function(){
                  if(!$(this).hasClass('active-unit-merge')) { $(this).find('.unit-chk').removeClass('d-none') }else{ $(this).find('.unit-chk').addClass('d-none') }
                });
                
                $('.oup-unit').addClass('d-none');
                
                // unit-parent-floor
                let index = -1;
                let currentUnitIndex = 0;
                $(this).parent().closest('.unit-container').find('.merge_other_units').each(function(){
                    index++;
                    if($(this).hasClass('active')){
                        currentUnitIndex = index;
                    }
                })
                let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
                // alert(currentFloorIndex);
                // alert(currentUnitIndex);
                $('#unit-parent-floor').val(currentFloorIndex);
                
                ($(this).data('uid') != undefined) ? ($('#parent-unit').val($(this).data('uid')), $('#unit-exist').val(1)) : ($('#parent-unit').val(currentUnitIndex), $('#unit-exist').val(0));
            
                $(this).parent('.unit-merge-group').find('.save-unit-merge').removeClass('d-none');
                
                // current storey unit input validations
                // $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                let reqElements = $(this).parent().closest('.storey-unit').find('input, select').addClass('req-validate');
                reqElements.each(function(){
                    $(this).not(':hidden').addClass('req-validate');
                })
            }
            if($(this).prop('checked') === false){
                $(this).parent().closest('.unit-container').removeClass('active-unit-merge');
                $(this).removeClass('active');
                $(this).parent().find('.merge_other_unit_lable').addClass('btn-outline-primary');
                $(this).parent().find('.merge_other_unit_lable').removeClass('btn-primary');
                $('.merge_other_units').prop('disabled', false)
                $('.unit-chk').addClass('d-none');
                $('#unit-exist').val(0);
                $('#parent-unit').val('');
                 $('#unit-parent-floor').val('');
                 $(this).parent('.unit-merge-group').find('.save-unit-merge').addClass('d-none')
            }
           
        });
        
        $(document).on('click', '.merge_other_floors', function(){
            let currentFloorIndex = $(".storey").index($(this).closest('.storey'));
           
            $('.floor-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $('.unit-chk').each(function(){
                ($(this).prop('checked') === false) ? $(this).addClass('d-none') : '';
            });
            
            $(this).parent().find('.floor-merge-btn').removeClass('btn-outline-primary');
            $(this).parent().find('.floor-merge-btn').addClass('btn-primary');
            
            if($(this).prop('checked') === true){
                
                ($(this).data('fid') != undefined) ? $('#parent-floor').val($(this).data('fid')) : $('#parent-floor').val(currentFloorIndex) ;
                
                
                $('.no_of_units, .add-unit').prop('disabled', false);
                $(this).closest('.storey').find('.no_of_units').val(0);
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
                $(this).closest('.storey').find('.add-unit').prop('disabled', true);
                
                //
                $('.floor-chk').removeClass('d-none'); 
                $(this).closest('.storey').find('.floor-chk').addClass('d-none');
                $('.oup-floor').addClass('d-none');
                $('.save-merge-btn').addClass('d-none');
                $(this).closest('.storey').find('.save-merge-btn').removeClass('d-none')
                
                $(this).closest('.storey').find('.unit-container').html('');
                
            }
            
            if($(this).prop('checked') === false){
                $('#parent-floor').val('')
                $('.floor-chk').addClass('d-none'); 
                $('.floor-chk').prop('checked', false); 
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
                $(this).closest('.storey').find('.add-unit').prop('disabled', false);
                $(this).closest('.storey').find('.save-merge-btn').addClass('d-none');
                $(this).parent().find('.floor-merge-btn').addClass('btn-outline-primary');
                $(this).parent().find('.floor-merge-btn').removeClass('btn-primary');
            }
        });
        
        // floor-parent-
        $(document).on('click', '.floor-chk', function(){
            if($(this).prop('checked') === true){
                $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.floor-dds_row').find('.no_of_units').val(0);
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', true);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',true);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',true);
                
            }else{
                // $(this).closest('.floor-dds_row').nextAll('.unit-container').html('');
                $(this).closest('.storey').find('.no_of_units').prop('readOnly', false);
                $(this).closest('.floor-dds_row').find('textarea, button, select').prop('disabled',false);
                $(this).closest('.storey').find('.merge_other_floors').prop('disabled',false);
            }
            
        });
        
        $(document).on('click', '.unit-chk', function(){
            ($(this).prop('checked') === true)
            ? (
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',true)
               )
            :(
                $(this).closest('.storey-unit').find('.unit-name, textarea, button, select').prop('disabled',false)
              )
            ;
            
        });
        

        function getFloors(startIndex, count){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_floors') }}",
                data:{c_id : c_id, count : count, start_index : startIndex},
                success: function(response) {
                    temp_floors = response.floors;
                    $('.loader-container').addClass('d-none');
                }
            });
            
            return temp_floors;
        }
        $(document).on('click', '.remove-merge',function(e){
            remove_merge();
            $(".remove-storey").last().removeClass('d-none');
            let currentStoreyLength = $('.storey').length;
            $('.no_of_floors').val(currentStoreyLength);
            
        });
        
        function remove_merge(){
            toggleLoadingAnimation();
            var temp_floors =null;
            let c_id = $('#category').val();
            let property_id = $('#property_id').val();

            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('remove_merge') }}",
                data:{c_id : c_id, property_id : property_id},
                success: function(response) {
                    toggleLoadingAnimation();
                    $('.storey').remove();
                    let floors = getPropertyFloors(property_id)
                    $(floors).insertAfter(".append-floors")
                    // $('.select2-dd').select2();
                    initiateSelectDD()
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });

                    if (response.data.floors_merge_status == 0 || response.data.units_merge_status == 0) {
                        $('.remove-merge-ele').addClass('d-none');
                    }
                }
            });
        }

        function initiateSelectDD(){
            $('.select2-dd').select2({minimumResultsForSearch: -1});
            $('.is-searchable').select2();
            $('.ddopt_te').select2({
                tags: true,
            });
        }
        
        function getUnits(startIndex, count, floor_id, floorIdOc){
            toggleLoadingAnimation();
            var temp_units =null;
            let c_id = $('#category').val();
            let propertyId = $('#property_id').val();
            $.ajax({
                type: "GET",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async:false,
                url: "{{ url('get_units') }}",
                data:{c_id : c_id,count :count, floor_id : floor_id, start_index : startIndex, property_id : propertyId, floor_idoc : floorIdOc},
                success: function(response) {
                    toggleLoadingAnimation();
                    temp_units = response;
                }
            });
            
            return temp_units;
        }
        
        function getPropertyFloors(property_id){
            var temp_floors =null;
            let c_id = $('#category').val();
            $.ajax({
                type: "GET",
                async:false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('get_edit_floors') }}",
                data:{c_id : c_id ,property_id : property_id},
                success: function(response) {
                    temp_floors = response;
                }
            });
            
            return temp_floors;
        }
        
       
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
        
        $(document).on('click', '.save-floor-merge', function(e){
            $('.loader-container').removeClass('d-none');
            // setTimeout(function(){
            //     $('.loader-container').addClass('d-none');
            // }, 1000);
            // toastr.success('Floors Merged Successfully');
            // 
            let save_floor_merge_url =  "{{ url('save_floor_merge') }}";
            saveProperty(save_floor_merge_url, 'save-floor-merge');
        });
        
        $(document).on('click', '.save-unit-merge', function(e){
            toggleLoadingAnimation();
            let save_floor_merge_url =  "{{ url('save_unit_merge') }}";
            // saveProperty(save_floor_merge_url);
             $.ajax({
                url: save_floor_merge_url, 
                type: 'POST',
                dataType: 'json',
                data: $('#update_property').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toggleLoadingAnimation();
                    $('#update_property').attr('action', response.data.action_url);
                    $('#property_id').val(response.data.id);
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    $('.select2-dd').select2();
                    if (response.data.floors_merge_status == 1 || response.data.units_merge_status == 1) {
                        $('.remove-merge-ele').removeClass('d-none');
                    }
                    toastr.success('Units merged successfully');
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);
                    
                    $('.storey').each(function(){
                        $(this).children().find('.storey-unit').last().find('.remove-storey-unit').removeClass('d-none');
                        let currentStoreyUnitLength = $(this).children().find('.storey-unit').length;
                        $(this).find('.no_of_units').val(currentStoreyUnitLength)
                    });
                },
                error: function(xhr) {
                     $('.loader-container').addClass('d-none');
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
                        });
                    } 
                    }
            });

        });
        
        function saveProperty(save_merge_url, ele = null){
            toggleLoadingAnimation();
            $.ajax({
                url: save_merge_url, 
                type: 'POST',
                dataType: 'json',
                data: $('#update_property').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toggleLoadingAnimation();
                    if(ele == 'save-floor-merge'){
                        toastr.success('Floors Merged successfully.');
                    }
                    if(ele == 'update_property_btn'){
                        toastr.success('Property Details updated successfully.');
                    }
                    
                    $('#update_property').attr('action', response.data.action_url);
                    $('#property_id').val(response.data.id);
                    $('.storey').remove();
                    let floors = getPropertyFloors(response.data.id)
                    $(floors).insertAfter(".append-floors")
                    initiateSelectDD()
                    if (response.data.floors_merge_status == 1 || response.data.units_merge_status == 1) {
                        $('.remove-merge-ele').removeClass('d-none');
                    }
                    
                    $(".remove-storey").last().removeClass('d-none');
                    let currentStoreyLength = $('.storey').length;
                    $('.no_of_floors').val(currentStoreyLength);

                    if($('#merge-gis').prop('checked') === true || $('#split-gis').prop('checked') === true){
                        $('.split-merge-gis').prop('checked', false);
                        setSplitMergeOptionDataAttributes();
                        
                    }
                    $('.split-merge-container').html('');
                },
                error: function(xhr) {
                    toggleLoadingAnimation();
                    if (xhr.status === 422) { 
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('<span class="input-error flash-errors" style="color: red">'+value[0]+'</span>').insertAfter('input[name='+key+']');
                        });
                        let egis_ids = xhr.responseJSON.egis_ids;
                        console.log(egis_ids)
                        $('#update_property input[name="mgis_id[]"]').each(function(){
                            (egis_ids.includes(this.value)) 
                            ? ($(this).addClass('is-invalid'),
                                $('<span class="input-error flash-errors" style="color: red">'+xhr.responseJSON.msg+'</span>')
                                .insertAfter($(this).parent('.input-group'))
                            ) 
                            : '';
                        });
                        
                    } 
                    // else
                    }
                // }
            });
        }
        function setSplitMergeOptionDataAttributes(){
            let GISID = "{{$property->gis_id}}";
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('surveyor/split-merge-options') }}",
                data: {
                    gis_id: GISID,
                },
                success: function(response) {
                    if(response.merges > 0){
                        let mergeContent = response.mergeContent;
                        if(typeof mergeContent == 'object'){
                            mergeContent = mergeContent.join(',');
                            $('.split-merge-data-container').html(`<span class="badge bg-success">This Property Merged with ${mergeContent} GIS-ID's</span>`); 
                        }
                        
                    }
                    $('#merge-gis').attr('data-option_cnt', (5 - response.merges));
                    
                   
                },
                error: function(xhr,response) { 
                    
                }
            });
        }

           $(document).on('click', '#update_property_btn', function(e) {
                e.preventDefault(); // Prevent default form submission
                var isValid = validateForm();
                let save_merge_url = $('#update_property').attr('action');
                if (isValid) {
                    // toggleLoadingAnimation();
                    let currentBtn = $(this).attr('id');
                    saveProperty(save_merge_url, 'update_property_btn');
                }
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
            $('.geo-loc-error').html('')
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
              // Will return ['granted', 'prompt', 'denied']
              (result.state == 'denied') ? $('.geo-loc-error').html('Please Enable Your Location.') :'';
            });
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    $('#latitude').val(lat);
                    $('#longitude').val(lon);
                });
            }
            
            // Swal.fire({
            //     position: 'top-end',
            //     title: 'Geolocation is not supported by this browser.',
            //     // timer: 1500
            //     timer: 2000,
            //     showCancelButton: false,
            //     showConfirmButton: false
            // })
            
           
        }

        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hiddebs.modal', function() {
            // location.reload();
        });
        
        
        
        // $(document).on('click','#update_property_btn', function(e){
        //     e.preventDefault(); // Prevent default form submission
        //     var isValid = validateForm();
        //     if (isValid) {
        //         // Form is valid, submit the form
        //         // $('#update_property').submit();
        //     }
            
        // });
        
        function validateForm() {
            $('.flash-errors').remove();
            var isValid = true;
            let noOfFloors = $('#update_property .no_of_floors');
            let floors = $('#update_property .storey');

            let mergeGISIDValuesValidStatus     = true;
            let matchGISMGISStatus = true;

            if($('#merge-gis').prop('checked') === true){
                mergeGISIDValuesValidStatus =  areMergeGISIDValuesValid('#update_property input[name="mgis_id[]"]', 'property already exists with this Gis-ID.');
                let match_merge_ids = [];
                match_merge_ids.push($('#gis_id').val())
                $('#create_property input[name="mgis_id[]"]').each(function() {
                
                        var value = $(this).val();
                        if (match_merge_ids.includes(value)) {
                            matchGISMGISStatus = false;
                            if (value != '') {
                                ($('<span class="input-error flash-errors" style="color: red">GIS ID must be unique.</span>')
                                    .insertAfter($(this).parent('.input-group')))
                            }
                            // return false; // Not unique
                        }
                        match_merge_ids.push(value);
                    
                }); 
            }

            $('#update_property .ctfd-required').each(function() {
                var value = ($(this).hasClass('form-select')) ? $(this).val() : $(this).val().trim();
                if (value === '' || value === null) {
                    isValid = false;
                    // 
                    ($(this).hasClass('no_of_floors') || $(this).hasClass('mgis-id')) ?
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter($(this).parent('.input-group')), $(this).addClass('is-invalid')) :
                    ($('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                        .insertAfter(this), $(this).addClass('is-invalid'));;
                } else {
                    $(this).removeClass('is-invalid');
                }
                $('.is-invalid:first').focus();

            });
            // alert(`filal reqired :  ${isValid}`);
            let unitNamesUniqueStatus = true;
            let floorNamesUniqueStatus = true;
            let floorUnitTypeDDStatus = true;
            let floorUnitTypeCatDDStatus = true;
            let noOfFloorsStatus = true;
            let floorsStatus = true;
            // Usage

            // alert($('.save-floor-merge').is(':visible'));
            if($('.save-floor-merge').is(':visible') == true){
                toastr.error('Please Click on save button to merge floors.')
                $('.save-floor-merge:visible').addClass('animate-merge-btn');
                $('.save-floor-merge:visible').focus();
                return false;
            }
            if($('.save-unit-merge').is(':visible') == true){
                toastr.error('Please Click on save button to merge units.')
                $('.save-unit-merge:visible').addClass('animate-merge-btn');
                $('.save-unit-merge:visible').focus();
                return false;
            }
            

            floorNamesUniqueStatus = areInputValuesUnique('#update_property input[name="floor_name[]"]', 'merged-floor-name', 'Floor Name must be unique.');
            unitNamesUniqueStatus  = areInputValuesUnique('#update_property .unit-name', 'merged-unit-name', 'Unit Name must be unique.');

            $('#update_property .floor_unit_type_dd, #update_property .un_unit_type_dd').each(function() {
                console.log($(this).is(':visible'))
                if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                    if ($(this).val() == null || $(this).val() == undefined) {
                        // alert('not choosen');
                        var errorMessage = $('<span>').attr('class', 'input-error flash-errors').css('color', 'red')
                            .text('This field is required.');
                        $(this).parent().find('.select2-container').append(errorMessage);
                        floorUnitTypeDDStatus = false;
                    }
                }
            });
            
            $('#update_property .floor_unit_type_cat_dd').each(function() {
                console.log($(this).is(':visible'))
                if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                    if ($(this).val() == null || $(this).val() == undefined) {
                        // alert('not choosen');
                        var errorMessage = $('<span>').attr('class', 'input-error flash-errors').css('color', 'red')
                            .text('This field is required.');
                        $(this).parent().find('.select2-container').append(errorMessage);
                        floorUnitTypeCatDDStatus = false;
                    }
                }
            });
            $('#update_property .cpdd-required').each(function() {
                // console.log($(this).is(':visible')) /
                if ($(this).is(':visible') === true && $(this).prop('disabled') === false) {
                    if ($(this).val() == null || $(this).val() == undefined) {
                        $('<span class="input-error flash-errors" style="color: red">This field is required.</span>')
                            .insertAfter(this);
                        $(this).addClass('is-invalid');
                        floorUnitTypeDDStatus = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                }
            });
            // alert(floorNamesUniqueStatus);

            if ($('#update_property  .no_of_floors').is(':visible') === true) {
                if (noOfFloors.val() < 1 && noOfFloors.val() != '') {
                    $('<span class="input-error flash-errors" style="color: red">Please Enter Valid Floors Count.</span>')
                        .insertAfter(noOfFloors.parent('.input-group'))
                    // toastr.error('Invalid Floors Count');
                    noOfFloorsStatus = false;
                } else {
                    noOfFloorsStatus = true;
                }
                if (floors.length != noOfFloors.val()) {
                    $('<span class="input-error flash-errors" style="color: red">Please click on Add Floors button to create Floors.</span>')
                        .insertAfter(noOfFloors.parent('.input-group'))
                    floorsStatus = false;
                } else {
                    floorsStatus = true;
                }
            }
            // alert(isValid);
            isValid = (isValid == false || floorNamesUniqueStatus == false || unitNamesUniqueStatus == false ||
                floorUnitTypeDDStatus == false || floorUnitTypeCatDDStatus == false || noOfFloorsStatus == false ||
                floorsStatus == false ||mergeGISIDValuesValidStatus == false || matchGISMGISStatus == false) ? false : true;
            // return isValid;
            // alert(`filal isInvalid ${isValid}`)
            return isValid;
        }

        function areInputValuesUnique(selector, mergedEle, msg) {
            var inputValues = [];
            let inputUniqueStatus = true;
            $(selector).each(function() {
                if (!$(this).hasClass(mergedEle)) {
                    
                    var value = $(this).val();
                    if (inputValues.includes(value)) {
                        inputUniqueStatus = false;
                        if (value != '') {
                            ($('<span class="input-error flash-errors" style="color: red">' + msg + '</span>')
                                .insertAfter(this))
                        }
                        // return false; // Not unique
                    }
                    inputValues.push(value);
                }
            });
            return inputUniqueStatus;
        }
        function areMergeGISIDValuesValid(selector, msg) {
            var mergeIDStatus = true;
            let merge_ids = [];
            let inputUniqueStatus = true;
            $(selector).each(function() {
                    var value = $(this).val();
                    if (merge_ids.includes(value)) {
                        inputUniqueStatus = false;
                        if (value != '') {
                            ($('<span class="input-error flash-errors" style="color: red">GIS ID must be unique.</span>')
                                .insertAfter($(this).parent('.input-group')))
                        }
                        // return false; // Not unique
                    }
                    merge_ids.push(value);
                
            }); 
            let priorGisId ="{{$property->gis_id}}";
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('surveyor/merge-gis-id-valid-search') }}",
                async:false,
                data: {
                    merge_ids: merge_ids,
                    prior_gis_id : priorGisId
                },
                success: function(response) {
                    mergeIDStatus = response.status;
                    let egis_ids = response.egis_ids;
                    $('#update_property input[name="mgis_id[]"]').each(function(){
                        (egis_ids.includes(this.value)) 
                        ? ($(this).addClass('is-invalid'),
                            $('<span class="input-error flash-errors" style="color: red">'+response.msg+'</span>')
                            .insertAfter($(this).parent('.input-group'))
                        ) 
                        : '';
                    });
                }
            });

            return mergeIDStatus;
        }

        // validate comma separated 10 digit contact numbers
        $(document).on('input', '.is-contact-no', function() {
            let currentEle = $(this);
            currentEle.val($(this).val().replace(/[^0-9,]/g, '').replace(/(\,,*?)\,,*/g, '$1'));
            let regex = /^(\d{10},)*\d{10}$/;
            (regex.test(currentEle.val())) ? (currentEle.val(), currentEle.removeClass('is-invalid')) : currentEle
                .addClass('');
        });

        //validate integer input values 
        $(document).on('input', '.is-numeric', function() {
            let currentEle = $(this);
            currentEle.val($(this).val().replace(/[^0-9]/g, ''));
        });

        //validate integer input values 
        $(document).on('input', '.is-person-name', function() {
            let currentEle = $(this);
            currentEle.val($(this).val().replace(/[^a-zA-Z]/g, ''));
        });
        
        //  
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