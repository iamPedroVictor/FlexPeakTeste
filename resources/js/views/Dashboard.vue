<template>
    <div>
        <HeaderComponent isDashboard='true'>
            <strong slot="left">Vendedor: {{nome}}</strong>
            <strong slot="center">Dashboard</strong>
        </HeaderComponent>
        <main class="container w90 center">
            <cards url="Perfil">
                <strong slot="title">Perfil</strong>
            </cards>
            <cards url="Vendas">
                <strong slot="title">Vendas</strong>
            </cards>
            <cards url="Produtos">
                <strong slot="title">Produtos</strong>
            </cards>
        </main>
    </div>
</template>

<script>
    import cards from '../components/dashboard/cards';
    import HeaderComponent from '../components/headerComponent';
    import Api from '../service/api';
    const api = new Api('Vendedor');

    export default {
        name: 'dashboard',
        components: {
            cards,
            HeaderComponent
        },
        data(){
            return {
                token: null,
                nome: ""
            }
        },
        beforeMount(){
            const config = {
                headers: {
                   Authorization: `Bearer ${sessionStorage.getItem('token')}`
                }
            }
            api.all(config)
                .then(resolve => {
                    this.nome = resolve.data.nome;
                })
                .catch(erro => {
                    console.log(erro.message);
                })
        }
}
</script>

<style>
    html,body{
        width: 100%;
        max-width: 1280px;
    }
    main{
        margin-top: 100px;
    }

    .container{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: center;
        justify-content: space-around;
    }
    .w90{
        width: 90%;
    }
    .center{
        margin-left: auto;
        margin-right: auto;
    }
</style>
