<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-plus"></i>
        </span>

        <span>
            Nueva propuesta de proyecto: <strong>{{ notificacion.data.proyecto }}</strong>
        </span>
    </span>
</template>

<script>
export default {
    props: ['notificacion']
}
</script>
