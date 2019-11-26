<template>
    <div id="perfilForm" class="center container w30">
        <h1>Perfil: {{nome}}</h1>
        <p>Deseja alterar suas informações?</p>
        <formularioRegistro
         @send-message="handleSendMessage"
         Url="'Vendedor'"
         >
         </formularioRegistro>
    </div>
</template>

<script>
    import formularioRegistro from "../components/formularioUsuario"

    import Api from "../service/api";
    const api = new Api('Vendedor');

    export default {
    name: 'Home',
        components : {
            formularioRegistro
        },
    data(){
      return {
          Usuario: null,
          token: null,
          nome: null
      }
    },
    beforeMount(){
        const config = {
            headers: {
                Authorization: `Bearer ${sessionStorage.getItem('token')}`
            }
        }
        api.all(config)
            .then(response => {
                this.nome = response.data.nome;
                this.input = {
                    nome : response.data.nome
                }
            })
            .catch(error => {
                console.log(error);
        })
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
    h1, p{
        text-align: center;
    }
</style>