import "./bootstrap";
import Vue from "vue";
import VueCodeMirror from 'vue-codemirror';
import CodePreview from '../components/scripts/code-preview'
import TablaComponente from '../components/archivobd/tabla-componente'
import Validate from "../plugins/Validate"


Vue.use(VueCodeMirror);
Vue.use(Validate);

new Vue({
    el: "#app",
    components: {CodePreview, TablaComponente},
    
});