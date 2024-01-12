<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('webgis/css/control/searchbox.css') }}">
    <link rel="stylesheet" href="{{ asset('webgis/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('webgis/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('webgis/css/popup.css') }}">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://konu.co.in/dev.survey.proper-t.co/public/assets/images/favicon.svg">

    <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="{{ asset('webgis/css/ol/ol3gm.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('webgis/css/ol/ol.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('webgis/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('webgis/css/control/layerswitchercontrol.css') }}" />
    <link rel="stylesheet" href="{{ asset('webgis/css/control/controlbar.css') }}" type="text/css" />
    <link href="{{ asset('webgis/css/ol3-geocoder.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('webgis/css/loading.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0ma/css/font-awesome.min.css">
    <title>KONU WebGIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="{{ asset('webgis/js/jquery-2.2.4.min.js') }}"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('webgis/css/mystyle.css') }}?v=85256">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .query-link label {
            font-weight: 400 !important;
            ;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
        }

        .link_style {
            padding-top: 2px;
        }

        .custom-checkbox {
            position: relative;
            left: 0;
            top: 0;
        }

        .custom-checkbox-input {
            display: none;
        }

        .custom-checkbox-text {
            padding: 1rem;
            background-color: #aaa;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox-input:checked~.custom-checkbox-text {
            background-color: red;
            color: white;
        }

        .hide-search {
            display: none !important;
        }

        .show-search {
            display: inline-block !important;
        }

        #search-results {
            position: absolute;
            display: none;
            top: 60px;
            right: 10px;
            background-color: #fff;
            font-weight: 500;
            font-size: 13px;
            font-family: 'Titillium Web', sans-serif;
            border: 1px solid #0074e4;
            z-index: 100000;
        }

        #search-results div {
            padding: 10px;
            cursor: pointer;
            border-bottom: solid 1px #000;
        }

        .autoComplete_wrapper>ul {
            z-index: 100000 !important;
        }

        .metro-card-container {
            min-width: 80px !important;
        }

        .metro-card-content {
            padding: 10px;
            color: #000 !important;
            font-weight: bolder;
            font-size: 15px;
        }

        .metro-clo-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 27px;
            height: 27px;
            color: white;
            position: absolute;
            top: -2px !important;
            right: -2px !important;
            background-color: #f7931d;
            border-radius: 50%;
            font-weight: bold;
        }

        .forsale {
            max-height: 190px;
            min-height: 0px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .img-right-text {
            line-height: 1.2;
        }

        .toplink {
            text-decoration: none;
        }

        .imgwidth {
            border-radius: 5px;
            width: 108px;
            height: 80px;
        }

        @media (max-width: 767.98px) {
            .ol-layerswitcher.ol-unselectable.ol-control {
                height: 300px !important;
            }
        }

        .dropdown-menu-gis {
            z-index: 99999 !important;
            width: 240px;
        }

        .dropdown-menu-gis li {
            padding: 10px;
            border-bottom: solid 1px #f9f9f9;
        }

        .dropdown-menu-gis li img {
            margin-right: 15px;
        }
    </style>
</head>

<body>
    <div id="ajaxLoader" class="ajax-loader">
        <div class="signal"></div>
    </div>
    <!--<div id="metro-card" class="ol-popup animate__animated animate__flipInX">-->
    <!--    <a href="#" id="metro-card-closer" class="ol-popup-closer">-->
    <!--        <i class="fa-solid fa-circle-xmark clo_btn"></i>-->
    <!--    </a>-->
    <!--    <div id="metro-card-content"></div>-->
    <!--</div>-->
    <div id="place-card" class="ol-popup-place animate__animated animate__flipInX">
        <a href="#" id="card-closer" class="ol-popup-closer">
            <i class="fa-solid fa-circle-xmark clo_btn"></i>
        </a>
        <div id="card-content"></div>
    </div>
    <div id="popup" class="ol-popup animate__animated animate__flipInX">
        <a href="#" id="popup-closer" class="ol-popup-closer">
            <i class="fa-solid fa-circle-xmark clo_btn"></i>
        </a>
        <div id="popup-content"></div>
        <!--<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>-->
        <!--<script>
            -- >
            <
            !--Fancybox.bind('[data-fancybox="gallery"]', {
                -- >
                //
                <
                !--
            });
            -- >
            <
            !--
        </script>-->
    </div>
    <div id="popupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Information</h4>
                </div>
                <div id="popupModalContent" class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row headerRow">
            <div class="col-md-3 d-none d-md-block d-lg-block">
                <div class="heading"> <img src="{{ asset('webgis/images/konu-logo.svg') }}" style="width: 160px;">
                </div>
            </div>
            <!--<div class="col-md-2 link_style">-->
            <!--    <a href="https://municipalservices.in/gissurvey/statastics.php" target="_blank" style="color:#fff;text-decoration:none;font-size:16px;">Survey Abstract</a>-->
            <!--</div>-->
            <!--<div class="col-md-2 link_style">-->
            <!--    <a href="http://municipalservices.in/gissurvey/webgis/points/overall_map.php" target="_blank" style="color:#fff;text-decoration:none;font-size:16px;">Mission Bhagiratha</a>-->
            <!--</div>-->
            <!--<div class="col-md-1" style="padding-left: 0px;">
                <img src="images/mepma.png" width="40" height="40" class="pos">
            </div>-->
            <div class="col-md-9 bg-orange d-flex justify-content-between gap-3">
                <div>
                    <img src="{{ asset('webgis/images/konu-logo-white.svg') }}" style="width: 140px;"
                        class="d-block d-md-none d-lg-none" />
                </div>
                <!--<input id="google-search-input" type="search" dir="ltr" class="d-flex align-items-center hide-search">-->
                <input type="text" id="google-search-input" placeholder="Enter a place"
                    class="d-flex align-items-center hide-search">
                <!--<div class="btns">-->
                <div class="d-flex justify-content-end">
                    <div id="Query"> <button class="btn btn-query" onclick="gettheme('Query')"
                            style="background-color:#fff; color:#027F8B;">
                            <!--<img src="{{ asset('webgis/images/filters.png') }}" width="30">-->
                            <i class="fa-solid fa-sliders"></i>
                        </button> </div>

                    <div class="dropdown">
                        <button class="btn btn-query " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="background-color:#fff; color:#027F8B;">
                            <!--<img src="{{ asset('webgis/images/filters.png') }}" width="30">-->
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-gis">
                            <li class="d-flex align-items-center">
                                <img src="{{ asset('webgis/images/icon_commercial_one.png') }}"
                                    style="width: 40px;" />
                                <span>Commercial</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="{{ asset('webgis/images/icon_demolished_one.png') }}"
                                    style="width: 40px;" />
                                <span>Demolished</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="{{ asset('webgis/images/icon_multiunit_one.png') }}"
                                    style="width: 40px;" />
                                <span>Multiunit</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="{{ asset('webgis/images/icon_plot_land_one.png') }}"
                                    style="width: 40px;" />
                                <span>Plot Land</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="{{ asset('webgis/images/icon_residency_one.png') }}"
                                    style="width: 40px;" />
                                <span>Residency</span>
                            </li>
                            <li class="d-flex align-items-center pb-2" style="border-bottom:none">
                                <img src="{{ asset('webgis/images/icon_under_construction_one.png') }}"
                                    style="width: 40px;" />
                                <span>Under Construction</span>
                            </li>
                            <li class="dropdown-divider p-0" style="border-bottom:none"></li>
                            <li class="d-flex align-items-center">
                                <div class="d-flex align-items-center" style="width:50%">
                                    <span><i class="fa-solid fa-circle me-2" style="color:#7B7CDE"></i></span>
                                    <span>Default</span>
                                </div>
                                <div class="d-flex align-items-center" style="width:50%">
                                    <span><i class="fa-solid fa-circle me-2" style="color:#EF0E70"></i></span>
                                    <span>Vacant</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center pb-0" style="border-bottom:none">
                                <div class="d-flex align-items-center" style="width:50%">
                                    <span><i class="fa-solid fa-circle me-2" style="color:#33BE12"></i></span>
                                    <span>Rent</span>
                                </div>
                                <div class="d-flex align-items-center" style="width:50%">
                                    <span><i class="fa-solid fa-circle me-2" style="color:#5BC6F4"></i></span>
                                    <span>Sale</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--<div class="left" id="Themes"> <img src="images/themes.png" width="24" height="24" class="top" alt="" title="Themes" onclick="gettheme('Themes')"> </div>-->
                <!--<div class="left" id="Legend"> <img src="images/legend.png" width="24" height="24" class="top" alt="" title="Legend"  onclick="gettheme('Legend')"/> </div>-->
                <!-- <div id="Maps"> <button class="btn btn-maps " onclick="gettheme('Maps')">Maps</button> -->
            </div>
            <!--	<div class="left" id="Draw">
                               <img src="images/draw.png" width="24" height="24" class="top" title="Draw" alt=""  onclick="gettheme('Draw')"/>
                               </div>
                               <div class="left" id="AddEvents">
                               <img src="images/add event.png" width="24" height="24" class="top" title="Add Events" alt=""  onclick="gettheme('Add Events')"/>
                               </div>
                               <div class="left" id="Events">
                               <img src="images/events.png" width="24" height="" class="top" title="Events" alt="24"  onclick="gettheme('Events')"/>
                               </div>
                               <div class="left" id="Aroundme">
                               <img src="images/around me.png" width="24" height="24" class="top" title="Around me" alt=""  onclick="gettheme('Around me')"/>
                               </div>-->
            <!--<div class="left" id="Wardinfo"> <img src="images/ward info.png" width="24" height="24" class="top" title="Ward info" alt=""  onclick="gettheme('Wardinfo')"/> </div>-->
            <!--<div class="left" id="knowyourproperty"> <img src="images/know your property.png" width="24" class="top" title="know your property" height="24" alt=""  onclick="gettheme('knowyourproperty')"/> </div>-->
            <!--	<div class="left" id="Knowyourplot">
                            <img src="images/know your plot.png" width="24" class="top" height="24"  title="Know your plot" alt=""  onclick="gettheme('Know your plot')"/>
                            </div>-->
            <!--<div class="left" id="Feedback"> <img src="images/feedback.png" width="24" height="24" class="top" title="Feedback" alt=""  onclick="gettheme('Feedback')"/> </div>-->
            <!--<div class="left" id="Share"> <img src="images/share.png" width="24" height="24" class="top" title="Share" alt=""  onclick="gettheme('Share')"/> </div>-->
            <!--	<div class="left" id="Announcement">
                            <img src="images/announcement.png" width="24" class="top" height="24" title="Announcement"  alt=""  onclick="gettheme('Announcement')"/>
                            </div>-->
            <!--<div class="left" id="Help"> <img src="images/help.png" width="24" height="24" class="top" title="Help" alt="" onclick="gettheme('Help')"/> </div>-->
        </div>
    </div>
    </div>
    </div>
    <!--
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15225.326527773286!2d78.45824329999999!3d17.4438343!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sin!4v1528892118739" width="100%" height="900" frameborder="0" style="border:0" allowfullscreen></iframe>
        -->
    <div class="d-flex justify-content-center align-items-center shadow" style="z-index: 9999; position: relative;">
        <div class="topbar  panel-group d-accordion" style="display:show" id="frameposition">
            <form id="searchFilter">
                @csrf
                <div class="firststheader">
                    <div class="filter-inp">
                        <input type="text" class="form-control" placeholder="Pincode" name="pincode"
                            id="pincode">
                    </div>
                    <div class="SurveyNon filter-inp">
                        <select class="form-select" name="unit_type" id="unit_type">
                            <option value="">Select</option>
                            <option value="1"> Vacant </option>
                            <option value="2"> Occupied </option>
                        </select>
                    </div>
                    <div class="filter-inp">
                        <select class="form-select " name="surveyed_id" id="surveyed_id">
                            <option value="">Survey Status</option>
                            <option value="1">Surveyed</option>
                            <option value="2">Not Surveyed</option>
                        </select>
                    </div>
                    <div class="filter-inp">
                        <select class="form-select" name="sale_rent" id="sale_rent">
                            <option value="">Sale/Rent</option>
                            <option value="1">For Sale</option>
                            <option value="2">For Rent</option>
                        </select>
                    </div>
                    <div class="filter-inp">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Budget
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <div class="flex pad15">
                                <div>
                                    <select class="form-select budget" name="min_budget" id="min_budget">
                                        <option value=""> No Min </option>
                                        @forelse ($budgets as $key => $min)
                                            <option value="{{ $min->id }}">
                                                {{ $min->amount . ' ' . $min->units->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select budget" name="max_budget" id="max_budget">
                                        <option value=""> No Max </option>
                                        @forelse ($budgets as $key => $max)
                                            <option value="{{ $max->id }}">
                                                {{ $max->amount . ' ' . $max->units->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <li class="d-none">
                                <a class=" dropdown-item" href="#">
                                    <button class="btn-apply">Apply</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-inp">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Area
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <div class="flex pad15">
                                <div>
                                    <select class="form-select" name="min_area" id="min_area">
                                        <option value=""> Min Area </option>
                                        @forelse($area_measurments as $key => $min)
                                            <option value="{{ $min->measurement }}">
                                                {{ $min->measurement . ' ' . $min->units->name }} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select" name="max_area" id="max_area" disabled>
                                        <option value=""> Max Area </option>
                                        @forelse($area_measurments as $key => $max)
                                            <option value="{{ $max->measurement }}">
                                                {{ $max->measurement . ' ' . $max->units->name }} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <li class="d-none">
                                <a class="dropdown-item" href="#">
                                    <button class="btn-apply">Apply</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-inp">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonn"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Survey Date
                        </button>
                        <ul class="dropdown-menu datte" aria-labelledby="dropdownMenuButtonn">
                            <div class="flex pad15">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="today"
                                                id="defaultCheckas" name="dateFilter">
                                            <label class="form-check-label" for="defaultCheckas">
                                                Today
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="week"
                                                name="dateFilter" id="defaultChecksa">
                                            <label class="form-check-label" for="defaultChecksa">
                                                This week
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="month"
                                                name="dateFilter" id="defaultChecksb">
                                            <label class="form-check-label" for="defaultChecksb">
                                                This Month
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="customDate"
                                                name="dateFilter" id="custom_date_filter">
                                            <label class="form-check-label" for="defaultChecksc">
                                                Custom date Range
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 custom-date-filter " style="display:none">
                                        <label class="form-label">From date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="from_date"
                                                id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 custom-date-filter" style="display:none">
                                        <div class="form-group">
                                            <label class="form-label">To date</label>
                                            <input type="date" class="form-control" name="to_date" id="to_date"
                                                max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <li class="d-none">
                                <a class="dropdown-item" href="#">
                                    <button class="btn-apply">Apply</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-inp">
                        <div class="form-group">
                            <select type="text" class="form-select" id="category_property"
                                name="category_property">
                                <option value="">Select a Category</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="filter-inp">
                        <button class="btn dropdown-toggle " type="button" id="menubtn" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More
                        </button>
                        <ul class="dropdown-menu moreOuter" id="menuDescription">
                            <p class="head">MORE FILTERS</p>
                            <div class="more">
                                <div class="mb-2 filter-data" id="gated_community" style="display: none;">
                                    <p class="normalhead"><b>Gated Community</b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1"
                                                    name="gated_community" value="1">Gated Community
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1"
                                                    name="gated_community" value="0">Non-Gated Community
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="categoryy">
                                    <div class="filter-data" id="sub_categories" style="display: none;">
                                        <p class="normalhead"><b>Commercial Sub-Type</b></p>
                                        <div class="categoryy">
                                            <select class="form-select" name="subCategories">
                                                <option value="">-Select Commercial Sub-Type-</option>
                                                @forelse($subCategories as $key=>$subCategories)
                                                    <option value="{{ $subCategories->id }}">
                                                        {{ $subCategories->cat_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-data" id="plot_land_types" style="display: none;">
                                        <p class="normalhead"><b>Plot Land Types</b></p>
                                        <div class="categoryy">
                                            <select class="form-select" name="plotLandTypes">
                                                <option value="">-Select Plot Land Type-</option>
                                                @forelse($plotLandCategories as $key=>$plotLandCategories)
                                                    <option value="{{ $plotLandCategories->id }}">
                                                        {{ $plotLandCategories->cat_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-data" id="construction_state" style="display: none;">
                                        <p class="normalhead"><b>Construction Status</b></p>
                                        <div class="row">
                                            @forelse ($construction_status as $key => $construction)
                                                <div class="col-md-6 col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $construction['id'] }}" id="defaultChecka"
                                                            name="construction_state[]">
                                                        <label class="form-check-label" for="defaultCheckab">
                                                            {{ $construction['name'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="furnishing_status" style="display: none;">
                                    <p class="normalhead"><b>Furnishing Status</b></p>
                                    <div class="categoryy">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="8,41,42"
                                                        id="defaultChecka" name="furnishing_status[]">
                                                    <label class="form-check-label" for="defaultCheckab">
                                                        Furnished
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="9,43"
                                                        id="defaultCheckb" name="furnishing_status[]">
                                                    <label class="form-check-label" for="defaultCheckab">
                                                        Unfurnished
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="filter-data" id="ameneties" style="display: none;">
                                    <p class="normalhead"><b>Ameneties</b></p>
                                    <div class="categoryy">
                                        <div class="row">
                                            @forelse($ameneties as $key => $amenity)
                                                <div class="col-md-6 col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $amenity['id'] }}" id="defaultChecka"
                                                            name="ameneties[]">
                                                        <label class="form-check-label" for="defaultChecka">
                                                            {{ $amenity['name'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="category_status" style="display: none;">
                                    <p class="normalhead"><b>Category</b></p>
                                    <div class="categoryy">
                                        <select class="form-select select2-dd11" id="brand_category_id"
                                            name="brand_category_id">
                                            <option value="">-Select-</option>
                                            @forelse ($brand_parent_categories as $brand_parent_category)
                                                <option value="{{ $brand_parent_category->id }}">
                                                    {{ $brand_parent_category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-data" id="brand_sub_categories" style="display: none;">
                                    <p class="normalhead"><b>Sub - Category</b></p>
                                    <div class="categoryy">
                                        <select class="form-select" id="brand_sub_category_id"
                                            name="brand_sub_category_id">
                                            <option value="">-Select Sub Category-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-data" id="brand_categories" style="display: none;">
                                    <p class="normalhead"><b>Brand</b></p>
                                    <div class="categoryy">
                                        <select class="form-select" id="brand_id" name="brand_id">
                                            <option value="">-Select Brand-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-data" id="no_of_bedrooms" style="display: none;">
                                    <p class="normalhead"><b>No of Bedrooms</b></p>
                                    <div class="categoryy">
                                        <div class="btn-group" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            <label class="custom-checkbox LabelCategory">
                                                <input type="checkbox" class="btn-check btnChecked" value="all"
                                                    id="" autocomplete="off" name="all_bedrooms">
                                                <span class=" btn btn-outline-primary" for="btncheck112a">Any </span>
                                            </label>
                                            <?php
                                            for ($i = 1; $i < 10; $i++) {
                                            ?>
                                            <label class="custom-checkbox LabelCategory">
                                                <input type="checkbox" class="btn-check btnChecked"
                                                    value="<?php echo $i; ?>" id="" autocomplete="off"
                                                    name="no_of_bedrooms[]">
                                                <span class=" btn btn-outline-primary" for="btncheck112a">
                                                    <?php echo $i; ?> </span>
                                            </label>
                                            <!-- <label class="btn btn-outline-primary" for="btncheck1"> </label> -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="no_of_bathrooms" style="display: none;">
                                    <p class="normalhead"><b>No of Bathrooms</b></p>
                                    <div class="categoryy">
                                        <div class="btn-group" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            <label class="custom-checkbox LabelCategory">
                                                <input type="checkbox" class="btn-check btnChecked" value="all"
                                                    id="" autocomplete="off" name="all_bathrooms">
                                                <span class=" btn btn-outline-primary" for="btncheck112a">Any </span>
                                            </label>
                                            <?php
                                            for ($i = 1; $i < 10; $i++) {
                                            ?>
                                            <label class="custom-checkbox LabelCategory">
                                                <input type="checkbox" class="btn-check btnChecked"
                                                    value="<?php echo $i; ?>" id="" autocomplete="off"
                                                    name="no_of_bathrooms[]">
                                                <span class=" btn btn-outline-primary" for="btncheck112a">
                                                    <?php echo $i; ?> </span>
                                            </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="age_of_property" style="display: none;">
                                    <p class="normalhead"><b>Age of Property</b></p>
                                    <div class="categoryy">
                                        <div class="row">
                                            @forelse($age_of_property_options As $key => $age_of_property_option)
                                                <div class="col-md-6 col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $age_of_property_option['id'] }}"
                                                            id="defaultCheckba" name="age_of_property[]">
                                                        <label class="form-check-label" for="defaultCheckba">
                                                            {{ $age_of_property_option['name'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="property_facing" style="display: none;">
                                    <p class="normalhead"><b>{{ $property_facing['name'] }}</b></p>
                                    <div class="categoryy">
                                        <div class="row">
                                            @forelse($property_facing_options as $key=>$property_facing_option)
                                                <div class="col-md-4 col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $property_facing_option['id'] }}"
                                                            id="defaultCheck1a" name="property_facing_id[]">
                                                        <label class="form-check-label" for="defaultCheck1a">
                                                            <?php echo $property_facing_option['name']; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-data" id="no_of_open_sides" style="display: none;">
                                    <p class="normalhead"><b>No of Open Sides</b></p>
                                    <div class="categoryy">
                                        <div class="btn-group" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            <?php
                                            for ($i = 1; $i < 5; $i++) {
                                            ?>
                                            <label class="custom-checkbox LabelCategory">
                                                <input type="checkbox" class="btn-check btnChecked"
                                                    value="<?php echo $i; ?>" id="" autocomplete="off"
                                                    name="no_of_open_sides[]">
                                                <span class=" btn btn-outline-primary" for="btncheck112a">
                                                    <?php echo $i; ?> </span>
                                            </label>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 filter-data" id="no_of_price">
                                    <p class="normalhead"><b>Price</b></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1"
                                                    name="no_price" value="1">Available
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1"
                                                    name="no_price" value="0">Not Available
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="" id="gis_id">
                                    <p class="normalhead"><b>GIS ID</b></p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="gis_id" id="gis_id"
                                            value="">
                                    </div>
                                </div>
                                <div class="" id="address">
                                    <p class="normalhead"><b>Address</b></p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="street_name"
                                            id="street_name" value="">
                                    </div>
                                </div>

                            </div>
                            <div class="  btm-buttos d-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#">
                                            <button class="btn btn-reset">Reset all filters</button>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#">
                                            <button class="btn btn-apply">Apply</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between filter-action-group">
                        <div class="btn btn-reset mx-2" id="btnReset">Reset</div>
                        <div class="btn btn-search" id="btnSearch">Search </div>
                    </div>

                    <div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div id="map" class="map"></div>
    <div id="btnCrosshair" title="Live Location" class="">
        <img id="crosshair-image" width="30" height="30" src="{{ asset('webgis/img/geo-location.svg') }}">
    </div>

    <div class="icon-north"><img width="40" height="50" src="{{ asset('webgis/img/north.png') }}"></div>
    <div id="scaleline"></div>
    <br>
    <div class="frame_position" style="display:none;" id="frameposition2"> content </div>
    <div class="frame_position" style="display:none;" id="frameposition11">
        <div class="panel-group d-accordion animated fadeInDown" id="animated-example">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #662e94; color: #fff;" data-toggle="collapse"
                    data-parent=".d-accordion" href="#aboutus">
                    <h4 class="panel-title"><span id="themename"></span> <i class="fa fa-chevron-up pull-right"></i>
                    </h4>
                </div>
                <div id="aboutus" class="panel-collapse collapse in">
                    <div class="panel-body" style="height:100vh;overflow-y:scroll;">
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="Legenddiv" style="display:none;">
                            <!--<div style="margin-bottom: 10px;"><img src="images/cenima_theater.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Cenima Theatres</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/educational_institutions.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Educational Institutions</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/godowns.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Godowns</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/hosipatal1.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Hospitals and Nursing</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/industrial_usage.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Industrial Usage</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/kalyana_mandapam.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Kalyana Mandapam</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/banks.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Offices and Banks</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/residence.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Residence</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/restaurents.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Restaurents and Lodges</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/shop.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Shop</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/lights.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">High Mast Lights</span></div>
                                                                                                                    <div style="margin-bottom: 10px;"><img src="images/others.png" style="width: 50px;height: 50px;"><span style="font-weight:bold;">Others</span></div>
                                                                                    -->
                        </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="mapdiv" style="display:none;">
                            <div class="col-md-4"> <img src="{{ asset('webgis/images/map1.PNG') }}" class="map_box"
                                    width="84" height="67"> </div>
                            <div class="col-md-4"> <img src="{{ asset('webgis/images/map2.jpeg') }}" class="map_box"
                                    width="84" height="67"> </div>
                            <div class="col-md-4"> <img src="{{ asset('webgis/images/map3.jpeg') }}" class="map_box"
                                    width="84" height="67"> </div>
                        </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="wardinfodiv" style="display:none;"> </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="knowyourptdiv" style="display:none;"> </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="feedbackdiv" style="display:none;"> </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="sharediv" style="display:none;"> </div>
                        <!------end inner div---->
                        <!------inner div--->
                        <div id="helpdiv" style="display:none;"> </div>
                        <!------end inner div---->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var apiUrl = "{{ url('/') }}";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>

    <div class="record" id="countdiv" style="display:block"><span class="content3">Properties Found
            :</span><span id="properties_count"></span></div>
    <div id="search-results"></div>
    <div class="footer">
        <div>Powered by-<img src="{{ asset('webgis/images/vmax.png') }}"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw">
    </script>
    <script type="text/javascript" src="{{ asset('webgis/js/ol/ol3gm.js') }}"></script>
    <script src="{{ asset('webgis/js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
    <!-- layerswitchercontrol controls -->
    <script type="text/javascript" src="{{ asset('webgis/js/control/layerswitchercontrol.js') }}"></script>
    <!-- bar controls -->
    <script type="text/javascript" src="{{ asset('webgis/js/control/controlbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/control/buttoncontrol.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/control/togglecontrol.js') }}"></script>
    <script src="{{ asset('webgis/js/ol3-geocoder.js') }}"></script>
    <script src="{{ asset('webgis/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/app_starter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/app_config.js') }}?v='6'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/layers_data.js') }}?v='10'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/layer_controller.js') }}?v='98'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/utility.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/popupController.js') }}?v='54545'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/metroCardController.js') }}?v='6'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/placeCardController.js') }}?v='5'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/infoControl.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/map-controller.js') }}?v='5523'"></script>
    <script type="text/javascript" src="{{ asset('webgis/js/google_search_controller.js') }}?v='12'"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script type="text/javascript" src="{{ asset('webgis/js/search_filter.js') }}?v='5464'"></script>
    <link rel="stylesheet" href="{{ asset('webgis/css/select2.min.css') }}">
    <script type="text/javascript" src="{{ asset('webgis/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#min_area').on('change', function() {
                var selectedMinArea = $(this).val();
                $('#max_area option').prop('disabled', false);
                $('#max_area option').each(function() {
                    if ($(this).val() !== '' && parseFloat($(this).val()) < parseFloat(
                            selectedMinArea)) {
                        $(this).prop('disabled', true);
                    }
                });
                $('#max_area').prop('disabled', selectedMinArea === '');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // var currentDate = new Date();
            // var formattedDate = currentDate.toISOString().substring(0, 10);
            // $('#to_date').attr('min', formattedDate);
            $('.select2-dd').select2();
        });
    </script>
    <script>
        $(function() {
            // Smooth Scroll
            $('a[href*="#"]').bind('click', function(e) {
                var anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(anchor.attr('href')).offset().top
                }, 1000);
                e.preventDefault();
            });
        });
        $('.i-accordion').on('show.bs.collapse', function(n) {
            $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass(
                'fa-chevron-down fa-chevron-up');
        });
        $('.i-accordion').on('hide.bs.collapse', function(n) {
            $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass(
                'fa-chevron-up fa-chevron-down');
        });
        /* P */
        $('.accordion-2a, .accordion-2b, .accordion-3').on('show.bs.collapse', function(n) {
            $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass('fa-minus fa-plus');
        });
        $('.accordion-2a, .accordion-2b, .accordion-3').on('hide.bs.collapse', function(n) {
            $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass('fa-plus fa-minus');
        });
    </script>
    <script>
        function gettheme(value) {
            //alert(value);
            //$("#frameposition").hide();
            $("#themename").text(value);
            if (value == 'Query') {
                // $("#frameposition").hide();
                // $("#Querydiv").show();
                // $("#themediv").hide();
                // $("#Legenddiv").hide();
                // $("#mapdiv").hide();
                // $("#wardinfodiv").hide();
                // $("#knowyourptdiv").hide();
                // $("#feedbackdiv").hide();
                // $("#sharediv").hide();
                // $("#helpdiv").hide();

                // $("#Query").addClass('tab');
                // $("#Themes").removeClass('tab');
                // $("#Legend").removeClass('tab');
                // $("#Maps").removeClass('tab');
                // $("#Wardinfo").removeClass('tab');
                // $("#knowyourproperty").removeClass('tab');
                // $("#Share").removeClass('tab');
                // $("#Feedback").removeClass('tab');
                // $("#Help").removeClass('tab');

                $("#frameposition").fadeToggle(500);
                $('#countdiv').toggleClass('toggle-ele-to-center');
            } else if (value == 'Themes') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").show();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").addClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Legend') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").show();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").addClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Maps') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").show();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").addClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Wardinfo') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").show();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").addClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'knowyourproperty') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").show();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").addClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Feedback') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").show();
                $("#sharediv").hide();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").addClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Share') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").show();
                $("#helpdiv").hide();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").addClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").removeClass('tab');
                $("#frameposition").show();
            } else if (value == 'Help') {
                $("#frameposition").hide();
                $("#Querydiv").hide();
                $("#themediv").hide();
                $("#Legenddiv").hide();
                $("#mapdiv").hide();
                $("#wardinfodiv").hide();
                $("#knowyourptdiv").hide();
                $("#feedbackdiv").hide();
                $("#sharediv").hide();
                $("#helpdiv").show();

                $("#Query").removeClass('tab');
                $("#Themes").removeClass('tab');
                $("#Legend").removeClass('tab');
                $("#Maps").removeClass('tab');
                $("#Wardinfo").removeClass('tab');
                $("#knowyourproperty").removeClass('tab');
                $("#Share").removeClass('tab');
                $("#Feedback").removeClass('tab');
                $("#Help").addClass('tab');
                $("#frameposition").show();
            }
        }
    </script>
    <script>
        function getbranch() {
            var value = $("#ownername").val();
            //alert(value);
            $.ajax({
                type: "POST",
                url: "https://webgis.proper-t.co/php/ajax_owner_name.php",
                data: 'keyword=' + value,
                beforeSend: function() {
                    $("#ownername").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data) {
                    //alert(data);
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#ownername").css("background", "#FFF");
                    //$("#ifsc_code").val('');
                    //$("#search-box").val('');
                }
            });
        }
    </script>
    <script>
        function selectCountry(val) {
            //$("#ifsc_code").val(ifsc);
            $("#ownername").val(val);
            $("#suggesstion-box").hide();
        }
    </script>

    <script>
        $(document).ready(function() {
            // Make AJAX call
            $(document).on('change', '#sale_rent', function() {
                let sale_type = $(this).val();
                if (sale_type == '') {
                    sale_type = 1;
                }
                $.ajax({
                    type: "GET",
                    url: "{{ route('surveyor.ajax.get-budget') }}", // Replace with your PHP file
                    data: {
                        'sale_type': sale_type
                    },
                    dataType: "json",
                    success: function(data) {
                        // Populate select options
                        // console.log(data)
                        var select = $(".budget");
                        select.empty();
                        select.append('<option value="">Select</option>');
                        $.each(data, function(key, value) {
                            select.append('<option value="' + value.id + '">' + value
                                .amount + value
                                .name +
                                '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Make AJAX call
            $(document).on('change', '#brand_category_id', function() {
                let c_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.get-brand-sub-category') }}", // Replace with your PHP file
                    data: {
                        'c_id': c_id
                    },
                    dataType: "json",
                    success: function(data) {
                        // Populate select options
                        // console.log(data)
                        var select = $("#brand_sub_category_id");
                        select.empty();
                        select.append('<option value="">Select a Brand sub category</option>');
                        $.each(data, function(key, value) {
                            select.append('<option value="' + value.id + '">' + value
                                .name +
                                '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Make AJAX call
            $(document).on('change', "#brand_sub_category_id", function() {
                let c_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.get-brand-sub-category') }}", // Replace with your PHP file
                    data: {
                        'c_id': c_id
                    },
                    dataType: "json",
                    success: function(data) {
                        // Populate select options
                        // console.log(data)
                        var select = $("#brand_id");
                        select.empty();
                        select.append('<option value="">Select a Brand</option>');
                        $.each(data, function(key, value) {
                            select.append('<option value="' + value.id + '">' + value
                                .name +
                                '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#menubtn").click(function() {
                $("#menuDescription").toggle();
            });
            $(document).on("click", function(event) {
                var target = $(event.target);
                if (!target.closest("#menuDescription").length && !target.is("#menubtn")) {
                    $("#menuDescription").hide();
                }
            });
        });
    </script>
    <script>
        var options = [];
        $('.dropdown-menu a').on('click', function(event) {
            var $target = $(event.currentTarget),
                val = $target.attr('data-value'),
                $inp = $target.find('input'),
                idx;
            if ((idx = options.indexOf(val)) > -1) {
                options.splice(idx, 1);
                setTimeout(function() {
                    $inp.prop('checked', false)
                }, 0);
            } else {
                options.push(val);
                setTimeout(function() {
                    $inp.prop('checked', true)
                }, 0);
            }
            $(event.target).blur();
            console.log(options);
            return false;
        });
    </script>
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }
    </script>
</body>

</html>

</html>
