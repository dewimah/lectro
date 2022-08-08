<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Setting Arus</h1>
        </div>

        <form @submit.prevent="tambahSettingSuhu">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Setting Suhu</label>
                    <input type="text" class="form-control" v-model="SettingSuhu.name">
                </div>
                <div class="form-group">
                    <label for="suhu_min">Suhu Minimum</label>
                    <input type="number" class="form-control" v-model="SettingSuhu.temp_min">
                </div>
                <div class="form-group">
                    <label for="suhu_max">Suhu Maximum</label>
                    <input type="number" class="form-control" v-model="SettingSuhu.temp_max">
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
            SettingSuhu: {},
            role: localStorage.getItem("role")
        }
    },

    mounted() {
        if(this.role !== "admin")
        {
        localStorage.clear();
        window.location.href ="/login"
        } else {
        router.push({name : "add-setting-suhu"})
        }
    },

    methods: {
        tambahSettingSuhu(){
            this.axios
                .post(process.env.MIX_API_KEY+'settingsuhu/', this.SettingSuhu,{
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