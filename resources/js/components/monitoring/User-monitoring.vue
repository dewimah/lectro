<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>User - Monitoring</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">Chart Suhu</div>
<apexchart type="radialBar" height="340" :options="chartOptions" :series="series"></apexchart>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">Chart Tegangan</div>
<apexchart type="radialBar" height="340" :options="chartOptions2" :series="seriestegangan"></apexchart>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">Chart Arus</div>
<apexchart type="radialBar" height="340" :options="chartOptions3" :series="seriesarus"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts';
export default {
    data() {
        return{
            Monitoring: [],
            dataSetting: [],
            dataSettingMatch: [],
            dataJoin: [],
            series: [],
            seriestegangan: [],
            seriesarus: [],
            // CHART 1 (SUHU)
          chartOptions: {
            chart: {
              height: 340,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                  margin: 5,
                  size: '30%',
                  background: 'transparent',
                  image: undefined,
                },
                dataLabels: {
                  name: {
                    show: false,
                  },
                  value: {
                    show: false,
                  }
                }
              }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: ['Maks', 'T1', 'T2', 'T3', 'Min'],
            legend: {
              show: true,
              floating: true,
              fontSize: '16px',
              position: 'left',
              offsetX: 0,
              offsetY: -10,
              labels: {
                useSeriesColors: true,
              },
              markers: {
                size: 0
              },
              formatter: function(seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
              },
              itemMargin: {
                vertical: 3
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                    show: false
                }
              }
            }]
          },
          //CHART 2 (TEGANGAN)
          chartOptions2: {
            chart: {
              height: 340,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                  margin: 5,
                  size: '30%',
                  background: 'transparent',
                  image: undefined,
                },
                dataLabels: {
                  name: {
                    show: false,
                  },
                  value: {
                    show: false,
                  }
                }
              }
            },
            colors: ['#1ab7ea', '#39539E', '#0077B5'],
            labels: ['Maks', 'VTotal', 'Min'],
            legend: {
              show: true,
              floating: true,
              fontSize: '16px',
              position: 'left',
              offsetX: 0,
              offsetY: -10,
              labels: {
                useSeriesColors: true,
              },
              markers: {
                size: 0
              },
              formatter: function(seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
              },
              itemMargin: {
                vertical: 3
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                    show: false
                }
              }
            }]
          },
          // CHART 3 (ARUS)
          chartOptions3: {
            chart: {
              height: 340,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                  margin: 5,
                  size: '30%',
                  background: 'transparent',
                  image: undefined,
                },
                dataLabels: {
                  name: {
                    show: false,
                  },
                  value: {
                    show: false,
                  }
                }
              }
            },
            colors: ['#1ab7ea', '#0084ff', '#0077B5'],
            labels: ['Maks', 'Arus', 'Min'],
            legend: {
              show: true,
              floating: true,
              fontSize: '16px',
              position: 'left',
              offsetX: 0,
              offsetY: -10,
              labels: {
                useSeriesColors: true,
              },
              markers: {
                size: 0
              },
              formatter: function(seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
              },
              itemMargin: {
                vertical: 3
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                    show: false
                }
              }
            }]
          }
        }
    },
    components:{
       'apexchart': VueApexCharts
    },
    created(){

    },
    mounted() {
        // setInterval(() => {
        this.axios
        .get(process.env.MIX_API_KEY+'monitoring/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then(response =>{
            this.Monitoring = response.data;
        })
        .then(function (){
            $(".DataTable").DataTable();
        });
        this.axios
        .get(process.env.MIX_API_KEY+'setting/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then(response =>{
            this.dataSetting = response.data;
            const lastData = this.Monitoring.slice(-1)[0];
            this.dataSetting.map(a => {
                if(a.id === lastData.battery_id){
                    this.dataSettingMatch = a;
                }
            });
            // console.log(this.dataSettingMatch);
            // console.log(lastData);
            this.series.push(this.dataSettingMatch.temp_max);
            this.series.push(lastData.temp_1);
            this.series.push(lastData.temp_2);
            this.series.push(lastData.temp_3);
            this.series.push(this.dataSettingMatch.temp_min);

            this.seriestegangan.push(this.dataSettingMatch.tegangan_max);
            this.seriestegangan.push(lastData.tegangan_tot);
            this.seriestegangan.push(this.dataSettingMatch.tegangan_min);

            this.seriesarus.push(this.dataSettingMatch.arus_max);
            this.seriesarus.push(lastData.arus);
            this.seriesarus.push(this.dataSettingMatch.arus_min);
        })
        .then(function (){
            $(".DataTable").DataTable();
        });
// }, 1000)
    },
    methods: {
        deleteSetting(id){
            this.axios
                .delete(process.env.MIX_API_KEY+'monitoring/' + id)
                .then(response => {
                    let i = this.Monitoring.map(data => data.id).indexOf(id);
                    this.Monitoring.splice(i,1)
                });
        }
    }
}
</script>;