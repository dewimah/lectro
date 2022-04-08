<template>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Data User</h3>
        </div>


    <form @submit.prevent="tambahUser">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama User</label>
                <input type="text" class="form-control" v-model="User.name" placeholder="Nama User">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" v-model="User.email" placeholder="Email User">
            </div>

            <div class="form-group">
                <label for="email">Password</label>
                <input type="text" class="form-control" v-model="User.password" placeholder="Password User">
            </div>
        </div>

        <div class="card-footer">
            <router-link to="data-user" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="button" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return{
            User: {}
        }
    },
    methods: {
        tambahUser(){
            this.axios
                .post('http://127.0.0.1:8000/api/user/', this.User)
                .then(response => (
                    this.$router.push({name:'Data-user'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>