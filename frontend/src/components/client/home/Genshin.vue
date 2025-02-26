<template>
    <div class="flex flex-col items-center mt-16 mb-10 mx-2">
        <img src="/city.png" alt="city" width="100">
        <p class="text-3xl font-bold text-primary-50 text-shadow-custom">Acc Genshin</p>
        <div class="mt-5 flex flex-col xl:flex-row gap-10">
            <template v-for="item in data">
                <div class="flex flex-col items-center">
                    <img :src="item.image" alt="genshin" width="400" class=" rounded-xl">
                    <p class="text-primary-300 my-4 text-2xl font-bold text-shadow-custom">{{ item.type }}</p>
                    <p class="text-primary-400 text-xl text-shadow-custom">Số tài khoản </p>
                    <p class="text-primary-300 text-xl font-bold text-shadow-custom">{{ item.accounts }}</p>
                    <p class="text-primary-400 text-xl text-shadow-custom">Đã bán</p>
                    <p class="text-primary-300 text-xl font-bold text-shadow-custom">{{ item.sold }}</p>
                    <Button label="Khám Phá" severity="warn" size="large"></Button>
                </div>
            </template>
        </div>
    </div>
</template>
<script setup>
import Button from 'primevue/button';
import { ref } from 'vue';

const data = ref([
    { image: '/genshin1.jpg', type: 'REROLL LIMITED ( NEW )', accounts: 526, sold: 1014 },
    { image: '/genshin2.jpg', type: 'ACC VIP CẤP THẤP', accounts: 160, sold: 1006 },
    { image: '/genshin3.png', type: 'REROLL THƯỜNG', accounts: 317, sold: 2641 },
    { image: '/genshin4.png', type: 'REROLL LIMITED', accounts: 0, sold: 734 },
]);
</script>