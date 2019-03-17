import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/auth/Login'
import Logout from './components/auth/Logout'
import Register from './components/auth/Register'
import FrontPage from './components/FrontPage'
import Profile from "./components/Profile";
import AdvertBody from './components/advert/AdvertBody';
import AdvertForm from './components/advert/AdvertForm';




Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/demoadvert',
            name: 'demoadvert',
            component: AdvertBody
        },
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
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/ilmoitus',
            name: 'ilmoitus',
            component: AdvertForm,
            meta: {
                requiresAuth: true,
            },
        }
    ]
});

export default router