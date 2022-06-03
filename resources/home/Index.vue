<template>
    <div class="home">
            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <h2><b>BMS's</b>LECTRO</h2>
                    </div>

                    <div class="card-body">
                        <p class="login-box-msg">Welcome to BMS Monitoring</p>
                        <form action="recover-password.html" method="post">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <router-link :to="{name: 'halaman-login'}" v-if="!loggedIn" class="btn btn-primary my-2 my-sm-0">LOGIN</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: 'Home',

    data(){
        return {
            loggedIn: null
        }
    },

    methods: {
        getLoggedIn() {
            this.loggedIn = localStorage.getItem("loggedIn")
        }
    },

    watch: {
        $route: {
            immediate: true,
            handler(){
                this.getLoggedIn()
            }
        }
    }
}
</script>