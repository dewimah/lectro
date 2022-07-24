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
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>BMS</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>
                                            <router-link to="halaman-detail" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </router-link>
                                            <button class="btn btn-danger btn-sm">
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
            Monitoring: {},
            currentUser: {},
            token: localStorage.getItem('token')
        }
    },

    created(){
        this.axios
            .get("http://127.0.0.1:8000/api/monitoring/")
            .then((response) => {
                this.Monitoring = response.data;
            })
            .then(function(){
                $(".DataTable").DataTable();
            });
    },

    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('http://127.0.0.1:8000/api/user').then((response)=>{
            this.currentUser = response.data
        }).catch((errors) => {
            console.log(errors)
        })
    },
    
}
</script>