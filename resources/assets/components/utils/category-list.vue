
<template>
<div>
    <div class="table-responsive">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Plataforma</th>
                    <th class="text-center">Modelado</th>
                    <th class="text-center">Base de datos</th>
                    <th class="text-center">Codificación</th>
                    <th class="text-center">Descripción</th>
                    
                </thead>
                <tbody>
                    <tr v-for="categoria in categorias" class="text-center">
                        <td v-text="categoria.nombre"></td>
                        <td v-text="categoria.plataforma"></td>
                        <td v-text="categoria.modelado"></td>
                        <td v-text="categoria.base_datos"></td>
                        <td v-text="categoria.codificacion"></td>
                        <td class="text-center">
                            <popover title="Descripción" placement="bottom" >
                                <button type="button" class="btn btn-default btn-xs" data-role="trigger" title="Descripción" >
                                    <span class="fa fa-map-o"></span>
                                </button>
                                <div slot="popover">
                                    {{categoria.descripcion}}
                                </div>
                            </popover>
                        </td>


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
    props:['categorias']
}


</script>