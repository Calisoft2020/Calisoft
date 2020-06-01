<template>
    <ul class="list-group">
        <li class="list-group-item list-group-item-success text-center" v-if="total">
          <h4 class="list-group-item-heading"> Total: {{ total }} %</h4>
        </li>
        <li class="list-group-item" v-for="documento in documentos" 
            :class="{'list-group-item-info': documento == active }"
            :key="documento.PK_id">
            <a @click.prevent="$emit('selected', documento)">
                {{ documento.nombre }} ({{ documento.tipo.nombre }})
            </a>
            <span class="badge" v-if="documento.evaluaciones.length && documento.tipo.required">
              {{ prDocumento(documento) }}%
            </span>

        </li>
    </ul>
</template>

<script>
import _ from "lodash";
export default {
  props: ["documentos", "active"],
  methods: {
    prDocumento(doc) {
      let promedio = _.meanBy(doc.evaluaciones, 'checked') * 100;
      return Math.round(promedio);
    }
  },
  computed: {
    total() {
      return Math.round(_.meanBy(this.validDocs, doc => this.prDocumento(doc)));
    },
    validDocs() {
      return this.documentos.filter(doc => doc.evaluaciones.length && doc.tipo.required)
    }
  }
};
</script>

