@if (isset($compliances))
    @if (isset($files['ghmc']))
        <div class="col-md-6 file-input-wrapper ">
            <div class="">
                <label for="files" class="form-label">
                    GHMC Certificate
                </label>
            </div>
            <div class="col-xxl-12 col-md-12 ">
                @forelse($files['ghmc'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="ghmc-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="ghmc-gallery">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    {{-- <span> {{ $file_name['ghmc'][$key] }} </p> --}}
                @empty
                @endforelse
            </div>
            <div class="col-xxl-12 col-md-12 ">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview ghmcRemove">
                </div>
            </div>
        </div>
    @endif
    @if (isset($files['commenc']))
        <div class="col-md-6 file-input-wrapper ">
            <div class="">
                <label for="files" class="form-label">
                    Commencement Certificate
                </label>
            </div>
            <div class="col-xxl-12 col-md-12 ">
                @forelse($files['commenc'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="commenc-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="commenc-gallery">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    {{-- <span> {{ $file_name['commenc'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
            <div class="col-xxl-12 col-md-12 ">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">
                </div>
            </div>
        </div>
    @endif

    <div class="col-md-6 file-input-wrapper">
        <div class="">
            <label for="files" class="form-label">
                RERA Number : <span>{{ $compliances->rear_number ?? '' }}</span>
            </label>
        </div>
        @if (isset($files['rear']))
            <div class="col-xxl-12 col-md-12 ">
                @forelse($files['rear'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="rear-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="rear-gallery">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    {{-- <span> {{ $file_name['rear'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
        @endif
        <div class="col-xxl-12 col-md-12 ">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>


    <div class="col-md-6 file-input-wrapper ">
        <div class="">
            <label for="files" class="form-label">
                DTCP/HMDA Number : <span>{{ $compliances->hdma_number ?? '' }}</span>
            </label>
        </div>
        @if (isset($files['hmda']))
            <div class="col-xxl-12 col-md-12 ">
                @forelse($files['hmda'] as $key=>$file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="hmda-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="hmda-gallery">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                    {{-- <span> {{ $file_name['hmda'][$key] }} </span> --}}
                @empty
                @endforelse
            </div>
        @endif
        <div class="col-xxl-12 col-md-12 ">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>

    @if (isset($files['legal']))
        <div class="col-md-6 file-input-wrapper ">
            <div class="">
                <label for="files" class="form-label">
                    Legal Documents
                </label>
            </div>
            <div class="col-xxl-12 col-md-12">
                @forelse($files['legal'] as $key=> $file)
                    @php
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                        <a data-fancybox="legal-gallery" href="{{ $file }}" class="">
                            <span>
                                <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                    width="80" height="80"
                                    onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                            </span>
                        </a>
                    @else
                        <div class="card " style="width: 18rem;">
                            <video controls data-fancybox="legal-gallery">
                                <source src="{{ asset($file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
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
    <div class="col-md-6 file-input-wrapper  text-center">
        <div class="col-xxl-12 col-md-12">
            <label for="files" class="form-label ">
                No Compliances Found
            </label>
        </div>
    </div>
@endif
