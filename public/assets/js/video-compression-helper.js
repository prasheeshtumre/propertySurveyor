
        $(document).ready(function () {
           $(document).on('#compressButton', 'click', function () {
                compressVideo();
            });
        });

        function compressVideo() {
            const inputElement = document.getElementById('videoInput');
            const inputFile = inputElement.files[0];

            if (!inputFile) {
                alert('Please select a video file.');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                const videoData = event.target.result;
                const compressedBlob = compressWithWhammy(videoData);

                // Handle the compressed blob as needed
                saveAs(compressedBlob, 'compressed_video.webm');
            };

            reader.readAsArrayBuffer(inputFile);
        }

        function compressWithWhammy(videoData) {
            const arrayBuffer = new Uint8Array(videoData);
            const frames = Whammy.Video.fromImageArray(arrayBuffer, 30);

            // Get the blob from Whammy.js
            const blob = Whammy.fromImageArray(frames, 30);

            return blob;
        }

        // Function to save the compressed blob as a file
        function saveAs(blob, filename) {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename || 'download';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }