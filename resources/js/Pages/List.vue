<script setup>
import {ref} from "vue";
import {data} from "autoprefixer";
import {Link} from "@inertiajs/vue3";

const props = defineProps(['items'])

const itemVisibility = ref({})
const localItems = ref([...props.items])
function toggleChileVisibility(id){
    itemVisibility.value[id] = !itemVisibility.value[id]
}

function deleteItem(id){
    axios.delete(`/api/item/delete/${id}`)
        .then(res => {
            localItems.value = localItems.value.filter(item => item.id !== id)
        })
}

function sendUpdatePosition(id, direction){
    axios.post('/api/item/update-position', {id: id, direction: direction})
        .then(res => {
            console.log(res)
        })
}

function moveItemUp(index){
    if (index > 0){
        const temp = localItems.value[index]
        localItems.value[index] = localItems.value[index - 1]
        localItems.value[index - 1] = temp

        sendUpdatePosition(temp.id, 'up')
    }
}


function moveItemDown(index){
    if (index < props.items.length - 1){
        const temp = localItems.value[index]
        localItems.value[index] = localItems.value[index + 1]
        localItems.value[index + 1] = temp

        sendUpdatePosition(temp.id, 'down')
    }
}

</script>

<template>
    <div class="bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto flex flex-col bg-white p-5 rounded-lg">
            <div class="grid grid-cols-9 mb-6 px-6">
                <div class="col-span-2">Наименование</div>
                <div>Кол-во</div>
                <div>Источник</div>
                <div>Лазер</div>
                <div>Сварка</div>
                <div>Сборка</div>
                <div>Электр</div>
                <div></div>
            </div>

            <div v-for="(item, index) in localItems" :key="item.id">
                <div class="grid grid-cols-9 mb-3 bg-[#F8FAFC] rounded-lg px-6 py-3">
                    <div class="col-span-2 flex gap-x-3">
                        <div class="flex flex-col gap-y-1">
                            <button
                                v-on:click="moveItemUp(index)"
                                :disabled="index === 0"
                                :class="{ 'opacity-25': index === 0}"
                            >
                                <img src="/icons/up.png" alt="" width="14" height="12">
                            </button>
                            <button
                                v-on:click="moveItemDown(index)"
                                :disabled="localItems.length - 1 === index"
                                :class="{ 'opacity-25': localItems.length - 1 === index}"
                            >
                                <img src="/icons/down.png" alt="" width="14" height="12">
                            </button>
                        </div>
                        <div>
                            {{ item.name }}
                        </div>
                        <div v-on:click="toggleChileVisibility(item.id)" class="content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    <div>{{ item.count }}</div>
                    <div>{{ item.source }}</div>
                    <div>{{ item.laser }}</div>
                    <div>{{ item.weld }}</div>
                    <div>{{ item.assembly }}</div>
                    <div>{{item.electric }}</div>
                    <div class="flex gap-x-3 justify-end">
                        <Link href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 bg-[#7843E9] p-0.5 rounded-md text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </Link>
                        <button v-on:click="deleteItem(item.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 bg-red-600 p-0.5 rounded-md text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div
                    v-show="itemVisibility[item.id]"
                    v-for="child in item.child_items"
                    :key="child.id"
                    class="grid grid-cols-9 mb-2 bg-white border-2 rounded-lg px-3 py-2"
                >
                    <div class="col-span-2 flex gap-x-3">
                        <div>
                            {{ child.name }}
                        </div>
                    </div>
                    <div>{{ child.count }}</div>
                    <div>{{ child.source }}</div>
                    <div>{{ child.laser }}</div>
                    <div>{{ child.weld }}</div>
                    <div>{{ child.assembly }}</div>
                    <div>{{child.electric }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
