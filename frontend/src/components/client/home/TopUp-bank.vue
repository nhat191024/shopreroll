<template>
    <p class="mt-6 mb-3 text-5xl font-medium text-primary-50 text-shadow-custom text-center">Auto Bank, ví điện tử</p>
    <div class="relative h-fit w-11/12">
        <div class="absolute bg-black opacity-65 rounded-lg w-full h-full "></div>
        <div class="relative h-full w-full flex flex-col xl:flex-row gap-2 py-5 px-6">
            <div class="text-primary-200 flex flex-col gap-2 shrink-0 xl:w-1/2">
                <p class="text-primary-200 font-bold text-2xl text-center">Thông tin ngân hàng</p>
                <p>Thông tin</p>
                <p>Ngân hàng: Techcombank</p>
                <p>Chủ tài khoản: Lưu Thành Đạt</p>
                <p>Số Tài Khoản:</p>
                <Button :label="bankAccount" severity="info" icon="pi pi-copy" class="w-1/2 md:w-1/4"
                    @click="copyBankAccount"></Button>
                <p>Nội dung chuyển tiền:</p>
                <Button :label="bankContent" icon="pi pi-copy" severity="info" class="w-1/2 text-nowrap md:w-1/4"
                    @click="copyBankContent"></Button>
                <div class="w-full flex flex-col items-center justify-center my-10">
                    <p>QR tài khoản của shop</p>
                    <img src="/qrbank.jpg" alt="QR">
                </div>
            </div>
            <div class="text-primary-200 shrink-0 xl:w-1/2">
                <p class="text-primary-200 font-bold text-2xl text-center">Hướng dẫn</p>
                <p class="mt-5 text-red-600 font-medium">Lưu ý!!! Hệ thống cộng tiền tự động trong 30s nên vui lòng
                    chuyển đúng nội dung ở trên : nap " ID SHOP ( 6 số ) "</p>
                <p class="mt-5 font-medium">Nếu chuyển sai vui lòng liên hệ ADMIN hoặc số điện thoại 0386496488
                    (12h-24h) để được hỗ trợ.</p>
                <p class="mt-5 font-medium"> Techcombank thì trong vòng 1 ngày mà khách chuyển thêm trùng số tiền thì sẽ
                    bị delay đến hôm sau. Mẹo khắc phục là chuyển lệch 1đ nếu nạp thêm</p>
            </div>
        </div>
    </div>

    <Toast position="top-left" />
</template>
<script setup>
import { ref, defineAsyncComponent } from 'vue';
import { copyToClipboard } from '@/helper/helper.js';

import { useToast } from 'primevue/usetoast';
const Toast = defineAsyncComponent(() => import('primevue/toast'));
const Button = defineAsyncComponent(() => import('primevue/button'));

const toast = useToast();
const bankContent = ref('nap 123456');
const bankAccount = ref('1234567890');

const copyBankAccount = () => {
    copyToClipboard(bankAccount.value);
    toast.add({ severity: 'success', summary: 'Thành công', detail: 'Đã sao chép số tài khoản', life: 3000 });
};

const copyBankContent = () => {
    copyToClipboard(bankContent.value);
    toast.add({ severity: 'success', summary: 'Thành công', detail: 'Đã sao chép nội dung chuyển tiền', life: 3000 });
};

</script>