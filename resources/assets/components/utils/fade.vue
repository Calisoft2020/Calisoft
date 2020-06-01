<template>
    <transition name="fade" :mode="mode">
        <slot/>
    </transition>
</template>
<script>
export default {
  props: ['mode']
}
</script>

<style scoped>
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .4s;
    }
</style>

