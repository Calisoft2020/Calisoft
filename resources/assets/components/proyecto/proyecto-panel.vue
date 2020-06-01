<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4 class="panel-header m-0">{{ proyecto.nombre }}</h4>
                </div>
                <div class="col-xs-6">
                    <dropdown v-if="evaluacion" v-model="dropdown">
                        <button class="btn btn-xs pull-right" @click="dropdown=true">
                            EVALUACIÓN
                            <span class="caret"></span>
                        </button>
                        <template slot="dropdown">
                            <li><a :href="modelacion" class="text-primary">MODELACIÓN</a></li>
                            <li><a :href="plataforma" class="text-warning">PLATAFORMA</a></li>
                            <li><a :href="codificacion" class="text-success">CODIFICACIÓN</a></li>
                            <li><a :href="basedatos" class="text-danger">BASES DE DATOS</a></li>
                        </template>
                    </dropdown>
                    <dropdown-resultados v-if="completado" :proyecto-id="proyecto.PK_id"/>
                    <div v-if="activo" class="text-center">
                        <em>El proyecto todavia no se encuentra listo para evaluación</em>
                    </div>
                </div>
            </div>
        </div>
        <proyecto-eval :proyecto="proyecto"></proyecto-eval>
        <div class="panel-footer" v-if="evaluacion">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-block btn-xs btn-danger" @click="activeModal=true">Volver a activar proyecto</button>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-block btn-xs btn-success" @click="completeModal=true">Terminar Evaluación</button>
                </div>
            </div>
        </div>
        <modal v-model="activeModal" title="Activar Proyecto" :footer="false">
            <section>
                <p>
                    La siguiente acción habilatara al estudiante de editar documentos del proyecto.<br>
                    <b>Esta seguro de continuar?</b>
                </p>
                <button class="btn btn-warning center-block" @click="activar()">Continuar</button>
            </section>
        </modal>
        <modal v-model="completeModal" title="Terminar Evaluacion" :footer="false">
            <section>
                <p>
                    La siguiente acción concluira la evaluacion de proyecto.<br>
                    Asegurese de que todas las evaluaciones han sido completados
                    antes de cambiar el estado del proyecto a <b>COMPLETADO</b>.
                </p>
                <button class="btn btn-success center-block" @click="completar()">Aceptar</button>
            </section>
        </modal>
    </div>
</template>
<script>
import { Dropdown, Modal } from "uiv";
import ProyectoEval from "./proyecto-eval";
import DropdownResultados from './dropdown-resultados'
import UrlsMixin from "../mixins/proyecto-urls";
import EstadoMixin from "../mixins/proyecto-estados"

export default {
  mixins: [UrlsMixin, EstadoMixin],
  props: {
    proyecto: { type: Object, required: true }
  },
  components: {
    Dropdown,
    ProyectoEval,
    Modal,
    DropdownResultados
  },
  methods: {
    update(accion) {
      return axios
        .put(`api/proyectos/${this.proyecto.PK_id}/${accion}`)
        .then(res => {
          this.$set(this.proyecto, "state", res.data.state);
        });
    },
    activar() {
      this.update("activar").then(() => {
        this.activeModal = false;
        toastr.info(`El proyecto ${this.proyecto.nombre} ha sido activado`);
      });
    },
    completar() {
      this.update("completar").then(() => {
        this.completeModal = false;
        toastr.success(`El proyecto ${this.proyecto.nombre} ha sido marcado como completado`)
      });
    }
  },
  data() {
    return { dropdown: false, activeModal: false, completeModal: false };
  }
};
</script>
<style>
    .m-0 {
        margin: 0;
    }
</style>
