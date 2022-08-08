<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Setting Arus</h1>
        </div>

        <form @submit.prevent="tambahSettingArus">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Setting Arus</label>
                    <input type="text" class="form-control" v-model="SettingArus.name">
                </div>
                <div class="form-group">
                    <label for="arus_min">Arus Minimum</label>
                    <input type="number" class="form-control" v-model="SettingArus.arus_min">
                </div>
                <div class="form-group">
                    <label for="arus_max">Arus Maximum</label>
                    <input type="number" class="form-control" v-model="SettingArus.arus_max">
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
            SettingArus: {},
            role: localStorage.getItem("role")
        }
    },

    mounted() {
        if(this.role !== "admin")
        {
        localStorage.clear();
        window.location.href ="/login"
        } else {
        router.push({name : "add-setting-arus"})
        }
    },

    methods: {
        tambahSettingArus(){
            this.axios
                .post(process.env.MIX_API_KEY+'settingarus/', this.SettingArus,{
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
                .catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
                })
                //.catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>