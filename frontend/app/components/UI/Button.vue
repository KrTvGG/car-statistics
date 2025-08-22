<script lang="ts" setup>
    const { to } = defineProps<{
        to?: string
        autoWidth?: boolean
    }>()

    const nuxtLink = resolveComponent("UILink")
    const tag = computed(() => {
        if (to) return nuxtLink
        else return "button"
    })
</script>

<template>
    <component
        :is="tag"
        :to="to"
        class="ui-button"
        :class="{ 'ui-button--auto-width': autoWidth }"
    >
        <span class="ui-button__text">
            <slot></slot>
        </span>
    </component>
</template>

<style lang="scss" scoped>
    .ui-button{
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        height: 47px;
        background-color: $main-clr;
        &--auto-width {
            width: fit-content;
            padding: 0 15px;
        }
        &__text {
            color: #fff;
        }
    }
</style>