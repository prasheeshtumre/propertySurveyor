Dropzone.autoDiscover = false;
var dropzone = new Dropzone("#image-upload", {
  acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
  addRemoveLinks: true,
  dictRemoveFile: "Remove",
  // maxFiles: 5,
});

dropzone.on("removedfile", function (file) {
  let imageId = file.previewElement.querySelector(".dz-remove").getAttribute("data-image-id");
  if (typeof imageId !== "undefined" && imageId !== null) {
    $.ajax({
      type: "GET",
      url: apiUrl + "/surveyor/property/image/destroy/" + imageId,
      success: function (response) {
        // Handle success or show a message
      }
    });
  }
});

dropzone.on("addedfile", function (file) {
  if (file instanceof File) {
    // Check if the file size is greater than 500 KB (500 * 1024 bytes)
    if (file.size > 500 * 1024) {
      // Read the file content to compare with existing files
      var reader = new FileReader();
      reader.onload = function (event) {
        var duplicate = false;
        // Loop through the existing files in the dropzone
        dropzone.files.forEach(function (existingFile) {
          if (existingFile !== file) {
            if (existingFile.name === file.name) {
              dropzone.removeFile(file);
              duplicate = true;
              return;
            }
          }
        });
        console.log(`file duplicate status: ${duplicate}`);
        if (!duplicate) {
          console.log(`file is duplicated: ${duplicate}`);
          // If the file is not a duplicate, proceed with compression
          var compressor = new Compressor(file, {
            maxWidth: 800,
            maxHeight: 800,
            quality: 0.8,
            mimeType: "image/jpeg",
            success: function (result) {
              // Remove the original file from Dropzone and add the compressed one
              dropzone.removeFile(file);
              dropzone.addFile(result);
              
              // Upload the compressed file to the server
              result.upload.filename = result.name; // Set the filename for the server
              dropzone.processFile(result);
            },
            error: function (err) {
              console.error("File compression error:", err.message);
            }
          });
        }
      };
      reader.readAsDataURL(file);
    }
  }
});


function logFileSize(file) {
    var fileSizeInMB = file.size / (1024 * 1024);
    console.log("Compressed file size:", fileSizeInMB.toFixed(2), "MB");
}
dropzone.on("success", function(file, response) {
    // Add the image ID as a data attribute to the remove button
    var removeButton = file.previewElement.querySelector(".dz-remove");
    if (removeButton) {
        removeButton.setAttribute("data-image-id", response.id);
    }
});