<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><h5>Jumlah Sel</h5></div>

        <div class="card-body">
          <!--                    <div class="input-group mb-3">
                        <input v-model="cell.cellbaterai" type="number" class="form-control" placeholder="Masukan Jumlah Sel Baterai">
                        <button @submit.prevent="tambahCell" class="btn btn-outline-secondary" type="submit" id="button-addon2">Tambah</button>
                    </div>
-->
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
                </tr>
              </thead>

              <tbody>
                <tr v-for="(cell, index) in cell" :key="cell.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ cell.id }}</td>
                  <td>{{ cell.cellbaterai }}</td>
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
                  <th>No</th>
                  <th>Suhu Min</th>
                  <th>Suhu Max</th>
                  <th>V Min</th>
                  <th>V Max</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(Setting, index) in Setting" :key="Setting.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ Setting.temp_min }}</td>
                  <td>{{ Setting.temp_max }}</td>
                  <td>{{ Setting.tegangan_min }}</td>
                  <td>{{ Setting.tegangan_max }}</td>
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
      this.axios
        .delete("http://127.0.0.1:8000/api/battery/" + id)
        .then((response) => {
          let i = this.Battery.map((data) => data.id).indexOf(id);
          this.Battery.splice(i, 1);
        });
    },

    tambahCell() {
      this.axios
        .post("http://127.0.0.1:8000/api/cell/", this.cell)
        .then((response) => this.$router.push({ name: "data-bms" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },

    deleteSetting(id) {
      this.axios
        .delete("http://127.0.0.1:8000/api/setting/" + id)
        .then((response) => {
          let i = this.Setting.map((data) => data.id).indexOf(id);
          this.Setting.splice(i, 1);
        });
    },
  },
};
</script>



