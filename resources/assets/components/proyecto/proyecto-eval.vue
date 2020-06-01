<template>
    <table class="table table-condensed table-bordered">
        <tbody>
            <tr>
                <th>Nombre:</th>
                <td>{{ proyecto.nombre }}</td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td class="text-uppercase">{{ proyecto.state }}</td>
            </tr>
            <tr>
                <th>Categoria:</th>
                <td>{{ proyecto.categoria.nombre }}</td>
            </tr>
            <tr>
                <th>Semillero</th>
                <td>{{ proyecto.semillero.nombre }}</td>
            </tr>
            <tr>
                <th>Grupo de investigación:</th>
                <td>{{ proyecto.grupo_de_investigacion.nombre }}</td>
            </tr>
            <tr>
                <th>Creado el:</th>
                <td>{{ new Date(proyecto.created_at).toLocaleDateString() }}</td>
            </tr>
            <tr>
                <th>Integrantes:</th>
                <td>
                    <span class="badge badge-info" v-for="integrante in integrantes" :key="integrante.PK_id" style="margin-right: 1%">
                        {{ integrante.name }}
                    </span>
                </td>
            </tr>
            <tr v-if="evaluadores.length">
                <th>Evaluadores:</th>
                <td>
                    <span class="badge badge-info" v-for="evaluador in evaluadores" :key="evaluador.PK_id" style="margin-right: 1%">
                        {{ evaluador.name }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import UsersMixin from '../mixins/proyecto-users'
export default {
    mixins: [UsersMixin],
    props: {
        proyecto: { type: Object, required: true }
    }
}
</script>

