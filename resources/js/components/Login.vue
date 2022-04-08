<template>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline" color="#1c3b10">
                <div class="card-header text-center">
                    <h4>BMS's LECTRO</h4>
                </div>

                <div class="card-body">
                    <p class="login-box-msg">Log in to start your session</p>
                    <form action="" method="post" @submit.prevent="login">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" v-model="User.email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="User.password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-block" color="#1c3b10">Log In</button>
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
            User: {}
        }
    },
}
</script>