
require('./bootstrap');

window.Vue = require('vue');


require('./components/subscribe-button');


Vue.config.ignoredElements=['video-js'];
Vue.component('subscribe-button',require('./components/subscribe-button.vue').default)
Vue.component('Votes',require('./components/Votes.vue').default)
Vue.component('Comments',require('./components/Comments.vue').default)

const app = new Vue({
    el: '#app',
});
