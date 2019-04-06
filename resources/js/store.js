import  Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
axios.defaults.baseURL = "http://localhost:8000/api"

export const store = new Vuex.Store({

    state:{
        token: localStorage.getItem('access_token') || null,
    },
    getters: {
      loggedIn(state){
          return state.token !== null
      },
    },
    mutations: {
        retrieveToken(state, token){
        state.token = token
        },
        destroyToken(state){
            state.token = null
        },
    },
    actions:{
        register(context, data){
            return new Promise((resolve, reject) =>{
                axios.post('/register',{
                    firstname: data.firstname,
                    lastname: data.lastname,
                    nickname: data.nickname,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.passwordConfirmation,
                })
                    .then( response => {
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },
        retrieveToken(context, credentials){
            return new Promise((resolve, reject) =>{
            axios.post('/login',{
                username: credentials.username,
                password: credentials.password,
            })
                .then( response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                })
             })
        },
        destroyToken(context){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token

            if(context.getters.loggedIn){
                return new Promise((resolve, reject) =>{
                    axios.post('/logout')
                        .then( response => {
                            localStorage.removeItem('access_token')
                            context.commit('destroyToken')
                            resolve(response)
                        })
                        .catch(error => {
                            localStorage.removeItem('access_token')
                            context.commit('destroyToken')
                            reject(error)
                        })
                })
            }
        },
        fetchUserData(context){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token
            if(context.getters.loggedIn){
                return new Promise((resolve, reject) =>{
                    axios.get('/userdata',{
                    })
                        .then( response => {
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            }

        },
        updateUserData(context, data){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token
            if(context.getters.loggedIn){
                return new Promise((resolve, reject) =>{
                    axios.post('/updateUser',{
                        firstname: data.firstname,
                        lastname: data.lastname,
                        nickname: data.nickname,
                        address: data.address,
                        zipcode: data.zipcode,
                        city: data.city,
                        phonenumber: data.phonenumber,
                    })
                        .then( response => {
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            }
        },
        fetchConversations(context){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token
            if(context.getters.loggedIn){
                return new Promise((resolve,reject) => {
                    axios.get('/conversations', {
                    })
                        .then(response => {
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            }
        },
        fetchMessages(context, data){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token
            if(context.getters.loggedIn){
                return new Promise((resolve,reject) => {
                    axios.get('/messages', {
                        params: {
                            user: data.user2,
                        }
                    })
                        .then(response => {
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            }
        },
        sendMessage(context, data){
            axios.defaults.headers.common['Authorization'] = 'Bearer '  + context.state.token
            if(context.getters.loggedIn){
                return new Promise((resolve, reject) => {
                    axios.post('/sendMessage', {
                        params: {
                            user2: data.user2,
                            message: data.content,
                        }
                    })
                        .then( response => {
                            resolve(response)
                        })
                        .catch( error => {
                            reject(error)
                        })
                })
            }
        },
    }
})