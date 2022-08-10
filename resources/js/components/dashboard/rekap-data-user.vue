<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          <h1>REKAP DATA</h1>
        </div>

        <div class="card-body">
          <router-link
            to="/user-monitoring"
            class="btn btn-success"
            style="background-color: #1c3b10"
          >
            Kembali
          </router-link>
          <br /><br />
          <form @submit.prevent="inputTanggal">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">From</span>
              <input
                v-model="firstdate"
                type="date"
                class="form-control"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
              <span class="input-group-text" id="basic-addon1">To</span>
              <input
                v-model="lastdate"
                type="date"
                class="form-control"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
              <button
                class="btn btn-outline-secondary"
                type="submit"
                id="button-addon2"
              >
                Search
              </button>
            </div>
          </form>

          <div id="chart">
            <apexchart
              ref="realtimeChart"
              v-if="show"
              type="line"
              height="350"
              :options="chartOptions"
              :series="series"
            ></apexchart>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import moment from "moment";
export default {
  data() {
    return {
      show: false,
      firstdate: "",
      lastdate: "",
      series: [
        {
          name: "Suhu 1",
          type: "area",
          data: [],
        },
        {
          name: "Suhu 2",
          type: "line",
          data: [],
        },
        {
          name: "Suhu 3",
          type: "line",
          data: [],
        },
        {
          name: "Voltase",
          type: "line",
          data: [],
        },
        {
          name: "Ampere",
          type: "line",
          data: [],
        },
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "line",
        },
        stroke: {
          curve: "smooth",
        },
        fill: {
          type: "solid",
          opacity: [0.0, 1],
        },
        labels: [],
        markers: {
          size: 1,
        },
        yaxis: [
          {
            title: {
              text: "Suhu (C)",
            },
          },
          {
            opposite: true,
            title: {
              text: "Voltase",
            },
          },
          {
            opposite: true,
            title: {
              text: "Ampere",
            },
          },
        ],
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if (typeof y !== "undefined") {
                return y.toFixed(0) + " points";
              }
              return y;
            },
          },
        },
      },
    };
  },

  components: {
    apexchart: VueApexCharts,
  },

  created() {
    console.log(this.$route.params.id);
    this.axios
      .get(process.env.MIX_API_KEY + "monitoring/" + this.$route.params.id, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      })
      .then((response) => {
        this.dataMonitoring = response.data;
        console.log(this.dataMonitoring);
        this.dataMonitoring.map((a) => {
          this.series[0].data.push(a.temp_1);
          this.series[1].data.push(a.temp_2);
          this.series[2].data.push(a.temp_3);
          this.series[3].data.push(a.tegangan_tot);
          this.series[4].data.push(a.arus);
          this.chartOptions.labels.push(a.created_at.substring(0, 10));
          console.log("ihir");
        });

        console.log(this.series);
        //console.log(this.series[1].data)
        if (this.series[0].data !== []) {
          this.show = true;
        }
      });
  },

  methods: {
    inputTanggal() {
      this.axios
        .get(
          process.env.MIX_API_KEY +
            "monitoring/" +
            this.firstdate +
            "/waktu/" +
            this.lastdate,
          {
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          }
        )
        .then((response) => {
          console.log(response);
          this.series[0].data = [];
          this.series[1].data = [];
          this.series[2].data = [];
          this.series[3].data = [];
          this.series[4].data = [];
          this.chartOptions.labels = [];

          response.data.map((a) => {
            //console.log(a.created_at)
            this.series[0].data.push(a.temp_1);
            this.series[1].data.push(a.temp_2);
            this.series[2].data.push(a.temp_3);
            this.series[3].data.push(a.tegangan_tot);
            this.series[4].data.push(a.arus);
            this.chartOptions.labels.push(a.created_at.substring(0, 10));
            console.log("ihir");
          });
        });
    },
    currentDateTime(a) {
      return moment(a).format("MM/DD/YYYY");
    },
  },

  // mounted(){
  //     this.inputTanggal();
  // }
};
</script>