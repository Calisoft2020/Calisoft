<template>
    <div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <th class="text-center">Componente</th>
                    <th class="text-center">Estandar</th>
                    <th class="text-center">Nomenclatura</th>
                    <th class="text-center">Valor</th>
                </thead>
                <tbody>
                    <tr v-for="componente in componentes" class="text-center">
                        <td v-text="componente.nombre"></td>
                        <td v-text="componente.estandar"></td>
                        <td v-text="componente.nomenclatura"></td>
                        <td v-text="componente.valor"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import { Popover } from "uiv";
export default{
    components:{Popover},
    props:['componentes']
}
</script>