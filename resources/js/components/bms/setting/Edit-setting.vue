<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data Setting</h3>
        </div>


    <form @submit.prevent="updateSetting">
        <div class="card-body">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" v-model="Setting.id" disabled>
            </div>

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
            <router-link :to="{name: 'halaman-detail'}" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Update</button>
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
    created(){
        this.axios
            .get('http://127.0.0.1:8000/api/setting/' + this.$route.params.id)
            .then ((response) => {
                this.Setting = response.data;
            })
    },
    methods: {
        /*editBms(id){
            this.axios.get('http://127.0.0.1:8000/api/battery/' + id)
            .then((response)=>{
                this.Battery = response.data;
                console.log(response.data);
            })
        },*/
        updateSetting(){
            this.axios
                .put('http://127.0.0.1:8000/api/setting/' + this.$route.params.id, this.Setting)
                .then((response) => {
                    this.$router.push({ name:'data-bms'})
                })
        }
    }
}
</script>