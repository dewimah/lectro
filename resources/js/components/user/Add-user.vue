<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Tambah Data User</h3>
        </div>

        <ValidationObserver v-slot="{handleSubmit}">
        <form @click.prevent="handleSubmit(tambahUser)">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama User</label>
                    <ValidationProvider name="name" rules="required" v-slot="{ errors }">
                    <input type="text" class="form-control" v-model="User.name" placeholder="Nama User">
                    <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" v-model="User.email" placeholder="Email User">
                    
                </div>

                <div class="form-group">
                    <label for="exampleSelectRounded0">Role</label>
                    <ValidationProvider name="role" rules="required" v-slot="{ errors }">
                    <select class="custom-select rounded-0" id="exampleSelectRounded0" v-model="User.role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <ValidationProvider name="password" rules="min:8" v-slot="{ errors }">
                    <input type="text" class="form-control" v-model="User.password" placeholder="Password minimal 8 karakter">
                    <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <ValidationProvider name="passwordconfirmation" rules="min:8|confirmpassword" v-slot="{ errors }">
                    <input type="password" class="form-control" v-model="User.password_confirmation" placeholder="Konfirmasi Password">
                    <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                    </ValidationProvider>
                </div>
            </div>

            <div class="card-footer">
                <router-link to="data-user" class="btn btn-danger" type="button">Cancel</router-link>
                <button type="button" class="btn btn-success" style="background-color:#1c3b10">Simpan</button>
            </div>
        </form>
        </ValidationObserver>
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
                .post('http://127.0.0.1:8000/api/admin/register/', this.User)
                .then(response => (
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
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