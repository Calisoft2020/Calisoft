<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-plus"></i>
        </span>

        <span>
            El proyecto: <strong>{{ notificacion.data.proyecto }}</strong> fue aceptado. 
        </span>
    </span>
</template>

<script>
export default {
    props: ['notificacion']
}
</script>
