import './bootstrap';
import Vue from 'vue';
import axios from 'axios';

import { Modal } from 'uiv';
import BsPdf from '../components/bs/bs-pdf';
import BsSwitch from '../components/bs/bs-switch';

import DocumentList from '../components/documentacion/document-list'

new Vue({
    el: '#app',
    components: {
        DocumentList,
        Modal,
        BsPdf,
        BsSwitch
    },
    data() {
        return {
            tipos: [],
            documentos: [],
            evModal: false,
            selected: {}
        }
    },
    created() {
        axios.all([
            axios.get(`/api/proyectos/${window.proyectoId}/documentacion`),
            axios.get('/api/tdocumentos')
        ]).then(axios.spread((documentos, tipos) => {
            this.documentos = documentos.data;
            this.tipos = tipos.data;
        }))
    }
})