<template>
  <div>
    <div v-if="fazerLogin">
      <login ></login>
      <button type="button" v-on:click="registrar()">Quero me registrar</button>
    </div>
    <div v-else>
      <registrar></registrar>
      <button type="button" v-on:click="registrar()">Possuo uma conta e desejo fazer login</button>
    </div>
  </div>

</template>

<script>
  import login from "../components/login"
  import registrar from "../components/register"
  
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

</style>