<template>
    <form @submit.prevent="$emit('update', eval)">
        <textarea-input name="observacion" label="Observación" v-model="eval.observacion" />
        <div class="row">
            <div class="col-sm-6 text-center">
                <bs-switch :id="eval.componente.PK_id" label="VALIDO" v-model="eval.checked" :options="switchOptions" />
            </div>
            <div class="col-sm-6 text-center">
                <button type="submit" class="btn blue">Guardar</button>
            </div>
        </div>
    </form>
</template>
<script>
import BsSwitch from '../bs/bs-switch'
import TextareaInput from '../inputs/textarea-input';
import _ from 'lodash';

export default {
    components: { BsSwitch, TextareaInput },
    props: ['evaluacion'],
    data() {
        return {
            eval: _.cloneDeep(this.evaluacion),
            switchOptions: {
                onText: 'SI',
                offText: 'NO',
                onColor: 'success',
                offColor: 'danger'
            }
        }
    },
    watch: {
        evaluation() {
            this.eval = _.cloneDeep(this.evaluacion);
        }
    }
}
</script>
