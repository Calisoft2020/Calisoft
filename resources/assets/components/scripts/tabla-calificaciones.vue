<template>
   <div>
    <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <th class="text-center">Item</th>
                    <th class="text-center">Atributo</th>
                    <th class="text-center">Fila</th>
                    <th class="text-center">Aprobado</th>
                </thead>
                <tbody>
                    <tr v-for="item in items"  class="text-center" >
                        <td v-text="item.item"></td>
                        <td v-text="item.atributo"></td>
                        <td v-text="item.fila"></td>
                        <td v-if="item.calificacion == 1"> 
                            <i class="glyphicon glyphicon-ok" style="color : green;"></i>         
                        </td>
                        <td v-else> 
                            <i class="glyphicon glyphicon-remove" style="color : red;"></i>         
                        </td> 
                    </tr> 
                </tbody>
            </table>
    </div>
             
    </div>
</template>
<script>
export default {
   props : { 
       items : { 
             type : Array,
       }
   }
}
</script>
