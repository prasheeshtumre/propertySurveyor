{{-- <script> --}}
    $("form[id=PricingDetailsForm]").submit(function(e) {
        toggleLoadingAnimation();
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        // console.log(formData, "formData")
        $.ajax({
            url: pricingUrl,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toggleLoadingAnimation();

                // Handle success response
                if (currentScreen < $screens.length - 1) {
                    currentScreen++;
                    showScreen(currentScreen);
                    progressbar++;
                    showAtive(progressbar);
                }
                $(".input-error").remove();
                $("input").removeClass("is-invalid");
            },
            error: function(jqXHR, status, error) {
                toggleLoadingAnimation();
                $(".input-error").remove();
                $("input").removeClass("is-invalid");
                if (jqXHR.status == 422) {
                    for (const [key, value] of Object.entries(
                            jqXHR.responseJSON.errors
                        )) {
                        toastr.error(value[0]);
                        if (key != "pricing_details_for" && key != "ownership" && key !=
                            "new_resale_unit") {
                            $("form[id=PricingDetailsForm] input[name=" + key + "]")
                                .addClass(
                                    "is-invalid"
                                );
                            $("form[id=PricingDetailsForm] input[name=" + key + "]")
                                .after(
                                    '<span class="text-danger input-error" role="alert">' +
                                    value +
                                    "</span>"
                                );
                        }
                        $(
                            "form[id=PricingDetailsForm] textarea[name=" + key + "]"
                        ).addClass("is-invalid");
                        $("form[id=PricingDetailsForm] textarea[name=" + key + "]")
                            .after(
                                '<span class="text-danger input-error" role="alert">' +
                                value +
                                "</span>"
                            );

                        $("#err" + key).after(
                            '<span class="input-error" style="color:red">' + value +
                            "</span>"
                        );
                    }
                    $(".btn-primary").removeClass("nextBtn");
                } else {
                    // alert('something went wrong! please try again..');
                }
            }
        });
    });
    $(document).on('click', '.nxt-btn', function(){

        currentStep = $(this).attr('id');
        currentScreen  = $(this).attr('data-screen');
         
        if(currentStep == 'step3'){
            if(currentScreen == 'plot-land'){
                let galleryImagesLength = $("#image-gallery")[0].files.length;
                let imagesCount = $(this).attr('data-images-count') ?? 0;
                 if(galleryImagesLength == 0 && imagesCount == 0){
                        toastr.error('Image Files Required.')
                    return false;
                }
                toggleLoadingAnimation();
                $('.input-error').remove();
                $('input').removeClass('is-invalid');
                $('.btn-primary').addClass('nextBtn');
                toastr.success('Record Added Successfully');
                var url =
                    "{{ route('surveyor.property.plot_land.unit_details', [ $property->id ?? 0]) }}";
                url = url.replace(':id', );
                setTimeout(function() {
                    window.location.href = url;
                }, 3000);
                
            }else{
                
                let galleryImagesLength = $("#imageInput")[0].files.length;
                let amenityImagesLength = $("#icm-amenities")[0].files.length;
                let interiotImagesLength = $("#icm-interior")[0].files.length;
                let floorPlanImagesLength = $("#icm-floor-plan")[0].files.length;
                
                let imagesCount = $(this).attr('data-images-count') ?? 0;
                if(galleryImagesLength == 0 && amenityImagesLength == 0 && 
                    interiotImagesLength == 0 && floorPlanImagesLength == 0  && imagesCount == 0){
                        toastr.error('Image Files Required.')
                    return false;
                }
                if (currentScreen < $screens.length - 1) {
                    currentScreen++;
                    showScreen(currentScreen);
                    progressbar++;
                    showAtive(progressbar);
                }
                $('.input-error').remove();
                $('input').removeClass('is-invalid');
                $('.btn-primary').addClass('nextBtn');
            }
        }

       
    })

{{-- </script> --}}
