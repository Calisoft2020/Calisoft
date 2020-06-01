<template>
    <form @submit.prevent="safeExec(submit)">
                    
        <text-input name="nombre" label="Nombre" icon="fa fa-tag" 
            v-model="componente.nombre"
            v-validate="'required|alpha_spaces|max:30'"
            :error-messages="errors.collect('nombre')"
            pattern="[0-9a-zA-ZáéíóúñÁÉÍÓÚ ,.:-]{2,300}" 
            required>
        </text-input>
        
        <div class="form-group form-md-radios">
            <label>OBLIGATORIO</label>
            <bs-switch ref="switch" :id="id" label="requerido" v-model="componente.required"></bs-switch>
        </div>
        
        <textarea-input name="descripcion" label="Descripción" v-model="componente.descripcion" 
            v-validate="'required|max:300'"
            :error-messages="errors.collect('descripcion')"    
            required>
        </textarea-input>


        <div class="text-center">
            <button type="submit" class="btn green-jungle"><i class="fa fa-plus"></i>{{ submitText }}</button>
            <button type="button" class="btn red" data-dismiss="modal"><i class="fa fa-ban"></i>Cancelar</button>
        </div>
    </form>
</template>
<script>
import _ from 'lodash'
import BsSwitch from "../bs/bs-switch"
import TextInput from "../inputs/text-input"
import TextareaInput from "../inputs/textarea-input"
export default {
    components: { BsSwitch, TextInput, TextareaInput },
    props: {
        editable: Object,
        submitText: { type: String, default: "Guardar" },
        id: { type: String, required: true }
    },
    data() {
        return {
            componente: this.schema()
        }
    },
    methods: {
        submit(){
            this.$emit("submit", this.componente)
        },
        schema() {
            return {
                nombre: "",
                required: false,
                descripcion: "",
            }
        },
        reset() {
            this.componente = this.schema()
            setTimeout(() => this.errors.clear())
        }
    },
    watch: {
        editable(val) {
            this.$refs.switch.mount()
            this.componente = val ? _.clone(val) : this.schema()
        } 
    }
}
</script>
