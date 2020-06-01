<template>
    <div class="btn-group btn-group-vertical center-block">
        <template v-if="creacion">
            <button type="button" class="btn blue" @click="$emit('propuesta')">
                Enviar Propuesta
            </button>
            <button class="btn yellow-gold" @click="$emit('editar')">
                Editar Datos
            </button>
            <button class="btn red" @click="$emit('eliminar')">
                Eliminar
            </button>
        </template>
        <template v-if="activo">
            <button class="btn btn-primary" @click="$emit('evaluacion')">
                Realizar Evaluacion
            </button>
        </template>
        <proyecto-resultados v-if="completado" :proyecto-id="proyecto.PK_id"/>

    </div>
</template>
<script>
import ProyectoResultados from './proyecto-resultados'
import EstadosMixin from '../mixins/proyecto-estados'
export default {
  props: {
    proyecto: { type: Object, required: true }
  },
  mixins: [EstadosMixin],
  components: {
      ProyectoResultados
  }
};
</script>
