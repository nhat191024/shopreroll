<template>
    <Menubar :model="navItems">
        <template #start>
            <router-link to="/">
                <img src="/logo.png" alt="logo" width="150">
            </router-link>
        </template>
        <template #item="{ item, props, hasSubmenu }">
            <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
                <a :href="href" v-bind="props.action" @click="navigate">
                    <span :class="item.icon"></span>
                    <span class="ml-2">{{ item.label }}</span>
                </a>
            </router-link>
            <a v-else :href="item.url" :target="item.target" v-bind="props.action">
                <span :class="item.icon"></span>
                <span class="ml-2">{{ item.label }}</span>
                <span v-if="hasSubmenu" class="pi pi-fw pi-angle-down ml-2"></span>
            </a>
        </template>
        <template #end>
            <div class="border border-1 border-black rounded-full p-2 flex justify-center items-center"
                @click="userToggle">
                <i class="pi pi-user" style="font-size: 1.3rem"></i>
            </div>
            <TieredMenu ref="userMenu" id="overlay_tmenu" :model="userItem" popup>
                <template #item="{ item, props, hasSubmenu }">
                    <router-link v-if="item.login === auth" v-slot="{ href, navigate }" :to="item.route" custom>
                        <a :href="href" v-bind="props.action" @click="navigate">
                            <span :class="item.icon"></span>
                            <span class="ml-2">{{ item.label }}</span>
                        </a>
                    </router-link>
                </template>
            </TieredMenu>
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
import { RouterLink } from 'vue-router';

const auth = ref(false);

const navItems = ref([
    {
        label: 'Trang chủ',
        icon: 'pi pi-home',
        route: '/'
    },
    {
        label: 'Nạp tiền',
        icon: 'pi pi-wallet',
        items: [
            {
                label: 'Nạp thẻ cào',
                icon: 'pi pi-wallet',
                route: '/deposit'
            },
            {
                label: 'Nạp qua ngân hàng',
                icon: 'pi pi-wallet',
                route: '/deposit-bank'
            }
        ]
    },
    {
        label: 'Nạp game',
        icon: 'pi pi-money-bill',
        items: [
            {
                label: 'Genshin Impact',
                icon: 'pi pi-money-bill',
                route: '/top-up/genshin-impact'
            },
            {
                label: 'Zenless Zone Zero',
                icon: 'pi pi-money-bill',
                route: '/top-up/Zenless-zone-zero'
            }
        ]
    },
    {
        label: 'Lịch sử',
        icon: 'pi pi-history',
        items: [
            {
                label: 'Lịch sử nạp tiền',
                icon: 'pi pi-history',
                route: '/deposit'
            },
            {
                label: 'Lịch sử mua hàng',
                icon: 'pi pi-history',
                route: '/transaction'
            }
        ]
    }
]);

const userItem = ref([
    {
        label: 'Đăng nhập',
        icon: 'pi pi-sign-in',
        route: '/login',
        login: false
    },
    {
        label: 'Đăng ký',
        icon: 'pi pi-sign-in',
        route: '/register',
        login: false
    },
    {
        label: 'Đổi mật khẩu',
        icon: 'pi pi-key',
        route: '/change-pass',
        login: true
    },
    {
        label: 'Đăng xuất',
        icon: 'pi pi-sign-out',
        route: '/logout',
        login: true
    }
])
const userMenu = ref();
const userToggle = (event) => {
    userMenu.value.toggle(event);
};
</script>