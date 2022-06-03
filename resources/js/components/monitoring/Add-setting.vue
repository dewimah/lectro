<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Tambah Data Setting</h3>
        </div>


    <form @submit.prevent="tambahSetting">
        <div class="card-body">
            <div class="form-group">
                <label for="temp_min">Suhu Mininum</label>
                <input type="number" class="form-control" v-model="Setting.temp_min">
            </div>
            
            <div class="form-group">
                <label for="temp_max">Suhu Maksimum</label>
                <input type="number" class="form-control" v-model="Setting.temp_max">
            </div>

            <div class="form-group">
                <label for="tegangan_min">Tegangan Minimum</label>
                <input type="number" class="form-control" v-model="Setting.tegangan_min">
            </div>

            <div class="form-group">
                <label for="tegangan_max">Tegangan Maksimum</label>
                <input type="number" class="form-control" v-model="Setting.tegangan_max">
            </div>
        </div>

        <div class="card-footer">
            <router-link to="halaman-detail" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return{
            Setting: {}
        }
    },
    methods: {
        tambahSetting(){
            this.axios
                .post('http://127.0.0.1:8000/api/setting/', this.Setting)
                .then(response => (
                    this.$router.push({name:'halaman-detail'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>