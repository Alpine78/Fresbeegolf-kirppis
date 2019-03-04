import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/auth/Login'
import Logout from './components/auth/Logout'
import Register from './components/auth/Register'
import FrontPage from './components/FrontPage'




Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                requiresVisitor: true,
            },
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                requiresVisitor: true,
            },
        },
        {
            path: '/',
            name: 'frontpage',
            component: FrontPage
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: {
                requiresAuth: true,
            },
        },

    ]
});

export default router