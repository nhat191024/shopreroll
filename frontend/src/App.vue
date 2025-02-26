<template>
    <router-view></router-view>
</template>
<script setup>
import { useRecaptchaProvider } from 'vue-recaptcha';

useRecaptchaProvider();
</script>