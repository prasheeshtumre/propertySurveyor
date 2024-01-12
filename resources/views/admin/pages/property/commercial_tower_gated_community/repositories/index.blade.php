@if ($block_id == 'project-repositories')
    <div class="row file-input-wrapper">
        <div class="col-xxl-12 col-md-12 mb-12">
            <div>
                <label for="files" class="form-label">
                    Project Brochure</label>
                <div class="d-flex justify-content-center flex-column ">
                    <form class="unit-gallery-zone icm-zone">
                        <div class="icm-file-list"></div>
                        <input type="file" id="project_brochure_file" class="files img-upload" multiple
                            style="display: none;"
                            data-action="{{ route('commercial-tower.repositories.brochure-files') }}">
                        <div>
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                        </div>
                        <div class="row old-files-icm-lable-preview-group">
                            <label for="project_brochure_file" class="icm-zone-label col">Click here to upload Project
                                Brochure files</label>
                        </div>
                    </form>
                </div>
                <span class="clr_err text-danger othe_errr brochure_file_err"></span>

            </div>

        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_files['brochure']))
                @forelse($project_repository_files['brochure'] as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="gallery-project-brochure" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="gallery-project-brochure">
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
                <label for="files" class="form-label">
                    Project Promotional Video</label>
                <div class="d-flex justify-content-center flex-column ">
                    <form class="unit-gallery-zone icm-zone">
                        <div class="icm-file-list"></div>
                        <input type="file" id="project_promotional_video" class="files img-upload" multiple
                            style="display: none;"
                            data-action="{{ route('commercial-tower.repositories.promotional-video-files') }}">
                        <div>
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                        </div>
                        <div class="row old-files-icm-lable-preview-group">
                            <label for="project_promotional_video" class="icm-zone-label col">Click here to upload
                                Project Promotional Video files</label>
                        </div>
                    </form>
                </div>
                <span class="clr_err text-danger othe_errr video_files_err"></span>

            </div>

        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_files['video_files']))
                @forelse($project_repository_files['video_files'] as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="video-files" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="video-files">
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
                <label for="files" class="form-label">
                    Images</label>
                <div class="d-flex justify-content-center flex-column ">
                    <form class="unit-gallery-zone icm-zone">
                        <div class="icm-file-list"></div>
                        <input type="file" id="image_files" class="files img-upload" multiple style="display: none;"
                            data-action="{{ route('commercial-tower.repositories.image-files') }}">
                        <div>
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                        </div>
                        <div class="row old-files-icm-lable-preview-group">
                            <label for="image_files" class="icm-zone-label col">Click here to upload Image files</label>
                        </div>
                    </form>
                    <span class="clr_err text-danger othe_errr image_files_err"></span>
                </div>

            </div>
        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_files['image_files']))
                @forelse($project_repository_files['image_files'] as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="gallery-images-files" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="gallery-images-files">
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
                <label for="files" class="form-label">
                    3D View Video
                </label>
                <div class="d-flex justify-content-center flex-column ">
                    <form class="unit-gallery-zone icm-zone">
                        <div class="icm-file-list"></div>
                        <input type="file" id="view_video_files" class="files img-upload" multiple
                            style="display: none;"
                            data-action="{{ route('commercial-tower.repositories.view-video-files') }}">
                        <div>
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                        </div>
                        <div class="row old-files-icm-lable-preview-group">
                            <label for="view_video_files" class="icm-zone-label col">Click here to upload 3D Video
                                Files</label>
                        </div>
                    </form>
                </div>
                <span class="clr_err text-danger othe_errr 3dvideo_files_err"></span>

            </div>
        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_files['3dvideo_files']))
                @forelse($project_repository_files['3dvideo_files'] as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="gallery-threed" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="gallery-threed">
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
                <label for="files" class="form-label">
                    All Floor Plans
                </label>
                <div class="d-flex justify-content-center flex-column ">
                    <form class="unit-gallery-zone icm-zone">
                        <div class="icm-file-list"></div>
                        <input type="file" id="all_floor_plan_file" class="files img-upload" multiple
                            style="display: none;"
                            data-action="{{ route('commercial-tower.repositories.floor-files') }}">
                        <div>
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                        </div>
                        <div class="row old-files-icm-lable-preview-group">
                            <label for="all_floor_plan_file" class="icm-zone-label col">Click here to upload Floor
                                Files</label>
                        </div>
                    </form>
                </div>
                <span class="clr_err text-danger othe_errr floor_file_err"></span>

            </div>
        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_files['floor_file']))
                @forelse($project_repository_files['floor_file'] as $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="gallery-floor-file" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="gallery-floor-file">
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

    <div class="row align-items-center mb-2">

        {{-- <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="" class="form-label">
                        Website Address </label>
                    <input type="text" class="form-control " name="website">
                </div>
                    <span class="clr_err text-danger othe_errr website_err"></span>

            </div> --}}

        <h4 id="add-btn" class="mb-3"> Others </h4>
        <div class="" id="container1">
            <div class=" row align-items-end original-div file-input-wrapper">
                <div class="col-xxl-12 col-md-12 mb-12 ">
                    <div class="form-group">
                        <label for="files" class="form-label"> Upload (PDF, Images)
                        </label>
                        <div class="d-flex justify-content-center  ">
                            <div>
                                <form class="unit-gallery-zone icm-zone">
                                    <div class="row">
                                        <div class="col-md-6 m-2">
                                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                                            <label for="files" class="form-label"> Enter the Name </label>
                                            <input type="text" name="name" class="form-control other_file_name"
                                                id="" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="icm-file-list"></div>
                                    <input type="file" id="other_files-img" class="files img-upload"
                                        style="display: none;"
                                        data-action="{{ route('commercial-tower.repositories.other-files') }}">

                                    <div class="row old-files-icm-lable-preview-group">
                                        <label for="other_files-img" class="icm-zone-label col">Click here to upload
                                            Other Files</label>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <span class="addpuls" onClick="clone_div()"> <i class="fa-solid fa-plus"></i>
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
            <div id="app_div"> </div>
        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($project_repository_other_files))
                @forelse($project_repository_other_files as $key=>$file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="gallery-other-file" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="gallery-other-file">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    <span class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
                @empty
                @endforelse
            @endif
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview"
                class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

            </div>
        </div>


        <div class="col-md-12">
            <form id="ProjectRepositoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xxl-3 col-md-3 mb-3">
                        <label for="" class="form-label"> Youtube Link </label>
                        <div class="">
                            @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.property_info')
                            <input type="text" name="youtube_link" id="" class="form-control"
                                maxlength="500" placeholder=""
                                value="{{ $project_repository->youtube_link ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <input type="submit" class="btn btn-md btn-primary" value="Save & Proceed" />
                </div>
            </form>
        </div>
    </div>
    {{-- @elseif($block_id == 'bt-repositories')
    @include('admin.pages.property.commercial_tower_gated_community.repositories.includes.block_repositories') --}}
@endif
{{-- <script src="{{ asset('assets/js/property/gated/image-compression-helper.js') }}?v=154"></script> --}}
{{-- <script src="{{ asset('assets/js/property/gated/add-repository-images.js') }}?v=12jvjv6546"></script> --}}
