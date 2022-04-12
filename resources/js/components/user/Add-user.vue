<template>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Data User</h3>
        </div>

        <form>
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
                    <label for="exampleSelectRounded0">Role</label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" v-model="User.role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" v-model="User.password" placeholder="Password minimal 8 karakter">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" class="form-control" v-model="User.password_confirmation" placeholder="Konfirmasi Password">
                </div>
            </div>

            <div class="card-footer">
                <router-link to="data-user" class="btn btn-danger" type="button">Cancel</router-link>
                <button @click.prevent="tambahUser" type="button" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return{
            User: {
                name: '',
                email: '',
                role: '',
                password: '',
                password_conformation: ''
            },
            errors:[]
        }
    },
    methods: {
        tambahUser(){
            this.axios
                .post('http://127.0.0.1:8000/api/register/', this.User)
                .then(response => (
                    this.$router.push({name:'data-user'})
                    //console.log(response)
                ))
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    //console.log(error)
                })
                
        }
    }
}
</script>