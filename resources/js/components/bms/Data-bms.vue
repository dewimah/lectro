<template>
<div class="bms">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h5>Data BMS</h5></div>
                <div class="card-body">
                    <router-link to="add-bms" class="btn btn-success" type="button">
                    <i class="fa-solid fa-circle-plus"></i> Tambah</router-link> <br><br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--<th>No</th>-->
                                        <th>ID</th>
                                        <th>Nama BMS</th>
                                        <th>Jumlah Sel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr v-for="bms in bms" :key="bms.id">
                                        <!--<td>x</td>-->
                                        <td>{{ bms.id }}</td>
                                        <td>{{ bms.name }}</td>
                                        <td>{{ bms.jml_sel }}</td>
                                        <td>
                                            <router-link :to="{name: 'edit-bms', params: {id: bms.id}}" class="btn btn-app">
                                                <i class="fas fa-edit"></i> <br>Edit
                                            </router-link>
                                            <button class="btn btn-danger" @click="deletebms(bms.id)">
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
</div>
</template>

<script>
export default {
    data() {
        return{
            Battery: []
        }
    },
    created(){
        this.axios
        .get('http://127.0.0.1:8000/api/battery/')
        .then(response =>{
            this.product = response.data;
        });
    },
    methods: {
        deleteBms(id){
            this.axios
                .delete('http://127.0.0.1:8000/api/battery/${id}')
                .then(response => {
                    let i = this.product.map(data => data.id.indexOf(id));
                    this.product.splice(i,1)
                });
        }
    }
}
</script>


