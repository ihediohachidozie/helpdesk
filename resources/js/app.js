
import router from './routes';
require('./bootstrap');


Vue.component('footer-part', require('./components/footer.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
    el: '#app',
    router
});
