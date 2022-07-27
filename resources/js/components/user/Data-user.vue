<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Data User</h5></div>
                <div class="card-body">
                    <router-link to="add-user" class="btn btn-success" type="button" style="background-color:#1c3b10">
                    <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped DataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="(User, index) in User" :key="User.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ User.id }}</td>
                                        <td>{{ User.name }}</td>
                                        <td>{{ User.email }}</td>
                                        <td>
                                            <router-link :to="{ name: 'edit-user', params: {id: User.id} }" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deleteUser(User.id)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
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
        })
        .then(function (){
            $(".DataTable").DataTable();
        });
    },
    methods: {
        deleteUser(id) {
            Swal.fire({
                title: "Anda yakin ingin menghapus data ini?",
                text: "Klik batal untuk membatalkan hapus data",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#ddd",
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.value) {
                    this.axios
                        .delete('http://127.0.0.1:8000/api/user/' + id)
                        .then(()=> {
                            Swal.fire(
                                "Terhapus",
                                "Data sudah terhapus",
                                "success"
                            );
                            let i = this.User.map(data => data.id).indexOf(id);
                            this.User.splice(i,1)
                        })
                        .catch(() => {
                            Swal.fire (
                                "Gagal",
                                "Data gagal terhapus",
                                "warning"
                            );
                        });
                }
            });
        }
        // deleteUser(id){
        //     this.axios
        //         .delete('http://127.0.0.1:8000/api/user/' + id)
        //         .then(response => {
        //             let i = this.User.map(data => data.id).indexOf(id);
        //             this.User.splice(i,1)
        //         })
        //         .then(function (){
        //             var msg = "Apakah anda yakin untuk menghapusnya"
        //             agree = confirm(msg)
        //             if (agree)
        //                 return true
        //             else
        //                 return false
        //         });
        // }
    }
}
</script>
