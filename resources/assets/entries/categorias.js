import "./bootstrap";
import Vue from "vue";
import Modal from "../components/utils/modal";
import { Popover } from "uiv";
import CategoryMix from '../components/mixins/category-mix';
import TextInput from "../components/inputs/text-input";
import TextareaInput from "../components/inputs/textarea-input";

const PORCENTAJES = ['modelado', 'plataforma', 'base_datos', 'codificacion'];



let vm = new Vue({
    el: '#app',
    mixins: [CategoryMix],
    components: { Modal, Popover, TextInput, TextareaInput },
    data() {
        return {
            categorias: [],
            offset: 4,
            formErrors: {},
            formErrorsUpdate: {},
            newCategoria: this.schema(),
            fillCategoria: this.schema(),
            elimiCategoria: {},
        }

    },
    created() {
        axios.get('/api/categorias')
            .then(response => {
                this.categorias = response.data;
            });
    },
    methods: {

        store() {
            if (!this.sumaPorcentajes()) return;
            axios.post('/api/categorias', this.newCategoria)
                .then(response => {
                    this.categorias.push(response.data);
                    this.formErrors = {};
                    this.newCategoria = this.schema();
                    $("#crear-categoria").modal("hide");
                    toastr.success('Categoría creada correctamente');
                })
                .catch(error => this.formErrors = error.response.data.errors);
        },
        openEditModal(categoria) {
            this.fillCategoria = Object.assign({}, categoria);
            $('#editar-categoria').modal("show");
        },
        openDeleteModal(categoria) {
            this.elimiCategoria = categoria;
            $('#eliminar-categoria').modal("show");
        },
        update() {
            if (!this.sumaPorcentajesEditar()) return;
            axios.put('/api/categorias/' + this.fillCategoria.PK_id, this.fillCategoria)
                .then(response => {
                    this.categorias = this.categorias.map(value => {
                        return value.PK_id == this.fillCategoria.PK_id ? this.fillCategoria : value;
                    });
                    this.fillCategoria = this.schema();
                    $("#editar-categoria").modal("hide");
                    toastr.info('Categoría editada correctamente');
                })
                .catch(error => this.formErrorsUpdate = error.response.data.errors);
        },

        destroy(categoria) {
            axios.delete('/api/categorias/' + categoria.PK_id)
                .then(response => {
                    this.categorias = this.categorias.filter(value => value != categoria);
                    $("#eliminar-categoria").modal("hide");
                    toastr.info('Categoría eliminada correctamente');
                });


        },

        sumaPorcentajes() {
            let sumatoria = 0;
            //Realiza la sumatoria de los porcentajes .. pdt: puto hectorino
            PORCENTAJES.forEach(diagrama => {
                sumatoria += Number.parseInt(this.newCategoria[diagrama]);
            });

            if (sumatoria != 100) {
                toastr.error("la suma de los porcentajes debe ser igual a 100%");
                return false;
            }
            return true;
        },

        sumaPorcentajesEditar() {
            let sumatoria = 0;
            //Realiza la sumatoria de los porcentajes .. pdt: puto hectorino
            PORCENTAJES.forEach(diagrama => {
                sumatoria += Number.parseInt(this.fillCategoria[diagrama]);
            });

            if (sumatoria != 100) {
                toastr.error("la suma de los porcentajes  debe ser igual a 100%");
                return false;
            }
            return true;
        },
    }
});