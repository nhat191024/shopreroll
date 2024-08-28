<template>
    <div class="flex flex-col items-center mt-16 mb-10 mx-2">
        <img src="/city.png" alt="city" width="100">
        <p class="text-3xl font-bold text-primary-50 text-shadow-custom">Nạp Game</p>
        <div class="mt-5 flex flex-col xl:flex-row gap-10">
            <template v-for="item in data">
                <div class="flex flex-col items-center">
                    <img :src="item.image" alt="genshin" width="400" class="rounded-2xl border-2 border-yellow-500">
                    <p class="text-primary-300 my-4 text-2xl font-bold text-shadow-custom">{{ item.name }}</p>
                    <p class="text-primary-400 text-xl text-shadow-custom">Đang nạp</p>
                    <p class="text-primary-300 text-xl font-bold text-shadow-custom">{{ item.Recharging }}</p>
                    <p class="text-primary-400 text-xl text-shadow-custom">Đã nạp</p>
                    <p class="text-primary-300 text-xl font-bold text-shadow-custom">{{ item.hasBeenCharged }}</p>
                    <Button label="Nạp ngay" severity="warn" size="large"></Button>
                </div>
            </template>
        </div>
    </div>
</template>
<script setup>
import Button from 'primevue/button';
import { ref } from 'vue';

const data = ref([
    { image: '/genshinTopUp.webp', name: 'Genshin', Recharging: '1', hasBeenCharged: '2' },
    { image: '/zzzTopUp.webp', name: 'Zenless Zone Zero', Recharging: '1', hasBeenCharged: '2' },
]);
</script>