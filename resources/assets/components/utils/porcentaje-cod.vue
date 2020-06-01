<template>
  <div>
      <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <th class="text-center">Items</th>
                    <th class="text-center">Prioridad</th>
                    
                </thead>
                <tbody>
                    <tr class="text-center" v-for="item in items">
                        <td v-text="item.item"></td>
                        <td v-text="item.valor"></td>
                    </tr>
                </tbody>
            </table>
        </div>
  </div>      
</template>
<script>
export default {
  components:{},
  props:['items']

}
</script>

