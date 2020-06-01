import "./bootstrap";
import Vue from "vue";
import Modal from "../components/utils/modal";
import TextInput from "../components/inputs/text-input";

let vm = new Vue({
    el: '#app',
    components: { Modal, TextInput },
    data() {
        return {
            items: [],
            formErrorsUpdate: {},
            fillItem: {},
        }
    },
    created() {
        axios.get('/api/codificacion')
            .then(response => {
                this.items = response.data;
            });
    },
    methods: {
        update() {
            axios.put('/api/codificacion/' + this.fillItem.PK_id, this.fillItem)
                .then(response => {
                    this.items = this.items.map(value => {
                        return value.PK_id == this.fillItem.PK_id ? this.fillItem : value;
                    });
                    $("#editar-item").modal("hide");
                    this.fillItem = {};

                    toastr.info('Item editado correctamente');
                })
                .catch(error => this.formErrorsUpdate = error.response.data.errors);
        },
        openEditModal(item) {
            this.fillItem = Object.assign({}, item);
            $('#editar-item').modal("show");
        },
    }
});