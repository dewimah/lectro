<template>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline" color="#1c3b10">
                <div class="card-header text-center">
                    <h4>BMS's LECTRO</h4>
                </div>

                <div class="card-body">
                    <p class="login-box-msg">Log in to start your session</p>
                    <ValidationObserver v-slot="{handleSubmit}">
                        <form  @submit.prevent="handleSubmit(login)">
                            <div class="form-group mb-3">
                                <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
                                <input type="email" class="form-control" v-model="User.email" placeholder="Email">
                                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                                </ValidationProvider>
                            </div>

                            <div class="form-group mb-3">
                                <ValidationProvider name="password" rules="min:8" v-slot="{ errors }">
                                <input type="password" class="form-control" v-model="User.password" placeholder="Password">
                                <span class="invalid-feedback d-block">{{ errors[0] }}</span>
                                </ValidationProvider>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block" color="#1c3b10">Log In</button>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return{
            User: {
                email:'',
                password:''
            },
            errors:{}
        }
    },

    methods: {
        login(){
            axios.post(process.env.MIX_API_KEY+'login', this.User).then((response) =>{
                console.log(response)
                localStorage.setItem('token', response.data.data.Token)
                localStorage.setItem('role', response.data.data.user.roles[0].name)
                localStorage.setItem('id', response.data.data.user.id)
                if (response.data.data.battery.length !== 0) {
                    localStorage.setItem('battery_id', response.data.data.battery[0].battery_id)
                }
                if (response.data.data.user.roles[0].name === "admin") {
                    window.location.href = "/admin-monitoring"
                } else if (response.data.data.user.roles[0].name === "user") {
                    window.location.href = "/user-monitoring"
                }
                //console.log(response.data)
                // this.$router.push({ name: "admin-monitoring"});
            }).catch((errors) => {
                this.errors = errors.response.data.errors;
            })
        }
    }
}

</script>