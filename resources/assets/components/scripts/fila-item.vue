<template>
   
        <tr class="text-center">
            <td v-text="item.item"></td>
            <td>  
              
                <input type="text" name="total" class="form-control" 
                v-validate="'required|min_value:0|numeric'" v-model="item.pivot.total"required="required" />
                <span v-if='errors.has("total")' class="text-danger"  >{{errors.collect("total")[0]}}</span>
            </td>
            <td> 
                 <input type="text" name="acertadas" class="form-control" 
                v-validate="{required:true,min_value:0,max_value:item.pivot.total,numeric:true}" 
                v-model="item.pivot.acertadas"required="required" />
                <span v-if='errors.has("acertadas")' class="text-danger"  >{{errors.collect("acertadas")[0]}}</span>       
                
            </td>
            <td >
                {{item.pivot.nota}}        
            </td>
        </tr>
    
</template>

<script>
 import TextInput from "../inputs/text-input";

export default {
       
    components:{TextInput},
    props: {
        item:{type:Object,required:true},   
    },
    methods:{
        
        
        update(item){
            axios.put('/api/evaluacionesScript/' + window.ScriptId,{
                PK_id: item.PK_id, nota:item.pivot.nota, acertadas:item.pivot.acertadas,
                total:item.pivot.total,

                }).then(response=>{

            }).catch(reason => this.setErrors(reason.response.data.errors));

        },

        validacion(total,acertadas){
            
            if(total>0){
                this.item.pivot.nota=(acertadas/total).toFixed(2)
                
            }
            else
            {
                this.item.pivot.nota=0
            }
            this.safeExec(()=> this.update(this.item))
            

        },
    },
       
    watch:{
        "item.pivot.total":function(total){
            this.$validator.validate("acertadas")
                .then(()=>this.validacion(total,this.item.pivot.acertadas))
            

        },
         "item.pivot.acertadas":function(acertadas){
            this.validacion(this.item.pivot.total,acertadas)
         },
         
    },
}

</script>