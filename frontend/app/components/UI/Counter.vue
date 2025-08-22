<script lang="ts" setup>
    const modelValue = defineModel<number>()
    const {
        min = 1,
        max = 100,
        step = 1,
    } = defineProps<{
        min?: number
        max?: number
        step?: number
    }>()
    const inputValue = computed({
        get: () => modelValue.value,
        set: value => {
            if (!value) modelValue.value = min
            else if (value >= max && modelValue.value != max)
                modelValue.value = max
            else if (value <= min && modelValue.value != min)
                modelValue.value = min
            else modelValue.value = value
        },
    })
    const increase = () => {
        if (modelValue.value && modelValue.value < max) modelValue.value += step
    }
    const decrease = () => {
        if (modelValue.value && modelValue.value > min) modelValue.value -= step
    }
</script>

<template>
    <div class="ui-counter">
        <div class="ui-counter__btn" @click="decrease">-</div>
        <input class="ui-counter__input" type="number" v-model="inputValue" />
        <div class="ui-counter__btn" @click="increase">+</div>
    </div>
</template>

<style lang="scss" scoped>
    .ui-counter {
        width: 80px;
        height: 35px;
        border-radius: 5px;
        border: 1px solid #000;
        display: grid;
        grid-template-columns: 20px 1fr 20px;
        &__btn {
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            &:first-child {
                border-right: 1px solid #000;
            }
            &:last-child {
                border-left: 1px solid #000;
            }
        }
        &__input {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    }
</style>