<template>
    <div class="panel panel-info">
        <div class="panel-heading text-center">
          {{ doc}} - Total: <b>{{ total }}%</b>
        </div>
        <div class="panel-body">
            <ul class="list-group" >
                <li class="list-group-item" v-for="evaluador in evaluadores" 
                  :key="evaluador.PK_id"
                  :class="{'list-group-item-info': evaluador.PK_id == evaluadorID}">

                  <a @click="evaluadorID = evaluador.PK_id">{{ evaluador.name }}</a>
                  <span class="badge">{{ evaluador.promedio }}%</span>
                </li>
            </ul>
            <ul class="list-group">
              <li class="list-group-item" v-for="evaluacion in evaluacionesEscogidas" 
                :key="`${evaluacion.FK_ComponenteId}-${evaluacion.EvaluatorId}`">
                <h5 class="list-group-item-heading">
                  {{ evaluacion.componente.nombre }}
                  <span class="pull-right fa" :class="{
                    'fa-check text-success': evaluacion.checked,
                    'fa-times text-danger': !evaluacion.checked 
                    }"></span>  
                </h5>
                <p class="list-group-item-text">
                  {{ evaluacion.observacion }}
                </p>
              </li>
            </ul>
        </div>
    </div>
</template>
<script>
import _ from "lodash";
export default {
  props: ["evaluaciones", "doc"],
  data() {
    return {
      evaluadorID: null
    };
  },
  computed: {
    evaluadores() {
      return _.uniqBy(this.evaluaciones, "evaluador.PK_id").map(ev => {
        let evaluador = ev.evaluador;
        let evaluaciones = this.evaluaciones.filter(
          ev => ev.evaluador.PK_id === evaluador.PK_id
        );
        let promedio = _.meanBy(evaluaciones, "checked") * 100;
        evaluador.promedio = Math.round(promedio);
        return evaluador;
      });
    },
    evaluacionesEscogidas() {
      return this.evaluaciones.filter(
        ev => ev.evaluador.PK_id === this.evaluadorID
      );
    },
    total() {
      return (
        this.evaluadores.reduce(
          (sum, evaluador) => sum + evaluador.promedio,
          0
        ) / this.evaluadores.length
      );
    }
  }
};
</script>
