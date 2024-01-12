$(document).ready(function () {
    $(document).on('click', '#pills-reposotories-tab', function (e) {
        let propertyId = $('#property_id').val();
        let blockId = $('.repositories-accordion').first().data('block-id');
        getRepositoryContent(propertyId, blockId)
    });

    $(document).on('click', '.repositories-accordion', function (e) {

        let propertyId = $('#property_id').val();
        let blockId = $(this).data('block-id');
        getRepositoryContent(propertyId, blockId);
    });

    $(document).on('change', '#block_tower_id', function (e) {
        e.preventDefault();
        let block_tower_id = $(this).val();
        // toggleLoadingAnimation();
        let propertyId = $('#property_id').val();
        let blockId = 'bt-repositories';
        getRepositoryContent(propertyId, blockId, block_tower_id)
    });

    //project repositories images submit form 
    $(document).on('submit', '#ProjectRepositoryForm', function (event) {
        event.preventDefault();
        var formData = $('#ProjectRepositoryForm').serialize();
        toggleLoadingAnimation()
        $.ajax({
            url: apiUrl+"/commercial-tower/repositories/add-project-repository",
            type: 'POST',
            data: formData,
            success: function (data) {
                toastr.success("Successfully Added Project Repository");
                // $('#bt-repository-capsule').collapse('show');
                // $('#bt-repository-capsule .accordion-button').click();
                toggleLoadingAnimation();
                setTimeout(() => {
                    $('#pills-price-trends-tab').trigger('click');
                    $('#pills-price-trends-tab').tab('show');
                }, 5000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    $('.flash-errors').remove();
                    var errors = jqXHR.responseJSON.errors;
                    $.each(jqXHR.responseJSON.errors, function (key, value) {
                        $('<span class="input-error flash-errors" style="color: red">' +
                            value[0] +
                            '</span>').insertAfter('input[name=' + key +
                                ']');
                        toastr.error(value[0]);
                    });
                }
                toggleLoadingAnimation();
            }
        });
    });

});


function getRepositoryContent(propertyId, blockId, block_tower_id = "") {
    toggleLoadingAnimation();
    $.ajax({
        type: "GET",
        url: apiUrl +"/commercial-tower/repositories/index",
        data: {
            property_id: propertyId,
            block_id: blockId,
            block_tower_id: block_tower_id
        },
        success: function (response) {
            if (response.status === false) {
                toggleLoadingAnimation();
                // toastr.error(response.message);
                $('#defined_block_tab').empty();
                $('#amenities_defined_block_tab').empty();
                $('#complainces_defined_tab_content').empty();
            } else {
                toggleLoadingAnimation();
                $('#defined_block_tab').empty();
                $('#amenities_defined_block_tab').empty();
                $('#complainces_defined_tab_content').empty();
                $('.' + blockId + '-body').html(response);
                $('#block_tower_id').val(block_tower_id);
                $('.block_tower_val').val(block_tower_id);
                if (block_tower_id != '') {
                    $('#bt_files_upload').removeClass('d-none');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggleLoadingAnimation();
        }
    });
}

function clone_div() {
    var property_id = $('#property_id').val();
    var gis_id = $('#gis_id').val();
    var cat_id = $('#cat_id').val();
    var residential_type = $('#residential_type').val();
    var residential_sub_type = $('#residential_sub_type').val();

    var count = $('.original-div').length;

    var html = `<div class=" row align-items-end original-div file-input-wrapper" id="newrow${count}">       
                               
                                <div class="col-xxl-12 col-md-12 mb-12">
                                    <div class="form-group">
                                        <label for="files" class="form-label"> Upload (PDF, Images)
                                        </label>
                                        <div class="d-flex justify-content-center ">
                                            <div>
                                                <form class="unit-gallery-zone icm-zone">
                                                    <div class="row">
                                                        <div class="col-md-6 m-2">
                                                            <input type="hidden" name="property_id" id="property_id" value="${property_id}">
                                                            <input type="hidden" name="gis_id" id="gis_id" value="${gis_id}">
                                                            <input type="hidden" name="cat_id" id="cat_id" value="${cat_id}">
                                                            <input type="hidden" name="residential_type" id="residential_type" value="${residential_type}">
                                                            <input type="hidden" name="residential_sub_type" id="residential_sub_type"
                                                                value="${residential_sub_type}">
                                                            <label for="files" class="form-label"> Enter the Name </label>
                                                            <input type="text" name="name" class="form-control other_file_name"
                                                                id="" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="icm-file-list"></div>
                                                    <input type="file" id="other_files-img${count}" class="files img-upload"
                                                        style="display: none;"
                                                        data-action="`+apiUrl +`/commercial-tower/repositories/other-files">

                                                    <div class="row old-files-icm-lable-preview-group">
                                                        <label for="other_files-img${count}" class="icm-zone-label col">Click here to upload Other Files</label>
                                                    </div>
                                                </form>
                                                            
                                            </div>
                                            
                                            <div class="form-group">
                                    
                                                <button onclick="remove(${count})" class="btn btn-danger ms-2 "><span class=""> <i class="fa-solid fa-minus" ></i> </span></button>
                                            </div>
                                        </div>
                                      
                                    
                                    </div>
                                </div>`;

    $('#app_div').append(html);

}

function remove(id) {
    $('#newrow' + id).remove();
}
