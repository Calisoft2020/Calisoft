<template>
    <div id="accordion" class="panel-group">
        <div class="panel panel-default" v-for="(evaluacion, index) in evaluaciones" :key="evaluacion.FK_ComponenteId">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a v-if="evaluacion.componente.required == 1" data-toggle="collapse" data-parent="#accordion" :href="'#collapse' + index">
                        {{ evaluacion.componente.nombre }} <span class="label label-primary big">r</span>
                    </a>
                    <a v-else data-toggle="collapse" data-parent="#accordion" :href="'#collapse' + index">
                        {{ evaluacion.componente.nombre }}
                    </a>
                    <span class="pull-right fa" :class="indicator(evaluacion)"></span>
                </h4>
            </div>
            <div :id="'collapse' + index" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="text-center">
                        {{ evaluacion.componente.descripcion }}
                    </div>
                    <div class="text-center text-info" v-if="(!editable && evaluacion.observacion)">
                        <hr>
                        <strong>Observacion:</strong>
                        {{ evaluacion.observacion }}
                    </div>
                    <div v-if="editable">
                        <hr>
                        <evaluation-form :evaluacion="evaluacion" @update="update" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import EvaluationForm from './evaluation-form'

export default {
    components: {
        EvaluationForm
    },
    props: {
        documentoId: { type: String, required: true },
        editable: { type: Boolean, default: false }
    },
    data() {
        return {
            evaluaciones: [],
        }
    },
    created() {
        axios.get('/api/evaluaciones/' + this.documentoId)
            .then(res => this.evaluaciones = res.data)
    },
    methods: {
        indicator(evaluacion) {
            return {
                'fa-times-circle text-danger': !evaluacion.checked,
                'fa-check-circle text-success': evaluacion.checked
            }
        },
        update(evaluacion) {
            let payload = this.getPayload(evaluacion);
            axios.put('/api/evaluaciones/' + this.documentoId, payload).then(() => {
                toastr.info(`Componente: ${evaluacion.componente.nombre} ha sido calificado!`);
                this.evaluaciones = this.evaluaciones.map(
                    val => evaluacion.FK_ComponenteId == val.FK_ComponenteId ? evaluacion : val
                )
            });
        },

        getPayload(evaluacion) {
            return {
                componente_id: evaluacion.FK_ComponenteId,
                checked: evaluacion.checked,
                observacion: evaluacion.observacion
            }
        }
    }
}
</script>
