<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data BMS</h3>
        </div>


    <form @submit.prevent="updateBms">
        <div class="card-body">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" v-model="Battery.id" disabled>
            </div>

            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" v-model="Battery.name" placeholder="Nama BMS">
            </div>
            
            <div class="form-group">
                <label for="jml_sel">Jumlah Sel</label>
                <select name="jml_sel" class="form-control" v-model="Battery.cell_id">
                    <option v-for="cell in cell" :key="cell.id" :value="cell.id">{{cell.cellbaterai}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jml_sel">Setting</label>
                <select name="jml_sel" class="form-control" v-model="Battery.setting_id">
                    <option v-for="Setting in Setting" :key="Setting.id" :value="Setting.id">{{Setting.name}}</option>
                </select>
            </div>

            <div class="form-group">
                    <label for="name">Tipe</label>
                    <input type="text" class="form-control" v-model="Battery.tipe" placeholder="Tipe BMS">
                </div>

                <div class="form-group">
                    <label for="name">Serial</label>
                    <input type="text" class="form-control" v-model="Battery.serial" placeholder="Serial BMS">
                </div>
        </div>

        <div class="card-footer">
            <router-link :to="{name: 'data-bms'}" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Update</button>
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
    created(){
        this.axios
            .get(process.env.MIX_API_KEY+"battery/"+this.$route.params.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then ((response) => {
                this.Battery = response.data.data;
            }),
        this.loadDataCell();
        this.loadDataSetting();
    },
    methods: {
        updateBms(){
            this.axios
                .put(process.env.MIX_API_KEY+"battery/"+this.$route.params.id, this.Battery, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
                    this.$router.push({ name:'data-bms'})
                })
        },
        loadDataCell(){
            this.axios
                .get(process.env.MIX_API_KEY+"cell/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {
                    // console.log(data)
                    this.cell = data.data
                    });
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
}
</script>