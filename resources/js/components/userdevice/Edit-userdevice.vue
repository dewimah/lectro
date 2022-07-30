<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data User Device</h3>
        </div>


        <form @submit.prevent="updateUserdevice">
                <div class="card-body">
                    <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" v-model="BatteryUser.bttt" disabled>
                </div>

                <div class="form-group">
                    <label for="baterai_id">Nama Baterai</label>
                    <select name="baterai_id" class="form-control" v-model="BatteryUser.bttt">
                        <option v-for="Battery in Battery" :key="Battery.id" :value="Battery.id">{{Battery.name}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="user_id">Nama User</label>
                    <select name="user_id" class="form-control" v-model="BatteryUser.usss">
                        <option v-for="User in User" :key="User.id" :value="User.id">{{User.name}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" class="form-control" v-model="BatteryUser.is_active">
                        <option value='aktif'>Aktif</option>
                        <option value='non-aktif'>Non Aktif</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <router-link to="/data-userdevice" class="btn btn-danger" type="button">Cancel</router-link>
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
    created() {
        // this.axios
        //      .get(process.env.MIX_API_KEY+"userdevice/"+this.$route.params.id)
        //      .then((response) => {
        //         this.BatteryUser = response.data;
        //         //console.log(response.data)
        //     }),
        this.loadDataBattery();
        this.loadDataUser();
        console.log(this.$route.params.id)
        this.axios
            .get(process.env.MIX_API_KEY+"userdevice/" + this.$route.params.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then((response) => {
                this.BatteryUser = response.data[0];
                console.log(response)
            })

    },
    methods: {
        updateUserdevice(){
            this.axios
                .put(process.env.MIX_API_KEY+"userdevice/"+this.$route.params.id, this.BatteryUser, {
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
                    this.$router.push({ name:'data-userdevice'})
                })
        },
        loadDataBattery(){
            this.axios
                .get(process.env.MIX_API_KEY+"battery/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {
                    console.log(data)
                    this.Battery = data.data
                    // console.log(this.Battery)
                    });
        },
        loadDataUser(){
            this.axios
                .get(process.env.MIX_API_KEY+"dewi/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {
                    console.log(data)
                    this.User = data
                    });
        }
    }
}
</script>