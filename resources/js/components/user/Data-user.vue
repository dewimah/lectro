<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Data User</h5></div>
                <div class="card-body">
                    <router-link to="add-user" class="btn btn-success" type="button">
                    <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--<th>No</th>-->
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <!--<th>Password</th>-->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="User in User" :key="User.id">
                                        <!--<td>x</td>-->
                                        <td>{{ User.id }}</td>
                                        <td>{{ User.name }}</td>
                                        <td>{{ User.email }}</td>
                                        <!--<td>{{ User.password }}</td>-->
                                        <td>
                                            <router-link :to="{name: 'edit-user', params: {id: User.id}}" class="btn btn-app">
                                                <i class="fas fa-edit"></i> <br>Edit
                                            </router-link>
                                            <button class="btn btn-danger" @click="deleteUser(User.id)">
                                                <i class="fa-solid fa-trash"></i> <br>Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    
                </div>
            </div>
        </div>
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
        .get('http://127.0.0.1:8000/api/user')
        .then(response =>{
            this.User = response.data;
        });
    },
    methods: {
        deleteUser(id){
            this.axios
                .delete('http://127.0.0.1:8000/api/user/' + id)
                .then(response => {
                    let i = this.User.map(data => data.id).indexOf(id);
                    this.User.splice(i,1)
                });
        }
    }
}
    
</script>
