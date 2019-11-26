<template>
    <div id="login" class="center container w30">
        <h1>Login</h1>
        <input type="text" name="email" v-model="input.email" placeholder="E-Mail" />
        <input type="password" name="password" v-model="input.password" placeholder="Senha" />
        <button type="button" class="center" v-on:click="login()">Entrar</button>
        <span class="mensagem" v-if="mensagem">{{mensagem}}</span>
    </div>
</template>

<script>
    import Api from '../service/api';

    const api = new Api('login');

    export default {
        name: 'login',
        data(){
            return {
                input: {
                    email: "",
                    password: ""
                },
                mensagem: null
            }
        },
        methods: {
            login(){
                if(this.input.email != "" && this.input.password != ""){
                    api.store({
                        email: this.input.email,
                        password: this.input.password
                    })
                        .then(response => {
                            sessionStorage.setItem('token', response.data.token)
                            this.$router.push('/dashboard');
                        })
                        .catch(error => {
                            console.log(error.response.data.Error);
                            this.mensagem = error.response.data.Erro;
                        });
                }else{
                    this.mensagem = "Informe um email/senha";
                }
            }
        }   
    }
</script>

<style>
    .center{
        margin-left: auto;
        margin-right: auto;
    }
    .container{
        display: flex;
        flex-direction: column;
    }
    .container h1{
        text-align: center;
    }
    .container input, .container button {
        margin-top: 20px;
    }
    .container button{
        width: 25%;
        height: 50px;
    }
    .w30{
        width: 30%;
    }
    .mensagem{
        color: red;
        font-weight: bold;
        text-align: center;
        margin-top: 25px;
    }
</style>