<script lang="ts" setup>
    const opened = ref<boolean>(false)
</script>

<!--
    Пример использования
    <UIAccordion>
        <template v-slot:head="{ opened }">
            <div class='my-accordion' :class="{'my-accordion--opened': opened}">
            </div>
        </template>
        <template v-slot:body>
        </template>
    </UIAccordion>
-->

<template>
    <div class="ui-accordion">
        <div class="ui-accordion__head" @click="opened = !opened">
            <slot name="head" :opened="opened"></slot>
        </div>
        <div
            class="ui-accordion__body"
            :class="{ 'ui-accordion__body--opened': opened }"
        >
            <div class="ui-accordion__body-container">
                <slot name="body"></slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .ui-accordion {
        &__head {
        }
        &__body {
            display: grid;
            grid-template-rows: 0fr;
            transition: all 0.3s ease;
            &--opened {
                grid-template-rows: 1fr;
            }
        }
        &__body-container {
            min-height: 0px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
    }
</style>