<template>
    <div class="form-group form-md-line-input" :class="state">
        <div class="input-icon">
            <input :type="type" :name="name" class="form-control" :value="value" 
                @input="input" v-bind="$attrs"/>
            <label :for="name" class="control-label">{{ label }}</label>
            <span v-if="errorMessages.length" class=" help-block">
                <strong>{{ errorMessages[0] }}</strong>
            </span>
            <i :class="icon"></i>
        </div>
    </div>
</template>
<script>
import Input from "../../mixins/Input"
export default {
    mixins: [Input],
    props: {
        label: String,
        icon: String
    }
}
</script>