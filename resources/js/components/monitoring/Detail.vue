<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Detail Monitoring</h5></div>
                <div class="card-body">
                    <router-link to="admin-monitoring" class="btn btn-success" type="button" style="background-color:#1c3b10">
                    Kembali</router-link> <br><br>
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped DataTable">
                                <thead>
                                    <tr>
                                        <th>SoC</th>
                                        <th>SoH</th>
                                        <th>Arus</th>
                                        <th>T1</th>
                                        <th>T2</th>
                                        <th>T3</th>
                                        <th>V Sel</th>
                                        <th>V Total</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>X</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
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
            Monitoring: {}
        }
    },
    created(){
        this.axios
        .get('http://127.0.0.1:8000/api/monitoring/')
        .then(response =>{
            this.Monitoring = response.data;
        });
    },
    methods: {
        deleteSetting(id){
            this.axios
                .delete('http://127.0.0.1:8000/api/monitoring/' + id)
                .then(response => {
                    let i = this.Monitoring.map(data => data.id).indexOf(id);
                    this.Monitoring.splice(i,1)
                });
        }
    }
}
</script>