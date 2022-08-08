<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h1>HALAMAN REQUEST PAK RUDI</h1>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-6">
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
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{this.Battery}}</h3>
                                    <p>BMS</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="{ name: 'data-bms'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- <div class="card direct-chat direct-chat-primary">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card-header">
                                <h3 class="card-title">Forum Diskusi</h3>
                            </div>
                            <div class="card-body">
                                <div class="direct-chat-messages">
                                    <div class="direct-chat-msg right"  v-if="this.current_user == Message.user_id">
                                        <div v-for="Message in Message" :key="Message.id" class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">{{ Message.name}}</span>
                                            <span class="direct-chat-timestamp float-right">{{Message.jam}}</span>
                                        </div>
                                        <div class="direct-chat-text" v-for="Message in Message" :key="Message.id">
                                            {{Message.message}}
                                        </div>
                                    </div>

                                    <div class="direct-chat-msg" v-else>
                                        <div class="direct-chat-infos clearfix" v-for="Message in Message" :key="Message.id">
                                            <span class="direct-chat-name float-right">{{Message.name}}</span>
                                            <span class="direct-chat-timestamp float-left">{{Message.jam}}</span>
                                        </div>

                                        <div class="direct-chat-text" v-for="Message in Message" :key="Message.id">
                                            {{Message.message}}
                                        </div>
                                        
                                    </div>

                                    
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <form @submit.prevent="kirimPesan">
                                    <div class="input-group">
                                        <textarea type="text" v-model="Chat.message" placeholder="Type Message ..." class="form-control"></textarea>
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            Battery:[],
            User: [],
            result:[],
            dataMessage:[],
            dataMessageUser:[],
            Chat: {},
            Message: [],
            current_user : localStorage.getItem("id"),
        }
    },

    mounted() {
        //this.fetchCurrentUser(this.$route.params.id) 
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
            this.Battery = response.data.data;
        })

        this.axios
        .get(process.env.MIX_API_KEY + "jumlahuser/",  {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token")
                }
            })
        .then((response) => {
            //console.log(response.data);
            this.User = response.data.data;
        })

        // this.axios
        // .get(process.env.MIX_API_KEY + "message/",  {
        //         headers: {
        //             "Content-Type": "application/json",
        //             Authorization: "Bearer " + localStorage.getItem("token")
        //         }
        //     })
        // .then((response) => {
        //     console.log(response.data);
        //     this.Message = response.data;
        // })
    },

    methods: {
        // kirimPesan() {
        //     this.axios
        //     .post(process.env.MIX_API_KEY + "message/", this.Chat, {
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 Authorization: "Bearer " + localStorage.getItem("token")
        //             }
        //         })
        //     .then((response) => {
        //         //console.log(response.data.data);
        //         this.Message = response.data;
        //         this.newMessage = '';

                
        //     })
        // },
        // chatkanan() {
        //     this.axios
        //     .get(process.env.MIX_API_KEY + "message/", {
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 Authorization: "Bearer " + localStorage.getItem("token")
        //             }
        //         })
        //     .then((response) => {
                
        //     })
        // }
    }
}
</script>
