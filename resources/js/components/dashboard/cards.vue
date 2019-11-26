<template>
    <a :href="url">
        <div class="card">
            <slot name="title"></slot>
        </div>
    </a>
</template>

<script>
export default {
    name: 'cards',
    props: {
        title: String,
        url: String
    }
}
</script>

<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        margin-right: 25px;
        width: 250px;
        height: 100px;
        text-align: center;
        padding-top: 25px;
    }
    
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .container {
        padding: 2px 16px;
    }
</style>