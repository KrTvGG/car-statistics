type TMethod = "GET" | "PATCH" | "POST" | "PUT" | "DELETE"

export const getAPIUrl = () => {
    let url = `${useRequestURL().protocol}//${useRequestURL().hostname}:8000`
    // if (process.server) url = url.replace("localhost", "localhost:8000")

    return url
}

export const request = async <T> (
    url: string,
    method?: TMethod,
    body?: TRequestBody,
) => {
    const fetchData  = {
        method: method,
        params: method == 'GET' ? body : undefined,
        body: method != 'GET' ? body : undefined,
        headers: {
            ...useRequestHeaders(['cookie']),
        },
        credentials: 'include',
    }
    url = getAPIUrl() + url
    if (process.client)
        return await $fetch<T>(url, fetchData)
    else{
        const { data, error } = await useFetch(url)
        if (error.value)
            throw createError(error.value)
        return <T>data.value
    }
}