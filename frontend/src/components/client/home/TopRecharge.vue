<template>
    <div class="h-fit flex justify-center mx-2 mb-4 md:mt-10">
        <div class="w-full xl:w-3/4 flex flex-col xl:flex-row xl:gap-6 p-2 bg-opacity-60 bg-black">
            <iframe class="w-full h-40 md:h-96 xl:h-full"
                src="https://www.youtube.com/embed/OizK-VT4aj8?si=16HBObssgGa8zgqi" title="YouTube video player"
                frameborder="0"
                allow="web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="my-4 xl:w-2/5">
                <p class="text-2xl font-medium text-primary-400 drop-shadow-2xl text-center">Top Nạp Tiền</p>
                <div class="flex justify-center items-center text-primary-200 text-xl font-light md:font-medium mt-4">
                    <table class="w-full h-full">
                        <tr v-for="(item, index) in data" :key="index">
                            <td class="text-black pb-2">
                                <Avatar :label="`${index + 1}`" shape="circle"
                                    style="background-color: #fef08a; font-weight: 400;" />
                            </td>
                            <td class="pb-2 text-ellipsis overflow-hidden">{{ item.name }}</td>
                            <td class="mb-2 flex justify-center text-center">
                                <span class="outline outline-1 p-1 rounded-sm">{{ item.amount }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Avatar from 'primevue/avatar';

const data = ref([
    { name: 'Keith sierra', amount: 10000000 },
    { name: 'Nam', amount: 9000 },
    { name: 'Perawit', amount: 8000 },
    { name: 'Nguyễn Duy', amount: 7000 },
    { name: 'Paul', amount: 6000 },
    { name: 'Vo phuc khang', amount: 5000 },
    { name: 'Dương Quang Ánh', amount: 4000 },
    { name: 'Nguyễn minh Quang', amount: 3000 },
    { name: 'Nhữ đình lâm', amount: 2000 },
    { name: 'Nguyễn Văn Trường', amount: 1000 },
]);
</script>