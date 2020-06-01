<template>
    <span class="details">
        <span class="label label-sm label-icon label-danger">
            <i class="fa fa-minus"></i>
        </span>

        <span>
            <strong>{{ notificacion.data.user }}</strong> 
            No ha aceptado la invitación al proyecto:
            <strong>{{ notificacion.data.proyecto }}</strong>
        </span>
    </span>
</template>


<script>
export default {
  props: ['notificacion']
}
</script>
