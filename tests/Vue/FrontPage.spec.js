import Vue from 'vue';
import Vuex from 'vuex';
import BootstrapVue from 'bootstrap-vue'
import {createLocalVue, shallowMount} from '@vue/test-utils';
import Frontpage from '../../resources/js/components/FrontPage.vue';

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(BootstrapVue);


describe('FrontPage component test', () => {
    let wrapper;
    beforeEach(() => {
                wrapper = shallowMount(Frontpage, {
                    stubs: {
                        'search-results' : "<div />"
                    },
                    localVue,
                    Vue
                },

        )

    })

   it('Access to wrapper', () => {
       expect(wrapper.exists()).toBe(true);
   })

    it('FrontPage renders', () => {
        expect(wrapper.html()).toContain("Tässäpä uusimmat ilmoitukset");
    })

})
