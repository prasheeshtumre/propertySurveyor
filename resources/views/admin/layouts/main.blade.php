<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title>KONU </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--font awesome-->
    <link href="{{ asset('assets/css/fonts/css2.css') }}" rel="stylesheet">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/css/animation_check.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!--
        custom Css-->

    <link href="{{ asset('assets/css/custom.min.css') }}?v=1" rel="stylesheet" type="text/css" />

    <!-- <link href="{{ asset('assets/css/unit-details.css') }}?v=fghn" rel="stylesheet" type="text/css" /> -->
    {{-- <link href="{{ asset('assets/css/fonts/all.min.css') }}?v=5"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="{{ asset('assets/css/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/dropzone/dropzone.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/fancybox/jquery.fancybox.min.css') }}" />
    @stack('css')
</head>

<body class="ristrict-scroll">

    <div class="global-loader-container ">
        <div class="center-body">
            <div class="loader-circle-9">
                <img src="{{ asset('assets/images/konu-icon.svg') }}" alt="" height="30">
                <span></span>
            </div>
        </div>
    </div>


    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.includes.header')
        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="{{ asset('assets/js/lordicon/gsqxdxog.json') }}" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                            </lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                                It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Logout Confirmation Modal-->

        <!-- ========== App Menu ========== -->
        @include('admin.includes.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')
            <!-- End Page-content -->

            @include('admin.includes.footer')
        </div>
        <!-- end main content-->
        <div class="modal fade" id="logout-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header py-2" style="background:#e1e1e1">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you want to logout ?
                    </div>
                    <div class="modal-footer pb-0 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('logout-form1').submit();">Logout</button>
                        <form id="logout-form1" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END layout-wrapper -->


    <!--end back-to-top-->
    <script>
        var apiUrl = "{{ url('/') }}";
    </script>
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/sweetalert/sweetalert2@11.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert/sweetalert.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr/toastr.min.css') }}">

    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/jquery.searchSuggestions.js') }}"></script> -->

    <!-- prismjs plugin -->
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/pages/modal.init.js') }}"></script>
    <script src="{{ asset('assets/js/idle-popup.js') }}?v=6543"></script>

    <script src="{{ asset('assets/js/validate/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/responsive.bootstrap5.min.js') }}"></script>
    <!--datatable export buttons scripts starts-->
    <script src="{{ asset('assets/js/dataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons/buttons.print.min.js') }}"></script>
    <!--datatable export buttons scripts ends-->
    <script src="{{ asset('assets/js/jspdf/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/js/compressor/compressor.js') }}"></script>
    <script src="{{ asset('assets/js/ffmpeg/ffmpeg.min.js') }}"></script>


    <script src="{{ asset('assets/js/fancybox/jquery.fancybox.min.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            'position-class': 'toast-top-full-width'
        }

        function toggleLoadingAnimation() {
            // $('html, body').scrollTop(0);
            $('.global-loader-container').toggleClass('d-none');
            ($('.global-loader-container').hasClass('d-none')) ? $('body').removeClass('ristrict-scroll'): '';
        }

        $(document).on('mousemove keydown scroll', '.global-loader-container', function() {
            ($('.global-loader-container').hasClass('d-none')) ? $('body').removeClass('ristrict-scroll'): $('body')
                .addClass('ristrict-scroll');
        })

        function toggleFileLoadingAnimation() {
            $('.lds-file-loader').toggleClass('d-none')
        }

        $(document).ready(function() {
            toggleLoadingAnimation();
        });

        $(window).on('beforeunload', function() {
            // $(window).scrollTop(0);
        });

        // $(document).on('ready', function(){
        //     toggleLoadingAnimation();
        // })
        $(document).on('ready', function() {
            $('[data-fancybox="unit_videos"]').fancybox({
                type: 'iframe',
                iframe: {
                    // css: {
                    //     width: '70%',
                    //     height: '70%'
                    // }
                }
            });
        });
    </script>
    <script src="{{ asset('assets/js/numberToWords/numberToWords.min.js') }}"></script>

    @stack('scripts')
</body>

</html>