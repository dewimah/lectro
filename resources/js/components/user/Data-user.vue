<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h1>Data User</h1></div>
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
            User: {},
            role: localStorage.getItem("role")
        }
    },
    mounted(){
        if(this.role !== "admin")
        {
        localStorage.clear();
        window.location.href ="/login"
        } else {
        router.push({name : "data-user"})
        }
    },
    created(){
        this.axios
        .get(process.env.MIX_API_KEY+"dewi/", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then(response =>{
            this.User = response.data;
            console.log(response.data)
        })
        .then(function (){
            $(".DataTable").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
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
                        .delete(process.env.MIX_API_KEY+'user/' + id,{
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
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
    }
}
</script>

<style>
.buttons-excel {
  display: inline-block;
  font-weight: 400;
  line-height: 1.6;
  color: #212529;
  text-align: center;
  text-decoration: none;
  vertical-align: middle;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  border-radius: 0.25rem;
  color: #fff;
  background-color: #007e0f;
  border-color: #005a21;
}
.buttons-pdf {
  display: inline-block;
  font-weight: 400;
  line-height: 1.6;
  color: #212529;
  text-align: center;
  text-decoration: none;
  vertical-align: middle;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  border-radius: 0.25rem;
  color: #fff;
  background-color: #c20000;
  border-color: #f30000;
}
</style>
