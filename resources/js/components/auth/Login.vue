<template>
<section class="vh-100" style="background-color: #1C3B11;">
  <div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img :src="getFotoBattery()"
                alt="login form" class="img-fluid" width="30000px" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form @submit.prevent="login">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">LECTRO</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" class="form-control form-control-lg" v-model="User.email"/>
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" v-model="User.password"/>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</template>

<script>
export default {
    data() {
        return {
            photo: "",
            User: {}
        }
    },

    methods : {
        getFotoBattery() {
            return "/img/ESS.png" + this.photo;
        },
        
        login() {
            axios.post(process.env.MIX_API_KEY+'login', this.User).then((response) =>{
                console.log(response)
                localStorage.setItem('token', response.data.data.Token)
                localStorage.setItem('role', response.data.data.user.roles[0].name)
                localStorage.setItem('id', response.data.data.user.id)
                //localStorage.setItem('id_battery', response.data.data.ba)
                if (response.data.data.battery.length !== 0) {
                    const battery = response.data.data.battery;
                    const batt = []; 
                    battery.forEach(element => {
                        batt.push(element.battery_id); 
                    }); 
                    localStorage.setItem('battery_id', JSON.stringify(batt));
                }

                const users = JSON.parse(localStorage.getItem("battery_id") || "[]");
                
                console.log(users);
                if (response.data.data.user.roles[0].name === "admin") {
                    window.location.href = "/admin-monitoring"
                } else if (response.data.data.user.roles[0].name === "user") {
                    window.location.href = "/user-monitoring"
                }
                console.log(response.data)
                this.$router.push({ name: "admin-monitoring"});
            }).catch((errors) => {
                this.errors = errors.response.data.errors;
            })
        }
    }
}
</script>

<style>
.img-fluid {
    margin-top: 90px;
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
    margin-left: 15px;
}
</style>
