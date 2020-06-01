<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-check"></i>
        </span>

        <span>
            La evaluación de su proyecto <strong>{{ notificacion.data.proyecto }}</strong> a sido completada
        </span>
    </span>
</template>

<script>
export default {
    props: ['notificacion']
}
</script>
