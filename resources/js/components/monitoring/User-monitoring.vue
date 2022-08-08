<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          <div class="row mt-1">
            <div class="col-md-11">
              <h1>Monitoring BMS</h1>
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
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table
              id="example1"
              class="table table-bordered table-striped DataTable"
            >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama BMS</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(result, index) in result" :key="result.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ result.namabattery }}</td>
                  <td>
                    <router-link
                      :to="'/halaman-detail-user/' + result.battery_id"
                      class="btn btn-sm btn-secondary"
                    >
                      <i class="fa-solid fa-circle-info"></i>
                    </router-link>
                
                    <router-link
                    :to="'/rekapdata-user/' + result.battery_id"
                    class="btn btn-sm btn-info"
                    >
                      <i class="fa-solid fa-calendar-days"></i>
                    </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      BatteryUser: [],
      dataMonitoring: [],
      dataNotifikasi: [],
      result: [],
      filterNotifikasi: [],
      token: localStorage.getItem("token"),
      battery_id: JSON.parse(localStorage.getItem("battery_id")),
      user_id: localStorage.getItem("id"),
      role: localStorage.getItem("role"),
    };
  },

  created() {
    //console.log(this.user_id);
    //console.log(this.dataMonitoring);
    this.axios
      .get(process.env.MIX_API_KEY + "userdevice/", {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + this.token,
        },
      })
      .then((response) => {
        //console.log(response.data)
        this.BatteryUser = response.data;

        this.battery_id.map((a) => {
          this.BatteryUser.map((b) => {
            if (a === b.battery_id && b.usss == this.user_id) {
              this.result.push(b);
            }
          });
        });
      })
      .then(function () {
        $(".DataTable").DataTable({
          dom: "Bfrtip",
          buttons: ["excel", "pdf"],
        });
      });

       this.axios
      .get(process.env.MIX_API_KEY + "monitoring/", {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + this.token,
        },
      })
      .then((response) => {
        console.log(response.data);
        //this.BatteryUser = response.data;
      })
  },

  methods: {
    fetchMonitoring() {
      setInterval(() => 
      {
        this.axios
          .get(process.env.MIX_API_KEY + "monitoring/", {
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          })
          .then((response) => {
            this.dataMonitoring = response.data;
            this.filterNotifikasi=[],
            this.battery_id.map((a) => {
              this.dataMonitoring.map((b) => {
                //console.log(b);
                if (a == b.battery_id && this.user_id == b.id) {
                  this.filterNotifikasi.push(b);
                  //console.log(this.filterNotifikasi)
                }
              });
            });
          });
      }, 5000);
    },

    check() {
      setInterval(() => {
        this.dataNotifikasi = [],
        this.filterNotifikasi.map((a) => {
          if (a.temp_1 > a.temp_max) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Atas (T1)`
            );
          }
          if (a.temp_2 > a.temp_max) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Atas (T2)`
            );
          }
          if (a.temp_3 > a.temp_max) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Atas (T3)`
            );
          }
          if (a.temp_1 < a.temp_min) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Bawah (T1)`
            );
          }
          if (a.temp_2 < a.temp_min) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Bawah (T2)`
            );
          }
          if (a.temp_3 < a.temp_min) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Bawah (T3)`
            );
          }
          if (a.arus > a.arus_max) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Atas (Arus)`
            );
          }
          if (a.arus < a.arus_min) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Bawah (Arus)`
            );
          }
          if (a.tegangan_tot > a.tegangan_max) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Atas (Tegangan)`
            );
          }
          if (a.tegangan_tot < a.tegangan_min) {
            this.dataNotifikasi.push(
              `${a.battery_id} Battery ${a.name} Melampaui Batas Bawah (Tegangan)`
            );
          }
        })
      }, 5000);
    },
  },
  mounted() {
    this.fetchMonitoring();
    this.check();
    // if(this.role !== "user")
    // {
    //   localStorage.clear();
    //   window.location.href ="/login"
    // } else {
    //   router.push({name : "user-monitoring"})
    // }
    // this.axios
    //   .get(process.env.MIX_API_KEY + "monitoring/", {
    //     headers: {
    //       "Content-Type": "application/json",
    //       Authorization: "Bearer " + this.token,
    //     },
    //   })
    //   .then((response) => {
    //     console.log(response.data);
    //   });
  },
};
</script>


<style>
.buttons-excel {
  display: inline-block;
  font-weight: 400;
  line-height: 1.6;
  color: #212529;
  text-align: center;
  text-decoration: none;
  vertical-align: middle;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  border-radius: 0.25rem;
  color: #fff;
  background-color: #007e0f;
  border-color: #005a21;
}
.buttons-pdf {
  display: inline-block;
  font-weight: 400;
  line-height: 1.6;
  color: #212529;
  text-align: center;
  text-decoration: none;
  vertical-align: middle;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  border-radius: 0.25rem;
  color: #fff;
  background-color: #c20000;
  border-color: #f30000;
}
</style>