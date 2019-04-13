import Vue from 'vue';
import Vuex from 'vuex';
import BootstrapVue from 'bootstrap-vue'
import {createLocalVue, shallowMount} from '@vue/test-utils';
import NavBar from '../../resources/js/components/navbar/NavBar.vue';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(BootstrapVue);


describe('Navbar as LOGGEDIN  FALSE test', () => {
    let wrapper;
    let store;

    store = new Vuex.Store({
        modules: {
            basket: {
                getters:{
                    loggedIn: () => false,
                }
            }
        }
    })
    wrapper = shallowMount(NavBar, {
            localVue,
            Vue,
            store,
            stubs: {
                "search-bar": "<div />"
            }
        },
    )



    it('Access to wrapper', () => {
        expect(wrapper.exists()).toBe(true);
    })

    it('Navbar has banner text', () => {
        expect(wrapper.html()).toContain("FrisbeeGolf Kirppis");

    })

    it('Navbar has LOGIN LINK', () => {
        expect(wrapper.text()).toContain("Kirjaudu sisään")
    })

})
