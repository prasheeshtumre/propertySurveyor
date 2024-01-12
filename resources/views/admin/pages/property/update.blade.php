@extends('admin.layouts.main')
@section('content')
    <style>
      .wrapper {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .checkmark__circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            stroke-width: 4;
            stroke-miterlimit: 10;
            stroke: #3fa44f;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 4;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin-bottom: 20px;
            box-shadow: inset 0px 0px 0px #3fa44f;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        .message {
            font-family: Arial, sans-serif;
            font-size: 32px;
            color: #3fa44f;
            margin-bottom: 10px;
            opacity: 0;
            animation: fade-in 1s ease-in-out 1s forwards;
        }

        .tagline {
            font-family: Arial, sans-serif;
            font-size: 20px;
            color: #666;
            opacity: 0;
            animation: fade-in 1s ease-in-out 1.5s forwards;
        }

        @keyframes stroke {
            100% {
            stroke-dashoffset: 0;
            }
        }

        @keyframes scale {
            0%, 100% {
            transform: none;
            }
            50% {
            transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
            box-shadow: inset 0px 0px 0px 50px #3fa44f;
            }
        }

        @keyframes fade-in {
            0% {
            opacity: 0;
            }
            100% {
            opacity: 1;
            }
        }
        .global-loader-container {
            display: none !important;
        }
    </style>
 
    <div class="page-content">
        <div class="container-fluid">
        @php  $back_url = '#'; @endphp
            @if(Session::has('back_url'))
                @php 
                    $back_url = Session::get('back_url');
                @endphp
            @endif
            
            <a href="{{$back_url}}"  class="back-url">
                <span class="mdi mdi-arrow-left-thin bx-md"></span>
            </a>
            <div class="row justify-content-center align-items-center " style="height: 60vh;">
                <!-- The centered column for the checkmark -->
                <div class="col-12 col-md-6 text-center d-flex justify-content-center flex-column align-items-center">
                    <div class="">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <circle class="checkmark__circle" cx="50" cy="50" r="45" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M35 50 l10 10 l25 -25"/>
                        </svg>
                    </div>
                    <h2 class="success-message">
                        @if(Session::has('message'))
                            {{Session::get('message')}}
                        @endif
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    @if(Session::has('message'))
    <script>
        $(function(){

            const myTimeout = setTimeout(intiateRedirection, 3000);

            function intiateRedirection() {
                window.location.replace("{{ $back_url }}");
            }

            function myStopFunction() {
                clearTimeout(myTimeout);
            }

        });

        
    </script>
    @endif
@endpush
