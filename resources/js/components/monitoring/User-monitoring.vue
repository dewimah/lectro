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
                <tr
                  v-for="(BatteryUser, index) in BatteryUser"
                  :key="BatteryUser.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ BatteryUser.namabattery }}</td>
                  <td>
                    <router-link
                      :to="'/halaman-detail-user/'+BatteryUser.battery_id"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="fa-solid fa-circle-info"></i>
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
      BatteryUser: {},
      //dataSettings: [],
      dataMonitoring: [],
      dataNotifikasi: [],
      token: localStorage.getItem("token"),
      battery_id : localStorage.getItem("battery_id")
      //battery_id: localStorage.get("users"),

    };
  },

  created() {
    console.log(this.battery_id);
    this.axios
      .get(process.env.MIX_API_KEY+"userdevice/", {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.token
          }
      })
      .then((response) => {
        //console.log(response)
        this.BatteryUser = response.data;
        //console.log(this.BatteryUser)
      })
      .then(function () {
        $(".DataTable").DataTable({
          dom: "Bfrtip",
          buttons: ["excel", "pdf"],
        });
      });
  },

  methods: {
  //NOTIFIKASI
  fetchMonitoring() {
    setInterval(() =>
    {
      this.axios
        .get(process.env.MIX_API_KEY+"monitoring/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then((response) => {
          this.dataMonitoring = response.data;
          console.log(response)
        })
        .catch((err) => {
          alert(err);
        });
    }, 5000);
  },

  // fetchSettings() {
  //       // Fetch data settings
  //     this.axios
  //       .get(process.env.MIX_API_KEY+"setting/")
  //       .then((response) => {
  //         this.dataSettings = response.data;
  //       })
  //       .catch((err) => {
  //         alert(err);
  //       });
  // },

  check() {
      setInterval(() => {
        this.dataNotifikasi = []; 
        //const a = a;
        // console.log(a);
      this.dataMonitoring.map((a) => {
        if (a.temp_1 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Atas (T1)`);
        }
        if (a.temp_2 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Atas (T2)`);
        }
        if (a.temp_3 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Atas (T3)`);
        }
        if (a.temp_1 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Bawah (T1)`);
        }
        if (a.temp_2 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Bawah (T2)`);
        }
        if (a.temp_3 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Bawah (T3)`);
        }
        if (a.arus > a.arus_max)
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Atas (Arus)`);
        }
        if (a.arus < a.arus_min)
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Bawah (Arus)`);
        }
        if (a.tegangan > a.tegangan_max)
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Atas (Arus)`);
        }
        if (a.tegangan < a.tegangan_min)
        {
          this.dataNotifikasi.push (`Battery ${a.namabattery} Melampaui Batas Bawah (Tegangan)`);
        }
      })
      }, 5000);
    },
  },
  mounted () {
    this.fetchMonitoring();
    this.check();
  }
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