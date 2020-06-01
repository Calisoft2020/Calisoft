import "./bootstrap";
import Vue from "vue";
import VueCodeMirror from 'vue-codemirror';
import { Modal, Pagination } from "uiv";
import Paginator from '../classes/paginator';

Vue.use(VueCodeMirror);

new Vue({
    el: "#app",
    components: { Modal, Pagination },
    data: {
        script: [],
        newDocumentos: {},
        formErrors: {},
        formErrorsUpdate: {},
        modalState: false,
        paginator: new Paginator(),
        deleteModalState: false,
        elimiScript: {},
        search: "",
        prevScript: {},
        prevModal: false,
        codeOptions: {
            lineNumbers: true,
            mode: 'application/x-httpd-php',
            readOnly: true,
            theme: 'eclipse'
        }
    },
    created() {
        this.refresh();
    },
    methods: {
        refresh() {
            axios.get('/api/scripts/')
                .then(response => this.script = this.paginator.data = response.data);
        },
        destroy(script) {
            axios.delete('/api/scripts/' + script.PK_id)
                .then(() => {
                    this.script = this.paginator.data = this.script.filter(value => value != script);
                    this.deleteModalState = false;
                    toastr.warning('Documento Eliminado Correctamente');
                }).catch(reason => console.log(reason.response.data.errors));
        },
        openDeleteModal(script) {
            this.elimiScript = script;
            this.deleteModalState = true;

        },
        closeDeleteModal() {
            this.deleteModalState = false;
        },
        preview(script) {
            if (script.code) {
                this.prevScript = script;
                this.prevModal = true;
            } else {
                axios.post('/api/scripts/preview/' + script.url).then(res => {
                    script.code = res.data.code;
                    this.prevScript = script;
                    this.prevModal = true;
                });
            }
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