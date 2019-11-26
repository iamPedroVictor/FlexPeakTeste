<template>
  <h1>token: {{token}}</h1>
</template>

<script>
export default {
    name: 'dashboard',
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
