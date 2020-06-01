<template>
    <a :id="id"></a>
</template>

<script>
export default {
    props: ['src', 'id', 'prefix', 'container'],
    data() {
        return { localSrc: this.src }
    },
    mounted() {
        this.media();
    },
    methods: {
        media() {
            $('#' + this.id).media({
                src: this.prefix + this.localSrc,
                width: $(this.container).width(),
                height: 520
            });
        }
    },
    watch: {
        src(value) {
            this.localSrc = value;
            this.media();
        }
    }
}
</script>
