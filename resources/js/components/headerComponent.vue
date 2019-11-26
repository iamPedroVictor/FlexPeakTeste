<template>
    <header>
        <slot class="left" name="left"></slot>
        <slot class="center" name="center"></slot>
    </header>
</template>

<script>
    import Api from '../service/api';
    const api = new Api('Vendedor');
export default {
    name: 'HeaderComponent',
    props: {
        isDashboard: String
    }
}
</script>

<style>
    header{
        height: 50px;
        width: 100%;
        background-color: red;
        margin-left: -10px;
        margin-top: -25px;
    }

    .left{
        margin-left: 10px;
        padding-top: 25px;
    }
    .center{
        margin-left: auto;
        margin-right: auto;
        padding-top: 25px;
    }
</style>