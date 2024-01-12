/*
   File: image-compression-helper.js
   Description: This JavaScript file contains the code for compressing image files.
   Author: 
   Date: november 2023
*/

// starts here...
    $(document).ready(function () {
        // $("#demolishedImageInput").on("change", function (e) {
        $(document).on("change",".rera-hmda-files", function(e){
            // alert()  
            let validStatus = reraAndHmdaFFValidation({ 
                            selector: this,
                            files : e.target.files,
                            acceptedFiles:['.jpg', '.jpeg', '.png', '.gif','.mp4', '.avi', '.mkv', '.mov', '.pdf'],
                            maxFiles : 1
                        });
            (validStatus) ? reraAndHmdaHandleImageCompression(this, e.target.files) : '';
        });
    });

    $(document).on('click', '.icm-remove-img-item', function(){
        let currentInpEle = $(this).parent().closest('.unit-gallery-zone').find("input[type='file']");
        currentInpEle.val('');
        $(this).parent('.image-item').remove();
    });

    let reraAndHmdaCompressedFiles = []; // Store compressed files globally

    function reraAndHmdaFFValidation(options) {
        var allowedTypes = options.acceptedFiles || [];
        var maxAllowedFiles = options.maxFiles || 1;
        var fileInputSelector = options.selector || '';
        var inputFiles = options.files || [];
    
        // Assuming you have a file input element with the id "fileInput"
        var fileInput = $(fileInputSelector);
        
            var validFiles = [];
            let validFilesErrorStatus = true;
    
            for (var i = 0; i < inputFiles.length; i++) {
                var fileName = inputFiles[i].name;
                var fileExtension = fileName.slice((fileName.lastIndexOf(".") - 1 >>> 0) + 2);
    
                if (allowedTypes.includes('.' + fileExtension.toLowerCase())) {
                    validFiles.push(inputFiles[i]);
                } else {
                    toastr.error('Invalid file type: ' + fileExtension);
                    // Optionally, you might want to clear the file input
                    fileInput.value = '';
                    validFilesErrorStatus = false; // Stop further processing if an invalid file type is found
                }
            }
    
            if (validFiles.length > maxAllowedFiles) {
                toastr.error('Too many files. Maximum allowed: ' + maxAllowedFiles);
                // Optionally, you might want to clear the file input
                validFilesErrorStatus = false;
            }
        return validFilesErrorStatus;
    }
    
    function reraAndHmdaHandleImageCompression(ele, files) {
        let currentSelector = $(ele);
        let fileList = currentSelector.parent(".icm-zone").find(".icm-file-list");
        fileList.empty(); // Clear previous file list
    
        // Convert FileList to an array for compatibility
        let filesArray = Array.from(files);
    
        // Map each file to a promise that resolves when compression is complete
         let compressionPromises = filesArray.map((file) => {
            return reraAndHmdaCompressImage(file);
    });
    
        // Wait for all compression promises to resolve
        Promise.all(compressionPromises)
            .then((result) => {
                reraAndHmdaCompressedFiles = result.filter((file) => file !== null); // Filter out non-image files
                // Display file sizes and previews
                for (let i = 0; i < filesArray.length; i++) {
                    let originalFile = filesArray[i];
                    let compressedFile = reraAndHmdaCompressedFiles[i];
                    reraAndHmdaDisplayFileDetails(originalFile, compressedFile, fileList);
                }
                // Check if there are any image files to upload
                if (reraAndHmdaCompressedFiles.length > 0) {
                    $(currentSelector)[0].files  = reraAndHmdaCompressedFiles;
                    // uploadCompressedFiles(currentSelector, reraAndHmdaCompressedFiles);
                }
            })
            .catch((error) => {
                console.error("Image compression error:", error.message || error);
            });
    }

    
    function isImageFile(file) {
        // Check if the file has a valid image file extension
        const allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif'];
        const fileName = file.name.toLowerCase();
        return allowedExtensions.some(ext => fileName.endsWith(ext));
    }

    function reraAndHmdaCompressImage(file) {
        if (isImageFile(file)) {
            let mimeType = file.type;
            return new Promise((resolve, reject) => {
                new Compressor(file, {
                    maxWidth: 800,
                    maxHeight: 800,
                    quality: 0.8,
                    mimeType: mimeType,
                    success(result) {
                        resolve(result); // Resolve with the compressed file
                    },
                    error(err) {
                        reject(err); // Reject with the compression error
                    },
                });
            });
        }else {
            return Promise.resolve(file); // Resolve with the original file for non-image files
        }
    }

    function reraAndHmdaDisplayFileDetails(originalFile, compressedFile, fileList) {
        let listItem = document.createElement("div");
        listItem.classList.add("image-item");

        // Create image element for preview
        let dzImageDiv = document.createElement("div");
        dzImageDiv.classList.add("icm-image");
        let previewImage = document.createElement("img");
        let fileType = originalFile.type;
        if (fileType.startsWith("image/")) {
            previewImage.src = URL.createObjectURL(originalFile);
        } else if (fileType.startsWith("video/")) {
            previewImage.src = apiUrl + "/public/assets/images/svg/default-mp4.svg";
        } else if (fileType === "application/pdf") {
            previewImage.src = apiUrl + "/public/assets/images/svg/default-pdf.svg";
        } else {
            console.log("Unsupported file type");
            return;
        }
        previewImage.setAttribute("data-original-filename", originalFile.name);

        dzImageDiv.appendChild(previewImage);
        listItem.appendChild(dzImageDiv);

        // Create the outer div
        let overlayDiv = document.createElement("div");
        overlayDiv.classList.add("overlay");

        // Create the loader div
        // let loaderContainerDiv = document.createElement("div");
        // loaderContainerDiv.classList.add("progress", "icm-progress");
        // loaderContainerDiv.setAttribute("role", "progressbar");
        // loaderContainerDiv.setAttribute("aria-valuemin", 0);
        // loaderContainerDiv.setAttribute("aria-valuemax", 100);
        // loaderContainerDiv.innerHTML = `<div class=" icm-progress-bar" style="width: 0%"></div>`;

        // Create the checkmark div
        let successCheckmarkDiv = document.createElement("div");
        successCheckmarkDiv.classList.add("icm-success-mark");
        let successMarkEle = `<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                        <title>Check</title>
                                        <defs></defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                        </g>
                                    </svg>`;
        successCheckmarkDiv.innerHTML = successMarkEle;
        let errorCheckmarkDiv = document.createElement("div");
        errorCheckmarkDiv.classList.add("icm-error-mark");
        let errorMarkEle = `<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      <title>Error</title>      <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>        </g>      </g>    </svg>`;
        errorCheckmarkDiv.innerHTML = errorMarkEle;

        // Append loader and checkmark divs to the overlay div
        // overlayDiv.appendChild(loaderContainerDiv);
        overlayDiv.appendChild(successCheckmarkDiv);
        overlayDiv.appendChild(errorCheckmarkDiv);

        // Append the overlay div to listItem
        listItem.appendChild(overlayDiv);

        // Display file sizes dynamically as each file is compressed
        let fileSizeText = document.createElement("p");
        fileSizeText.textContent = `${formatBytes()}`;
        fileSizeText.classList.add("icm-file-size");
        let removeImgItem = document.createElement("button");
        removeImgItem.setAttribute("type", 'button');
        removeImgItem.classList.add('btn', 'btn-danger', 'icm-remove-img-item', 'show');
        removeImgItem.textContent = `Remove`;
        listItem.appendChild(fileSizeText);
        listItem.appendChild(removeImgItem);

        fileList.append(listItem);

        // Update the preview image and file size once compression is complete
        reraAndHmdaCompressImage(originalFile)
            .then((compressed) => {
                previewImage.src = URL.createObjectURL(compressed);
                fileSizeText.textContent = `${formatBytes(compressed.size)}`;
                if (compressed.type.startsWith("video/")) {
                    previewImage.src = apiUrl + "/public/assets/images/svg/default-mp4.svg";
                } else if (compressed.type === "application/pdf") {
                    previewImage.src = apiUrl + "/public/assets/images/svg/default-pdf.svg";
                }
                // checkmarkDiv.classList.add('active');
            })
            .catch((error) => {
                console.error("Image compression error:", error.message || error);
            });
    }
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return "0 Bytes";

        let k = 1024;
        let dm = decimals < 0 ? 0 : decimals;
        let sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

        let i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
    }
    // async function uploadCompressedFiles(currentSelector, reraAndHmdaCompressedFiles) {
    //     // let postUrl = $("#uploadButton").attr("data-action");
    //     let uploadPromises = []; // Array to hold Promise instances
    //     let postUrl = currentSelector.attr("data-action");
    //     let icmForm = currentSelector.closest('form')

    //     for (let i = 0; i < reraAndHmdaCompressedFiles.length; i++) {
    //         let compressedFile = reraAndHmdaCompressedFiles[i];
    //         let formData = new FormData(icmForm[0]);
    //         formData.append("file", compressedFile, compressedFile.name);
    //         let originalFileName = compressedFile.name;
    //         let matchingImage = $(
    //             '.icm-image img[data-original-filename="' + originalFileName + '"]'
    //         );
    //         let closestImageItem = matchingImage.closest(".image-item");

    //         // Introduce a delay before initiating the AJAX request
    //         await new Promise((resolve) => setTimeout(resolve, 2000));

    //         // Create a new Promise for each AJAX call and push it to the array
    //         let uploadPromise = new Promise((resolve, reject) => {
    //             $.ajax({
    //                 url: postUrl,
    //                 type: "POST",
    //                 data: formData,
    //                 processData: false,
    //                 contentType: false,
    //                 xhr: function () {
    //                     var xhr = new window.XMLHttpRequest();
    //                     // Upload progress
    //                     xhr.upload.addEventListener(
    //                         "progress",
    //                         function (evt) {
    //                             if (evt.lengthComputable) {
    //                                 var percentComplete =
    //                                     (evt.loaded / evt.total) * 100;
    //                                 let currentPreviewEle =
    //                                     closestImageItem.find(".progress-bar");
    //                                 updateProgressBar(
    //                                     currentPreviewEle,
    //                                     percentComplete
    //                                 );
    //                                 // console.log('Upload Progress: ' + percentComplete + '%');
    //                             }
    //                         },
    //                         false
    //                     );
    //                     return xhr;
    //                 },
    //                 success: function (response) {
    //                     console.log(
    //                         "Upload success at " +
    //                             new Date().toLocaleTimeString() +
    //                             ":",
    //                         response
    //                     );
    //                     resolve(response); // Resolve the Promise if the AJAX call is successful
    //                 },
    //                 error: function (error) {
    //                     reject(error); // Reject the Promise if there's an error
    //                 },
    //             });
    //         });

    //         uploadPromise.then(() => {
    //             // Add 'active' class to the overlay div of the corresponding image item
    //             let successCheckEle = closestImageItem
    //                 .find(".overlay")
    //                 .find(".icm-success-mark");
    //             closestImageItem.find(".icm-progress").hide();
    //             closestImageItem.find(".icm-remove-img-item").addClass('show');
    //             successCheckEle.addClass("active");
    //         }).catch((error) => {
    //             // Handle the error here
    //             console.error("Upload failed:", error);
    //             // You can add code here to display an error message or take any other appropriate action
    //             let errCheckEle = closestImageItem
    //                 .find(".overlay")
    //                 .find(".icm-error-mark");
    //             closestImageItem.find(".icm-progress").hide();
    //             closestImageItem.find(".icm-remove-img-item").addClass('show');
    //             errCheckEle.addClass("active");
    //         });;

    //         uploadPromises.push(uploadPromise); // Add the Promise to the array
    //     }

    //     // Return a Promise that resolves when all individual AJAX Promises resolve
    //     return Promise.all(uploadPromises);
    // }
    function updateProgressBar(ele, percent) {
        // ele.css('width', percent + '%').text(percent.toFixed(2) + '%');
        ele.css("width", percent + "%");
    }

// ends here...
