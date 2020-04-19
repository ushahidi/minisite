import I18n from "./vendor/I18n";
window.I18n = I18n;

window.Vue = require("vue");
window.Vue.prototype.$I18n = new I18n();
Vue.component("reorder", require("./components/Reorder.vue").default)
const app = new Vue({
    el: "#app"
});
console.log("YAY")