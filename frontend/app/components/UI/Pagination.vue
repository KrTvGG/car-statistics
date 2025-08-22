<script lang="ts" setup>
    const page = defineModel<number>("page", { default: 1 })
    const maxPage = defineModel<number>("maxPage", { required: true })

    const pageNum = computed(() =>
        typeof page.value == "string" ? +page.value : page.value,
    )
    const maxPageNum = computed(() =>
        typeof maxPage.value == "string" ? +maxPage.value : maxPage.value,
    )

    watch(maxPage, () => {
        if (maxPage < page) maxPage.value = page.value
    })
    const aroundExt = 2
    const aroundActive = 2
    if (page.value > maxPage.value) page.value = maxPage.value

    const setPage = (val: number) => {
        page.value = val
    }
</script>

<template>
    <div class="pagination" v-if="maxPage > 1">
        <div
            class="pagination-button pagination-button--prev"
            :class="(page as number) <= 1 && 'pagination-button--disable'"
            @click="() => (page as number)--"
        >
            <NuxtIcon class="pagination-button__icon" name="slider-arrow" />
        </div>
        <div class="pagination__list">
            <template v-for="p in aroundExt + 1">
                <div
                    class="pagination-item"
                    v-if="maxPageNum >= p && p != page"
                    @click="setPage(p)"
                >
                    {{ p }}
                </div>
                <div
                    class="pagination-item pagination-item--active"
                    v-else-if="maxPageNum >= p && p == page"
                >
                    {{ p }}
                </div>
            </template>
            <div
                class="pagination-item"
                v-if="aroundExt + 2 < pageNum - aroundActive"
            >
                ...
            </div>
            <template v-for="p in aroundActive * 2 + 1">
                <div
                    class="pagination-item"
                    v-if="
                        pageNum + p - 1 - aroundActive > aroundExt + 1 &&
                        pageNum + p - 1 - aroundActive <= maxPageNum &&
                        page != pageNum + p - 1 - aroundActive
                    "
                    @click="setPage(pageNum + p - 1 - aroundActive)"
                >
                    {{ pageNum + p - 1 - aroundActive }}
                </div>
                <div
                    class="pagination-item pagination-item--active"
                    v-else-if="
                        pageNum + p - 1 - aroundActive > aroundExt + 1 &&
                        pageNum + p - 1 - aroundActive <= maxPageNum &&
                        page == pageNum + p - 1 - aroundActive
                    "
                >
                    {{ pageNum + p - 1 - aroundActive }}
                </div>
            </template>
            <div
                class="pagination-item"
                v-if="maxPageNum - aroundExt > pageNum + aroundActive + 1"
            >
                ...
            </div>
            <template v-for="p in aroundExt + 1">
                <div
                    class="pagination-item"
                    v-if="
                        maxPageNum + p - 1 - aroundExt >=
                            pageNum + aroundActive + 1 &&
                        page != maxPageNum + p - 1 - aroundExt
                    "
                    @click="setPage(maxPageNum + p - 1 - aroundExt)"
                >
                    {{ maxPageNum + p - 1 - aroundExt }}
                </div>
                <div
                    class="pagination-item pagination-item--active"
                    v-else-if="
                        maxPageNum + p - 1 - aroundExt >=
                            pageNum + aroundActive + 1 &&
                        page == maxPageNum + p - 1 - aroundExt
                    "
                >
                    {{ maxPageNum + p - 1 - aroundExt }}
                </div>
            </template>
        </div>
        <div
            class="pagination-button pagination-button--next"
            :class="page >= maxPage && 'pagination-button--disable'"
            @click="() => (page as number)++"
        >
            <NuxtIcon class="pagination-button__icon" name="slider-arrow" />
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .pagination {
        display: flex;
        align-items: center;
        gap: clampFluid(30);
        &__list {
            display: flex;
            gap: 10px;
        }
    }
    .pagination-item {
        width: clampFluid(64);
        height: auto;
        aspect-ratio: 1;
        border: 2px solid transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        @include p1;
        opacity: 0.7;
        &--active {
            opacity: 1;
            pointer-events: none;
            border-color: var(--color-main);
        }
    }
    .pagination-button {
        width: clampFluid(64);
        height: auto;
        aspect-ratio: 1;
        background-color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        &--disable {
            opacity: 0.5;
            pointer-events: none;
        }
        &--prev {
            rotate: 180deg;
        }
        &__icon {
            width: clampFluid(24);
            height: auto;
            aspect-ratio: 24 / 18;
            color: var(--black);
        }
    }
</style>