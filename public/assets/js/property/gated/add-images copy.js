Dropzone.autoDiscover = false;
var title = $("#project_brochure_file").data("title");


var projectBrochureFile = new Dropzone("#project_brochure_file", {
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
    addRemoveLinks: true,
    dictRemoveFile: "Remove",
    dictDefaultMessage: "Drag and drop or click to upload " + title,
    maxFiles: 5,
    transformFile: function (file, done) {
        // Use Compressor.js to compress the image
        if (file.size > 500 * 1024) {
            new Compressor(file, {
                quality: 0.68, // Adjust the quality as needed (0.6 means 60% quality)
                success(result) {
                    done(result); // Pass the compressed file to Dropzone
                },
                error(err) {
                    console.error(err.message);
                    done(file); // If an error occurs, upload the original file
                },
            });
        }
    },
});

projectBrochureFile.on("removedfile", function(file) {
  let imageId = file.previewElement
    .querySelector(".dz-remove")
    .getAttribute("data-image-id");
  if (typeof imageId !== "undefined" && imageId !== null) {
    $.ajax({
      type: "GET",
      url:
        apiUrl +
        "/surveyor/property/gated-community-details/repository/destroy/" +
        imageId,
      success: function(response) {
        // Handle success or show a message
      }
    });
  }
});



// function logFileSize(file) {
//   var fileSizeInMB = file.size / (1024 * 1024);
//   console.log("Compressed file size:", fileSizeInMB.toFixed(2), "MB");
// }
projectBrochureFile.on("success", function(file, response) {
  // Add the image ID as a data attribute to the remove button
  var removeButton = file.previewElement.querySelector(".dz-remove");
  if (removeButton) {
    removeButton.setAttribute("data-image-id", response.id);
  }
});
