@extends('admin.layouts.main')
@section('content')
<link href="https://survey.proper-t.co/public/assets/css/show-property-details.css?v=34563353" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <form action="{{ route('gis-engineer.gis-id-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->has('import'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->get('import') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('success'))
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5>{!! Session::get('success') !!}</h5>
                            </div>
                        </div>
                    </div>
                    @endif

                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
     
    </div>
</div>
@endsection
@push('scripts')
<script>
   $(document).ready(function() {
    // Define an array of elements to track
    var elementsToTrack = ['#view-blocks--floors', '#view-property-status', '#element3']; // Add your element IDs here

    // Function to check if an element is in the viewport
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= $(window).height() &&
            rect.right <= $(window).width()
        );
    }

    // Function to handle the scroll event and check element visibility
    function handleScroll() {
        for (var i = 0; i < elementsToTrack.length; i++) {
            var element = $(elementsToTrack[i]);
            if(element.hasClass('data-cached') == false) {
                if (isElementInViewport(element[0])) {
                    // The element is visible on scroll
                    element.addClass('data-cached');
                    alert(`now element ${i} is visible and data-cached status is: ${element.hasClass('data-cached')}`)
                    // You can add any other actions you want to perform here
                }
            }
        }
    }

    // Add a scroll event listener to the window using jQuery
    $(window).on('scroll', handleScroll);
});

</script>
@endpush