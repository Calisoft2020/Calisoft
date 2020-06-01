<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-plus"></i>
        </span>

        <span>
            Se ha asignado el evaluador:
            <strong>{{ notificacion.data.from }}</strong>
        </span>
    </span>
</template>


<script>
export default {
  props: ['notificacion']
}
</script>
