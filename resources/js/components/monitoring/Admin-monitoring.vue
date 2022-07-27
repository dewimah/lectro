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
                                        <th>ID Baterai</th>
                                        <th>ID User</th>
                                        <!-- <th>BMS</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="(BatteryUser, index) in BatteryUser" :key="BatteryUser.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ BatteryUser.battery_id }}</td>
                                        <td>{{ BatteryUser.id }}</td>
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
            // Monitoring: {},
            // currentUser: {},
            BatteryUser: {},
            token: localStorage.getItem('token')
        }
    },

    created(){
        this.axios
        .get('http://127.0.0.1:8000/api/userdevice/')
        .then((response) =>{
            this.BatteryUser = response.data;
        })
        .then(function (){
            $(".DataTable").DataTable();
        });
        // this.axios
        //     .get("http://127.0.0.1:8000/api/monitoring/")
        //     .then((response) => {
        //         this.Monitoring = response.data;
        //     })
        //     .then(function(){
        //         $(".DataTable").DataTable();
        //     });
    },

    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('http://127.0.0.1:8000/api/user').then((response)=>{
            this.currentUser = response.data
        }).catch((errors) => {
            console.log(errors)
        })
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
                        .delete('http://127.0.0.1:8000/api/userdevice/' + id)
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
        //     this.axios
        //         .delete('http://127.0.0.1:8000/api/userdevice/' + id)
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
        }
    }
    
}
</script>