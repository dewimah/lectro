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