<template>
    <select :id="id" class="form-control selectpicker" :value="value" :title="title" @change="change" :required="required">
        <slot></slot>
    </select>
</template>

<script>
export default {
    props: ['id', 'value', 'title', 'required'],
    data(){
        return { initialized: false }
    },

    // Asigna el valor del v-model
    updated(){
        if(!this.initialized){
            $("#" + this.id).val(this.value);
            this.initialized = true;
        }
    },



    methods: {
        change(e) {
            this.$emit('input', e.target.value);
        }
    }
}
</script>
