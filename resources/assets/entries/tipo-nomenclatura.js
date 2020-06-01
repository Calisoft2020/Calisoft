import "./bootstrap";
import Vue from "vue";
import Modal from "../components/utils/modal";
import TextInput from "../components/inputs/text-input";

new Vue({
    el: '#app',
    components: { Modal, TextInput },
    data() {
        return {
            componentes: [],
            errorsUpdate: {},
            fillNomenclatura: {},
        }
    },
    created() {
        axios.get('/api/basedatos')
            .then(response => {
                this.componentes = response.data;
            });
    },
    methods: {
        update() {
            axios.put('/api/basedatos/' + this.fillNomenclatura.PK_id, this.fillNomenclatura)
                .then(response => {
                    this.componentes = this.componentes.map(value => {
                        return value.PK_id == this.fillNomenclatura.PK_id ? this.fillNomenclatura : value;
                    });
                    $('#editar-componente').modal("hide");
                    this.fillNomenclatura = {};

                    toastr.info('Componente Editado Correctamente');
                })
                .catch(error => this.errorsUpdate = error.response.data.errors);
        },
        openEditModal(componente) {
            this.fillNomenclatura = Object.assign({}, componente);
            $('#editar-componente').modal("show");
        },
    }
});