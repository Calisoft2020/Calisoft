import "./bootstrap";
import Vue from "vue";
import Paginator from '../classes/paginator';
import { Pagination } from "uiv";
import Modal from "../components/utils/modal-scroll";
import TablaCalificaciones from '../components/scripts/tabla-calificaciones';


new Vue({
    el: "#app",
    components: { Pagination, TablaCalificaciones, Modal },
    data: {
        proyectoId: window.proyectoId,
        script: [],
        formErrors: {},
        formErrorsUpdate: {},
        paginator: new Paginator(),
        search: "",
        items: [],
        modalState: false,
        nombreScript: "",
    },
    created() {
        this.refresh();
    },
    methods: {
        refresh() {
            axios.get(`/api/proyectos/${window.proyectoId}/scripts`)
                .then(response => this.script = this.paginator.data = response.data);
        },
        modal(script) {
            $("#ventana").modal("show");
            axios.get('/api/itemsEvaluados/' + script).then(res => {
                this.items = res.data;

                this.nombreScript = res.data[0].url.substring(5, res.data[0].url.length);
            }).catch(res => { console.log(res); });
        }
    },
    watch: {
        search(query) {
            this.paginator.data = this.script.filter(script => {
                return new RegExp(query, 'ig')
                    .test(`${script.url}`)
            })
        }
    }


});