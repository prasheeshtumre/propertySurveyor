 // generate floors using add floor button
 $(document).on('click', "#create_property .add-floor", function(){
    let currentStoreyCount = $('#create_property .storey').length;
    let count = ($('#create_property  .no_of_floors').val() == '') ? 0 : parseInt($('#create_property .no_of_floors').val());
    // alert(count)
    if(count < 1 || count > 200){
        toastr.error('please enter valid floor count');
        return false
    }
    let finalCount = parseInt(currentStoreyCount) + parseInt(count) ;
    let totalCount = parseInt(currentStoreyCount) + parseInt(count);
    let str = '';
    var finaleFloors = '';
    
    // alert('start : '+currentStoreyCount+'totalCount : '+ finalCount)
    //getFloors(start index, finalCount)
    finaleFloors = getFloors(currentStoreyCount, finalCount);
    (currentStoreyCount > 0 ) 
    ? (
        $(finaleFloors).insertAfter($("#create_property .storey:last-child"))
        ) 
    : $(finaleFloors).insertAfter( $(this).closest("#create_property .append-floors") );
    $(".remove-storey").each(function(){
        (!$(this).hasClass('d-none')) ? $(this).addClass('d-none') : '';
    })
    $(".remove-storey").last().removeClass('d-none');
    $('.floor_unit_type_dd').select2();
    $('#create_property  .no_of_floors').val($('#create_property .storey').length);
    
});
 // <div class="col-auto p-0 h-100 w-10 ">
                        //     <input class="form-check-input floor-chk d-none floor-parent-`+i+` mx-2 border border-dark" data-parent="`+i+`" type="checkbox" name="floor[]" value="`+i+`" id="flexCheckDefault">
                        // </div>
