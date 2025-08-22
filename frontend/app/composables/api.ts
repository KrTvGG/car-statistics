type TMethod = "GET" | "PATCH" | "POST" | "PUT" | "DELETE"

export const getAPIUrl = () => {
    let url = `${useRequestURL().protocol}//${useRequestURL().hostname}`
    if (process.server) url = url.replace("localhost", "laravel:8000")

    return url
}
let csrf: string

export const useRequest = async <T>(
    url: string,
    method?: TMethod,
    body?: TRequestBody,
) => {
    url = getAPIUrl() + url
    if (!csrf && method != "GET")
        csrf = await $fetch<string>(`${getAPIUrl()}/api/v1/csrf_generate/`)
    const response = await useFetch(url, {
        method,
        [method == "GET" ? "params" : "body"]: body,
        headers: {
            "X-CSRFToken": csrf,
            ...useRequestHeaders(["cookie"]),
        },
        credentials: "include",
    })

    if (response.error.value) throw createError(response.error.value)
    return {
        error: response.error,
        data: response.data as Ref<T>,
        refresh: response.refresh,
        status: response.status,
    }
}