<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h1 class="card-title">Tambah Data Setting</h1>
        </div>

    <ValidationObserver v-slot="{handleSubmit}">
    <form @submit.prevent="handleSubmit(tambahSetting)">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Setting</label>
                <ValidationProvider name="name" rules="required" v-slot="{ errors }">
                <input type="text" class="form-control" v-model="Setting.name">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="temp_min">Suhu</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <select type="number" class="form-control" v-model="Setting.settingsuhus_id">
                    <option v-for="SettingSuhu in SettingSuhu" :key="SettingSuhu.id" :value="SettingSuhu.id">{{SettingSuhu.name}}</option>
                </select>
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="tegangan_min">Tegangan</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <select type="number" class="form-control" v-model="Setting.settingtegangans_id">
                    <option v-for="SettingTegangan in SettingTegangan" :key="SettingTegangan.id" :value="SettingTegangan.id">{{SettingTegangan.name}}</option>
                </select>
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="tegangan_min">Arus</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <select type="number" class="form-control" v-model="Setting.settingaruses_id">
                    <option v-for="SettingArus in SettingArus" :key="SettingArus.id" :value="SettingArus.id">{{SettingArus.name}}</option>
                </select>
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
        </div>

        <div class="card-footer">
            <router-link to="/data-bms" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
        </div>
    </form>
    </ValidationObserver>
</div>
</template>

<script>
export default {
    data() {
        return{
            Setting: {},
            SettingSuhu: {},
            SettingArus: {},
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
        router.push({name : "add-setting"})
        }
    },

    methods: {
        tambahSetting(){
            this.axios
                .post(process.env.MIX_API_KEY+'setting/', this.Setting, {
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
            .catch(err => console.log(err))
            .finally(() => this.loading = false)
        },

        loadDataSettingArus() {
            this.axios
                .get(process.env.MIX_API_KEY+'settingarus/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.SettingArus = data});
        },

        loadDataSettingTegangan() {
            this.axios
                .get(process.env.MIX_API_KEY+'settingtegangan/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.SettingTegangan = data});
        },

        loadDataSettingSuhu() {
            this.axios
                .get(process.env.MIX_API_KEY+'settingsuhu/', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then(({data}) => {this.SettingSuhu = data});
        }
        
    },

    created() {
        this.loadDataSettingArus();
        this.loadDataSettingTegangan();
        this.loadDataSettingSuhu();
    }
}
</script>