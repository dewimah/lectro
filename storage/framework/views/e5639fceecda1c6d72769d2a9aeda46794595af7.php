<!DOCTYPE html>

<html lang="en">
<head>
    <?php echo $__env->make('template.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <title>BMS | LECTRO</title>
</head>

<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <!--NAVBAR-->
            <?php echo $__env->make('template.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--NAVBAR END-->

        <!--SIDEBAR-->
            <?php echo $__env->make('template.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

   <?php echo $__env->make('template.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH D:\lectro\resources\views/home.blade.php ENDPATH**/ ?>