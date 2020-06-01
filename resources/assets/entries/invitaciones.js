import './bootstrap';
import Vue from 'vue';

new Vue({
    el: '#app',
    data: {
        invitaciones: [],
        accepted: {}
    },
    created() {
        axios.get('/api/student/invitations').then(res => {
            this.invitaciones = res.data;
        });
    },
    methods: {
        accept(proyecto) {
            axios.put('/api/invitations/' + proyecto.PK_id).then(() => {
                this.accepted = proyecto
            });
        },
        reject(proyecto) {
            axios.delete('/api/invitations/' + proyecto.PK_id).then(() => {
                let index = this.invitaciones.indexOf(proyecto);
                this.invitaciones.splice(index, 1);
            })
        }

    }
});
