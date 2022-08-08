<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h1>HALAMAN REQUEST PAK RUDI</h1>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-6 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{this.User}}</h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="{ name: 'data-user' }" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div> -->

                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <p>Jumlah BMS</p>
                                    <h3>{{this.rudi}}</h3>
                                    
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="{ name: 'data-bms'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data()
    {
        return{
            rudi:{},
            role:localStorage.getItem("role")
        }
    },

    created() {
        //console.log(this.dataMessageUser);
        this.axios
        .get(process.env.MIX_API_KEY + "rudi/",  {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then((response) => {
            // console.log(response);
            this.rudi = response.data.data;
        })

        // this.axios
        // .get(process.env.MIX_API_KEY + "jumlahuser/",  {
        //         headers: {
        //             "Content-Type": "application/json",
        //             Authorization: "Bearer " + localStorage.getItem("token")
        //         }
        //     })
        // .then((response) => {
        //     //console.log(response.data);
        //     this.User = response.data.data;
        // })
    }
}

</script>
