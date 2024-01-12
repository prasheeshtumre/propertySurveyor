@extends('admin.layouts.main')
@section('content')
    <style>
        .global-loader-circle-2 {
            position: absolute;
            width: 70px;
            height: 70px;
            top: 45%;
            left: 50%;
            display: inline-block;
        }

        .global-loader-circle-2:before,
        .global-loader-circle-2:after {
            content: "";
            display: block;
            position: absolute;
            border-width: 5px;
            border-style: solid;
            border-radius: 50%;
        }

        .global-loader-circle-2:before {
            width: 70px;
            height: 70px;
            border-bottom-color: #fbfbfb;
            border-right-color: #fbfbfb;
            border-top-color: transparent;
            border-left-color: transparent;
            animation: global-loader-circle-2-animation-2 1s linear infinite;
        }

        .global-loader-container {
            width: 100%;
            background-color: rgb(0 0 0 / 30%);
            height: 100%;
            position: absolute;
            z-index: 9999;
        }

        .global-loader-circle-2:after {
            width: 40px;
            height: 40px;
            border-bottom-color: #fbfbfb;
            border-right-color: #fbfbfb;
            border-top-color: transparent;
            border-left-color: transparent;
            top: 22%;
            left: 22%;
            animation: global-loader-circle-2-animation 0.85s linear infinite;
        }

        @keyframes global-loader-circle-2-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-360deg);
            }
        }

        @keyframes global-loader-circle-2-animation-2 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