function getFloors(startIndex, count){
    var temp_floors = null;
    let c_id = $('#category').val();
    let floors = '';
    for (let i = startIndex; i < count; i++) {
        let floor = `<div class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-`+i+` rounded border border-dark">
                    <div class="row dds_row floor-dds_row">
                       
                        <div class="col-md-2 storey-nou-child">
                            <div>
                                <label for="" class="form-label">No of Units per Floor `+(i + 1)+`<span class="errorcl">*</span></label>
                                <div class="input-group">
                                <input type="text" class="form-control form-control-sm no_of_units is-numeric" data-pid="`+i+`" name="nth_unit[]" placeholder="0" aria-label="" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success add-unit" type="button"  id="button-addon2">Add Units</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div>
                                <label for="" class="form-label"> Floor Name <span class="errorcl">*</span></label>
                                <div>
                                <input type="text" class="form-control form-control-sm ctfd-required"  name="floor_name[]" >
                                </div>
                            </div>
                        </div>
                        ${c_id == 3 ? `
                        <div class="col-md-3 append-dd-to">
                          <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>
                          <select class="form-select select2-dd prop_category_dd cpdd-required form-select-sm" data-suid="1" data-pid="1" name="prop_category[`+i+`]" id="" >
                            <option disabled selected>-- select Category --</option>
                          </select>
                        </div>
                      ` : ''}
                        <div class="col-auto append-dd-to u-type">
                            <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>
                            <select class="form-select append-dd select2-dd futd floor_unit_type_dd floor_ddopt" data-fid="`+i+`"  name="unit_type[`+i+`]" id="" >
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-3 residential-floor-name-`+i+` d-none">
                            <label for="inputPassword6" class="form-label"></label>
                            <input type="text" id="" data-pid="`+i+`" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">
                        </div>
                        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-`+i+` d-none">
                            <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
                            <select class="form-select append-dd dd-child select2-dd floor_unit_type_cat_dd floor_ddopt is-searchable" name="fu_category[`+i+`]" id="" >
                            </select>
                        </div>
                        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-`+i+` d-none">
                            <label for="" class="form-label"> Sub Category </label>
                            <select class="form-select append-dd dd-child select2-dd floor_ddopt" name="fu_sub_category[`+i+`]" id=""  >
                            </select>
                        </div>
                        <div class="  col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-`+i+` d-none">
                            <label for="" class="form-label"> Enter Name/Brand </label>
                        
                                <select class="form-select append-dd dd-child select2-dd floor_ddopt ddopt_te" name="floor_brand[`+i+`]" id="" data-suid="1" data-pid="1" >
                                </select>
                                <!--data-bs-toggle="modal" data-bs-target="#add-brand-model"-->
                                
                        </div>
                        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-`+i+` d-none">
                            <label for="" class="form-label">Concerned Person Name</label>
                            <input type="text" id="" data-pid="`+i+`" name="person_name[`+i+`]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-person-name" aria-describedby="">
                        </div>
                        <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-`+i+` d-none">
                            <label for="" class="form-label">Mobile</label>
                            <input type="text" id="" data-pid="`+i+`" name="mobile[`+i+`]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm is-contact-no" data-valid-length="10" aria-describedby="">
                        </div>
                    </div>
                    <div class="row floor-parent__ufs-ufr">
                        <div class="col-xxl-3 col-md-3 mt-3">
                            <div class="form-check">
                            <input class="form-check-input floor-ufs-ufr" type="checkbox" name="floor_up_for_sale[`+i+`]" id="floor_up_for_sale[`+i+`]">
                            <label class="form-check-label" for="floor_up_for_sale[`+i+`]">
                                up for Sale
                            </label>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3 mt-3">
                            <div class="form-check">
                            <input class="form-check-input floor-ufs-ufr" type="checkbox" name="floor_up_for_rent[`+i+`]" id="floor_up_for_rent[`+i+`]" >
                            <label class="form-check-label" for="floor_up_for_rent[`+i+`]">
                                up for Rent
                            </label>
                            </div>
                        </div>
                    </div>           
                    <div class="row d-none">
                        <div class="mt-2" style="display: flex;justify-content: start;align-items: end;">
                            <div class="">
                                <!--Merge with Other Floors-->
                                <label for="floor-check-`+i+`" class="form-control floor-merge-btn btn btn-sm btn-outline-success mb-0"> 
                                Merge Floors
                                <input type="checkbox" class="d-none merge_other_floors" name="" data-current="`+i+`" id="floor-check-`+i+`" data-suid="1" data-pid="1" >
                            </div>
                            
                            <div class="d-none  save-merge-btn save-merge-btn-`+i+`">
                                <label for="" class="form-label">  <span class="errorcl"></span> </label>
                                <button type="button" class="btn btn-sm btn-outline-success save-floor-merge">save</button>
                            </div>
                        </div>
                    </div>
                    <div class="unit-container p-0"> </div>
                    <span class="remove-storey d-none">
                    <span class="mdi mdi-close-circle mdi-18px"></span></span>
                    </span>
                </div>`;
                floors += floor;
        
    }
    getFloorUnitTypes(startIndex, count);
    return floors;
}
// add
// floor_unit_type_dd

 function getFloorUnitTypes(startIndex, count){
    // $('.get-category-fields').empty();
    // $('.get-category-fields').append(new Option('Select Category', ''));
    var floorUnitTypes = '';
    $.ajax({
        type: "GET",
        url: apiUrl + '/surveyor/ajax/floor-unit-types',
        success: function(response) {
            // $('#plot_land_types').empty();
            if(response.length == 0){
                $("#plot_land_types").append('<option selected disabled >--Select Category--</option>');
            }
            if (response) {
                let options = response.options;
                let categories = response.categories;
                console.log(options);
                for (let j = startIndex; j < count; j++) {
                    $('.pfloor-'+ j +' .floor_unit_type_dd').empty();
                    $('.pfloor-'+ j +' .floor_unit_type_dd').append('<option selected disabled >--Select Category--</option>');
                    $.each(options, function(key, value) {
                        $('.pfloor-'+ j +' .floor_unit_type_dd').append($('<option value="'+ value.id +'" data-field="'+ value.field_type +'" >'+ value.name +'</option>'));
                    });
                    $('.pfloor-'+ j +' .prop_category_dd').empty();
                    $('.pfloor-'+ j +' .prop_category_dd').append('<option selected disabled >--Select Category--</option>');
                    $.each(categories, function(key, value) {
                        $('.pfloor-'+ j +' .prop_category_dd').append($("<option/>", {
                            value: value.id,
                            text: value.cat_name
                        }));
                    });
                }
            }
        }
    });
  
 }