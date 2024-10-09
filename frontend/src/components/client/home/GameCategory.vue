<template>
    <div class="flex flex-col xl:flex-row justify-center gap-5 my-10">
        <template v-for="item in data">
            <div class="flex flex-col items-center gap-2">
                <img :src="item.image" :alt="item.name" width="300" class="rounded-full border-2 border-yellow-500">
                <p class="text-3xl text-center text-yellow-400 drop-shadow-2xl text-shadow-custom font-bold">{{ item.name }}</p>
                <Button label="Mua Ngay" severity="info"></Button>
            </div>
        </template>
    </div>
</template>
<script setup>
import Button from 'primevue/button';
import { ref } from 'vue';

const data = ref([
    { image: '/zzz.webp', name: 'ACC Zenless Zone Zero' },
    { image: '/hsr.webp', name: 'Honkai Star Rail' },
]);
</script>