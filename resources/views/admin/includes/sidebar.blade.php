{{-- <style>
    #logout-confirm.modal-backdrop {
        --vz-backdrop-zindex: 1050;
        --vz-backdrop-bg: #000;
        --vz-backdrop-opacity: -0.5;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 0;
        width: 100vw;
        height: 100vh;
        background-color: var(--vz-backdrop-bg);
    }
</style> --}}

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('surveyor.dashboard') }}" class="logo logo-dark">
            <!--<span class="logo-sm">-->
            <!--    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="30">-->
            <!--</span>-->
            <!--<span class="logo-lg">-->
            <!--    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">-->
            <!--</span>-->
        </a>
        <!-- Light Logo-->
        <a href="{{ route('surveyor.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/konu-icon.svg') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/assets/images/konu-logo-white.svg') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            @if (Auth::user()->hasRole('surveyor'))
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>





                <li class="nav-item">
                    <a class="nav-link menu-link active" href="{{ route('surveyor.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('surveyor/basic_details') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                        <i class="fa-solid fa-house-user"></i> <span data-key="t-dashboards"> Add Property</span>

                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('surveyor/property/add-gated-comunity') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                        <i class="fa-solid fa-house-user"></i> <span data-key="t-dashboards">Add Gated
                            Community</span>

                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('commercial-tower.add-commercial-tower') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                        <i class="fa-solid fa-house-user"></i> <span data-key="t-dashboards">Add Commercial
                            Towers</span>

                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('surveyor.gated-reports') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                        <i class="fa-solid fa-house-user"></i> <span data-key="t-dashboards">View Gated
                            Community</span>

                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('surveyor.filter-data') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">

                        <i class="fa-solid fa-file-lines"></i> <span data-key="t-dashboards">Reports</span>

                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('surveyor.builders') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Builders</span>
                    </a>

                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="" role="button" aria-expanded="false" aria-controls="sidebarDashboards" data-bs-toggle="modal" data-bs-target="#logout-confirm">
                        <i class="ri-shut-down-fill"></i> <span data-key="t-dashboards">Logout</span>
                    </a>

                    <!--Modal confirm logout-->
                </li> <!-- end Dashboard Menu -->
            </ul>
            @endif
            @if (Auth::user()->hasRole('gis-engineer'))
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('gis-engineer.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('gis-engineer.geo-ids-import.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Add GIS-ID's</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="" role="button" aria-expanded="false" aria-controls="sidebarDashboards" data-bs-toggle="modal" data-bs-target="#logout-confirm">
                        <i class="ri-shut-down-fill"></i> <span data-key="t-dashboards">Logout</span>
                    </a>

                    <!--Modal confirm logout-->
                </li>
                </li>
            </ul>
            @endif
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>