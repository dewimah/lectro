<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Data BMS</h1>
        </div>


        <form @submit.prevent="tambahBms">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" v-model="Battery.name" placeholder="Nama BMS" required>
                </div>
            
                <div class="form-group">
                    <label for="jml_sel">Jumlah Sel</label>
                    <select name="jml_sel" class="form-control" v-model="Battery.cell_id" required>
                        <option v-for="cell in cell" :key="cell.id" :value="cell.id">{{cell.cellbaterai}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jml_sel">Setting</label>
                    <select name="jml_sel" class="form-control" v-model="Battery.setting_id" required>
                        <option v-for="Setting in Setting" :key="Setting.id" :value="Setting.id">{{Setting.name}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Tipe</label>
                    <input type="text" class="form-control" v-model="Battery.tipe" placeholder="Tipe BMS" required>
                </div>

                <div class="form-group">
                    <label for="name">Serial</label>
                    <input type="text" class="form-control" v-model="Battery.serial" placeholder="Serial BMS" required>
                </div>
            </div>

            <div class="card-footer">
                <router-link to="data-bms" class="btn btn-danger" type="button">Cancel</router-link>
                <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return{
            Battery: {},
            cell: {},
            Setting: {}
        }
    },
    methods: {
        tambahBms(){
            this.axios
                .post(process.env.MIX_API_KEY+'battery/', this.Battery, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(response => (
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
                    this.$router.push({name:'data-bms'})
                ))
                .catch(err => console.log(err))
        },
        loadDataCell(){
            this.axios
                .get(process.env.MIX_API_KEY+'cell/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.cell = data.data});
        },
        loadDataSetting(){
            this.axios
                .get(process.env.MIX_API_KEY+'setting/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.Setting = data});
        }
    },
    created(){
        this.loadDataCell();
        this.loadDataSetting();
    }
}
</script>