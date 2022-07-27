<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data User Device</h3>
        </div>


        <form @submit.prevent="updateUserdevice">
                <div class="card-body">
                    <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" v-model="BatteryUser.id" disabled>
                </div>

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
                        <option value=1>Aktif</option>
                        <option value=2>Non Aktif</option>
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
    created() {
        this.axios
             .get('http://127.0.0.1:8000/api/admin/userdevice/' + this.$route.params.id)
             .then((response) => {
                this.BatteryUser = response.data;
            }),
        this.loadDataBattery();
        this.loadDataUser();
    },
    methods: {
        updateUserdevice(){
            this.axios
                .put('http://127.0.0.1:8000/api/admin/userdevice/' + this.$route.params.id, this.BatteryUser)
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
                .get('http://127.0.0.1:8000/api/admin/battery/')
                .then(({data}) => {this.Battery = data});
        },
        loadDataUser(){
            this.axios
                .get('http://127.0.0.1:8000/api/admin/user/')
                .then(({data}) => {this.User = data});
        }
    }
}
</script>