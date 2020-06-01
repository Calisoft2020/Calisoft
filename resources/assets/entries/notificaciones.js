import './bootstrap';
import Vue from 'vue';

new Vue({
    el: '#app',
    data: {
        notificaciones: []
    },
    created() {
        axios.get('/api/notificaciones').then(res => {
            this.notificaciones = res.data;
        });
    },
    methods: {
        
        

    }
});

