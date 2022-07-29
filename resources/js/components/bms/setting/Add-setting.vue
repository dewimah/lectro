<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Tambah Data Setting</h3>
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
                <label for="temp_min">Suhu Mininum</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.temp_min">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            
            <div class="form-group">
                <label for="temp_max">Suhu Maksimum</label>
                <ValidationProvider name="temp_min" rules="batasmax" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.temp_max">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="tegangan_min">Tegangan Minimum</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.tegangan_min">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="tegangan_max">Tegangan Maksimum</label>
                <ValidationProvider name="temp_min" rules="batasmax" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.tegangan_max">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
            <div class="form-group">
                <label for="tegangan_min">Arus Minimum</label>
                <ValidationProvider name="temp_min" rules="batasmin" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.arus_min">
                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>

            <div class="form-group">
                <label for="tegangan_max">Arus Maksimum</label>
                <ValidationProvider name="temp_min" rules="batasmax" v-slot="{ errors }">
                <input type="number" class="form-control" v-model="Setting.arus_max">
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
            Setting: {}
        }
    },
    methods: {
        tambahSetting(){
            this.axios
                .post(process.env.MIX_API_KEY+'setting/', this.Setting)
                .then(response => (
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
                    this.$router.push({name:'data-bms'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>