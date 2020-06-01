import "./bootstrap";
import Vue from "vue";
import BsSwitch from "../components/bs/bs-switch";
import Modal from "../components/utils/modal";

new Vue({
    el: '#app',
    components: { BsSwitch, Modal },
    data() {
        return {
            tdocumentos: [],
            tdocForm: this.getSchema(),
            tdocEdit: {},
            tdocDel: {}
        }
    },
    created() {
        axios.get('/api/tdocumentos').then(res => {
            this.tdocumentos = res.data
        });
    },

    methods: {

        //crear tipo de documento
        store() {
            axios.post('/api/tdocumentos', this.tdocForm)
                .then(res => {
                    this.tdocumentos.push(res.data);
                    this.tdocForm = this.getSchema();
                    toastr.success('Tipo de Documento agregado');
                })
                .catch(err => this.showErrors(err.response.data.errors));
        },

        //editar tipo de documento
        update() {
            axios.put('/api/tdocumentos/' + this.tdocEdit.PK_id, this.tdocEdit)
                .then(res => {
                    this.tdocumentos = this.tdocumentos.map(tdoc => {
                        return tdoc.PK_id == this.tdocEdit.PK_id ? this.tdocEdit : tdoc;
                    });

                    this.tdocEdit = {};
                    toastr.info('Tipo de Documento actualizado');
                })
                .catch(err => this.showErrors(err.response.data.errors));
        },

        //eliminar tipo de documento
        destroy() {
            axios.delete('/api/tdocumentos/' + this.tdocDel.PK_id)
                .then(() => {
                    let index = this.tdocumentos.indexOf(this.tdocDel);
                    this.tdocumentos.splice(index, 1);
                    $("#destroy-tdoc").modal('hide');
                    toastr.info("Tipo de Documento eliminado");
                });
        },

        //seleciona el tipo de documento a editar
        selectEdit(tdoc) {
            this.tdocEdit = Object.assign({}, tdoc);
        },

        //seleciona el tipo de documento a eliminar
        selectDelete(tdoc) {
            this.tdocDel = tdoc;
            $("#destroy-tdoc").modal('show');
        },

        //esquema de tipo de documentos
        getSchema() {
            return { nombre: "", required: false }
        },

        //muestra los errors en toasts
        showErrors(data) {
            for (let msg in data) {
                toastr.error(data[msg]);
            }
        }
    }
})