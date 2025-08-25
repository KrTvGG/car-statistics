<script lang="ts" setup>
    const { data: requestGet } = await useFetch('http://localhost:8000/api/v1/test-route')
    const requestPost = ref(null)
    const formData = reactive<any>({
        text: ''
    })
    const errorInfo = ref<TRequestBody>({})
    const sendForm = async () => {
        errorInfo.value = {}

        try {
            const response = await request(`/api/v1/test-route`, "POST", formData) 
            console.log(response.text)
            requestPost.value = response.data
        } catch (error: any) {
            if (error.data) {
                Object.keys(error.data).forEach(item => {
                    errorInfo.value[item] = error.data[item]
                })
            }
        }
    }
</script>

<template>
    <div class="container">
        <br>
        <form @submit.prevent.stop="sendForm">
            <input type="text" v-model="formData.text" placeholder="Введите текст" required />
            <button type="submit">Отправить</button>
        </form>
        <br>
        <h3>Ответ от GET-запроса:</h3>
        <pre>{{ requestGet }}</pre>
        <h3>Ответ от POST-запроса:</h3>
        <pre>{{ requestPost }}</pre>
    </div>
</template>