<script lang="ts" setup>
    const modelValue = defineModel<Date>()
    const currentDate = ref<Date>(new Date())

    const currentYear = computed(() => currentDate.value.getFullYear())
    const currentMonth = computed(() => currentDate.value.getMonth())

    const calendar = computed(() => {
        const result: Date[] = []

        const monthStartDate = new Date(
            currentYear.value,
            currentMonth.value,
            1,
        )
        const monthEndDate = new Date(
            currentYear.value,
            currentMonth.value + 1,
            0,
        )

        const firstWeekDayOfMonth = monthStartDate.getDay()

        const prevMonth = new Date(currentYear.value, currentMonth.value - 1, 0)
        const nextMonth = new Date(currentYear.value, currentMonth.value + 1, 0)
        let i = 1

        while (firstWeekDayOfMonth > i) {
            const calendarDay =
                prevMonth.getDate() - firstWeekDayOfMonth + i + 1
            result.push(
                new Date(
                    prevMonth.getFullYear(),
                    prevMonth.getMonth(),
                    calendarDay,
                ),
            )
            i++
        }
        i = 1
        while (monthEndDate.getDate() >= i) {
            result.push(
                new Date(
                    monthEndDate.getFullYear(),
                    monthEndDate.getMonth(),
                    i,
                ),
            )
            i++
        }

        i = 1
        while (result.length < 42) {
            result.push(
                new Date(nextMonth.getFullYear(), nextMonth.getMonth(), i),
            )
            i++
        }
        return result
    })

    const currentMonthStr = computed(
        () => `${monthByNum(currentMonth.value + 1)} ${currentYear.value}`,
    )

    const prevMonth = () => {
        let tmpDate = new Date()
        tmpDate.setFullYear(currentDate.value.getFullYear())
        tmpDate.setMonth(0)
        tmpDate.setMonth(currentDate.value.getMonth() - 1)
        currentDate.value = tmpDate
    }
    const nextMonth = () => {
        let tmpDate = new Date()
        tmpDate.setFullYear(currentDate.value.getFullYear())
        tmpDate.setMonth(0)
        tmpDate.setMonth(currentDate.value.getMonth() + 1)
        currentDate.value = tmpDate
    }
</script>

<template>
    <div class="ui-calendar">
        <div class="ui-calendar__nav">
            <div
                class="ui-calendar__nav-btn calendar__nav-btn--prev"
                @click="prevMonth"
            >
                <NuxtIcon name="arrow" />
            </div>
            <span class="ui-calendar__nav-text">
                <span>{{ currentMonthStr }}</span>
            </span>
            <span
                class="ui-calendar__nav-btn calendar__nav-btn--next"
                @click="nextMonth"
                ><NuxtIcon name="arrow"
            /></span>
        </div>
        <div class="ui-calendar__content">
            <div class="ui-calendar__content-header">
                <p>Пн</p>
                <p>Вт</p>
                <p>Ср</p>
                <p>Чт</p>
                <p>Пт</p>
                <p>Сб</p>
                <p>Вс</p>
            </div>
            <div class="ui-calendar__content-days">
                <p
                    v-for="d in calendar"
                    @click="modelValue = d"
                    :class="{ actived: modelValue == d }"
                >
                    {{ d.getDate() }}
                </p>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .ui-calendar {
        width: fit-content;
        max-width: 700px;
        padding: 8px 52px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 2px 4px 12px 0px #0000000d;
        user-select: none;
        &__nav {
            display: grid;
            grid-template-columns: 32px 1fr 32px;
            align-items: center;
            margin-bottom: 15px;
            padding: 16px 0;
            color: #000;
            border-bottom: 1px solid #dfdfdf;
        }
        &__nav-btn {
            width: 100%;
            height: fit-content;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            .nuxt-icon {
                width: 14px;
                height: 14px;
                transition: all 0.3s ease;
            }
            &:hover {
                .nuxt-icon {
                    color: #000;
                }
            }
            &--prev {
                .nuxt-icon {
                    rotate: 90deg;
                }
            }
            &--next {
                .nuxt-icon {
                    rotate: -90deg;
                }
            }
        }
        &__nav-text {
            display: flex;
            align-items: center;
            justify-content: center;
            span {
                font-weight: 600;
                font-size: 20px;
                line-height: 100%;
            }
        }
        &__content {
        }
        &__content-header {
            display: grid;
            grid-template-columns: repeat(7, 42px);
            margin-bottom: 12px;
            p {
                font-weight: 500;
                font-size: 12px;
                line-height: 110%;
                color: #8b8b8b;
                text-align: center;
            }
        }
        &__content-days {
            display: grid;
            grid-template-columns: repeat(7, 42px);
            gap: 10px;
            p {
                width: 100%;
                height: fit-content;
                aspect-ratio: 1;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                border-radius: 15px;
                &:hover {
                    color: #000;
                }
                &.actived {
                    background-color: #000;
                    color: #fff;
                    cursor: default;
                    &:hover {
                        color: #fff;
                    }
                }
            }
        }
    }
</style>