<!DOCTYPE html>

<html lang="en">

<head>
    @include('template.head')
    <link rel="shortcut icon" href="{{asset('img/favicon4.png')}}">
    <title>BMS | LECTRO</title>

</head>

<!-- <body class="hold-transition sidebar-mini" onload="loadRole()"> -->

<body class="hold-transition sidebar-mini">

    <div id="app" class="wrapper">
        <!--NAVBAR-->
        <span id="navbar">
            @include('template.navbar')
        </span>
        <span id="sidebar">
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <img src="{{asset('img/logoputih.png')}}" alt="Logo" class="brand-image img" style="opacity: .8">
                    <span class="brand-text font-weight-light"></span>
                </a>

                @if(Auth::check())
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <div class="info">
                                <div class="info mb-4">
                                    @if(Auth::user() != null)
                                    <h5 style="color:#fff">
                                        {{Auth::user()->name}}
                                    </h5>
                                    <h6 style="color:#fff">
                                        {{Auth::user()->email}}
                                    </h6>
                                    @endif
                                </div>
                                @if (auth()->user()->getRoleNames()[0] != "admin")
                                <li class="nav-item">
                                    <router-link to="user-monitoring" class="nav-link">
                                        <i class="fa-solid fa-desktop"></i>
                                        <p>Monitoring</p>
                                    </router-link>
                                </li>
                                @endif

                                @if (auth()->user()->getRoleNames()[0] == "admin")
                                <li class="nav-item">
                                    <router-link to="admin-monitoring" class="nav-link">
                                        <i class="fa-solid fa-desktop"></i>
                                        <p>Monitoring</p>
                                    </router-link>
                                </li>

                                <li class="nav-item">
                                    <router-link to="data-userdevice" class="nav-link">
                                        <i class="fa-solid fa-mobile-button"></i>
                                        <p>Data User Device</p>
                                    </router-link>
                                </li>

                                <li class="nav-header">SETTING</li>

                                <li class="nav-item">
                                    <router-link to="data-user" class="nav-link">
                                        <i class="fa-solid fa-users"></i>
                                        <p>Data User</p>
                                    </router-link>
                                </li>

                                <li class="nav-item">
                                    <router-link to="data-bms" class="nav-link">
                                        <i class="fa-solid fa-car-battery"></i>
                                        <p>Data BMS</p>
                                    </router-link>
                                </li>
                                @endif

                                <li class="nav-item" onclick="Logout()">
                                    <!-- <form id="logout-form" action="{{ route('logout') }}" method="GET" class="nav-link">
                                    @csrf -->
                                    <a class="nav-link">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        <p>Logout</p>
                                    </a>
                                    <!-- </form> -->
                                </li>

                        </ul>
                    </nav>
                </div>

                @endif
            </aside>
        </span>
        <div class="content-wrapper" style="margin-left: 0px;">
            <div class="content-header">
                <div class="container-fluid">
                    <router-view> </router-view>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">

                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
    @include('template.script')
</body>

</html>

<script>
    window.onload = function() {
        const role = localStorage.getItem('role');
        console.log(role)
        if (role === null) {
            document.querySelector("#navbar").setAttribute("hidden", true);
            document.querySelector("#sidebar").setAttribute("hidden", true);
        } else {
            document.querySelector("#navbar").removeAttribute("hidden");
            document.querySelector("#sidebar").removeAttribute("hidden");
        }
    }

    function Logout() {
        localStorage.clear();
        window.location.href = "logout"
    }
    // function loadRole() {
    //     const role = localStorage.getItem('role');
    //     console.log(role)
    // }
</script>