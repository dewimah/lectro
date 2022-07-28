        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="dist/img/logo.png" alt="" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light">LECTRO</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <div class="info">
                                @if(Auth::user() != null)
                                <h5 style="color:#fff">
                                    {{Auth::user()->name}}
                                </h5>
                                <h6 style="color:#fff">
                                    {{Auth::user()->email}}
                                </h6>
                                @endif
                            </div>
                            <router-link to="admin-monitoring" class="nav-link">
                                <i class="fa-solid fa-desktop"></i>
                                <p>Monitoring</p>
                            </router-link>
                        </li>
                        @if (Auth::user() != null && Auth::user()->name == "admin")
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
                        @endif
                        <li class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            <form id="logout-form" action="{{ route('logout') }}" method="GET" class="nav-link">
                                @csrf
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>Logout</p>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>