<script lang="ts" setup>
    const modelValue = defineModel<string | number>()
    const text = ref<string>("")
    const isOpened = ref<boolean>(false)
    const { items, readonly, empty } = defineProps<{
        items: {
            [key: string | number]: string
        }
        placeholder?: string
        readonly?: boolean
        empty?: boolean
    }>()

    const select = (key: string | number) => {
        text.value = items[key]
        modelValue.value = key
        isOpened.value = false
    }

    if (!empty && !modelValue.value) {
        modelValue.value = Object.keys(items)[0]
        text.value = items[Object.keys(items)[0]]
    }

    const filteredItemKeys = computed(() => {
        if (!readonly && text.value.length)
            return Object.keys(items).filter(key =>
                items[key].toLowerCase().includes(text.value.toLowerCase()),
            )
        return Object.keys(items)
    })
</script>

<template>
    <div class="ui-select" v-click-outside="() => (isOpened = false)">
        <div class="ui-select__field" @mousedown="() => (isOpened = !isOpened)">
            <UIInput
                v-model="text"
                :placeholder="placeholder"
                :readonly="readonly"
                :onInput="
                    () => {
                        modelValue = undefined
                    }
                "
            />
        </div>
        <div
            class="ui-select__list"
            :class="{ 'ui-select__list--active': isOpened }"
        >
            <div class="ui-select__list-wrapper">
                <div
                    class="ui-select-item"
                    v-if="empty"
                    @click="
                        () => {
                            text = ''
                            modelValue = undefined
                        }
                    "
                >
                    <span class="ui-select-item__text">—</span>
                </div>
                <div
                    class="ui-select-item"
                    v-for="itemKey in filteredItemKeys"
                    @click="select(itemKey)"
                >
                    <span>{{ items[itemKey] }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .ui-select {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        z-index: 1;
        &__field {
            display: flex;
            align-items: center;
            cursor: pointer;

            &::after {
                content: "";
                width: 6px;
                height: auto;
                border: 1px solid #000;
                aspect-ratio: 1;
                position: absolute;
                clip-path: polygon(100% 0, 100% 100%, 0 100%);
                rotate: 45deg;
                translate: 0 -25%;
                right: 10px;
            }
        }
        &__list {
            position: absolute;
            top: 100%;
            background-color: #fff;
            border-top: none;
            display: none;
            width: 100%;
            border: 1px solid #000;
            border-top: none;
            &--active {
                display: block;
            }
            .ps {
                max-height: 300px;
            }
        }
        &__list-wrapper {
        }
    }

    .ui-select-item {
        padding: 3px 5px;
        cursor: pointer;
        &__text {
            display: block;
            min-height: 1em;
        }
    }
</style>