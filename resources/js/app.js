/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import I18n from './vendor/I18n';
window.I18n = I18n;

window.Vue = require('vue');
window.Vue.prototype.$I18n = new I18n;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('block-types', require('./components/BlockTypes.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

// Material Design Web Components Instantiation

// Drawer Menu
import { MDCDrawer } from "@material/drawer";
const drawer = MDCDrawer.attachTo(document.querySelector(".mdc-drawer"));
const button = document.querySelector(".mdc-icon-button");
MDCRipple.attachTo(button);
button.addEventListener("click", function() {
    drawer.open = true;
});

// const listEl = document.querySelector(".mdc-drawer .mdc-list");
const mainContentEl = document.querySelector(".mdc-drawer-scrim");

mainContentEl.addEventListener("click", event => {
    drawer.open = false;
});

// Text Field
// import { MDCTextField } from "@material/textfield";
// const textField = new MDCTextField(document.querySelector(".mdc-text-field"));

// Button
import { MDCRipple } from "@material/ripple/index";
const ripple = new MDCRipple(document.querySelector(".mdc-button"));

