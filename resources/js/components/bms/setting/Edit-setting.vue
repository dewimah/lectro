<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data Setting</h3>
        </div>


    <ValidationObserver v-slot="{handleSubmit}">
    <form @submit.prevent="handleSubmit(updateSetting)">
        <div class="card-body">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" v-model="Setting.id" disabled>
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
            <router-link :to="{name: 'data-bms'}" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Update</button>
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
    created(){
        this.axios
            .get(' http://127.0.0.1:8000/api/admin/setting/' + this.$route.params.id)
            .then ((response) => {
                this.Setting = response.data;
            })
    },
    methods: {
        updateSetting(){
            this.axios
                .put(' http://127.0.0.1:8000/api/admin/setting/' + this.$route.params.id, this.Setting)
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
                    this.$router.push({ name:'data-bms'})
                })
        }
    }
}
</script>