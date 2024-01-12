/*
   File: get-builder-sub-groups.js
   Description: This JavaScript file contains the code for fetching sub-groups of selected builder.
   Author: 
   Date: July 5, 2023

*/

// starts here...

$(document).on('change', ".builder-dd",function(){
    let builderId = $(this).val();
    let builderSubGroup = $(".builder-sub-group-dd");
    $.ajax({
        type: "GET",
        data: {
            builder_id: builderId
        },
        url: apiUrl + "/surveyor/builder/sub-group/list",
        success: function(response) {
            if(builderId != null){
                $(builderSubGroup).empty();
                $(builderSubGroup).append(
                    '<option selected disabled >-- choose Builder Sub Group --</option>');
                $.each(response.groups, function(key, value) {
                    builderSubGroup.append($("<option/>", {
                        value: value.id,
                        text: value.name
                    }));
                });
                initiateSelectDD()
            }
        },
        error: function(xhr, status, error) {
        // let text = ((typeof(xhr.status) != "undefined" && xhr.status !== null) ? xhr.status : 'error-code') + " : " + ((typeof(message) != "undefined" && message !== null) ? message : '') + " error-message" + ", Please click on save or Try again Later";
        $('#server-error-modal').modal('show');
            $('#server-error-msg').html('<p class="h4 text-success text-center"> Message : Please Try Again Later.</p>');
            $('#server-error-modal').modal('show');
            if(!$('.global-loader-container').hasClass('d-none')) {
                toggleLoadingAnimation();
            }
        }
    });
});