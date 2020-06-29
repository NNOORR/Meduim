require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Home from './components/home-component/Home'
import ArticlesView from './components/articles-component/articles-view'


Vue.component('articles-index', require('./components/articles-component/articles-index.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/article/:id',
            name: 'article',
            component: ArticlesView,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});