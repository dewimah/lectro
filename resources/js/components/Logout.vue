<template>
    
</template>

<script>
export default{
    data(){

    },
    methods:{
        logout(){
            axios.post('http://127.0.0.1:8000/api/logout').then(()=>{
                this.$routes.push({name:"login"})
            })
        }
    }
}
<script>