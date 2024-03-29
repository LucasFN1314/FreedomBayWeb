/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'axios'
import 'bootstrap-icons/font/bootstrap-icons.css'
import Vue from 'vue';

/*import { createApp } from 'vue';


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
/*
const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import IndexHeader from './components/index/header.vue';
app.component('index-header', IndexHeader);

import IndexInfo from './components/index/info.vue';
app.component('index-info', IndexInfo);

import InfoItem from './components/index/infoitem.vue';
app.component('info-item', InfoItem);

import InfoModal from './components/modals/infoModal.vue';
app.component('info-modal', InfoModal);
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.

app.mount('#app');
 */


window.Vue = require('vue').default;
import ExampleComponent from './components/ExampleComponent.vue';
Vue.component('example-component', ExampleComponent);

import IndexHeader from './components/index/header.vue';
Vue.component('index-header', IndexHeader);

import IndexInfo from './components/index/info.vue';
Vue.component('index-info', IndexInfo);

import InfoItem from './components/index/infoitem.vue';
Vue.component('info-item', InfoItem);

import InfoModal from './components/modals/infoModal.vue';
Vue.component('info-modal', InfoModal);

const app = new Vue({
    el: '#app'
});