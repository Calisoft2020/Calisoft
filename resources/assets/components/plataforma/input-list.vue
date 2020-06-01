<template>
    <section>
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 v-if="totales == npruebas" class="font-green-sharp">
                        <span data-counter="counterup" :data-value="totales" v-text="totales"></span>
                    </h3>
                    <h3 v-if="totales != npruebas" class="font-red-haze">
                        <span data-counter="counterup" :data-value="totales" v-text="totales"></span>
                    </h3>
                        <small>Barra de proceso</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span v-if="totales == npruebas" :style="{ width: porcentaje.toString() + '%' }" class="progress-bar progress-bar-danger green-sharp">
                        
                    </span>
                    <span v-if="totales != npruebas" :style="{ width: porcentaje.toString() + '%' }" class="progress-bar progress-bar-danger red-haze">
                        
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> Porcentaje </div>
                    <div class="status-number" > {{porcentaje.toString()}}% </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="sample">
                <thead>
                    <tr>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Reglas</th>
                        <th class="text-center">Input</th>
                        <th class="text-center">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(input,index) in formulario" :key="index" class="text-center">
                        <td>{{ input.type }}</td>
                        <td>{{ input.name || input.id || index }}</td>
                        <td>{{ reglas[index] }}</td>
                        <td v-if="matrix[index] == 1">
                            <input class="form-control" v-bind="input" :value="values[index]"  v-validate="reglas[index]"
                                @input="values[index] = $event.target.value">
                            <span class="text-danger" v-if="errors.has(input.name)">
                                {{ errors.first(input.name) }}
                            </span>
                        </td>
                        <td v-else>
                            <input class="form-control" v-bind="input" :value="values[index]"  v-validate="{ required: true, regex: new RegExp(`^${matrix[index]}$`)  }"
                                @input="values[index] = $event.target.value">
                            <span class="text-danger" v-if="errors.has(input.name)">
                                {{ errors.first(input.name) }}
                            </span>
                        </td>
                        <td>
                            <span class="fa fa-check text-success" v-if="resultados[index]"></span>
                            <span class="fa fa-close text-danger" v-else></span> 
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr v-if="values.length" class="active">
                        <th colspan="4">CALIFICACIÓN</th>
                        <th class="text-center">
                            {{ calificacion }}%
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row" v-if="totales < npruebas">
            <div class="col-sm-4">
                <button class="btn blue-hoki btn-block" @click="evaluar" title="Cargar y Guardar Automaticamente">
                    <i class="fa fa-android fa-2x pull-left"></i> Modo Asistido
                </button>
            </div>
            <div class="col-sm-4">
                <button class="btn green-jungle btn-block" @click="cargar()">
                    <i class="fa fa-plus fa-2x pull-left"></i> Cargar prueba   
                </button>
            </div>
            
            <div class="col-sm-4" v-if="values.length">
                <button class="btn btn-block btn-primary" @click="guardar()">
                    <i class="fa fa-save fa-2x"></i>GUARDAR PRUEBA
                </button>
            </div>
            <full-loading :show="cargando"/>
        </div>
    </section>

</template>

<script>
import {
  parseRule,
  parseInputs
} from "../../classes/plataforma/input-attributes";
import { mean } from "lodash";
import FullLoading from "../utils/full-loading";
export default {
  props: ["formulario", "casoPruebaId", "npruebas", "matrix"],
  components: { FullLoading },
  data() {
    return {
      values: [],
      tipos: ["valido", "invalido", "sql", "xss"],
      selected: -1,
      valido: 0,
      totales: 0,
      porcentaje: 0,
      cargando: false,
      alert: true
    };
  },
  created() {
    this.refresh();
    this.$validator.errorBag;
  },
  methods: {
    refresh() {
      axios.get(`/pruebasCasoPrueba/${window.casoPruebaId}`).then(res => {
        this.totales = res.data;
        this.porcentaje = Math.round(res.data * 100 / this.npruebas);
      });
    },
    cargar() {
      this.select();

      return axios
        .post("/api/testing", {
          inputs: this.formulario.map(input => input.id),
          tipo: this.tipos[this.selected]
        })
        .then(response => {
          this.values = response.data.values;
          this.valido = response.data.valido;
          setTimeout(() => this.validar());
        });
    },
    validar() {
      this.$validator.validateAll();
    },
    select() {
      this.selected += 1;
      if (this.selected >= this.tipos.length) {
        this.selected = 0;
      }
    },
    guardar() {
      let contexto = this.formulario.map((input, index) => ({
        nombre: input.name,
        entrada: this.values[index],
        estado: this.resultados[index]
      }));
      return axios
        .post("/api/testing/save/" + this.casoPruebaId, {
          contexto: contexto,
          calificacion: this.calificacion
        })
        .then(() => {
          this.alert && toastr.success("Prueba Guardada");
          this.refresh();
          this.values = [];
          this.errors.clear();
        });
    },
    async evaluar() {
      this.cargando = true;
      this.alert = false;
      let total = this.totales;
      while (total < this.npruebas) {
        await this.cargar();
        await this.timeout();
        await this.guardar();
        total++;
      }
      this.cargando = false;
      this.alert = false;
      toastr.info("Evaluación Asistida Completada");
    },
    timeout() {
      return new Promise(resolve => setTimeout(resolve, 1000));
    }
  },
  computed: {
    reglas() {
      return parseInputs(this.formulario);
    },
    resultados() {
      return this.formulario.map(
        input => this.errors.has(input.name) != this.valido
      );
    },
    calificacion() {
      return mean(this.resultados) * 100;
    }
  }
};
</script>