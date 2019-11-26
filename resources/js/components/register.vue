<template>
    <div id="login">
        <h1>Resgistrar</h1>
        <formularioRegistro
         @send-message="handleSendMessage"
         Url="register">
         </formularioRegistro>
    </div>
</template>

<script>
    import formularioRegistro from "../components/formularioUsuario"
    export default {
    name: 'Home',
        components : {
            formularioRegistro
        },
    data(){
      return {
      }
    },
    methods: {
        handleSendMessage(event, value){
            console.log(event);
            console.log("Token: ", event.data.token);
            sessionStorage.setItem('token', event.data.token);
            this.$router.push('/dashboard');
        }
    }
  }
</script>

<style>
</style>