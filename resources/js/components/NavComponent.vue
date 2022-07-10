<template>
        <nav style="background-color:#32681e" class="navbar navbar-expand-md">
            <div class="container">
                <a href="/" class="navbar-brands">
                LECTRO
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                                <li class="nav-item">
                                    <a class="nav-link calltoaction" href="/login">Login</a>
                                </li>
                            
                            <!--
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif 
                        -->
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle calltoaction" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Username
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="">
                                       Logout
                                    </a>
                                </div>
                            </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
export default {
    mounted() {
        
    },
}
</script>