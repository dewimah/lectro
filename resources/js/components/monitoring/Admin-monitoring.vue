<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Monitoring BMS - Admin</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped DataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>BMS</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="(BatteryUser, index) in BatteryUser" :key="BatteryUser.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ BatteryUser.battery.name }}</td>
                                        <td>{{ BatteryUser.user.name }}</td>
                                        <td>
                                            <router-link to="halaman-detail" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deleteUserdevice(BatteryUser.id)">
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
            BatteryUser: {},
            token: localStorage.getItem('token')
        }
    },

    created(){
        this.axios
        .get('http://127.0.0.1:8000/api/admin/userdevice/')
        .then((response) =>{
            this.BatteryUser = response.data;
        })
        .then(function (){
            $(".DataTable").DataTable();
        });
    },

    mounted(){
        localStorage.setItem('token', response.data.data.Token)
                localStorage.setItem('role', response.data.data.user.roles[0].name)
                if (response.data.data.user.roles[0].role === "admin") {
                    window.location.href = "/admin-monitoring"
                } else if (response.data.data.user.roles[0].role === "user") {
                    window.location.href = "/login"
                }
        // window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        // axios.get('http://127.0.0.1:8000/api/admin/user').then((response)=>{
        //     this.currentUser = response.data
        // }).catch((errors) => {
        //     console.log(errors)
        // })
    },

    methods: {
        deleteUserdevice(id){
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
                        .delete('http://127.0.0.1:8000/api/admin/userdevice/' + id)
                        .then(()=> {
                            Swal.fire(
                                "Terhapus",
                                "Data sudah terhapus",
                                "success"
                            );
                            let i = this.BatteryUser.map(data => data.id).indexOf(id);
                            this.BatteryUser.splice(i,1)
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