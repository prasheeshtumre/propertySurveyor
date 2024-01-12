Dropzone.autoDiscover = false;
var nameList = ["file1.jpg", "file2.jpg", "file3.jpg"]; // Your predefined list of names

var galleryDropzone = new Dropzone("#unit-dz-gallery", {
  paramName: "file", // The name that will be used to transfer the file
  // maxFilesize: 5, // Max file size in MB
  maxFiles: 5,
  acceptedFiles: ".jpeg,.jpg,.png,.gif",
  addRemoveLinks: true,
  dictRemoveFile: "Remove",
  init: function () {
    this.on("addedfile", function (file) {
      if (!file.processed) { // Check if the file has not been processed already
        file.processed = true; // Set flag to indicate that the file has been processed

        // Compress the added image using Compressor.js
        new Compressor(file, {
           maxWidth: 800,
            maxHeight: 800,
            quality: 0.8,
            mimeType: "image/jpeg",
          success: function (result) {
            // Get the original file name (without extension)
            var originalFileName = file.name.split('.').slice(0, -1).join('.');

            // Check if the original file name is in the nameList
            if (nameList.includes(originalFileName)) {
              // Rename the compressed file using the original file name
              result.name = originalFileName + "_compressed.jpg";

              // Upload the compressed file to the server
              galleryDropzone.uploadFile(result);
              
              // Do not remove the original file from galleryDropzone
              // Replace the original file with the compressed one
              file.previewElement.querySelector(".dz-image").src = URL.createObjectURL(result);
              file.previewElement.querySelector(".dz-size").innerHTML = formatBytes(result.size); // Update file size if needed
            } else {
              // Remove the file if it's not in the nameList
              galleryDropzone.removeFile(file);
            }
          },
          error: function (err) {
            console.error("File compression error:", err.message);
          }
        });
      }
    });
  }
});

// Function to format file size
function formatBytes(bytes, decimals = 2) {
  if (bytes === 0) return '0 Bytes';

  const k = 1024;
  const dm = decimals < 0 ? 0 : decimals;
  const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

  const i = Math.floor(Math.log(bytes) / Math.log(k));

  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}


var amenityDropzone = new Dropzone("#unit-dz-amenity", {
    // acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
    paramName: "file", // The name that will be used to transfer the file
    // maxFilesize: 5, // Max file size in MB
    maxFiles: 5,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Remove",
    init: function () {
      this.on("addedfile", function (file) {
        if (!file.processed) { // Check if the file has not been processed already
          file.processed = true; // Set flag to indicate that the file has been processed

          // Compress the added image using Compressor.js
          new Compressor(file, {
            maxWidth: 800,
            maxHeight: 800,
            quality: 0.8,
            mimeType: "image/jpeg",
            success: function (result) {
              // Do not remove the original file from galleryDropzone
              // Replace the original file with the compressed one
              file.previewElement.querySelector(".dz-image").src = URL.createObjectURL(result);
              file.previewElement.querySelector(".dz-size").innerHTML = formatBytes(result.size); // Update file size if needed

              // You can also update any other information related to the file here

              // If you want to upload only the compressed file, you can use galleryDropzone.uploadFile(result);
            },
            error: function (err) {
              console.error("File compression error:", err.message);
            }
          });
        }
      });
    }
});


var interiorDropzone = new Dropzone("#unit-dz-interior", {
  paramName: "file", // The name that will be used to transfer the file
  // maxFilesize: 5, // Max file size in MB
  maxFiles: 5,
  acceptedFiles: ".jpeg,.jpg,.png,.gif",
  addRemoveLinks: true,
  dictRemoveFile: "Remove",
  init: function () {
    this.on("addedfile", function (file) {
      if (!file.processed) { // Check if the file has not been processed already
        file.processed = true; // Set flag to indicate that the file has been processed

        // Compress the added image using Compressor.js
        new Compressor(file, {
          maxWidth: 800,
          maxHeight: 800,
          quality: 0.8,
          mimeType: "image/jpeg",
          success: function (result) {
            // Do not remove the original file from galleryDropzone
            // Replace the original file with the compressed one
            file.previewElement.querySelector(".dz-image").src = URL.createObjectURL(result);
            file.previewElement.querySelector(".dz-size").innerHTML = formatBytes(result.size); // Update file size if needed

            // You can also update any other information related to the file here

            // If you want to upload only the compressed file, you can use galleryDropzone.uploadFile(result);
          },
          error: function (err) {
            console.error("File compression error:", err.message);
          }
        });
      }
    });
  }
});

var floorPlanDropzone = new Dropzone("#unit-dz-floor-plan", {
  paramName: "file", // The name that will be used to transfer the file
  // maxFilesize: 5, // Max file size in MB
  maxFiles: 5,
  acceptedFiles: ".jpeg,.jpg,.png,.gif",
  addRemoveLinks: true,
  dictRemoveFile: "Remove",
  init: function () {
    this.on("addedfile", function (file) {
      if (!file.processed) { // Check if the file has not been processed already
        file.processed = true; // Set flag to indicate that the file has been processed

        // Compress the added image using Compressor.js
        new Compressor(file, {
          maxWidth: 800,
          maxHeight: 800,
          quality: 0.8,
          mimeType: "image/jpeg",
          success: function (result) {
            // Do not remove the original file from galleryDropzone
            // Replace the original file with the compressed one
            file.previewElement.querySelector(".dz-image").src = URL.createObjectURL(result);
            file.previewElement.querySelector(".dz-size").innerHTML = formatBytes(result.size); // Update file size if needed

            // You can also update any other information related to the file here

            // If you want to upload only the compressed file, you can use galleryDropzone.uploadFile(result);
          },
          error: function (err) {
            console.error("File compression error:", err.message);
          }
        });
      }
    });
  }
});



