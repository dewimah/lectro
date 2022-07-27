<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Data User Device</h5></div>
                <div class="card-body">
                    <router-link to="add-userdevice" class="btn btn-success" type="button" style="background-color:#1c3b10">
                    <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped DataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama BMS</th>
                                        <th>Nama User</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="(BatteryUser, index) in BatteryUser" :key="BatteryUser.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ BatteryUser.battery.name }}</td>
                                        <td>{{ BatteryUser.user.name }}</td>
                                        <td v-if="(BatteryUser.is_active == 0)">Non Aktif</td>
                                        <td v-else>Aktif</td>
                                        
                                        <td>
                                            <router-link 
                                            :to="{ name: 'edit-userdevice', params: { id: BatteryUser.id } }" 
                                            class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
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
            BatteryUser: {}
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
