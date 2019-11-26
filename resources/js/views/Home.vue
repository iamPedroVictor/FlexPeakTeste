<template>
  <div>
    <div class="container" v-if="fazerLogin">
      <login ></login>
      <button type="button" class="center w30" v-on:click="registrar()">Registrar</button>
    </div>
    <div class="container" v-else>
      <registrar></registrar>
      <button type="button" class="center w30" v-on:click="registrar()">Realizar login</button>
    </div>
  </div>

</template>

<script>
  import login from "../components/login";
  import registrar from "../components/register";
  
  export default {
    name: 'Home',
        components : {
            login,
            registrar
        },
    data(){
      return {
        fazerLogin: "sim"
      }
    },
    methods: {
      registrar(){
        if(this.fazerLogin === "sim"){
          this.fazerLogin = null;
        }else{
          this.fazerLogin = "sim";
        }
      }
    }
  }
</script>

<style>
  .conteiner{
    display: flex;
    flex-direction: column;
  }
</style>