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
            <!-- <a href="#" class="brand-link">
                <img src="{{asset('img/logoputih.png')}}" alt="" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light"></span>
            </a> -->

            <a href="#" class="brand-link">
                <img src="{{asset('img/logoputih.png')}}" alt="Logo" class="brand-image img" style="opacity: .8">
                <span class="brand-text font-weight-light"></span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <router-link to="admin-monitoring" class="nav-link">
                                <i class="fa-solid fa-desktop"></i>
                                <p>Monitoring</p>
                            </router-link>
                        </li>

                        <!-- <li class="nav-item">
                            <router-link to="ser-monitoring" class="nav-link">
                                <i class="fa-solid fa-desktop"></i>
                                <p>Monitoring</p>
                            </router-link>
                        </li> -->

                        <li class="nav-item">
                            <router-link to="data-userdevice" class="nav-link">
                                <i class="fa-solid fa-mobile-button"></i>
                                <p>Data User Device</p>
                                </a>
                        </li>

                        <li class="nav-header">SETTING</li>

                        <li class="nav-item">
                            <router-link to="data-bms" class="nav-link">
                                <i class="fa-solid fa-car-battery"></i>
                                <p>Data BMS</p>
                                </a>
                        </li>

                        <li class="nav-item">
                            <router-link to="data-user" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Data User</p>
                                </a>
                        </li>
                        <li class="nav-item" onclick="Logout()">
                            <!-- <form id="logout-form" action="{{ route('logout') }}" method="GET" class="nav-link">
                                @csrf -->
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>Logout</p>
                            <!-- </form> -->
                        </li> 

                    </ul>
                </nav>
            </div>
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
        <!--NAVBAR END-->

        <!--SIDEBAR-->
        <!--SIDEBAR END-->


        <!-- <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside> -->
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
      window.location.href = "/login"
   }
    // function loadRole() {
    //     const role = localStorage.getItem('role');
    //     console.log(role)
    // }
</script>