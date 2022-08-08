<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Setting Tegangan</h1>
        </div>

        <form @submit.prevent="tambahSettingSuhu">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Setting Tegangan</label>
                    <input type="text" class="form-control" v-model="SettingTegangan.name">
                </div>
                <div class="form-group">
                    <label for="suhu_min">Tegangan Minimum</label>
                    <input type="number" class="form-control" v-model="SettingTegangan.tegangan_min">
                </div>
                <div class="form-group">
                    <label for="suhu_max">Tegangan Maximum</label>
                    <input type="number" class="form-control" v-model="SettingTegangan.tegangan_max">
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
            SettingTegangan: {},
            role: localStorage.getItem("role")
        }
    },

    mounted() {
        if(this.role !== "admin")
        {
        localStorage.clear();
        window.location.href ="/login"
        } else {
        router.push({name : "add-setting-tegangan"})
        }
    },

    methods: {
        tambahSettingSuhu(){
            this.axios
                .post(process.env.MIX_API_KEY+'settingtegangan/', this.SettingTegangan,{
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