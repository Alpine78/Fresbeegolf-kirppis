import Vue from 'vue';
import Vuex from 'vuex';
import {createLocalVue, mount} from '@vue/test-utils';
import Profile from '../../resources/js/components/Profile.vue';


const localVue = createLocalVue();
localVue.prototype$eventHub = new Vue();
localVue.use(Vuex);


describe('MyName test', () => {
    it('TEST', () => {
        const wrapper = mount(Profile, {
            store,
            localVue,
            Vue,
        });

        expect(wrapper.vm.$data.name).toBe('My name');

    })
});