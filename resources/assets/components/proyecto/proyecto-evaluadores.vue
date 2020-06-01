<template>
    <div class="panel panel-warning">
        <div class="panel-heading text-center">EVALUADORES</div>
        <div class="panel-body bg-warning">
            <ul class="list-group">
                <li class="list-group-item text-center" v-for="usuario in evaluadores" :key="usuario.PK_id">
                    {{ usuario.name }} - {{ usuario.email }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['evaluadores']
}
</script>