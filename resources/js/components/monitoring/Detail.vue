<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><h1>Detail Monitoring BMS : {{ this.Asik.name }}</h1></div>
        <div class="card-body">
          <router-link
            to="/admin-monitoring"
            class="btn btn-success"
            style="background-color: #1c3b10"
          >
            Kembali</router-link
          >
          <br /><br />
          <img
            :src="getFotoBMS()"
            class="rounded mx-auto d-block"
            alt="villi"
            width="300px"
          />
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
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
  data() {
    return {
      // Monitoring: [],
      Asik: [],
      dataSetting: [],
      dataSettingMatch: [],
      dataJoin: [],
      series: [],
      seriestegangan: [],
      namaBatery: null,
      seriesarus: [],
      photo: "",
      role: localStorage.getItem("role"),
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
          fontSize: "10px",
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
        colors: ["#1c3b11", "#32681d", "#54892d"],
        labels: ["I Batas Max", "I Output", "I Batas Min"],
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
    };
  },
  components: {
    apexchart: VueApexCharts,
  },
  created() {
    // if(this.role !== "admin")
    // {
    //   localStorage.clear();
    //   window.location.href ="/login"
    // } else {
    //   router.push({name : "halaman-detail"})
    // }
  },
  mounted() {
    
    console.log(this.$route.params.id)
    // setInterval(() => {
    this.axios
      .get(process.env.MIX_API_KEY+"asik/" + this.$route.params.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
      .then((response) => {
        //console.log(response.data)
        this.Asik = response.data;
        console.log(this.Asik)

        //GET LAST DATA
        const lastData = this.Asik;
        console.log(lastData)
        this.namaBatery = lastData.name

        this.series.push(this.Asik.temp_max);
        this.series.push(lastData.temp_1);
        this.series.push(lastData.temp_2);
        this.series.push(lastData.temp_3);

        this.seriestegangan.push(this.Asik.tegangan_max);
        this.seriestegangan.push(lastData.tegangan_tot);
        this.seriestegangan.push(this.Asik.tegangan_min);

        this.seriesarus.push(this.Asik.arus_max);
        this.seriesarus.push(lastData.arus);
        this.seriesarus.push(this.Asik.arus_min);
      })
  },
  methods: {
    getFotoBMS() {
      return "/img/board.png" + this.photo;
    },
  }
};
</script>;