<template>
    <table class="table">
        <tbody>
            <tr>
                <th>Nombre:</th>
                <td>{{ proyecto.nombre }}</td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td class="text-uppercase">
                    <strong>{{ proyecto.state }}</strong>
                </td>
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
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        proyecto: { type: Object, required: true }
    }
}
</script>
