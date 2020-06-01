<template>
<a @click.prevent="submit()" class="text-uppercase">{{ label }}
    <form :id="id" :action="action" target="_blank" method="post">
        <input type="hidden" name="_token" :value="token">
    </form>
</a>
</template>
<script>
export default {
    props: {
        action: { type: String, required: true },
        id: { type: String },
        label: { type: String, default: 'submit' }
    },
    methods: {
        submit() {
            document.getElementById(this.id).submit()
        }
    },
    computed: {
        token() {
            let token = document.querySelector('meta[name="csrf-token"]');
            return token.getAttribute('content')
        }
    }
}
</script>
