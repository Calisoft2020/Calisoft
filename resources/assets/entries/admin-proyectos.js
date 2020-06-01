import "./bootstrap";
import Vue from "vue";
import ProyectoTabla from "../components/proyecto/proyecto-tabla";
import BsSelect from "../components/bs/bs-select";
import Fade from "../components/utils/fade";
import Paginator from '../classes/paginator';
import { Pagination } from 'uiv'

let vm = new Vue({
    el: '#app',
    components: { 
        ProyectoTabla, 
        BsSelect, 
        Pagination,
        Fade
    },
    data: {
        proyectos: [],
        seleccion: {},
        paginator: new Paginator([], 9),
        estado: "",
        search: ""
    },

    created() {
        axios.get('/api/proyectos').then(response => {
            this.proyectos = this.paginator.data = response.data
        });
    },

    methods: {
        update(proyecto){
            this.seleccion = proyecto;
            this.proyectos = this.paginator.data = this.proyectos.map(pro => {
                return pro.PK_id == proyecto.PK_id ? proyecto : pro;
            });
        },
        remove(proyecto){
            this.seleccion = {};
            this.proyectos = this.paginator.data = this.proyectos.filter(pro => pro.PK_id != proyecto.PK_id);
        }
    },
    watch: {
        search(query){
            this.paginator.data = this.proyectos.filter(p => {
                let test = new RegExp(query, 'i').test(p.nombre)
                if(this.estado) return test && this.estado == p.state;
                return test;
            })

        },
        estado(state){
            this.search = "";
            this.paginator.page = 1;
            this.paginator.data = this.proyectos.filter(p => {
                return this.estado ? (this.estado == p.state) : true;                
            });
        }
    }
});
