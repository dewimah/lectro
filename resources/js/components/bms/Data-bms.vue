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
                  <th>ID</th>
                  <th>Jumlah Sel</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(cell, index) in cell" :key="cell.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ cell.id }}</td>
                  <td>{{ cell.cellbaterai }}</td>
                  <td>
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
            to="add-setting"
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
                  <!-- <th>No</th> -->
                  <th>Suhu Min (C)</th>
                  <th>Suhu Max (C)</th>
                  <th>V Min (Volt)</th>
                  <th>V Max (Volt)</th>
                  <th>I Min (A)</th>
                  <th>I Max (A)</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(Setting, index) in Setting" :key="Setting.id">
                  <!-- <td>{{ index + 1 }}</td> -->
                  <td>{{ Setting.temp_min }}</td>
                  <td>{{ Setting.temp_max }}</td>
                  <td>{{ Setting.tegangan_min }}</td>
                  <td>{{ Setting.tegangan_max }}</td>
                  <td>{{ Setting.arus_min }}</td>
                  <td>{{ Setting.arus_max }}</td>
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
                  <th>No</th>
                  <th>ID BMS</th>
                  <th>ID Setting</th>
                  <th>Nama BMS</th>
                  <th>ID Sel</th>
                  <th>Tipe</th>
                  <th>Serial</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(Battery, index) in Battery" :key="Battery.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ Battery.id }}</td>
                  <td>{{ Battery.setting_id }}</td>
                  <td>{{ Battery.name }}</td>
                  <td>{{ Battery.cell_id }}</td>
                  <td>{{ Battery.tipe }}</td>
                  <td>{{ Battery.serial }}</td>
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
      Battery: {},
      cell: {},
      Setting: {},
      token: localStorage.getItem('token')
    };
  },
  created() {
    this.axios
      .get("http://127.0.0.1:8000/api/battery/")
      .then((response) => {
        this.Battery = response.data;
      })
      .then(function () {
        $(".DataTable2").DataTable();
      });
    this.axios
      .get("http://127.0.0.1:8000/api/cell/")
      .then((response) => {
        this.cell = response.data;
      })
      .then(function () {
        $(".DataTable1").DataTable();
      });
    this.axios
      .get("http://127.0.0.1:8000/api/setting/")
      .then((response) => {
        this.Setting = response.data;
      })
      .then(function () {
        $(".DataTable3").DataTable();
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
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.value) {
                    this.axios
                        .delete('http://127.0.0.1:8000/api/battery/' + id)
                        .then(()=> {
                            Swal.fire(
                                "Terhapus",
                                "Data sudah terhapus",
                                "success"
                            );
                            let i = this.Battery.map(data => data.id).indexOf(id);
                            this.Battery.splice(i,1)
                        })
                        .catch(() => {
                            Swal.fire (
                                "Gagal",
                                "Data gagal terhapus",
                                "warning"
                            );
                        });
                }
            });
      // this.axios
      //   .delete("http://127.0.0.1:8000/api/battery/" + id)
      //   .then((response) => {
      //     let i = this.Battery.map((data) => data.id).indexOf(id);
      //     this.Battery.splice(i, 1);
      //   })
      //   .then(function (){
      //               var msg = "Apakah anda yakin untuk menghapusnya"
      //               agree = confirm(msg)
      //               if (agree)
      //                   return true
      //               else
      //                   return false
      //   });
    },

    tambahCell() {
      this.axios
        .post("http://127.0.0.1:8000/api/cell/", this.cell)
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
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.value) {
                    this.axios
                        .delete('http://127.0.0.1:8000/api/setting/' + id)
                        .then(()=> {
                            Swal.fire(
                                "Terhapus",
                                "Data sudah terhapus",
                                "success"
                            );
                            let i = this.Setting.map(data => data.id).indexOf(id);
                            this.Setting.splice(i,1)
                        })
                        .catch(() => {
                            Swal.fire (
                                "Gagal",
                                "Data gagal terhapus",
                                "warning"
                            );
                        });
                }
            });
      // this.axios
      //   .delete("http://127.0.0.1:8000/api/setting/" + id)
      //   .then((response) => {
      //     let i = this.Setting.map((data) => data.id).indexOf(id);
      //     this.Setting.splice(i, 1);
      //   })
      //   .then(function (){
      //       var msg = "Apakah anda yakin untuk menghapusnya"
      //       agree = confirm(msg)
      //       if (agree)
      //           return true
      //       else
      //           return false
      //   });
    },
    deleteCell(id) {
            Swal.fire({
                title: "Anda yakin ingin menghapus data ini?",
                text: "Klik batal untuk membatalkan hapus data",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#ddd",
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.value) {
                    this.axios
                        .delete('http://127.0.0.1:8000/api/cell/' + id)
                        .then(()=> {
                            Swal.fire(
                                "Terhapus",
                                "Data sudah terhapus",
                                "success"
                            );
                            let i = this.cell.map(data => data.id).indexOf(id);
                            this.cell.splice(i,1)
                        })
                        .catch(() => {
                            Swal.fire (
                                "Gagal",
                                "Data gagal terhapus",
                                "warning"
                            );
                        });
                }
            });
      // this.axios
      //   .delete("http://127.0.0.1:8000/api/cell/" + id)
      //   .then((response) => {
      //     let i = this.Setting.map((data) => data.id).indexOf(id);
      //     this.Setting.splice(i, 1);
      //   })
      //   .then(function (){
      //       var msg = "Apakah anda yakin untuk menghapusnya"
      //       agree = confirm(msg)
      //       if (agree)
      //           return true
      //       else
      //           return false
      //   });
    },
  },
  
  mounted(){
    window.axios.defaults.headers.common['Authorization'] = 'Bearer $(this.token)'
  }
};
</script>



