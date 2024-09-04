<template>
    <!-- demo home -->
    <div class="relative z-10">
        <div class="h-dvh md:h-fit">
            <div class="flex flex-col items-center pt-14 px-2">
                <img src="/title.png" alt="title" width="100">
                <p class="text-4xl font-bold drop-shadow-2xl text-center text-primary-50 text-shadow-custom">
                    Shop Bán Acc Honkai Star Rail và Genshin Uy Tín hàng đầu Việt Nam
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-center mt-10 md:mt-16 gap-5">
                <Button label="Hỗ trợ " severity="info" raised as="a" href="#" target="_blank" size="large"></Button>
                <Button label="Nạp tiền" severity="info" raised as="a" href="#" target="_blank" size="large"></Button>
                <Button label="Nạp game" severity="info" raised as="a" href="#" target="_blank" size="large"></Button>
                <Button label="Cày thuê" severity="info" raised as="a" href="#" target="_blank" size="large"></Button>
            </div>
        </div>

        <TopRecharge></TopRecharge>
        <GameCategory></GameCategory>
        <Genshin></Genshin>
        <TopUp></TopUp>
    </div>
</template>
<script setup>
import Button from 'primevue/button';
import TopRecharge from '@/components/client/home/TopRecharge.vue';
import GameCategory from '@/components/client/home/GameCategory.vue';
import Genshin from '@/components/client/home/Genshin.vue';
import TopUp from '../../components/client/home/TopUp.vue';
</script>