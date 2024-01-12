<div class="accordion mt-3" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFirst">
            <button class="accordion-button repositories-accordion" type="button" data-block-id="project-repositories"
                data-bs-toggle="collapse" data-bs-target="#project-repositories" aria-expanded="true"
                aria-controls="project-repositories">
                Project Repository
            </button>
        </h2>
        <div id="project-repositories" class="accordion-collapse collapse show" aria-labelledby="headingFirst"
            data-bs-parent="#accordionExample">
            @if (isset($project_repository))
                <div class="accordion-body">
                    @if (isset($project_repository_files['brochure']))
                        <div class="row file-input-wrapper">
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
                                        <a data-fancybox="brochure-gallery" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                        <div data-fancybox="brochure-gallery" class="card " style="width: 18rem;">
                                            <video controls>
                                                <source src="{{ asset($file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
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
                        <div class="row file-input-wrapper">
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
                                        <a data-fancybox="video-gallery" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                        <div data-fancybox="video-gallery" class="card " style="width: 18rem;">
                                            <video controls>
                                                <source src="{{ asset($file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
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
                        <div class="row file-input-wrapper">
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
                                        <a data-fancybox="images-gallery" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                        <div data-fancybox="images-gallery" class="card " style="width: 18rem;">
                                            <video controls>
                                                <source src="{{ asset($file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
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
                        <div class="row file-input-wrapper">
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
                                        <a data-fancybox="threed-gallery" href="{{ $file }}" class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                        <div data-fancybox="threed-gallery" class="card " style="width: 18rem;">
                                            <video controls>
                                                <source src="{{ asset($file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
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
                        <div class="row file-input-wrapper">
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
                                        <a data-fancybox="floor-file-gallery" href="{{ $file }}"
                                            class="">
                                            <span>
                                                <img src="{{ $file }}"
                                                    class="rounded-circle border border-light border-4" width="80"
                                                    height="80"
                                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                            </span>
                                        </a>
                                    @else
                                        <div data-fancybox="floor-file-gallery" class="card " style="width: 18rem;">
                                            <video controls>
                                                <source src="{{ asset($file) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
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
                        <div class="row">
                            <div class="col-xxl-3 col-md-3 mb-3">
                                <label for="" class="form-label"> Youtube Link </label>
                                <div class="">
                                    <span class="card-text">{{ $project_repository->youtube_link }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($project_repository_other_files))
                        <div class="row align-items-center mb-2">
                            <h4 id="add-btn" class="mb-3"> Others</h4>
                            <div class="row">

                                @forelse($project_repository_other_files as $key=>$file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                        <div class="col-md-2">
                                            <a data-fancybox="others-gallery" href="{{ $file }}"
                                                class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-2">
                                            <div data-fancybox="others-gallery" class="card " style="width: 150px;">
                                                <video controls>
                                                    <source src="{{ asset($file) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    @endif
                                    <span
                                        class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
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
                    {{-- <div class="">
                    <!-- project repositories -->
                    <div class="project-repositories-body row">
                        @if (isset($project_repository->media_files))
                        @forelse( $project_repository->media_files as $media_file)
                        @if ($media_file->file_type == '3dvideo_files' || $media_file->file_type == 'video_files')
                        <div class="card col-auto" style="width: 18rem;">
                            <video controls>
                                <source src="{{asset($media_file->file_name)}}" type="video/mp4">
                Your browser does not support the video tag.
                </video>
                <div class="card-body">
                    <p class="card-text">{{ucwords($media_file->file_type)}}</p>
                </div>
                            </div>
                            @else
                            @php
                            $project_repository_file_url = asset($image->file_path . $image->file_name);
                            $extension = pathinfo($project_repository_file_url, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array(strtolower($extension), ['pdf'], true))
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="card h-100">
                                    <a href="{{$project_repository_file_url}}" target="__blank" class="text-center">
                                        <i class="fas fa-file-pdf bg-dark rounded" style="font-size: 185px; color: white; padding: 10px;"></i>
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="#">{{ucwords($image->file_type)}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'], true))
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="card h-100">
                                    <a><img class="card-img-top" src="{{$project_repository_file_url}}" alt=""></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            {{ucwords($image->file_type)}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p></p>
                            @endif
                            @endif
                            @empty
                            @endforelse
                            @endif
                        </div>
                    </div> --}}
                </div>
            @else
                <div class="accordion-body text-center">
                    No Project Repository Found
                </div>
            @endif
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSecond">
            <button class="accordion-button collapsed repositories-accordion" type="button"
                data-block-id="bt-repositories" data-bs-toggle="collapse" data-bs-target="#bt-repositories"
                aria-expanded="false" aria-controls="bt-repositories">
                Block/Tower Repository
            </button>
        </h2>
        <div id="bt-repositories" class="accordion-collapse collapse" aria-labelledby="headingSecond"
            data-bs-parent="#accordionExample">
            @if (count($block_tower_repositories) > 0)
                @if (isset($block_tower_repository_files_array))

                    @foreach ($block_tower_repository_files_array as $id => $block_tower_repository_files)
                        <div class="accordion-body">
                            <div>
                                <p class="tower-title mb-2">
                                    <b>{{ $block_tower_repositories[$id]->block->block_name ?? ($block_tower_repositories[$id]->towers->tower_name ?? '') }}</b>
                                </p>
                            </div>
                            @if (isset($block_tower_repository_files['floor_plan']))
                                <div class="row file-input-wrapper">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="floor_plan_n" class="form-label">
                                                Floor Plan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">

                                    @forelse($block_tower_repository_files['floor_plan'] as $key=>$file)
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                            <a data-fancybox="floor-plan-gallery" href="{{ $file }}"
                                                class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                        @else
                                            <div data-fancybox="floor-plan-gallery" class="card "
                                                style="width: 18rem;">
                                                <video controls>
                                                    <source src="{{ asset($file) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                        {{-- <span
                                    class="card-text">{{ ucwords($block_tower_repository_file_name['floor_plan'][$key]) }}</span> --}}
                                    @empty
                                    @endforelse

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview"
                                            class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($block_tower_repository_files['image_files']))
                                <div class="row file-input-wrapper">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="floor_plan_n" class="form-label">
                                                Images
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">

                                    @forelse($block_tower_repository_files['image_files'] as $key=>$file)
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                            <a data-fancybox="imagwe-gallery" href="{{ $file }}"
                                                class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                        @else
                                            <div data-fancybox="imagwe-gallery" class="card " style="width: 18rem;">
                                                <video controls>
                                                    <source src="{{ asset($file) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                        {{-- <span
                                    class="card-text">{{ ucwords($block_tower_repository_file_name['image_files'][$key]) }}</span> --}}
                                    @empty
                                    @endforelse

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview"
                                            class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($block_tower_repository_files['3dvideo']))
                                <div class="row file-input-wrapper">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="floor_plan_n" class="form-label">
                                                3D View Video
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">

                                    @forelse($block_tower_repository_files['3dvideo'] as $key=>$file)
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                            <a data-fancybox="three-d-gallery" href="{{ $file }}"
                                                class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                        @else
                                            <div data-fancybox="three-d-gallery" class="card "
                                                style="width: 18rem;">
                                                <video controls>
                                                    <source src="{{ asset($file) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                        {{-- <span
                                    class="card-text">{{ ucwords($block_tower_repository_file_name['3dvideo'][$key]) }}</span> --}}
                                    @empty
                                    @endforelse

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview"
                                            class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($block_tower_repository_files['tower_video']))
                                <div class="row file-input-wrapper">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <div>
                                            <label for="floor_plan_n" class="form-label">
                                                Tower/Unit Video
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">

                                    @forelse($block_tower_repository_files['tower_video'] as $key=>$file)
                                        @php
                                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                            <a data-fancybox="tower-v-gallery" href="{{ $file }}"
                                                class="">
                                                <span>
                                                    <img src="{{ $file }}"
                                                        class="rounded-circle border border-light border-4"
                                                        width="80" height="80"
                                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                </span>
                                            </a>
                                        @else
                                            <div data-fancybox="tower-v-gallery" class="card "
                                                style="width: 18rem;">
                                                <video controls>
                                                    <source src="{{ asset($file) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                        {{-- <span
                                    class="card-text">{{ ucwords($block_tower_repository_file_name['3dvideo'][$key]) }}</span> --}}
                                    @empty
                                    @endforelse

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview"
                                            class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($block_tower_repositories[$id]->youtube_link))
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <label for="" class="form-label"> Youtube Link </label>
                                        <div class="">
                                            <span
                                                class="card-text">{{ $block_tower_repositories[$id]->youtube_link }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($block_tower_repository_other_files[$id]))
                                <div class="row align-items-center mb-2">
                                    <h4 id="add-btn" class="mb-3"> Others</h4>
                                    <div class="col-xxl-12 col-md-12">

                                        @forelse($block_tower_repository_other_files[$id] as $key=>$file)
                                            @php
                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                                                <a data-fancybox="others-gallery" href="{{ $file }}"
                                                    class="">
                                                    <span>
                                                        <img src="{{ $file }}"
                                                            class="rounded-circle border border-light border-4"
                                                            width="80" height="80"
                                                            onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                                    </span>
                                                </a>
                                            @else
                                                <div data-fancybox="others-gallery" class="card "
                                                    style="width: 18rem;">
                                                    <video controls>
                                                        <source src="{{ asset($file) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            @endif
                                            <span
                                                class="card-text">{{ ucwords($block_tower_repository_other_file_name[$id][$key]) }}</span>
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
                        </div>
                    @endforeach
                @endif
            @else
                <div class="accordion-body text-center">
                    No Repository Found
                </div>
            @endif
        </div>
    </div>
</div>
