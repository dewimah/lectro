<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Monitoring BMS - Admin</h5></div>
                <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>BMS</th>
                                        <th>Pengaturan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>
                                            <router-link to="halaman-setting" class="btn btn-app">
                                                <i class="fa-solid fa-gear"></i> <br>Setting
                                            </router-link>
                                        </td>
                                        <td>
                                            <router-link to="halaman-detail" class="btn btn-app">
                                                <i class="fa-solid fa-circle-info"></i> <br>Detail
                                            </router-link>
                                            <a href="#" class="btn btn-app">
                                                <i class="fas fa-edit"></i> <br>Edit
                                            </a>
                                            <button class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i> <br>Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Donut Chart</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        
    </div>-->


    <!--<script src="asset {{('../../plugins/jquery/jquery.min.js')}}"></script>

    <script src="asset {{('../../plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="asset {{('../../plugins/chart.js/Chart.min.js')}}"></script>

    <script src="asset {{('../../dist/js/adminlte.min.js?v=3.2.0')}}"></script>

    <script src="asset{{('../../dist/js/demo.js')}}"></script>-->
</template>

<script>
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    /*var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })*/
export default {
    data() {
        return{
            User: null
        }
    },
    mounted(){
        axios.get('http://127.0.0.1:8000/api/monitoring').then((res)=>{
            this.User = res.data
        })
    }
}
</script>