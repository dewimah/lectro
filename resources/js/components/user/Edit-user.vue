<template>
    <div class="card card-success">
        <div class="card-header">
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
<!--
            <div class="form-group">
                <label for="email">Password</label>
                <input type="text" class="form-control" v-model="User.password" placeholder="Password User">
            </div>
-->
        </div>

        <div class="card-footer">
            <router-link :to="{name: 'data-user'}" class="btn btn-danger" type="button">Cancel</router-link>
            <button type="submit" class="btn btn-success">Update</button>
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
    created(){
        this.axios
            .get('http://127.0.0.1:8000/api/user/' + this.$route.params.id)
            .then ((response) => {
                this.User = response.data;
            });
    },
    methods: {
        /*editUser(id){
            this.axios.get('http://127.0.0.1:8000/api/user/' + id)
            .then((response)=>{
                this.User = response.data;
                console.log(response.data);
            });
        },*/
        updateUser(){
            this.axios
                .put('http://127.0.0.1:8000/api/user/' + this.$route.params.id, this.User)
                .then((response) => {
                    this.$router.push({ name:'data-user'})
                })
        }
    }
}
</script>