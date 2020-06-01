<template>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td>Proposito:</td>
                <td>{{ caso.proposito }} </td>
            </tr>
            <tr>
                <td>Alcance:</td>
                <td>{{ caso.alcance }} </td>
            </tr>
            <tr>
                <td>Resultado Esperado:</td>
                <td>{{ caso.resultado_esperado }} </td>
            </tr>
            <tr>
                <td>Criterios:</td>
                <td>{{ caso.criterios }} </td>
            </tr>
            <tr>
                <td>Prioridad:</td>
                <td>{{ caso.prioridad }} </td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td>{{ caso.estado }} </td>
            </tr>
            <tr>
                <td>Plazo:</td>
                <td>{{ caso.limite }} </td>
            </tr>
            
            <tr v-if="caso.formulario !== ''">
                <td>Json Enviado:</td>
                <td>
                    Total de Inputs: 
                    <span class="label label-sm label-danger circle">
                        {{ JSON.parse(caso.formulario).length }}
                    </span> 
                </td>
            </tr>

            <tr v-if="calificacion" class="info">
                <th>Calificacion:</th>
                <th>{{ calificacion }}%</th>
            </tr>
            
        </tbody>
    </table>
</template>
<script>
import { meanBy } from "lodash";
export default {
    props: {
        caso: { type: Object, required: true }
    },
    computed: {
        calificacion() {
            let pruebas = this.caso.pruebas
            if(!pruebas && !pruebas.length) return null;
            return meanBy(pruebas, 'calificacion') 
        }
    }
}
</script>

