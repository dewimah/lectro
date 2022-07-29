<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data Sel</h3>
        </div>

        <form @submit.prevent="updateCell">
            <div class="card-body">
                <div class="form-group">
                    <label for="temp_min">Jumlah Sel</label>
                    <input type="number" class="form-control" v-model="cell.cellbaterai">
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
            cell: {}
        }
    },

    created() {
        this.axios
             .get(process.env.MIX_API_KEY+'cell/' + this.$route.params.id)
             .then((response) => {
                this.cell = response.data.data;
            })
    },

    methods: {
        updateCell(){
            this.axios
                .put(process.env.MIX_API_KEY+'cell/' + this.$route.params.id, this.cell)
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