/*
   File: image-compression-helper.js
   Description: This JavaScript file contains the code for compressing image files.
   Author: 
   Date: november 2023
*/

// starts here...
    $(document).ready(function () {
        $("#demolishedImageInput").on("change", function (e) {
            // alert()  
            let validStatus = FFValidation({ 
                            selector: '#demolishedImageInput',
                            files : e.target.files,
                            acceptedFiles:['.jpg', '.jpeg', '.png', '.gif','.mp4', '.avi', '.mkv', '.mov', '.pdf'],
                            maxFiles : 5
                        });
            (validStatus) ? handleImageCompression("#demolishedImageInput", e.target.files) : '';
        });
    });

    // $(document).on('click', '.icm-remove-img-item', function(){
    //     $(this).parent('.image-item').remove();

    //     // let prevEleLength = $(this).parent().closest('.image-item').prev('.image-item').length;
    //     // console.log(prevEleLength)
    //     // let currentInpEle = $(this).parent().closest('.unit-gallery-zone').find("input[type='file']");

    // });
    $(document).on('click', '.icm-remove-img-item', function(){
        // Get the index of the clicked item
        let indexToRemove = $(this).parent('.image-item').index();
        // Remove the corresponding file from the compressedFiles array
        let fileInput = $(this).parent('.image-item').parent('.icm-file-list').next('input[type="file"]');
        // console.log('before : ',fileInput[0].files);

        let newFileList = new DataTransfer();
        let existingFileList = fileInput[0].files; 

        let existingFilesArray = Array.from(existingFileList);
        existingFilesArray.forEach((file, index) => {
            if(index != indexToRemove) 
                newFileList.items.add(file);
        });

        // Set the new FileList to the file input
        fileInput[0].files = newFileList.files;
        // console.log('after : ',fileInput[0].files);
        // Remove the parent element (image-item) from the DOM
        $(this).parent('.image-item').remove();
    });

    let compressedFiles = []; // Store compressed files globally

    function FFValidation(options) {
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
    
    function handleImageCompression(ele, files) {
        toggleLoadingAnimation();
        let currentSelector = $(ele);
        let fileList = currentSelector.parent(".icm-zone").find(".icm-file-list");
        fileList.empty(); // Clear previous file list
    
        // Convert FileList to an array for compatibility
        let filesArray = Array.from(files);
    
        // Map each file to a promise that resolves when compression is complete
        let compressionPromises = filesArray.map((file) => {
                return compressImage(file);
        });
    
        // Wait for all compression promises to resolve
        Promise.all(compressionPromises)
            .then((result) => {
                compressedFiles = result.filter((file) => file !== null); // Filter out non-image files
                // Display file sizes and previews
                for (let i = 0; i < filesArray.length; i++) {
                    let originalFile = filesArray[i];
                    let compressedFile = compressedFiles[i];
                    displayFileDetails(originalFile, compressedFile, fileList);
                }
                // Check if there are any image files to upload
                if (compressedFiles.length > 0) {
                    toggleLoadingAnimation();
                    let newFileList = new DataTransfer();

                    // Add each compressed file to the FileList
                    compressedFiles.forEach((file, index) => {
                        newFileList.items.add(new File([file], file.name, { type: file.type }));
                    });

                    // Set the new FileList to the file input
                    currentSelector[0].files = newFileList.files;
                    
                }
            })
            .catch((error) => {
                toggleLoadingAnimation();
                console.error("Image compression error:", error.message || error);
            });
    }

    
    function isImageFile(file) {
        // Check if the file has a valid image file extension
        const allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif'];
        const fileName = file.name.toLowerCase();
        return allowedExtensions.some(ext => fileName.endsWith(ext));
    }

    function compressImage(file) {
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

    function displayFileDetails(originalFile, compressedFile, fileList) {
        let listItem = document.createElement("div");
        listItem.classList.add("image-item");

        // Create image element for preview
        let dzImageDiv = document.createElement("div");
        dzImageDiv.classList.add("icm-image");
        let previewImage = document.createElement("img");
        previewImage.src = URL.createObjectURL(originalFile); // Display original file for preview
        previewImage.setAttribute("data-original-filename", originalFile.name);

        dzImageDiv.appendChild(previewImage);
        listItem.appendChild(dzImageDiv);

        // Create the outer div
        let overlayDiv = document.createElement("div");
        overlayDiv.classList.add("overlay");

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
        compressImage(originalFile)
            .then((compressed) => {
                previewImage.src = URL.createObjectURL(compressed);
                fileSizeText.textContent = `${formatBytes(compressed.size)}`;
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

// ends here...
