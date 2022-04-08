<template>
    <div class="card card-success">
        <div class="card-header">
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
                <input type="number" class="form-control" v-model="Battery.jml_sel" placeholder="Jumlah Sel">
            </div>
        </div>

        <div class="card-footer">
            <router-link to="data-bms" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return{
            Battery: {}
        }
    },
    methods: {
        tambahBms(){
            this.axios
                .post('http://127.0.0.1:8000/api/battery/', this.Battery)
                .then(response => (
                    this.$router.push({name:'Data-bms'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>