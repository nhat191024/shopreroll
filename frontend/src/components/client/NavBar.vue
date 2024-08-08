<template>
        <Menubar :model="navItems">
            <template #start >
                <img src="/logo.png" alt="logo" width="150">
            </template>
            <template #item="{ item, props }">
                <a class="flex items-center" v-bind="props.action">
                    <span :class="item.icon"></span>
                    <span class="ml-2">{{ item.label }}</span>
                </a>
            </template>
            <template #end>
                <div class="border border-1 border-black rounded-full p-2 flex justify-center items-center" @click="userToggle">
                    <i class="pi pi-user" style="font-size: 1.3rem"></i>
                </div>
                <TieredMenu ref="userMenu" id="overlay_tmenu" :model="userItem" popup />
            </template>
            <template #buttonicon>
                <i class="pi pi-align-justify" style="font-size: 1.2rem"></i>
            </template>
        </Menubar>
</template>
<script setup>
import { ref } from 'vue';
import TieredMenu from 'primevue/tieredmenu';
import Menubar from 'primevue/menubar';

const navItems = ref([
    {
        label: 'Trang chủ',
        icon: 'pi pi-home'
    },
    {
        label: 'Nạp tiền',
        icon: 'pi pi-wallet'
    },
    {
        label: 'Nạp game',
        icon: 'pi pi-money-bill'
    },
    {
        label: 'Lịch sử',
        icon: 'pi pi-history'
    }
]);

const userItem = ref([
{
        label: 'Đăng nhập',
        icon: 'pi pi-sign-in'
    },
    {
        label: 'Đăng ký',
        icon: 'pi pi-sign-in'
    },
])
const userMenu = ref();
const userToggle = (event) => {
    userMenu.value.toggle(event);
};
</script>