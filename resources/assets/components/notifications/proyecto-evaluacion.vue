<template>
    <span class="details">
        <span class="label label-sm label-icon label-success">
            <i class="fa fa-cogs"></i>
        </span>
        <span>
            El proyecto <strong>{{ notificacion.data.proyecto }}</strong>
            esta listo para ser evaluado
        </span>
    </span>
</template>


<script>
export default {
  props: ['notificacion']
}
</script>