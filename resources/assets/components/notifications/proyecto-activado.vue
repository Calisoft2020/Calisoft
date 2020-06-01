<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-circle"></i>
        </span>

        <span>
            Su proyecto <strong>{{ notificacion.data.proyecto }}</strong> ha sido activado
        </span>
    </span>
</template>

<script>
export default {
    props: ['notificacion']
}
</script>
