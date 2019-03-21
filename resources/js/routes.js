import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/auth/Login'
import Logout from './components/auth/Logout'
import Register from './components/auth/Register'
import FrontPage from './components/FrontPage'
import Profile from "./components/Profile";
import Chat from "./components/chat/ChatBody";



Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        {
            path: '/kirjaudu',
            name: 'login',
            component: Login,
            meta: {
                requiresVisitor: true,
            },
        },
        {
            path: '/rekisteroidy',
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
            path: '/ulos',
            name: 'signout',
            component: Logout,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/profiili',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/chat',
            name: 'chat',
            component: Chat,
            meta: {
                requiresAuth: true,
            },
        },


    ]
});

export default router