require('./bootstrap');

/**
 * VUE 2
 *
window.Vue = require('vue');

Vue.component('apply-button', require('./components/ApplyButton.vue').default);

const app = new Vue({
    el: '#app',
});
*/

import { createApp } from 'vue'
import ApplyButton from './components/ApplyButton.vue'
import ApplicationButtons from './components/ApplicationButtons.vue'
import ViewNotificationButton from './components/ViewNotificationButton.vue'

//Initialize app
const app = createApp({})

//Components
app.component('apply-button', ApplyButton);
app.component('application-buttons', ApplicationButtons);
app.component('view-notification', ViewNotificationButton);

//Mount app
app.mount('#app');