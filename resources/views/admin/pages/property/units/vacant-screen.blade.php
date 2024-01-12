@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<link href="{{ url('public/assets/css/unit-details.css') }}" rel="stylesheet" type="text/css" />
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
                    <h4 class="mb-sm-0">Add unit Type </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('surveyor/property/add-sub-category')}}/{{$unit_id}}" method="post">
                        <div class="row">

                            <input type="hidden" name="property_id" value="{{$unit_data->property_id}}">

                            <div class="col-md-3 append-dd-to">
                                <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                                <select class="form-select append-dd dd-child select2-dd floor_ddopt floor_unit_type_cat_dd is-searchable" name="fu_category" id="">
                                    <option selected="" disabled="">-Select -</option>
                                    @forelse($sub_category as $unit_category)
                                    <option data-field="{{$unit_category->field_type}}" value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('fu_category')
                                <p class="text-danger text-center mt-2" role="alert">
                                    <small>{{ $message }}</small>
                                </p>
                                @enderror
                            </div>


                            <div class="col-md-3 append-dd-to d-none">
                                <label for="" class="form-label"> Sub Category </label>
                                <select class="form-select append-dd dd-child select2-dd floor_ddopt is-searchable" name="fu_sub_category" id="">
                                </select>
                            </div>
                            <div class="  col-md-3 append-dd-to d-none">
                                <label for="" class="form-label"> Enter Name/Brand </label>

                                <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te" name="floor_brand" id="" data-suid="1" data-pid="1">
                                </select>
                                <!--data-bs-toggle="modal" data-bs-target="#add-brand-model"-->


                            </div>


                        </div>
                        <div class="col-xxl-3 col-md-3  mt-3">
                            <button type="submit" class="btn btn-warning waves-effect waves-light w_100" id="create_property_btn">Save &amp; Continue</button>
                        </div>
                    </form>
                </div> <!-- container-fluid -->
            </div>
        </div>
        <!-- End Page-content -->

    </div>

</div> <!-- container-fluid -->
</div>
<!--End Page-content -->
@endsection
@push('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=8574"></script>

<script>
    $(function() {
        $('.select2-dd').select2();
    });

    $(document).on('change', '.floor_ddopt, .unit_ddopt', function() {
        //to get and enable or display next unit drop-down element parenet block
        let next_parent_element = $(this).closest('.append-dd-to').nextAll('.append-dd-to').first();
        let current_block_dd_elements = $(this).closest('.append-dd-to').nextAll('.append-dd-to');
        let current_block_text_elements = $(this).closest('.append-dd-to').nextAll('.unit-tfd');
        let current_block_other_text_elements = $(this).closest('.append-dd-to').nextAll('.brand-tfd');
        // to get next occured unit drop-down 
        let fieldType = $(this).find(':selected').data('field');
        let fieldOtherType = $(this).find(':selected').data('others')
        let next_ddopt_child = ($(this).hasClass('floor_ddopt')) ?
            next_parent_element.find('.floor_ddopt') :
            next_parent_element.find('.unit_ddopt');
        // let uType = $(this).val() = 2;
        let cat_id = $(this).val();
        let propertyId = $('#property_id').val();
        let prop_cat = $(this).parent().closest('.dds_row').find('.prop_category_dd').first().val();
        // alert(prop_cat)
        $.ajax({
            type: "GET",
            data: {
                cat_id: cat_id,
                property_id: propertyId
            },
            url: "{{ url('get_unit_categories') }}",
            success: function(response) {
                next_parent_element.removeClass('d-none');
                ($('#category').val() == 2 || $('#category').val() == 3 && cat_id == 2) ?
                (next_parent_element.addClass('d-none')) :
                next_parent_element.removeClass('d-none');
                ($('#category').val() == 3) ?
                (prop_cat == 1) ? next_parent_element.removeClass('d-none'): (next_parent_element
                    .addClass('d-none')): '';
                $(next_ddopt_child).empty();
                // if(response.data.length == 0){
                // $(next_ddopt_child).append('<option selected disabled >--Select Category--</option>');
                // }
                if (response.data) {
                    console.log(fieldType);
                    if (fieldType == 'select') {
                        $(next_ddopt_child).append(
                            '<option selected disabled >--Select Category--</option>');
                        $.each(response.data, function(key, value) {
                            next_ddopt_child.append($("<option/>", {
                                value: value.id,
                                text: value.name
                            }));
                        });
                        $(current_block_text_elements).addClass('d-none');
                        $(current_block_other_text_elements).addClass('d-none');
                        // $(current_block_dd_elements).removeClass('d-none');
                    } else if (fieldType == 'text') {
                        $(current_block_text_elements).removeClass('d-none');
                        $(current_block_other_text_elements).addClass('d-none');
                        $(current_block_dd_elements).addClass('d-none');

                        // $.each(response, function(key, value) {

                        // });
                    }
                    //this will get hit after first dd change
                    else if (fieldType == undefined || fieldType == '') {
                        $(next_ddopt_child).append(
                            '<option selected disabled >--Select Category--</option>');
                        $.each(response.data, function(key, value) {
                            next_ddopt_child.append($("<option/>", {
                                value: value.id,
                                text: value.name
                            }));
                        });

                        $.each(response.other_options, function(key, value) {
                            next_ddopt_child.append($("<option></option>").attr({
                                "value": value.brand_name,
                                "data-others": 'others'
                            }).text(value.brand_name));
                        });

                    }
                    if (fieldOtherType == 'others') {
                        $(current_block_other_text_elements).removeClass('d-none');
                    }
                    $(next_ddopt_child).select2();
                    $('.ddopt_te ').select2({
                        tags: true,
                    });

                }




            }
        });

    });
</script>





{{-- <script src="{{ url('public/assets/js/property//hospitality_extra.js') }}"></script> --}}
@endpush