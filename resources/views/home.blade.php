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
        @if (Auth::user() == null)
        <span id="navbar" hidden>
            @include('template.navbar')
        </span>
        <span id="sidebar" hidden>
            @include('template.sidebar')
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
        @else
        <span id="navbar">
            @include('template.navbar')
        </span>
        <span id="sidebar">
            @include('template.sidebar')
        </span>
        <div class="content-wrapper" id="wp" style="margin-left: 250px;">
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
        @endif
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
        // let user: {{}}
        // console.log(user)
        // console.log()
        // console.log({!! json_encode(optional(auth()->user())) !!})
        // window.onload = function(){  
            // let token = localStorage.getItem('token')
            //         if (token === null) {
            //             document.getElementById("navbar").hidden = true;
            //             document.getElementById("sidebar").hidden = true;
            //             document.getElementById("wp").style.marginLeft = "0px";
            //         } else {
            //             document.getElementById("navbar").hidden = false;
            //             document.getElementById("sidebar").hidden = false;
            //             document.getElementById("wp").style.marginLeft = "250px";
            //         }
            // }  
    </script>
   @include('template.script')
</body>
</html>

<script>
//     function loadRole() {
//         const role = localStorage.getItem('role');
//         if(role !== "admin"){
//             window.location.href = "/login"
//         }
// }
</script>