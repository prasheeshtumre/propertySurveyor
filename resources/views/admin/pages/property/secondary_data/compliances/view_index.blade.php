@if (isset($compliances))
    @if (isset($files['ghmc']))
        <div class="row file-input-wrapper my-3">
            <div class="col-xxl-3 col-md-3">
                <label for="files" class="form-label">
                    GHMC Certificate
                </label>
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                @forelse($files['ghmc'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="ghmc-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <a data-fancybox="ghmc-gallery" data-src="{{ asset($file) }}" href="javascript:;"
                            class="video-preview">
                            <img src="{{ asset('assets/images/svg/') }}/default-mp4.svg"
                                class="rounded-circle border border-light border-4" width="80" height="80"
                                alt="Video Thumbnail">
                        </a>
                    @endif
                    {{-- <span> {{ $file_name['ghmc'][$key] }} </p> --}}
                @empty
                @endforelse
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview ghmcRemove">
                </div>
            </div>
        </div>
    @endif
    @if (isset($files['commenc']))
        <div class="row file-input-wrapper my-3">
            <div class="col-xxl-3 col-md-3">
                <label for="files" class="form-label">
                    Commencement Certificate
                </label>
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                @forelse($files['commenc'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="commenc-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <a data-fancybox="commenc-gallery" data-src="{{ asset($file) }}" href="javascript:;"
                            class="video-preview">
                            <img src="{{ asset('assets/images/svg/') }}/default-mp4.svg"
                                class="rounded-circle border border-light border-4" width="80" height="80"
                                alt="Video Thumbnail">
                        </a>
                    @endif
                    {{-- <span> {{ $file_name['commenc'][$key] }} </span> --}}
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

    <div class="row file-input-wrapper">
        <div class="col-xxl-3 col-md-3">
            <label for="files" class="form-label">
                RERA Number : <span>{{ $compliances->rear_number ?? '' }}</span>
            </label>
        </div>
        @if (isset($files['rear']))
            <div class="col-xxl-12 col-md-12 mt-3">
                @forelse($files['rear'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="rera-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <a data-fancybox="rera-gallery" data-src="{{ asset($file) }}" href="javascript:;"
                            class="video-preview">
                            <img src="{{ asset('assets/images/svg/') }}/default-mp4.svg"
                                class="rounded-circle border border-light border-4" width="80" height="80"
                                alt="Video Thumbnail">
                        </a>
                    @endif
                    {{-- <span> {{ $file_name['rear'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
        @endif
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>


    <div class="row file-input-wrapper my-3">
        <div class="col-xxl-3 col-md-3">
            <label for="files" class="form-label">
                DTCP/HMDA Number : <span>{{ $compliances->hdma_number ?? '' }}</span>
            </label>
        </div>
        @if (isset($files['hmda']))
            <div class="col-xxl-12 col-md-12 mt-3">
                @forelse($files['hmda'] as $key=>$file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="dtcp-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <a data-fancybox="dtcp-gallery" data-src="{{ asset($file) }}" href="javascript:;"
                            class="video-preview">
                            <img src="{{ asset('assets/images/svg/') }}/default-mp4.svg"
                                class="rounded-circle border border-light border-4" width="80" height="80"
                                alt="Video Thumbnail">
                        </a>
                    @endif
                    {{-- <span> {{ $file_name['hmda'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
        @endif
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>

    @if (isset($files['legal']))
        <div class="row file-input-wrapper my-3">
            <div class="col-xxl-3 col-md-3">
                <label for="files" class="form-label">
                    Legal Documents
                </label>
            </div>
            <div class="col-xxl-12 col-md-12">
                @forelse($files['legal'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="legal-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <a data-fancybox="legal-gallery" data-src="{{ asset($file) }}" href="javascript:;"
                            class="video-preview">
                            <img src="{{ asset('assets/images/svg/') }}/default-mp4.svg"
                                class="rounded-circle border border-light border-4" width="80" height="80"
                                alt="Video Thumbnail">
                        </a>
                    @endif
                    {{-- <span> {{ $file_name['legal'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
            <div class="col-xxl-12 col-md-12">
                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
                </div>
            </div>
        </div>
    @endif
@else
    <div class="row file-input-wrapper my-3 text-center">
        <div class="col-xxl-12 col-md-12">
            <label for="files" class="form-label ">
                No Compliances Found
            </label>
        </div>
    </div>
@endif
