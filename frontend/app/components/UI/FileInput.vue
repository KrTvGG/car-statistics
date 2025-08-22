<script lang="ts" setup>
    const modelValue = defineModel<File[]>()
    type TFormates = "image" | "application"
    const { totalMaxSize, fileMaxSize, maxFiles, formates, rewrite } =
        defineProps<{
            totalMaxSize?: number
            fileMaxSize?: number
            maxFiles?: number
            rewrite?: boolean
            formates?: TFormates[] | TFormates
        }>()

    const fileValide = (file: File) => {
        if (fileMaxSize && file.size / 1024 / 1024 > fileMaxSize) return false
        if (formates)
            if (typeof formates === "string" && !file.type.includes(formates))
                return false
            else if (
                typeof formates !== "string" &&
                !formates.filter(format => file.type.includes(format)).length
            )
                return false
        return true
    }

    const filesValidate = (files: File[]) => {
        if (maxFiles && maxFiles < files.length) return false
        let totalSize = 0
        files.forEach(file => {
            totalSize += file.size / 1024 / 1024
        })
        if (totalMaxSize && totalMaxSize < totalSize) return false

        return true
    }

    const inputFiles = (files: File[]) => {
        if (rewrite) modelValue.value = []
        if (filesValidate(files))
            files.forEach(file => {
                if (fileValide(file)) modelValue.value?.push(file)
            })
    }

    const removeFile = (index: number) => {
        modelValue.value?.splice(index, 1)
    }

    const getFileName = (file: File) => {
        return file.name.length > 25
            ? file.name.slice(0, 20) +
                  "... ." +
                  file.name.split(".")[file.name.split(".").length - 1]
            : file.name
    }

    const isImg = (file: File) => {
        return window.FileReader && file.type.includes("image")
    }

    const getURLfromFile = (file: File) => {
        return URL.createObjectURL(file)
    }

    const onInput = (event: Event) => {
        let input = <HTMLInputElement>event.target
        let files = input.files ? [...input.files] : []
        inputFiles(files)
    }

    const onDrop = (event: DragEvent) => {
        let files = event.dataTransfer ? [...event.dataTransfer.files] : []
        dragOver.value = false

        inputFiles(files)
    }

    const dragOver = ref<boolean>(false)
</script>

<template>
    <div class="ui-file-input">
        <label
            class="drop-zone"
            :class="{ 'drop-zone--drag-over': dragOver }"
            @dragover.prevent="
                () => {
                    dragOver = true
                }
            "
            @dragleave="
                () => {
                    dragOver = false
                }
            "
            @drop.prevent="onDrop"
        >
            <input
                class="drop-zone__input"
                type="file"
                multiple
                @change="onInput"
            />
            <p class="drop-zone__color">Перетащи или Нажми и выбери</p>
        </label>
        <div class="ui-file-input__list">
            <div class="file-item" v-for="(file, ind) in modelValue">
                <div class="file-item__icon">
                    <img
                        v-if="isImg(file)"
                        :src="getURLfromFile(file)"
                        alt=""
                    />
                    <NuxtIcon v-else name="clip" filled />
                </div>
                <div class="file-item__name">{{ getFileName(file) }}</div>
                <div class="file-item__remove" @click="removeFile(ind)">x</div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .ui-file-input {
        width: 300px;
        &__list {
            display: grid;
            gap: 5px;
        }
    }

    .file-item {
        display: grid;
        grid-template-columns: 25px 1fr auto;
        gap: 10px;
        align-items: center;
        &__icon {
            width: 100%;
            aspect-ratio: 1;
        }
        &__name {
            font-size: 13px;
        }
        &__remove {
            cursor: pointer;
            transition: all 0.3s ease;
            &:hover {
                color: #f00;
            }
        }
    }

    .drop-zone {
        border: 1px dashed #000;
        display: flex;
        height: 150px;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        &--drag-over {
            background-color: #f00;
        }
        &:hover {
            background-color: #f3f3f3;
        }
        &__input {
            display: none;
        }
    }
</style>