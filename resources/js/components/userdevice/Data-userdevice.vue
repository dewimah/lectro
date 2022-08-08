<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h1>Data User Device</h1></div>
                <div class="card-body">
                    <router-link to="add-userdevice" class="btn btn-success" type="button" style="background-color:#1c3b10">
                    <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped DataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Nama BMS</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="(BatteryUser, index) in BatteryUser" :key="BatteryUser.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ BatteryUser.namauser }}</td>
                                        <td>{{ BatteryUser.namabattery }}</td>
                                        <td v-if="(BatteryUser.is_active == 0)">Non Aktif</td>
                                        <td v-else>Aktif</td> 
                                        
                                        <td>
                                            <router-link :to="{ name: 'edit-userdevice', params: {id: BatteryUser.bttt} }" 
                                            class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm" @click="deleteUserdevice(BatteryUser.bttt)">
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
            role:localStorage.getItem("role")
        }
    },
    mounted() {
        this.axios.get(process.env.MIX_API_KEY + "userdevice", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            }).then((response) => {
            //console.log(response)
            this.BatteryUser = response.data
        })
        .then(function (){
            $(".DataTable").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        });

        this.axios.get(process.env.MIX_API_KEY + "rudi", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            }).then((response) => {
            console.log(response)
            //this.BatteryUser = response.data
        })

    },
    created(){
        if(this.role !== "admin")
        {
        localStorage.clear();
        window.location.href ="/login"
        } else {
        router.push({name : "data-userdevice"})
        }
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
                        .delete(process.env.MIX_API_KEY+'userdevice/' + id, {
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
