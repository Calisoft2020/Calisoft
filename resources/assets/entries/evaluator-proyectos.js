import './bootstrap'
import Vue from 'vue'
import ProyectoPanel from '../components/proyecto/proyecto-panel'

new Vue({
    el: '#app',
    components: {
        ProyectoPanel
    },
    data: {
        proyectos: [],
    },
    created() {
        axios.get('/api/user/proyectos').then(res => this.proyectos = res.data)
    }
})