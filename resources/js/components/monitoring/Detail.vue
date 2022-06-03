<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Battery Cell</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Setting</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
<!--TABS OVERVIEW-->
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><br>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="card card-success">
                                        <div class="card-header" style="background-color:#1c3b10">
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
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card card-success">
                                        <div class="card-header" style="background-color:#1c3b10">
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
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card card-success">
                                        <div class="card-header" style="background-color:#1c3b10">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--END TABS OVERVIEW-->

<!--TABS BATTERY CELLS-->
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">Battery Cell

                    </div>
<!--END TABS BATTERY CELL-->

<!--TABS SETTING-->
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"><br>
                        <div class="card">
                            <div class="card-header"><h5>Data Setting</h5></div>
                            <div class="card-body">
                                <router-link to="add-setting" class="btn btn-success" type="button" style="background-color:#1c3b10">
                                <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Suhu Min</th>
                                                    <th>Suhu Max</th>
                                                    <th>Tengangan Min</th>
                                                    <th>Tengangan Max</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr v-for="(Setting, index) in Setting" :key="Setting.id">
                                                    <td>{{index+1}}</td>
                                                    <td>{{ Setting.temp_min }}</td>
                                                    <td>{{ Setting.temp_max }}</td>
                                                    <td>{{ Setting.tegangan_min }}</td>
                                                    <td>{{ Setting.tegangan_max }}</td>
                                                    <td>
                                                        <router-link :to="{name: 'edit-setting', params: {id: Setting.id}}" class="btn btn-app">
                                                            <i class="fas fa-edit"></i> <br>Edit
                                                        </router-link>
                                                        <button class="btn btn-danger" @click="deleteSetting(Setting.id)">
                                                            <i class="fa-solid fa-trash"></i> <br>Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                
                            </div>
                        </div>
                    </div>
<!--END TABS SETTING-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return{
            Setting: {}
        }
    },
    created(){
        this.axios
        .get('http://127.0.0.1:8000/api/setting/')
        .then(response =>{
            this.Setting = response.data;
        });
    },
    methods: {
        deleteSetting(id){
            this.axios
                .delete('http://127.0.0.1:8000/api/setting/' + id)
                .then(response => {
                    let i = this.Setting.map(data => data.id).indexOf(id);
                    this.Setting.splice(i,1)
                });
        }
    }
}
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
</script>