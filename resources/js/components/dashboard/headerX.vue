<template>
  <header>
      <span id="nome">{{nome}}</span>
      <span id="data">{{mes}}/{{ano}}</span>
  </header>
</template>

<script>
    export default {
        name: 'headerX',
        data(){
            return {
                nome: "Pedro Victor",
                mes: "11",
                ano: "2019"
            }
        }
    }
</script>

<style>
    html, body {
        width: 100%;
        max-width: 1280px;
    }
    header{
        top:0;
        color:black;
        width: 100%;
        height: 200px;
    }
    #nome{
        left: 0;
    }
    #data{
        text-align: center;
    }
</style>