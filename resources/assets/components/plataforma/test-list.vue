<template>
    <section>
        <table class="table table-condensed table-bordered" v-for="(prueba, index) in pruebas" :key="prueba.PK_id">
            <thead>
                <tr class="danger">
                    <th class="text-center">Prueba #{{index + 1}}</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">{{ prueba.calificacion }}%</th>
                </tr>
                <tr class="active">
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Entrada</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="input in prueba.contexto" :key="input.nombre" class="text-center">
                    <td>{{ input.nombre }}</td>
                    <td>{{ input.entrada }}</td>
                    <td>
                        <span class="fa fa-check text-success" v-if="input.estado"></span>
                        <span class="fa fa-close text-danger" v-else></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>
<script>
export default {
    props: {
        pruebas: { type: Array, required: true }
    }
}
</script>
