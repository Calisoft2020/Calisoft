import Vue from 'vue';
import Notifications from '../components/notifications/notifications';

new Vue({
    el: '#notificaciones',
    render(h) {
        return h(Notifications);
    }
})
