<script lang="ts" setup>
    const modelValue = defineModel<boolean>()
</script>

<template>
    <label class="ui-checkbox">
        <input
            class="ui-checkbox__input"
            type="checkbox"
            v-model="modelValue"
        />
        <div class="ui-checkbox__marker"></div>
        <span class="ui-checkbox__text">
            <slot></slot>
        </span>
    </label>
</template>

<style lang="scss" scoped>
    .ui-checkbox {
        $this: &;
        display: flex;
        gap: 10px;
        width: fit-content;
        align-items: baseline;
        cursor: pointer;
        &__input {
            display: none;
            &:checked {
                & ~ #{$this}__marker {
                    &::after {
                        background-color: #000;
                    }
                }
            }
        }
        &__marker {
            border: 1px solid #000;
            padding: 2px;
            display: block;
            height: 15px;
            aspect-ratio: 1;
            &::after {
                content: "";
                width: 100%;
                height: 100%;
                display: flex;
            }
        }
        &__text {
        }
    }
</style>