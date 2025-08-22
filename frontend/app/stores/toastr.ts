export const useToastrStore = defineStore("toastr", () => {
    const activeToastr = ref<string | null>(null)
    const toastrMessage = ref<string>("")
    const timer = ref<number>(4000)
    let delayClose: ReturnType<typeof setInterval> | undefined

    const closeToastr = () => {
        activeToastr.value = null
        timer.value = 4000
        if (delayClose) {
            clearInterval(delayClose)
            delayClose = undefined
        }
    }

    const showSuccess = (message: string) => {
        showToastr("success", message)
    }

    const showError = (message: string) => {
        showToastr("error", message)
    }

    const showInfo = (message: string) => {
        showToastr("info", message)
    }

    const showToastr = (name: string, message: string) => {
        closeToastr()
        toastrMessage.value = message
        setTimeout(() => {
            if (name === activeToastr.value) return

            activeToastr.value = name
            delayClose = setInterval(() => {
                timer.value -= 10
                if (timer.value <= 0) {
                    closeToastr()
                }
            }, 10)
        }, 50)
    }

    return {
        activeToastr,
        toastrMessage: computed(() => toastrMessage.value),
        timer: computed(() => timer.value),
        closeToastr,
        showSuccess,
        showError,
        showInfo,
    }
})