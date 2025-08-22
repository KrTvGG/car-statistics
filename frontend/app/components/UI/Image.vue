<script lang="ts" setup>
    defineProps<{
        src: string
        alt?: string
    }>()
</script>

<template>
    <NuxtImg :src="src" :alt="alt" />
</template>

<style lang="scss" scoped></style>