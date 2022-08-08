<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          <div class="row mt-1">
            <div class="col-md-11">
              <h1>Monitoring BMS - Admin</h1>
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
                  <th>Nama</th>
                  <th>BMS</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(BatteryUser, index) in BatteryUser"
                  :key="BatteryUser.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ BatteryUser.namauser }}</td>
                  <td>{{ BatteryUser.namabattery }}</td>
                  <td>
                    <router-link
                      :to="'/halaman-detail/'+BatteryUser.battery_id"
                      class="btn btn-sm btn-primary"
                    >
                      <i class="fa-solid fa-circle-info"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteUserdevice(BatteryUser.bttt)"
                    >
                      <i class="fa-solid fa-trash"></i>
                    </button>
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
      role: localStorage.getItem("role")
    };
  },

  created() {
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
    deleteUserdevice(id) {
      Swal.fire({
        title: "Anda yakin ingin menghapus data ini?",
        text: "Klik batal untuk membatalkan hapus data",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#ddd",
        confirmButtonText: "Hapus",
      }).then((result) => {
        if (result.value) {
          this.axios
            .delete(process.env.MIX_API_KEY+"userdevice/" + id)
            .then(() => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.BatteryUser.map((data) => data.id).indexOf(id);
              this.BatteryUser.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

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
          //this.dataNotifikasi= [];
          //console.log(response)
        })
        .catch((err) => {
          alert(err);
        });
    }, 5000);
  },

  check() {
      setInterval(() => {
        this.dataNotifikasi = []; 
        this.dataMonitoring.map((a) => {
        if (a.temp_1 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Atas (T1)`);
        }
        if (a.temp_2 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Atas (T2)`);
        }
        if (a.temp_3 > a.temp_max) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Atas (T3)`);
        }
        if (a.temp_1 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Bawah (T1)`);
        }
        if (a.temp_2 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Bawah (T2)`);
        }
        if (a.temp_3 < a.temp_min) 
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Bawah (T3)`);
        }
        if (a.arus > a.arus_max)
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Atas (Arus)`);
        }
        if (a.arus < a.arus_min)
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Bawah (Arus)`);
        }
        if (a.tegangan_tot > a.tegangan_max)
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Atas (Tegangan)`);
        }
        if (a.tegangan_tot < a.tegangan_min)
        {
          this.dataNotifikasi.push (`Battery ${a.name} Melampaui Batas Bawah (Tegangan)`);
        }
      });
      }, 5000);
      // setInterval(() => { //Set Interval cek
      //   this.dataNotifikasi = []; // reset data notifikasi tiap interval detik
      //   this.dataSettings.forEach((obj) => { // Loop pengecekan tiap settings
      //     this.dataMonitoring.map((a) => { // Map data monitoring
      //       if (a.battery.setting_id === obj.id) { // pengecekan ketika data bms setting dengan id setting
      //         if (a.temp_1 > obj.temp_max) { // cek ketika temp 1 over
      //           this.dataNotifikasi.push( // push ke array dataNotifikasi
      //             `Battery ${a.battery.name} Overheat (temp1)`
      //           );
      //         }
      //         if (a.temp_2 > obj.temp_max) { // cek ketika temp 2 over
      //           this.dataNotifikasi.push(
      //             `Battery ${a.battery.name} Overheat (temp2)`
      //           );
      //         }
      //         if (a.temp_3 > obj.temp_max) { // cek ketika temp 3 over
      //           this.dataNotifikasi.push(
      //             `Battery ${a.battery.name} Overheat (temp3)`
      //           );
      //         }
      //         if (a.tegangan_tot > obj.tegangan_max) { // cek ketika tegangan over
      //           this.dataNotifikasi.push(`Battery ${a.battery.name} Over Volt`);
      //         }
      //         if (a.arus > obj.arus_max) { // cek ketika temp arus over
      //           this.dataNotifikasi.push(`Battery ${a.battery.name} Over Arus`);
      //         }
      //       }

      //     });
      //   });
      // }, 5000); //interval 
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