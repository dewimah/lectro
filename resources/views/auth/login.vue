<template>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline" color="#1c3b10">
                <div class="card-header text-center">
                    <h4>BMS's LECTRO</h4>
                </div>

                <div v-if="loginFailed" class="alert alert-danger">
                        Email atau Password Anda salah.
                </div>

                <div class="card-body">
                    <p class="login-box-msg">Log in to start your session</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" v-model="User.email" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="User.password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <button @click.prevent="login" type="submit" class="btn btn-success btn-block" color="#1c3b10">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return{
            //state user
            User: {
                email:'',
                password:''
            },
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state validation
            validation: [],
            //state login failed
            loginfailed:null
        }
    },

    methods: {
        /*login(){
            axios.post('http://127.0.0.1:8000/api/login/', this.User).then(() =>{
                this.$router.push({ name: "admin-monitoring"});
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
        */
       login() {
           if (this.User.email && this.User.password)
           {
               axios.get('http://localhost:8000/sanctum/csrf-cookie')
                    .then(response => {
                        //debug cookie
                        console.log(response)

                        axios.post('http://localhost:8000/api/login', {
                            email: this.USer.email,
                            password: this.User.password
                        }).then(res => {
                            //debug user login
                            console.log(res)

                            if (res.data.success){
                                //set localStoarge
                                localStorgae.setItem("loggedIn", "true")

                                //set localStorage
                                localStorage.setItem("token", res.data.token)

                                //change state
                                this.loggendIn = true

                                //redirect dashboard
                                return this.$router.push({name : 'admin-monitoring'})
                            } 
                            else
                            {
                                //set state login failed
                                this.loginFailde = true
                            }
                        }).catch(error => {
                            console.log(error)
                        })
                    })
           }
           this.validation = []

           if (!this.User.email)
           {
               this.validation.email = true
           }

           if (!this.User.password){
               this.validation.password = true
           }
       }
    },
    mounted(){
        if(this.loggedIn){
            return this.$router.push({ name: 'admin-monitoring'})
        }
    }
}

</script>