<template>
  <headerX></headerX>
</template>

<script>

    import  headerX from "../components/dashboard/headerX"

    export default {
        name: 'dashboard',
        components: {
            headerX
        },
        data(){
            return {
                token: null
            }
        },
        created: function(){
            this.token = sessionStorage.getItem('token');
        }
}
</script>

<style>

</style>
