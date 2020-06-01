<template>
    <input type="checkbox" :id="id" 
        :data-label-text="label || id"
        data-size="normal" 
        data-inverse="true" 
        :checked="value"
        v-bind="$attrs">
</template>

<script>
export default {
    props: ['id', 'value', 'label', 'options'],
    mounted() {
        this.mount()
    },
    methods: {
        handleChange(e, state) {
            this.$emit('input', state)
            this.$emit('change', state)
        },
        mount() {
            let el = $("#" + this.id);
            el.bootstrapSwitch(this.options);
            el.on('switchChange.bootstrapSwitch', this.handleChange);
        }
    }
}
</script>
