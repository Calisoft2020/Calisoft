<template>
    <div class="form-group form-md-line-input" :class="state">
        <textarea :name="name" class="form-control" style="resize: none" rows="3"
            @input="input" :value="value" v-bind="$attrs">
        </textarea>
        <label :for="name">{{ label }}</label>
        <span v-if="errorMessages.length" class="help-block">
            <strong>{{ errorMessages[0] }}</strong>
        </span>
   </div>
</template>
<script>
import Input from '../../mixins/Input'
export default {
    mixins: [Input],
    props: {
        label: String
    }
}
</script>