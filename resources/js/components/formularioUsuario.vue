<template>
    <div>
        <h2 v-if="mensagem">{{mensagem}}</h2>
        <form method="post" id="Register" @submit="checkForm">
            <p>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" v-model="input.nome" />
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" v-model="input.email" />
            </p>
            <p>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" v-model="input.senha" />
            </p>
            <p>
                <label for="nome" class="cepS">Cep</label>
                <input type="text" name="cep" id="cep" class="cepS" v-model="input.cep" />
                <button type="button" v-on:click="cepInfo()">Pesquisar pelo cep</button>
            </p>
            <p v-if="Achou">
                <label for="nome">Rua</label>
                <input type="text" name="rua" id="rua" v-model="input.rua" />
            </p>
            <div v-if="Achou">
                <input type="submit" value="Enviar" />
            </div>
        </form>
    </div>
</template>

<script>
    import Viacep from '../service/viacep';
    import Api from '../service/api';

    const viacep = new Viacep();
    export default {
        name: 'login',
        props: {
            Url: String
        },
        data(){
            return {
                input: {
                    nome: "",
                    email: "",
                    senha: "",
                    cep: "",
                    rua: ""

                },
                Achou: null,
                mensagem: null
            }
        },
        methods: {
            cepInfo: function(){
                if(this.input.cep === ''){
                    this.mensagem = "Informe um cep";
                    return;
                }
                viacep.get(this.input.cep)
                    .then(response => {
                        this.input.rua = response.data.logradouro;
                        this.Achou = "true";
                    })
                    .catch((error ) => {
                        this.mensagem = "Cep invalido";
                        if(error.response){
                            console.log(error.json());
                        }
                    });
            },
            checkForm: function(e){
                e.preventDefault();
                const api = new Api(this.$props.Url);
                api.store({
                    nome: this.input.nome,
                    email: this.input.email,
                    senha: this.input.senha,
                    cep: this.input.cep,
                    rua: this.input.rua,
                })
                .then(response => {
                    console.log(response);
                    this.$emit('send-message', response);
                })
                .catch(error => {
                    this.mensagem = error.response.data.Erro;
                });
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
    .cepS{
        width: 50%;
    }
</style>