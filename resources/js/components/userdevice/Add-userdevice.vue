<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Data User Device</h1>
        </div>


        <form @submit.prevent="tambahUserdevice"> 
            <div class="card-body">
                <div class="form-group">
                    <label for="baterai_id">Nama Baterai</label>
                    <select name="baterai_id" class="form-control" v-model="BatteryUser.battery_id">
                        <option v-for="Battery in Battery" :key="Battery.id" :value="Battery.id">{{Battery.name}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="user_id">Nama User</label>
                    <select name="user_id" class="form-control" v-model="BatteryUser.user_id">
                        <option v-for="User in User" :key="User.id" :value="User.id">{{User.name}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" class="form-control" v-model="BatteryUser.is_active">
                        <option value=aktif>Aktif</option>
                        <option value=non-aktif>Non Aktif</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <router-link to="data-userdevice" class="btn btn-danger" type="button">Cancel</router-link>
                <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return{
            BatteryUser: {},
            Battery: {},
            User: {}
        }
    },
    // mounted() {
    //     this.axios
    //     .get(process.env.MIX_API_KEY+"userdevice/" + this.$route.params.id, {
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 Authorization: "Bearer " + localStorage.getItem("token")
    //             }
    //         })
    //     .then((response) => {
    //         //console.log(response)
    //         this.BatteryUser = response.data;
    //     })
        
    // },

    methods: {
        tambahUserdevice(){
            this.axios
                .post(process.env.MIX_API_KEY+'userdevice/', this.BatteryUser, {
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
                    this.$router.push({name:'data-userdevice'})
                ))
                .catch(err => console.log(err))
        },
        loadDataBattery(){
            this.axios
                .get(process.env.MIX_API_KEY+"battery/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.Battery = data.data});
        },
        loadDataUser(){
            this.axios
                .get(process.env.MIX_API_KEY+"dewi/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.User = data});
        }
    },
    created(){
        this.loadDataBattery();
        this.loadDataUser();
    }
}
</script>