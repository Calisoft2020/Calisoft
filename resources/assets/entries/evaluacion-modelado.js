import './bootstrap'
import Vue from 'vue'
import DocList from '../components/modelacion/doc-list'
import EvaluationPanel from '../components/modelacion/evaluation-panel'

new Vue({
    el: '#app',
    components: {
        DocList,
        EvaluationPanel
    },
    data() {
        return {
            documentos: [],
            selected: null
        }
    },
    created() {
        axios.get('/api/evaluacion/modelado').then(res => this.documentos = res.data)
    }
})