<template>
    <div class="card card-success">
        <div class="card-header" style="background-color:#1c3b10">
            <h3 class="card-title">Edit Data User</h3>
        </div>


    <form @submit.prevent="updateUser">
        <div class="card-body">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control"  v-model="User.id" disabled>
            </div>

            <div class="form-group">
                <label for="name">Nama User</label>
                <input type="text" class="form-control" v-model="User.name" placeholder="Nama User">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control"  v-model="User.email" placeholder="Email User">
            </div>
        </div>

        <div class="card-footer">
            <router-link :to="{name: 'data-user'}" class="btn btn-danger" type="button" >Cancel</router-link>
            <button type="submit" class="btn btn-success" style="background-color:#1c3b10">Update</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return{
            User: []
        }
    },
    created(){
        this.axios
            .get(process.env.MIX_API_KEY+"user/"+this.$route.params.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
            .then ((response) => {
                this.User = response.data.data
                console.log(response.data)
            });
    },
    methods: {
        updateUser(){
            this.axios
                .put(process.env.MIX_API_KEY+"user/"+this.$route.params.id, this.User, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Berhasil Tersimpan'
                    }),
                    this.$router.push({ name:'data-user'})
                })
        }
    }
}
</script>