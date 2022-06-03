<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Tambah Data User</h3>
        </div>

        <form v-if="!success">
            <div class="card-body">
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control" v-model="User.name" placeholder="Nama User">
                    <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
                </div>
                
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" v-model="User.email" placeholder="Email User">
                    <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.role }">
                    <label for="exampleSelectRounded0">Role</label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" v-model="User.role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    <span class="help-block" v-if="has_error && errors.role">{{ errors.role }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" v-model="User.password" placeholder="Password minimal 8 karakter">
                    <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password_comfirmation }">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" class="form-control" v-model="User.password_confirmation" placeholder="Konfirmasi Password">
                    <span class="help-block" v-if="has_error && errors.password_confirmation">{{ errors.password_comfirmation }}</span>
                </div>
            </div>

            <div class="card-footer">
                <router-link to="data-user" class="btn btn-danger" type="button">Cancel</router-link>
                <button @click.prevent="tambahUser" type="button" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
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
            has_error: false,
            error: '',
            errors: {},
            success: false
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
                
        },
        success: function(){
            app.success = true
        },
        error: function(response){
            console.log(response.response.data.errors)
            app.has_error = true
            app.error = response.response.data.error
            app.error = response.response.data.error || {}
        }
    }
}
</script>