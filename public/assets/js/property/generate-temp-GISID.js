/*
   File: generate-temp-GISID.js
   Description: This JavaScript file contains the code for generating temporary gis id.
   Author: 
   Date: september 25, 2023
*/

// starts here...

function generateTempGisId(lat, long){
    toggleLoadingAnimation();
    let pincode = '';

    $.ajax({
        type: "GET",
        data: {lat : lat , long : long, pincode : pincode},
        url: apiUrl + "/surveyor/gis-id/generate-temp-id",
        success: function(response) {
            toggleLoadingAnimation();
            if(response.temporaryGisId != undefined){
                $('#gis_id').val(response.temporaryGisId);
                $('#gis_id').prop('readonly', true);
            }
            $('#temp-gis-id-status').val(1);
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
}
