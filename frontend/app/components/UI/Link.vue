<script lang="ts" setup>
    const { to } = defineProps<{
        to: string
    }>()
    const modalStore = useModalStore()

    const isBlank = computed(() => to[0] == "|")
    const isModal = computed(() => to[0] == "#")
    const link = computed(() => {
        if (isBlank) return to.slice(1)
        else if (isModal) return
        else return to
    })
    const modalName = computed(() => {
        if (isModal) return to.slice(1)
    })
    const openModal = () => {
        modalStore.openedModal = modalName.value || null
    }
</script>

<template>
    <NuxtLink v-if="!isModal" :to="link" :target="isBlank ? '_blank' : null">
        <slot></slot>
    </NuxtLink>
    <span v-else @click="openModal">
        <slot></slot>
    </span>
</template>

<style lang="scss" scoped>
    span {
        cursor: pointer;
    }
</style>