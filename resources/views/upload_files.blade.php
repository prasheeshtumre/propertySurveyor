@extends('admin.layouts.main')
@section('content')
<style>
.dz-remove {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
    
    margin-top: 4px;
}


.dz-image {
    border: 1px solid #d1d1d1;
    border-radius: 8px !important;
}
</style>
<div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
          
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('surveyor.property.image.dropzone.store')}}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="image-upload">
                            @csrf
                            <div>
                            <h3 class="text-center">Upload Images</h3>
                            <input type="hidden" name="property_id" value="345">
                        </div>    
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>--}}
   
    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        var dropzone = new Dropzone ("#image-upload", {
            // maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            // autoProcessQueue: false,
            addRemoveLinks: true, // Don't show remove links on dropzone itself.
            dictRemoveFile: "Remove",
        });

        dropzone.on("removedfile", function(file){
            alert('remove triggered');
        });

        dropzone.on("addedfile", function(file){
            if (file instanceof File) {
                var compressor = new Compressor(file, {
                    maxWidth: 800, // Set the maximum width for the compressed image
                    maxHeight: 800, // Set the maximum height for the compressed image
                    quality: 0.8, // Set the quality of the compressed image (0.1 to 1)
                    mimeType: "image/jpeg", // Set the desired MIME type of the compressed image
                    success: function(result) {
                        // Remove the original file from the Dropzone queue
                        dropzone.removeFile(file);
                        dropzone.addFile(result); // Add the compressed file to the dropzone
                        logFileSize(result);
                        alert('add triggered');
                    },
                    error: function(err) {
                        console.error("File compression error:", err.message);
                    }
                });
            }
        });

        dropzone.on("accept", function(file) {
            // Remove the original file from the preview
            var originalFiles = dropzone.getAcceptedFiles().filter(function(f) {
                return f !== file;
            });
            dropzone.removeAllFiles();
            originalFiles.forEach(function(f) {
                dropzone.addFile(f);
            });
        });

        function logFileSize(file) {
            var fileSizeInMB = file.size / (1024 * 1024);
            console.log("Compressed file size:", fileSizeInMB.toFixed(2), "MB");
        }

    </script>
    @endpush

