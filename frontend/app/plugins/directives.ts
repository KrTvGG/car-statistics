export default defineNuxtPlugin(nuxtApp => {
    nuxtApp.vueApp.directive("click-outside", {
        mounted: (el: HTMLElement, callback) => {
            document.addEventListener("click", (e: MouseEvent) => {
                if (e.target && !el.contains(<HTMLElement>e.target))
                    callback.value()
            })
        },
    })
})