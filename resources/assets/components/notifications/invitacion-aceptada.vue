<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-check"></i>
        </span>

        <span>
            <strong>{{ notificacion.data.user }}</strong> 
            Ha aceptado la invitación del proyecto:
            <strong>{{ notificacion.data.proyecto }}</strong>
        </span>
    </span>
</template>


<script>
export default {
  props: ['notificacion']
}
</script>
