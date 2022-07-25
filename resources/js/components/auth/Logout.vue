<template>

</template>

<script>
    import { useRouter } from "vue-router";
    export default {
        detup() {
            const router = useRouter
            const logout = () => {
                localStorage.setItem("authenticated", false);
                router.push({ name: "login"});
            };
            return {logout};
        }
    }
</script>