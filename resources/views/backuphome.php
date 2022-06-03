<!DOCTYPE html>

<html lang="en">
<head>
    @include('template.head')
    <title>BMS | LECTRO</title>
</head>

<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <!--NAVBAR-->
            @include('template.navbar')
        <!--NAVBAR END-->

        <!--SIDEBAR-->
            @include('template.sidebar')
        <!--SIDEBAR END-->
        
        <div class="content-wrapper">
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


        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
    </div>

   @include('template.script')
</body>
</html>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css" />
        <link rel="stylesheet" type="text/css" href="http://unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
        <!--<script src="http://unpkg.com/vue@latest/dist/vue.min.js"> </script>-->
        <script src="http://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"> </script>
        <script src="http://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js"> </script>
        <title>BMS | LECTRO</title>

        <style>
            body{
                background-color:#32681e;
            }
            .button{
                color:#275118;
            }
        </style>
    </head>

    <body>
        <div class="login-box">
            <div class="card card-outline" color="#1c3b10">
                <div class="card-header text-center">
                    <h4>BMS's <b color:#000>LECTRO</b></h4>
                </div>

                <div class="card-body">
                    <p class="login-box-msg">Welcome To BMS Monitoring</p>
                   
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('login') }}" type="button" class="btn btn-success btn-block" style="background-color:#1c3b10">Login</a>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>