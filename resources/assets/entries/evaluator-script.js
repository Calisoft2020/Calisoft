import './bootstrap'
import Vue from 'vue'
import VueCodeMirror from 'vue-codemirror';
import CodePreview from '../components/scripts/code-preview'
import TablaItems from '../components/scripts/tabla-items'
import TextareaInput from '../components/inputs/textarea-input';
import Modal from '../components/utils/modal';
import Validate from "../plugins/Validate";
import ReglasEstandar from "../classes/codificacion/reglas-estandar";

Vue.use(VueCodeMirror);
Vue.use(Validate);
new Vue({
    el: '#app',
    components: { CodePreview, TablaItems, TextareaInput, Modal },
    data: {

        fillItem: {},
        formErrorsUpdate: {},
        items: [],
        fillComentario: {},
        ReglasEst: new ReglasEstandar(),
        evaluado: false,
    },
    created() {
        this.refresh();

    },
    methods: {
        refresh() {

            axios.get('/api/evaluacionesScript/' + window.ScriptId).then(response => {
                this.items = response.data
            });
        },
        eval(url) {
            if (!this.evaluado) {
                axios.post('/api/scripts/preview/' + url).then(res => {
                     this.ReglasEst.evaluarEstandar(res.data.code, window.ScriptId, this.items);
                });
                this.evaluado = true;
            } 
        },
    },

})