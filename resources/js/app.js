import Vue from 'vue'
import VueRouter from 'vue-router'
import UserApi from './service/api';

Vue.use(VueRouter)

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import Dashboard from './views/Dashboard'
import Perfil from './views/Perfil'

const userApi = new UserApi('Vendedor');
const config = {
    headers: {
        Authorization: `Bearer ${sessionStorage.getItem('token')}`
    }
}

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/Perfil',
            name: 'perfil',
            component: Perfil
        }
    ],
});

router.beforeEach((to, from, next) => {
    const config = {
        headers: {
           Authorization: `Bearer ${sessionStorage.getItem('token')}`
        }
    }
    console.log(to.path);
    const user = userApi.all(config);
    if(!user.nome && to.path !== '/'){
        next('/');
    }else{
        next();
    }
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});