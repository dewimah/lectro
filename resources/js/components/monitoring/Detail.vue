<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><h1>Detail Monitoring {{ namaBatery }}</h1></div>
        <div class="card-body">
          <router-link
            to="/admin-monitoring"
            class="btn btn-success"
            style="background-color: #1c3b10"
          >
            Kembali</router-link
          >
          <br /><br />
          <div class="table-responsive">
            <div class="row">
              <div class="col-md-4">
                <div class="text-center">Grafik Suhu BMS (Celcius)</div>
                <apexchart
                  type="radialBar"
                  height="340"
                  :options="chartOptions"
                  :series="series"
                ></apexchart>
              </div>
              <div class="col-md-4">
                <div class="text-center">Grafik Tegangan BMS (Volt)</div>
                <apexchart
                  type="radialBar"
                  height="340"
                  :options="chartOptions2"
                  :series="seriestegangan"
                ></apexchart>
              </div>
              <div class="col-md-4">
                <div class="text-center">Grafik Arus BMS (Ampere)</div>
                <apexchart
                  type="radialBar"
                  height="340"
                  :options="chartOptions3"
                  :series="seriesarus"
                ></apexchart>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
  data() {
    return {
      Monitoring: [],
      dataSetting: [],
      dataSettingMatch: [],
      dataJoin: [],
      series: [],
      seriestegangan: [],
      namaBatery: null,
      seriesarus: [],
      // CHART 1 (SUHU)
      chartOptions: {
        chart: {
          height: 340,
          type: "radialBar",
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: "30%",
              background: "transparent",
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              },
            },
          },
        },
        colors: ["#1c3b11", "#32681d", "#54892d", "#699d38"],
        labels: ["Batas Suhu Max", "Suhu1", "Suhu2", "Suhu3"],
        legend: {
          show: true,
          floating: true,
          fontSize: "12px",
          position: "left",
          offsetX: 0,
          offsetY: -12,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0,
          },
          formatter: function (seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
          },
          itemMargin: {
            vertical: 3,
          },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: {
                show: false,
              },
            },
          },
        ],
      },
      //CHART 2 (TEGANGAN)
      chartOptions2: {
        chart: {
          height: 340,
          type: "radialBar",
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: "30%",
              background: "transparent",
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              },
            },
          },
        },
        colors: ["#1c3b11", "#32681d", "#54892d"],
        labels: ["V Batas Max", "V Output BMS", "V Min"],
        legend: {
          show: true,
          floating: true,
          fontSize: "12px",
          position: "left",
          offsetX: 0,
          offsetY: 10,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0,
          },
          formatter: function (seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
          },
          itemMargin: {
            vertical: 3,
          },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: {
                show: false,
              },
            },
          },
        ],
      },
      // CHART 3 (ARUS)
      chartOptions3: {
        chart: {
          height: 340,
          type: "radialBar",
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: "30%",
              background: "transparent",
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              },
            },
          },
        },
        colors: ["#1c3b11", "#32681d"],
        labels: ["I Batas Max", "I Output"],
        legend: {
          show: true,
          floating: true,
          fontSize: "12px",
          position: "left",
          offsetX: 0,
          offsetY: 23,
          labels: {
            useSeriesColors: true,
          },
          markers: {
            size: 0,
          },
          formatter: function (seriesName, opts) {
            return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
          },
          itemMargin: {
            vertical: 3,
          },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: {
                show: false,
              },
            },
          },
        ],
      },
    };
  },
  components: {
    apexchart: VueApexCharts,
  },
  created() {},
  mounted() {
    console.log(this.$route.params.id)
    // setInterval(() => {
    this.axios
      .get(process.env.MIX_API_KEY+"monitoring/" + this.$route.params.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
      .then((response) => {
        console.log(response)
        this.Monitoring = response.data;
        // console.log(this.Monitoring)
      })
      .then(function () {
        $(".DataTable").DataTable();
      });
    this.axios
      .get(process.env.MIX_API_KEY+"setting/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
      .then((response) => {
        // console.log(response)
        this.dataSetting = response.data;
        // console.log(response)
        // const lastData = this.Monitoring.slice(-1)[0];
        const lastData = this.Monitoring;
        console.log(lastData)
        this.namaBatery = lastData[0].battery.name
        // console.log(lastData)
        // console.log(lastData)

        this.dataSetting.map((a) => {
          if (a.id === lastData[0].battery.setting_id) {
            this.dataSettingMatch = a;
          }
        });
        // console.log(this.dataSettingMatch);
        // console.log(lastData);
        this.series.push(this.dataSettingMatch.temp_max);
        this.series.push(lastData[0].temp_1);
        this.series.push(lastData[0].temp_2);
        this.series.push(lastData[0].temp_3);
        // console.log(this.series)
        //this.series.push(this.dataSettingMatch.temp_min);

        this.seriestegangan.push(this.dataSettingMatch.tegangan_max);
        this.seriestegangan.push(lastData[0].tegangan_tot);
        this.seriestegangan.push(this.dataSettingMatch.tegangan_min);

        this.seriesarus.push(this.dataSettingMatch.arus_max);
        this.seriesarus.push(lastData[0].arus);
        //this.seriesarus.push(this.dataSettingMatch.arus_min);
      })
      .then(function () {
        $(".DataTable").DataTable();
      });
    // }, 1000)
  },
  methods: {
    deleteSetting(id) {
      this.axios
        .delete(process.env.MIX_API_KEY+"monitoring/" + id)
        .then((response) => {
          let i = this.Monitoring.map((data) => data.id).indexOf(id);
          this.Monitoring.splice(i, 1);
        });
    },
  },
};
</script>;