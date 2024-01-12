Dropzone.autoDiscover = false;
var otherFile = new Dropzone("#other_files", {
  paramName: "file", // The name that will be used to transfer the file
  // maxFilesize: 5, // Max file size in MB
  maxFiles: 5,
  dictDefaultMessage: "Drag and drop or click to upload Other File",
  acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.mp4",
  addRemoveLinks: true,
  dictRemoveFile: "Remove",
  init: function() {
    this.on("addedfile", function(file) {
      if (!file.processed) {
        // Check if the file has not been processed already
        file.processed = true; // Set flag to indicate that the file has been processed

        // Compress the added image using Compressor.js
        new Compressor(file, {
          maxWidth: 800,
          maxHeight: 800,
          quality: 0.8,
          mimeType: "image/jpeg",
          success: function(result) {
            // Do not remove the original file from galleryDropzone
            // Replace the original file with the compressed one
            file.previewElement.querySelector(
              ".dz-image"
            ).src = URL.createObjectURL(result);
            file.previewElement.querySelector(
              ".dz-size"
            ).innerHTML = formatBytes(result.size); // Update file size if needed

            // You can also update any other information related to the file here

            // If you want to upload only the compressed file, you can use galleryDropzone.uploadFile(result);
          },
          error: function(err) {
            console.error("File compression error:", err.message);
          }
        });
      }
    });
  }
});

otherFile.on("removedfile", function(file) {
  let imageId = file.previewElement
    .querySelector(".dz-remove")
    .getAttribute("data-image-id");
  if (typeof imageId !== "undefined" && imageId !== null) {
    $.ajax({
      type: "GET",
      url:
        apiUrl +
        "/surveyor/property/gated-community-details/repository/destroy-other-files/" +
        imageId,
      success: function(response) {
        // Handle success or show a message
      }
    });
  }
});

otherFile.on("success", function(file, response) {
  // Add the image ID as a data attribute to the remove button
  var removeButton = file.previewElement.querySelector(".dz-remove");
  if (removeButton) {
    removeButton.setAttribute("data-image-id", response.id);
  }
});

otherFile.on("error", function(file, response) {
  // Add the image ID as a data attribute to the remove button
  $(".flash-errors").remove();
  var errors = response.errors;
  // alert(errors);
  $.each(response.errors, function(key, value) {
    $(
      '<span class="input-error flash-errors" style="color: red">' +
        value[0] +
        "</span>"
    ).insertAfter("input[name=" + key + "]");

    toastr.error(value[0]);
  });
});

// Function to format file size
function formatBytes(bytes, decimals = 2) {
  if (bytes === 0) return "0 Bytes";

  const k = 1024;
  const dm = decimals < 0 ? 0 : decimals;
  const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}
