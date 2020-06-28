require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Home from './components/home-component/Home'


Vue.component('articles-index', require('./components/articles-component/articles-index.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});