<template>
    <h1>Halaman Monitoring Admin</h1>
</template>

<script>
export default {
    data() {
        return{
            User: null
        }
    },
    mounted(){
        axios.get('http://127.0.0.1:8000/api/monitoring').then((res)=>{
            this.User = res.data
        })
    }
}
</script>