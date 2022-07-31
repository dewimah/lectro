<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><h5>Jumlah Sel</h5></div>

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

      <div class="card">
        <div class="card-header"><h5>Data Setting</h5></div>

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
        <div class="card-header"><h5>Data BMS</h5></div>

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
                  <td>{{ Battery.setting.temp_min }} C</td>
                  <td>{{ Battery.setting.temp_min }} C</td>
                  <td>{{ Battery.setting.tegangan_min }} V</td>
                  <td>{{ Battery.setting.tegangan_min }} V</td>
                  <td>{{ Battery.setting.arus_min }} A</td>
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
      token: localStorage.getItem("token"),
    };
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
        //console.log(response.data)
        this.Setting = response.data;
      })
      .then(function () {
        $(".DataTable3").DataTable({
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

    tambahCell() {
      this.axios
        .post(process.env.MIX_API_KEY + "cell/", this.cell, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then((response) => this.$router.push({ name: "data-bms" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
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



