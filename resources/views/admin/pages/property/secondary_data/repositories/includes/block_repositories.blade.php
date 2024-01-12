 <form id="TowerRepositoryForm" method="POST" enctype="multipart/form-data">
     @csrf
     <div class="row">
         <div class="col-xxl-3 col-md-3 mb-3">
             <div>
                 <label for="block_tower_id" class="form-label">
                     @if (isset($property) && $property->residential_type == 7)
                         Select Block/Tower
                     @else
                         Select Block/Unit
                     @endif
                     <span class="errorcl">*</span>
                 </label>
                 <select class="form-control" name="block_tower_id" id="block_tower_id">
                     <option value="">select</option>
                     @forelse($block_tower as $key => $value)
                         <option value={{ $value->id }}>{{ $value->name }}</option>
                     @empty
                         <option value="">No option</option>
                     @endforelse
                 </select>
                 <span class="clr_err text-danger othe_errr block_tower_id_err"></span>
             </div>
         </div>
     </div>
 </form>
 <div class="d-none" id="bt_files_upload">
     <div class="row file-input-wrapper">
         <div class="col-xxl-12 col-md-12 mb-12">
             <div>
                 <label for="floor_plan_n" class="form-label">
                     Floor Plan
                 </label>
                 <div class="d-flex justify-content-center flex-column ">
                     <form class="unit-gallery-zone icm-zone">
                         <div class="icm-file-list"></div>
                         <input type="file" id="bt_floor_plan" class="files img-upload" multiple
                             style="display: none;"
                             data-action="{{ url('surveyor/property/gated-community-details/block-repository/floor-plan-files') }}">
                         <div>
                             <input type="hidden" name="block_tower_id" value="" id="block_tower_val">

                             @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                         </div>
                         <div class="row old-files-icm-lable-preview-group">
                             <label for="bt_floor_plan" class="icm-zone-label col">Click here to upload Floor
                                 Plan</label>
                         </div>
                     </form>
                 </div>
                 <span class="clr_err text-danger othe_errr floor_plan_n_err"></span>

             </div>
         </div>
         <div class="col-xxl-12 col-md-12">
             @if (isset($block_tower_repository_files['floor_plan']))
                 @forelse($block_tower_repository_files['floor_plan'] as $file)
                     @php
                         $extension = pathinfo($file, PATHINFO_EXTENSION);
                     @endphp
                     @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                         <a data-fancybox="floor-plan" href="{{ $file }}" class="">
                             <span>
                                 <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                     width="80" height="80"
                                     onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                             </span>
                         </a>
                     @else
                         <div class="card " style="width: 18rem;">
                             <video controls data-fancybox="floor-plan">
                                 <source src="{{ asset($file) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                             </video>
                         </div>
                     @endif
                 @empty
                 @endforelse
             @endif
         </div>
         <div class="col-xxl-12 col-md-12 mt-3">
             <div id="files-preview"
                 class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

             </div>
         </div>
     </div>
     <div class="row file-input-wrapper">
         <div class="col-xxl-12 col-md-12 mb-12">
             <div>
                 <label for="image_files_n" class="form-label">
                     Images
                 </label>
                 <div class="d-flex justify-content-center flex-column ">
                     <form class="unit-gallery-zone icm-zone">
                         <div class="icm-file-list"></div>
                         <input type="file" id="bt_image_file" class="files img-upload" multiple
                             style="display: none;"
                             data-action="{{ url('surveyor/property/gated-community-details/block-repository/image-files') }}">
                         <div>
                             @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                         </div>
                         <div class="row old-files-icm-lable-preview-group">
                             <label for="bt_image_file" class="icm-zone-label col">Click here to upload Images</label>
                         </div>
                     </form>
                 </div>
                 <span class="clr_err text-danger othe_errr image_files_n_err"></span>
             </div>
         </div>
         <div class="col-xxl-12 col-md-12">
             @if (isset($block_tower_repository_files['image_files']))
                 @forelse($block_tower_repository_files['image_files'] as $file)
                     @php
                         $extension = pathinfo($file, PATHINFO_EXTENSION);
                     @endphp
                     @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                         <a data-fancybox="image-file-gallery" href="{{ $file }}" class="">
                             <span>
                                 <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                     width="80" height="80"
                                     onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                             </span>
                         </a>
                     @else
                         <div class="card " style="width: 18rem;">
                             <video controls data-fancybox="image-file-gallery">
                                 <source src="{{ asset($file) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                             </video>
                         </div>
                     @endif
                 @empty
                 @endforelse
             @endif
         </div>
         <div class="col-xxl-12 col-md-12 mt-3">
             <div id="files-preview"
                 class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

             </div>
         </div>
     </div>
     <div class="row file-input-wrapper">
         <div class="col-xxl-12 col-md-12 mb-12">
             <div>
                 <label for="3dvideo_n" class="form-label">
                     3D View Video
                 </label>
                 <div class="d-flex justify-content-center flex-column ">
                     <form class="unit-gallery-zone icm-zone">
                         <div class="icm-file-list"></div>
                         <input type="file" id="bt_3dvideo_n" class="files img-upload" multiple
                             style="display: none;"
                             data-action="{{ url('surveyor/property/gated-community-details/block-repository/three-dimentional-view-video-files') }}">
                         <div>
                             @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                         </div>
                         <div class="row old-files-icm-lable-preview-group">
                             <label for="bt_3dvideo_n" class="icm-zone-label col">Click here to upload 3D View Video
                                 Files</label>
                         </div>
                     </form>
                 </div>
                 <span class="clr_err text-danger othe_errr 3dvideo_n_err"></span>
             </div>
         </div>
         <div class="col-xxl-12 col-md-12">
             @if (isset($block_tower_repository_files['3dvideo']))
                 @forelse($block_tower_repository_files['3dvideo'] as $file)
                     @php
                         $extension = pathinfo($file, PATHINFO_EXTENSION);
                     @endphp
                     @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                         <a data-fancybox="3dvideo-gallery" href="{{ $file }}" class="">
                             <span>
                                 <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                     width="80" height="80"
                                     onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                             </span>
                         </a>
                     @else
                         <div class="card " style="width: 18rem;">
                             <video controls data-fancybox="3dvideo-gallery">
                                 <source src="{{ asset($file) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                             </video>
                         </div>
                     @endif
                 @empty
                 @endforelse
             @endif
         </div>
         <div class="col-xxl-12 col-md-12 mt-3">
             <div id="files-preview"
                 class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

             </div>
         </div>
     </div>
     <div class="row file-input-wrapper">
         <div class="col-xxl-12 col-md-12 mb-12">
             <div>
                 <label for="tower_video_n" class="form-label">
                     Tower Video
                 </label>
                 <div class="d-flex justify-content-center flex-column ">
                     <form class="unit-gallery-zone icm-zone">
                         <div class="icm-file-list"></div>
                         <input type="file" id="bt_tower_video_n" class="files img-upload" multiple
                             style="display: none;"
                             data-action="{{ url('surveyor/property/gated-community-details/block-repository/tower-video') }}">
                         <div>
                             @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                         </div>
                         <div class="row old-files-icm-lable-preview-group">
                             <label for="bt_tower_video_n" class="icm-zone-label col">Click here to upload Tower Video
                                 Files</label>
                         </div>
                     </form>
                 </div>
                 <span class="clr_err text-danger othe_errr tower_video_n_err"></span>

             </div>
         </div>
         <div class="col-xxl-12 col-md-12">
             @if (isset($block_tower_repository_files['tower_video']))
                 @forelse($block_tower_repository_files['tower_video'] as $file)
                     @php
                         $extension = pathinfo($file, PATHINFO_EXTENSION);
                     @endphp
                     @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                         <a data-fancybox="tower-gallery" href="{{ $file }}" class="">
                             <span>
                                 <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                     width="80" height="80"
                                     onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                             </span>
                         </a>
                     @else
                         <div class="card " style="width: 18rem;">
                             <video controls data-fancybox="tower-gallery">
                                 <source src="{{ asset($file) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                             </video>
                         </div>
                     @endif
                 @empty
                 @endforelse
             @endif
         </div>
         <div class="col-xxl-12 col-md-12 mt-3">
             <div id="files-preview"
                 class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

             </div>
         </div>
     </div>

     <div class="row ">
         <h4 id="add-btn" class="mb-3"> Others </h4>
         <div class="" id="container1">
             <div class=" row align-items-end original-div file-input-wrapper">
                 <div class="col-xxl-12 col-md-12 mb-12 ">
                     <div class="form-group">
                         <label for="addFloor_n" class="form-label"> Upload (PDF, Images)
                         </label>
                         <div class="d-flex justify-content-center ">
                             <div>
                                 <form class="unit-gallery-zone icm-zone">
                                     <div class="row">
                                         <div class="col-md-6 m-2">
                                             @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                                             <label for="files" class="form-label"> Enter the Name </label>
                                             <input type="text" name="name"
                                                 class="form-control other_file_name" id="" placeholder=""
                                                 value="">
                                         </div>
                                     </div>
                                     <div class="icm-file-list"></div>
                                     <input type="file" id="bt_other_files-img" class="files img-upload"
                                         style="display: none;"
                                         data-action="{{ url('surveyor/property/gated-community-details/block-repository/other-files') }}">

                                     <div class="row old-files-icm-lable-preview-group">
                                         <label for="bt_other_files-img" class="icm-zone-label col">Click here to
                                             upload
                                             Other Files</label>
                                     </div>
                                 </form>
                             </div>
                             <div>
                                 <span class="addpuls" onclick="clone_div1()"> <i class="fa-solid fa-plus"></i>
                                 </span>
                             </div>


                         </div>
                     </div>
                 </div>
                 <div class="col-xxl-12 col-md-12 mt-3">
                     <div id="files-preview"
                         class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                     </div>
                 </div>
             </div>
             <div id="app_div1">



             </div>
         </div>
         <div class="col-xxl-12 col-md-12">
             @if (isset($block_tower_repository_other_files))
                 @forelse($block_tower_repository_other_files as $key=>$file)
                     @php
                         $extension = pathinfo($file, PATHINFO_EXTENSION);
                     @endphp
                     @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                         <a data-fancybox="pthers-gallery" href="{{ $file }}" class="">
                             <span>
                                 <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                     width="80" height="80"
                                     onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                             </span>
                         </a>
                     @else
                         <div class="card " style="width: 18rem;">
                             <video controls data-fancybox="pthers-gallery">
                                 <source src="{{ asset($file) }}" type="video/mp4">
                                 Your browser does not support the video tag.
                             </video>
                         </div>
                     @endif
                     <span class="card-text">{{ ucwords($block_tower_repository_other_file_name[$key]) }}</span>
                 @empty
                 @endforelse
             @endif
         </div>
         <div class="col-md-12">
             <form id="TowerRepositoryFormLink" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="col-xxl-3 col-md-3 mb-3">
                     <label for="" class="form-label"> Youtube Link </label>
                     <div class="">
                         @include('admin.pages.property.secondary_data.repositories.includes.property_info')
                         <input type="text" name="youtube_link" id="" class="form-control"
                             multiple="" value="{{ $block_tower_repository->youtube_link ?? '' }}"
                             placeholder="">
                     </div>
                 </div>
                 <div class="text-end">
                     <!-- <input type="submit" class="btn btn-md btn-primary" value="Save & Proceed" /> -->

                     <input type="submit" class="btn btn-md btn-primary" value="Save" />
                     <button type="button" class="btn btn-md btn-primary repositories-next-btn">Proceed</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
