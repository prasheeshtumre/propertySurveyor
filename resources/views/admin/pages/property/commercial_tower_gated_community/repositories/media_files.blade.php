<div class="accordion mt-3" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFirst">
            <button class="accordion-button collapsed repositories-accordion" type="button" data-block-id="project-repositories"
                data-bs-toggle="collapse" data-bs-target="#project-repositories" aria-expanded="true"
                aria-controls="project-repositories">
                Project Repository
            </button>
        </h2>
        <div id="project-repositories" class="accordion-collapse collapse " aria-labelledby="headingFirst"
            data-bs-parent="#accordionExample">
            @if (isset($project_repository))
                <div class="accordion-body row">
                    @if (isset($project_repository_files['brochure']))
                        <div class="col-md-6">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <div>
                                    <label for="files" class="form-label">
                                        Project Brochure</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">

                                @forelse($project_repository_files['brochure'] as $key=>$file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'PNG'], true))
                                        <a data-fancybox="gallery-project-brochure" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                    <a data-fancybox="gallery-project-brochure" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                        <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                            width="80" height="80" alt="Video Thumbnail">
                                    </a>
                                    @endif
                                    {{-- <span
                                        class="card-text">{{ ucwords($project_repository_file_name['brochure'][$key]) }}</span> --}}
                                @empty
                                @endforelse

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_files['video_files']))
                        <div class="col-md-6">
                            <div class="col-xxl-4 col-md-4 mb-3">
                                <div>
                                    <label for="files" class="form-label"> Project Promotional
                                        Video</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">

                                @forelse($project_repository_files['video_files'] as $key=> $file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                        <a data-fancybox="gallery-promotional" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                    <a data-fancybox="gallery-promotional" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                        <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                            width="80" height="80" alt="Video Thumbnail">
                                    </a>
                                    @endif
                                    {{-- <span
                                        class="card-text">{{ ucwords($project_repository_file_name['video_files'][$key]) }}</span> --}}
                                @empty
                                @endforelse

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_files['image_files']))
                        <div class="col-md-6">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <div>
                                    <label for="files" class="form-label">
                                        Images</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">

                                @forelse($project_repository_files['image_files'] as $key => $file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                        <a data-fancybox="gallery-images-files" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                    <a data-fancybox="gallery-images-files" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                        <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                            width="80" height="80" alt="Video Thumbnail">
                                    </a>
                                    @endif
                                    {{-- <span
                                        class="card-text">{{ ucwords($project_repository_file_name['image_files'][$key]) }}</span> --}}
                                @empty
                                @endforelse

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_files['3dvideo_files']))
                        <div class="col-md-6">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <div>
                                    <label for="files" class="form-label">
                                        3D View Video
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">

                                @forelse($project_repository_files['3dvideo_files'] as $key=>$file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                        <a data-fancybox="gallery-three-files" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                    <a data-fancybox="gallery-three-files" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                        <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                            width="80" height="80" alt="Video Thumbnail">
                                    </a>
                                    @endif
                                    {{-- <span
                                        class="card-text">{{ ucwords($project_repository_file_name['3dvideo_files'][$key]) }}</span> --}}
                                @empty
                                @endforelse

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_files['floor_file']))
                        <div class="col-md-6">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <div>
                                    <label for="files" class="form-label">
                                        All Floor Plans
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12">

                                @forelse($project_repository_files['floor_file'] as $key=>$file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'PNG'], true))
                                        <a data-fancybox="gallery-floor-files-img" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                    <a data-fancybox="gallery-floor-files-img" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                        <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                            width="80" height="80" alt="Video Thumbnail">
                                    </a>
                                    @endif
                                    {{-- <span
                                        class="card-text">{{ ucwords($project_repository_file_name['floor_file'][$key]) }}</span> --}}
                                @empty
                                @endforelse

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository->youtube_link))
                        <div class="col-md-6">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <label for="" class="form-label"> Youtube Link </label>
                                <div class="">
                                    <span class="card-text">{{ $project_repository->youtube_link }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_other_files))
                        <h4 id="add-btn" class="mb-3"> Others</h4>
                        <div class="row align-items-center mb-2">
                          
                                @forelse($project_repository_other_files as $key=>$file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                        <div class="col">
                                            <a data-fancybox="gallery-other-file" href="{{ $file }}" class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                            <span class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
                                        </div>
                                    @else
                                    <div class="col">
                                        <a data-fancybox="gallery-other-file" data-src="{{ asset($file) }}" href="javascript:;" class="video-preview">
                                            <img src="{{asset('assets/images/svg/')}}/default-mp4.svg" class="rounded-circle border border-light border-4"
                                                width="80" height="80" alt="Video Thumbnail">
                                        </a>
                                        <span class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
                                    </div>
                                    @endif
                                    
                                @empty
                                @endforelse


                           
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview"
                                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="accordion-body text-center">
                    No Project Repository Found
                </div>
            @endif
        </div>
    </div>

</div>
