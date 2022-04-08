<template>
    <div class="card card-success">
        <div class="card-header">
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
                <input type="number" class="form-control" v-model="Battery.jml_sel" placeholder="Jumlah Sel">
            </div>
        </div>

        <div class="card-footer">
            <router-link to="data-bms" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success">Update</button>
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
    cretaed(){
        this.axios
            .get('http://127.0.0.1:8000/api/battery/${this.$route.params.id}')
            .then ((res) => {
                this.Battery = res.data;
            })
    },
    methods: {
        updateBms(){
            this.axios
                .patch('http://127.0.0.1:8000/api/battery/${this.$route.params.id}', this.Battery)
                .then((res) => {
                    this.$router.push({ name:'Data-bms'})
                })
        }
    }
}
</script>