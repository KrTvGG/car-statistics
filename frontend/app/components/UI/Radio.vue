<script lang="ts" setup>
    const modelValue = defineModel<string>()
    const { value, name } = defineProps<{
        name: string
        value: string
    }>()
</script>

<template>
    <label class="ui-radio">
        <input
            type="ui-radio"
            class="ui-radio__input"
            v-model="modelValue"
            :name="name"
            :value="value"
        />
        <div class="ui-radio__marker"></div>
        <span class="ui-radio__text"><slot></slot></span>
    </label>
</template>

<style lang="scss" scoped>
    .ui-radio {
        $this: &;
        width: fit-content;
        display: flex;
        gap: 10px;
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
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 1px solid #000;
            padding: 2px;
            &::after {
                content: "";
                display: block;
                width: 100%;
                height: 100%;
                transition: all 0.3s ease;
                border-radius: 50%;
            }
        }
    }
</style>