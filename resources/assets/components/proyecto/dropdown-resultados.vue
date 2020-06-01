<template>
    <dropdown v-model="dropdown">
        <button class="btn btn-xs pull-right" @click="dropdown=true">
            REPORTES
            <span class="caret"></span>
        </button>
        <template slot="dropdown">
            <li>
                <post-form :id="`mod-${proyectoId}`" :action="`/pdf/proyecto/${proyectoId}/modelacion`" label="modelacion"/> 
            </li>
            <li>
                <post-form :id="`plat-${proyectoId}`" :action="`/pdf/proyecto/${proyectoId}/plataforma`" label="plataforma"/> 
            </li>
            <li>
                <post-form :id="`cod-${proyectoId}`" :action="`/pdf/proyecto/${proyectoId}/codificacion`" label="codificacion"/> 
            </li>
            <li>
                <post-form :id="`bas-${proyectoId}`" :action="`/pdf/proyecto/${proyectoId}/basedatos`" label="basedatos"/> 
            </li>
            <li>
                <post-form :id="`tot-${proyectoId}`" :action="`/pdf/proyecto/${proyectoId}/total`" label="global"/> 
            </li>
        </template>
    </dropdown>
</template>
<script>
import PostForm from '../utils/post-form'
import { Dropdown } from "uiv";
export default {
    props: ['proyectoId'],
    components: { PostForm, Dropdown },
    data() {
        return { dropdown: false }
    }
}
</script>
