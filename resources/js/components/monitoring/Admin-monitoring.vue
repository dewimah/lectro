<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          <div class="row mt-1">
            <div class="col-md-11">
              <h5>Monitoring BMS - Admin</h5>
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
                  <td>{{ BatteryUser.name }}</td>
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
                      @click="deleteUserdevice(BatteryUser.id)"
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
      dataSettings: [],
      dataMonitoring: [],
      dataNotifikasi: [],
      token: localStorage.getItem("token"),
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
        console.log(response)
        this.BatteryUser = response.data.data;
        // console.log(this.BatteryUser)
      })
      .then(function () {
        $(".DataTable").DataTable();
      });
  },

  mounted() {
    // localStorage.setItem('token', response.data.data.Token)
    //         localStorage.setItem('role', response.data.data.user.roles[0].name)
    //         if (response.data.data.user.roles[0].role === "admin") {
    //             window.location.href = "/admin-monitoring"
    //         } else if (response.data.data.user.roles[0].role === "user") {
    //             window.location.href = "/login"
    //         }
    // window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
    // axios.get(process.env.MIX_API_KEY+'admin/user').then((response)=>{
    //     this.currentUser = response.data
    // }).catch((errors) => {
    //     console.log(errors)
    // })
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
    fetchMonitor() {
        //Fetch data montitor dengan interval
      setInterval(() => {
        this.axios
          .get(process.env.MIX_API_KEY+"monitoring/")
          .then((response) => {
            this.dataMonitoring = response.data;
          })
          .catch((err) => {
            alert(err);
          });
      }, 5000);
    },
    fetchSettings() {
        // Fetch data settings
      this.axios
        .get(process.env.MIX_API_KEY+"setting/")
        .then((response) => {
          this.dataSettings = response.data;
        })
        .catch((err) => {
          alert(err);
        });
    },
    check() {
      setInterval(() => { //Set Interval cek
        this.dataNotifikasi = []; // reset data notifikasi tiap interval detik
        this.dataSettings.forEach((obj) => { // Loop pengecekan tiap settings
          this.dataMonitoring.map((a) => { // Map data monitoring
            if (a.battery.setting_id === obj.id) { // pengecekan ketika data bms setting dengan id setting
              if (a.temp_1 > obj.temp_max) { // cek ketika temp 1 over
                this.dataNotifikasi.push( // push ke array dataNotifikasi
                  `Battery ${a.battery.name} Overheat (temp1)`
                );
              }
              if (a.temp_2 > obj.temp_max) { // cek ketika temp 2 over
                this.dataNotifikasi.push(
                  `Battery ${a.battery.name} Overheat (temp2)`
                );
              }
              if (a.temp_3 > obj.temp_max) { // cek ketika temp 3 over
                this.dataNotifikasi.push(
                  `Battery ${a.battery.name} Overheat (temp3)`
                );
              }
              if (a.tegangan_tot > obj.tegangan_max) { // cek ketika tegangan over
                this.dataNotifikasi.push(`Battery ${a.battery.name} Over Volt`);
              }
              if (a.arus > obj.arus_max) { // cek ketika temp arus over
                this.dataNotifikasi.push(`Battery ${a.battery.name} Over Arus`);
              }
            }

          });
        });
      }, 5000); //interval 
    },
  },
  mounted() {
    // this.fetchSettings();
    // this.fetchMonitor();
    // this.check();
  },
};
</script>