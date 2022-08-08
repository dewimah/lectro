<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="row mt-1">
          <div class="col-md-11">
            <h1>Monitoring BMS : {{ this.Asik.name }}</h1>
          </div>
          <div class="col-md-1">
            <div class="dropdown float-right">
              <a
                href="#"
                role="button"
                id="dropdownMenuLink"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="fa-solid fa-bell"></i>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li v-if="dataNotifikasi.length < 1" class="dropdown-item">
                  Tidak ada Notifikasi
                </li>
                <li v-for="data in dataNotifikasi" :key="data.id">
                  <span class="dropdown-item">{{ data }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
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
      Asik: [],
      //Monitoring: [],
      dataSetting: [],
      dataSettingMatch: [],
      dataJoin: [],
      series: [],
      seriestegangan: [],
      namaBatery: null,
      monitoring_id: null,
      seriesarus: [],
      dataMonitoring: [],
      dataNotifikasi: [],
      photo: "",
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
  created() {},
  mounted() {
    // setInterval(() => {
    // $.each(localStorage.getItem("battery_id"), function (key, value) {
    //   console.log(value.battery_id);
    // });
    //console.log(localStorage.getItem("battery_id"));
    this.axios
      .get(
        process.env.MIX_API_KEY + "asik/" + localStorage.getItem("battery_id"),
        {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        }
      )
      .then((response) => {
        this.Asik = response.data;
        //console.log(response.data)

        //GET LAST DATA
        const lastData = this.Asik;
        console.log(lastData);
        this.namaBatery = lastData.name;

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
      }),
      this.fetchMonitoring();
    this.check();
  },

  methods: {
    //NOTIFIKASI
    fetchMonitoring() {
      setInterval(() => {
        this.axios
          .get(process.env.MIX_API_KEY + "monitoring/", {
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          })
          .then((response) => {
            this.dataMonitoring = response.data;
            console.log(response);
          })
          .catch((err) => {
            // alert(err);
          });
      }, 5000);
    },

    check() {
      setInterval(() => {
        this.dataNotifikasi = [];

        this.dataMonitoring.map((a) => {
          if (a.temp_1 > a.temp_max) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Atas (T1)`
            );
          }
          if (a.temp_2 > a.temp_max) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Atas (T2)`
            );
          }
          if (a.temp_3 > a.temp_max) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Atas (T3)`
            );
          }
          if (a.temp_1 < a.temp_min) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Bawah (T1)`
            );
          }
          if (a.temp_2 < a.temp_min) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Bawah (T2)`
            );
          }
          if (a.temp_3 < a.temp_min) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Bawah (T3)`
            );
          }
          if (a.arus > a.arus_max) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Atas (Arus)`
            );
          }
          if (a.arus < a.arus_min) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Bawah (Arus)`
            );
          }
          if (a.tegangan > a.tegangan_max) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Atas (Arus)`
            );
          }
          if (a.tegangan < a.tegangan_min) {
            this.dataNotifikasi.push(
              `Battery ${a.namabattery} Melampaui Batas Bawah (Tegangan)`
            );
          }
        });
      }, 5000);
    },

    getFotoBMS() {
      return "/img/board.png" + this.photo;
    },
  },
};
</script>;