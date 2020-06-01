<template>
    <div class="form-group form-md-line-input" :class="state">
        <div class="input-icon">
            <select :name="name" class="form-control" @change="input" v-bind="$attrs" :value="value">
                <slot></slot>
            </select>
            <label :for="name" class="control-label">{{ label }}</label>
            <i :class="icon"></i>
        </div>
    </div>
</template>

<script>
import Input from '../../mixins/Input'
export default {
    mixins: [Input],
    props: {
        icon: String,
        label: String,
        selected: String
    },
    mounted() {
        this.$emit('input', this.selected)
    }
}
</script>
