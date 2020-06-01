<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-check"></i>
        </span>

        <span>
            Se ha enviado el formulario del caso prueba <strong>{{ notificacion.data.caso }}</strong> 
            del proyecto <strong>{{ notificacion.data.proyecto }}</strong>.
        </span>
    </span>
</template>

<script>
export default {
    props: ['notificacion']
}
</script>
