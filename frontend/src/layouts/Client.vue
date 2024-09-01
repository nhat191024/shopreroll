<template>
    <Navbar></Navbar>
    <img src="/bg.webp" alt="" class=" fixed h-dvh w-dvw z-0 object-cover">
    <router-view></router-view>
    <Footer></Footer>
</template>
<script setup>
import Navbar from '@/components/client/NavBar.vue';
import Footer from '@/components/client/Footer.vue';
</script>
