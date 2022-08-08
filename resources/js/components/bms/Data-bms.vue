<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col md-6">
        <div class="card">
        <div class="card-header"><h1>Jumlah Sel</h1></div>

        <div class="card-body">
          <router-link
            to="add-cell"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />

          <div class="table-responsive">
            <table
              id="example1"
              class="table table-bordered table-striped DataTable1"
            >
              <thead>
                <tr>
                  <th>No</th>
                  <!-- <th>ID</th> -->
                  <th>Jumlah Sel</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(cell, index) in cell" :key="cell.id">
                  <td>{{ index + 1 }}</td>
                  <!-- <td>{{ cell.id }}</td> -->
                  <td>{{ cell.cellbaterai }}</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-cell', params: { id: cell.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteCell(cell.id)"
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

      <div class="col md-6">
        <div class="card">
        <div class="card-header"><h1>Setting Suhu</h1></div>

        <div class="card-body">
          <router-link
            to="/add-setting-suhu"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />
          <div class="table-responsive">
            <table
              id="example4"
              class="table table-bordered table-striped DataTable4"
            >
              <thead>
                <tr>
                  <th>Setting</th>
                  <th>Suhu Min</th>
                  <th>Suhu Max</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="SettingSuhu in SettingSuhu" :key="SettingSuhu.id">
                  <td>{{ SettingSuhu.name }}</td>
                  <td>{{ SettingSuhu.temp_min }} C</td>
                  <td>{{ SettingSuhu.temp_max }} C</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-setting-suhu', params: { id: SettingSuhu.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteSettingSuhu(SettingSuhu.id)"
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

    <div class="row justify-content-center">
      <div class="col md-6">
        <div class="card">
        <div class="card-header"><h1>Setting Tegangan</h1></div>

        <div class="card-body">
          <router-link
            to="/add-setting-tegangan"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />
          <div class="table-responsive">
            <table
              id="example6"
              class="table table-bordered table-striped DataTable6"
            >
              <thead>
                <tr>
                  <th>Setting</th>
                  <th>Tegangan Min</th>
                  <th>Tegangan Max</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="SettingTegangan in SettingTegangan" :key="SettingTegangan.id">
                  <td>{{ SettingTegangan.name }}</td>
                  <td>{{ SettingTegangan.tegangan_min }} V</td>
                  <td>{{ SettingTegangan.tegangan_max }} V</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-setting-tegangan', params: { id: SettingTegangan.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteSettingTegangan(SettingTegangan.id)"
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

      <div class="col md-6">
          <div class="card">
        <div class="card-header"><h1>Setting Arus</h1></div>

        <div class="card-body">
          <router-link
            to="/add-setting-arus"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />
          <div class="table-responsive">
            <table
              id="example5"
              class="table table-bordered table-striped DataTable5"
            >
              <thead>
                <tr>
                  <th>Setting</th>
                  <th>Arus Min</th>
                  <th>Arus Max</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="SettingArus in SettingArus" :key="SettingArus.id">
                  <td>{{ SettingArus.name }}</td>
                  <td>{{ SettingArus.arus_min }} A</td>
                  <td>{{ SettingArus.arus_max }} A</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-setting-arus', params: { id: SettingArus.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteSettingArus(SettingArus.id)"
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

    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><h1>Data Setting</h1></div>

        <div class="card-body">
          <router-link
            to="/add-setting"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />
          <div class="table-responsive">
            <table
              id="example3"
              class="table table-bordered table-striped DataTable3"
            >
              <thead>
                <tr>
                  <th>Setting</th>
                  <th>Suhu Min</th>
                  <th>Suhu Max</th>
                  <th>V Min</th>
                  <th>V Max</th>
                  <th>I Min</th>
                  <th>I Max</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="Setting in Setting" :key="Setting.id">
                  <td>{{ Setting.name }}</td>
                  <td>{{ Setting.temp_min }} C</td>
                  <td>{{ Setting.temp_max }} C</td>
                  <td>{{ Setting.tegangan_min }} V</td>
                  <td>{{ Setting.tegangan_max }} V</td>
                  <td>{{ Setting.arus_min }} A</td>
                  <td>{{ Setting.arus_max }} A</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-setting', params: { id: Setting.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteSetting(Setting.id)"
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

      <div class="card">
        <div class="card-header"><h1>Data BMS</h1></div>

        <div class="card-body">
          <router-link
            to="add-bms"
            class="btn btn-success"
            type="button"
            style="background-color: #1c3b10"
          >
            <i class="fa-solid fa-circle-plus"></i> Tambah
          </router-link>
          <br /><br />

          <div class="table-responsive">
            <table
              id="datatablebms"
              class="table table-bordered table-striped DataTable2"
            >
              <thead>
                <tr>
                  <th rowspan="2">BMS</th>
                  <th rowspan="2">Sel</th>
                  <th rowspan="2">Tipe</th>
                  <th rowspan="2">Serial</th>
                  <th colspan="2">Suhu</th>
                  <th colspan="2">Tegangan</th>
                  <th colspan="2">Arus</th>
                  <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <td>Max</td>
                  <td>Min</td>
                  <td>Max</td>
                  <td>Min</td>
                  <td>Max</td>
                  <td>Min</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="Battery in Battery" :key="Battery.id">
                  <td>{{ Battery.name }}</td>
                  <td>{{ Battery.cell.cellbaterai }}</td>
                  <td>{{ Battery.tipe }}</td>
                  <td>{{ Battery.serial }}</td>
                  <td>{{ Battery.setting.temp_max }} C</td>
                  <td>{{ Battery.setting.temp_min }} C</td>
                  <td>{{ Battery.setting.tegangan_max }} V</td>
                  <td>{{ Battery.setting.tegangan_min }} V</td>
                  <td>{{ Battery.setting.arus_max }} A</td>
                  <td>{{ Battery.setting.arus_min }} A</td>
                  <td>
                    <router-link
                      :to="{ name: 'edit-bms', params: { id: Battery.id } }"
                      class="btn btn-sm btn-warning"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteBms(Battery.id)"
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
      // Posts:{},
      Battery: {},
      cell: {},
      Setting: {},
      // getDataPosts,
      SettingSuhu: {},
      SettingTegangan: {},
      SettingArus:{},
      token: localStorage.getItem("token"),
      role: localStorage.getItem("role")
    };
  },

  mounted() {
    if(this.role !== "admin")
    {
      localStorage.clear();
      window.location.href ="/login"
    } else {
      router.push({name : "data-bms"})
    }
  },

  created() { 
    this.axios
      .get(process.env.MIX_API_KEY + "battery/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        // console.log(response);
        this.Battery = response.data.data;
      })
      .then(function () {
        $(".DataTable2").DataTable({
          dom: "Bfrtip",
          buttons: ["excel", "pdf"],
        });
      });
    this.axios
      .get(process.env.MIX_API_KEY+"cell/",{
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        this.cell = response.data.data;
        //console.log(response.data)
        //console.log(response.data.data)
      })
      .then(function () {
        $(".DataTable1").DataTable({
          dom: "Bfrtip",
          // lengthChange: false,
          buttons: ["excel", "pdf"],
        });
      });
    this.axios
      .get(process.env.MIX_API_KEY + "setting/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        console.log(response.data)
        this.Setting = response.data;
      })
      .then(function () {
        $(".DataTable3").DataTable({
          dom: "Bfrtip",
          // lengthChange: false,
          buttons: ["excel", "pdf"],
        });
    });
    this.axios
      .get(process.env.MIX_API_KEY + "settingsuhu/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        //console.log(response.data)
        this.SettingSuhu = response.data;
      })
      .then(function () {
        $(".DataTable4").DataTable({
          dom: "Bfrtip",
          // lengthChange: false,
          buttons: ["excel", "pdf"],
        });
    });
    this.axios
      .get(process.env.MIX_API_KEY + "settingarus/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        //console.log(response.data)
        this.SettingArus = response.data;
      })
      .then(function () {
        $(".DataTable5").DataTable({
          dom: "Bfrtip",
          // lengthChange: false,
          buttons: ["excel", "pdf"],
        });
    });
    this.axios
      .get(process.env.MIX_API_KEY + "settingtegangan/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + this.token
                }
            })
      .then((response) => {
        //console.log(response.data)
        this.SettingTegangan = response.data;
      })
      .then(function () {
        $(".DataTable6").DataTable({
          dom: "Bfrtip",
          // lengthChange: false,
          buttons: ["excel", "pdf"],
        });
    });
  },

  methods: {
    deleteBms(id) {
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
            .delete(process.env.MIX_API_KEY + "battery/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.Battery.map((data) => data.id).indexOf(id);
              this.Battery.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

    deleteSetting(id) {
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
            .delete(process.env.MIX_API_KEY+"setting/"+id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.Setting.map((data) => data.id).indexOf(id);
              this.Setting.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

    deleteCell(id) {
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
            .delete(process.env.MIX_API_KEY + "cell/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.cell.map((data) => data.id).indexOf(id);
              this.cell.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

    deleteSettingSuhu(id) {
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
            .delete(process.env.MIX_API_KEY + "settingsuhu/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.SettingSuhu.map((data) => data.id).indexOf(id);
              this.SettingSuhu.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

     deleteSettingArus(id) {
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
            .delete(process.env.MIX_API_KEY + "settingarus/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.SettingArus.map((data) => data.id).indexOf(id);
              this.SettingArus.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },

     deleteSettingTegangan(id) {
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
            .delete(process.env.MIX_API_KEY + "settingtegangan/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
              Swal.fire("Terhapus", "Data sudah terhapus", "success");
              let i = this.SettingTegangan.map((data) => data.id).indexOf(id);
              this.SettingTegangan.splice(i, 1);
            })
            .catch(() => {
              Swal.fire("Gagal", "Data gagal terhapus", "warning");
            });
        }
      });
    },
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



