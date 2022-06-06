<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Tambah Data BMS</h3>
        </div>


    <form @submit.prevent="tambahBms">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" v-model="Battery.name" placeholder="Nama BMS">
            </div>
            
            <div class="form-group">
                <label for="jml_sel">Jumlah Sel</label>
                <select name="jml_sel" class="form-control" v-model="Battery.cell_id" @change="onChangeChain">
                    <option>--Jumlah Sel--</option>
                    <option v-for="cell in cell" :key="cell.id" v-text="cell.cellbaterai"></option>
                </select>
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
            cell: {}
        }
    },
    methods: {
        tambahBms(){
            this.axios
                .post('http://127.0.0.1:8000/api/battery/', this.Battery)
                .then(response => (
                    this.$router.push({name:'data-bms'})
                ))
                .catch(err => console.log(err))
                //console.log(error)
                //.finally(() => this.loading = false)
        }
    }
}
</script>