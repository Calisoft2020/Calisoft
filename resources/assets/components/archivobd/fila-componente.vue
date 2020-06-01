<template>
   
        <tr class="text-center">
            <td v-text="item.nombre"></td>
            <td>  
                <input type="text" name="total" class="form-control" v-validate="'required|min_value:0|numeric'" 
                    v-model="item.pivot.total" required="required" v-bind:readonly="read" />
                <span v-if='errors.has("total")' class="text-danger"  >{{errors.collect("total")[0]}}</span>
            </td>
            <td> 
                <input type="text" name="acertadas" class="form-control" 
                    v-validate="{ required: true, min_value: 0, max_value: item.pivot.total, numeric: true }" 
                    v-model="item.pivot.acertadas" required="required" v-bind:readonly="read"/>
                <span v-if='errors.has("acertadas")' class="text-danger"  >
                    {{ errors.collect("acertadas")[0] }}
                </span>       
                
            </td>
            <td >
                {{item.pivot.calificacion}}        
            </td>
        </tr>
    
</template>

<script>
import TextInput from "../inputs/text-input";

export default {
  components: { TextInput },
  props: {
    item: { type: Object, required: true },
    read: {type: Boolean, default: true}
  },
  methods: {
    update(item) {
      axios
        .put("/api/evaluacionSql/" + window.archivoId, {
          PK_id: item.PK_id,
          calificacion: item.pivot.calificacion,
          acertadas: item.pivot.acertadas,
          total: item.pivot.total
        })
        .then(response => {})
        .catch(reason => this.setErrors(reason.response.data.errors));
    },

    validacion(total, acertadas) {
      this.item.pivot.calificacion =
        total > 0 ? (((acertadas / total * this.item.valor)* 5)/this.item.valor).toFixed(2) : 0;

       this.safeExec(()=> this.update(this.item))
    }
  },

  watch: {
    "item.pivot.total": function(total) {
      this.$validator
        .validate("acertadas")
        .then(() => this.validacion(total, this.item.pivot.acertadas));
    },
    "item.pivot.acertadas": function(acertadas) {
      this.validacion(this.item.pivot.total, acertadas);
    }
  }
};
</script>