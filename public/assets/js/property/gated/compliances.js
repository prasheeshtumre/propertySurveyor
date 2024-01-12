$(document).ready(function () {
    $(document).on("click", "#pills-compliances-tab", function (e) {
        let url = $(this).attr("data-url");
        getCompliancesBlock(url);
    });

    $(document).on('click', '#compliances-next-btn', function (event) {
        let isGHMCChecked = $("input[name='ghmc_radio']").is(':checked');
        let isCommencementCertificateChecked = $("input[name='comm_radio']").is(':checked');

        let ghmcApprovalFileLength = $("#ghmc_approval_file")[0].files.length;
        let ghmcFilesCount = $(this).attr('data-ghmc-images-count') ?? 0;
        let ghmcRadio = $("input[name='ghmc_radio']:checked").val();

        let commencementCertificateLength = $("#commencement_certificate_file")[0].files.length;
        let commencementCertificateFilesCount = $(this).attr('data-commencement-certificate-file-count') ?? 0;
        let commencementCertificateRadio = $("input[name='comm_radio']:checked").val();

        let errorStatus = true;
        $('.othe_errr').text('');
        if (isGHMCChecked === false ){
            toastr.error('The GHMC Approval field is required.');
            $('.ghmc_radio_err').text('The GHMC Approval field is required.');
            errorStatus=  false;
        }

        if (isCommencementCertificateChecked === false){
            toastr.error('The Commencement Certificate field is required.');
            $('.comm_radio_err').text('The Commencement Certificate field is required.');
            errorStatus = false;
        }

        if (ghmcApprovalFileLength == 0 && ghmcFilesCount == 0 && ghmcRadio == 1) {
            toastr.error('GHMC Approval File Required.');
            $('.ghmc_file_err').text('GHMC Approval File Required.');
            errorStatus = false;
        } 
        if (commencementCertificateLength == 0 && commencementCertificateFilesCount == 0 && commencementCertificateRadio==1){
            toastr.error('Commecement Certificate File Required.');
            $('.commenc_file_err').text('Commecement Certificate File Required.');
            errorStatus = false
        }
        
        if (errorStatus === true) {
            reraHmdaCompliancesFileUplaod();
        }
        return errorStatus;       
    });


   
});

function getCompliancesBlock(url) {
    toggleLoadingAnimation();
    let property_id = $("#property_id").val();

    $.ajax({
        type: "GET",
        url: url,
        data: {
            property_id: property_id
        },
        success: function (response) {
            if (response.status === false) {
                toggleLoadingAnimation();
                // toastr.error(response.message);
                $("#defined_block_tab").empty();
                $("#amenities_defined_block_tab").empty();
            } else {
                toggleLoadingAnimation();
                $("#defined_block_tab").empty();
                $("#amenities_defined_block_tab").empty();
                $("#complainces_defined_tab_content").html(response);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toggleLoadingAnimation();
        }
    });
}

function reraHmdaCompliancesFileUplaod(response){
    //compliance images submit form
    // $(document).on('click', '#CompliancesForm', function (event) {
        // event.preventDefault();
        toggleLoadingAnimation();

        var form = $("#CompliancesForm");
        var formData = new FormData(form[0]);
        var url = form.attr("action");

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                // console.log(data.comp_id);
                $("#comp_id").val(data.comp_id);
                toastr.success("Successfully Added Compliances");
                // getCompliancesBlock();
                toggleLoadingAnimation();
                setTimeout(() => {
                    $('#pills-reposotories-tab').trigger('click');
                }, 5000);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    $('.clr_err').text('');
                    var response = JSON.parse(jqXHR.responseText);
                    $.each(response.errors, function (key, value) {
                        var classname = key.replace(/\.+/g, '');
                        $('.' + classname + '_err').text(value);
                        toastr.error(value);
                    });
                }
                if (jqXHR.status == 413) {
                    $('.clr_err').text('');
                    alert('Check upload file size not more than 40MB');
                }
                toggleLoadingAnimation();
                $('.sucuss').css('display', 'none');
            }
        });

        toastr.remove();
    // });
}
