<!doctype html>
<html>
    <head>
        <style>
        .ol-popup-place {
            position: absolute;
            padding: 3px 15px 2px 15px !important;
            bottom: 12px;
            left: -50px;
            min-width: 200px;
            background-color:#fff;
            border-radius:10px;
            color: #ffffff;
            max-width: 400px;
            -webkit-box-shadow: 0px 7px 25px -5px rgba(0,0,0,0.7);
            -moz-box-shadow: 0px 7px 25px -5px rgba(0,0,0,0.7);
            box-shadow: 0px 7px 25px -5px rgba(0,0,0,0.7);
            word-wrap: break-word;
        }
        .ol-popup-place:after, .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
        .ol-popup-place:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
        .ol-popup-place:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }
    
        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: -10px !important;
            right: -10px !important;
            /*background-color: #207dff;*/
            color: #FFF !important;
            border-radius: 50%;
            width: 25px !important;
            height: 25px !important;
            text-align: center;
            padding-top: 5px !important;
            text-decoration: none;
        }
        
        .image-slideshow {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            position: relative;
            overflow: hidden;
        }
        
        .mySlides {
            display: none;
            max-width: 100%;
            height: auto;
        }
        
        .mySlides:first-child {
            display: block;
        }
        
        .slideshow-buttons {
            width: 100%;
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-between;
        }
        
        .slideshow-buttons button {
            background: none;
            border: none;
            color: black;
            font-size: 15px;
            cursor: pointer;
        }
        
        .information-component {
            padding: 5px 0;
        }
        .name-infor {
            color: #000;
            font-size: 15px;
            font-weight: 700;
        }
        .other-infor {
            margin: 5px 0;
            display: flex;
            font-size: 13px;
            font-weight: 400;
            color: #000;
            gap: 2%
        }
        .icon {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex: 1 1 15%;
        }
        .infor {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex: 1 1 83%;
        }
    </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class='place-search-component'>
            <div class='image-slideshow'>
                @foreach($photo_list as $photo)
                    <img class="mySlides" src="{{ $photo }}">
                @endforeach
                <div class="slideshow-buttons">
                    <button id="prevButton" onClick="plusDivs(-1)">
                        <i class="fa-solid fa-circle-chevron-left"></i>
                    </button>
                    <button id="nextButton" onClick="plusDivs(1)">
                        <i class="fa-solid fa-circle-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class='information-component'>
                <!--Name-->
                <div class="name-infor">{{ $name }}</div>
                <!--Open-->
                @if ($open)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="infor">{{ $open }}</div>
                </div>
                @endif
                <!--Rating-->
                @if ($rating)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="infor">{{ $rating }} Starts</div>
                </div>
                @endif
                <!--URL-->
                @if ($url_place)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="infor">
                        <a href={{$url_place}} target="_blank">{{$url_place}}</a>
                    </div>
                </div>
                @endif
                <!--Websitte-->
                @if ($website)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <div class="infor">
                        <a href={{$website}} target="_blank">{{$website}}</a>
                    </div>
                </div>
                @endif
                <!--Pluscode-->
                @if ($pluscode)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-vector-square"></i>
                    </div>
                    <div class="infor">{{ $pluscode }}</div>
                </div>
                @endif
                <!--Phone-->
                @if ($phone_number)
                <div class="other-infor">
                    <div class="icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="infor">{{ $phone_number }}</div>
                </div>
                @endif
            </div>
        </div>
    </body>
    
</html>

