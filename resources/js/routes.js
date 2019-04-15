import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/auth/Login'
import Logout from './components/auth/Logout'
import Register from './components/auth/Register'
import FrontPage from './components/FrontPage'
import Profile from "./components/Profile";
import ChatList from "./components/chat/ChatList";
import ChatBody from "./components/chat/ChatBody";
import AdvertBody from './components/advert/AdvertBody';
import AdvertForm from './components/advert/AdvertForm';




Vue.use(VueRouter)


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/ilmoitus',
            name: 'ilmoitus',
            component: AdvertBody,
            children: [
                { path: ':id', component: AdvertBody },
                { path: ':id/muokkaa', component: AdvertBody }                
            ]
        },
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
            name: 'frontPage',
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
            path: '/keskustelut',
            name: 'chat',
            component: ChatList,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/ilmoita',
            name: 'ilmoita',
            component: AdvertForm,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/keskustelu/:userId',
            name: 'privateChat',
            component: ChatBody,
            meta: {
                requiresAuth: true,
            },
        }

    ]
});

export default router