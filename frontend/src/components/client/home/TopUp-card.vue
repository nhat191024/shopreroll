<template>
    <p class="mt-6 mb-3 text-5xl font-medium text-primary-50 text-shadow-custom">Nạp Thẻ Cào</p>
    <div class="relative h-fit w-11/12">
        <div class="absolute bg-black opacity-65 rounded-lg w-full h-full "></div>
        <div class="relative h-full w-full flex flex-col gap-2  py-5 px-6">
            <div class="flex flex-col xl:flex-row w-full">
                <Form class="xl:w-1/2 flex flex-col items-center shrink-0 gap-4" @submit="onSubmit">
                    <p class="text-3xl text-primary-400 font-medium text-center mb-4">Nhập thẻ</p>
                    <div class="w-full">
                        <label for="" class="text-primary-400 font-medium text-lg">Nhà mạng</label>
                        <Select v-model="selectedMobileCarrier" :options="mobileCarriers" optionLabel="label"
                            placeholder="Chọn nhà mạng" class=" w-full"></Select>
                        <p class="text-red-500 font-bold mt-1">{{ mobileCarrierError }}</p>
                    </div>
                    <div class="w-full">
                        <label for="" class="text-primary-400 font-medium text-lg">Mệnh giá</label>
                        <Select v-model="selectedCardValue" :options="cardValues" optionLabel="label"
                            placeholder="Chọn mệnh giá" class=" w-full"></Select>
                        <p class="text-red-500 font-bold mt-1">{{ cardValueError }}</p>
                    </div>
                    <div class="w-full">
                        <label for="" class="text-primary-400 font-medium text-lg">Seri thẻ</label>
                        <InputGroup>
                            <InputGroupAddon>
                                <i class="pi pi-pen-to-square"></i>
                            </InputGroupAddon>
                            <InputText placeholder="Seri thẻ" v-model="serial" />
                        </InputGroup>
                        <p class="text-red-500 font-bold mt-1">{{ serialError }}</p>
                    </div>
                    <div class="w-full">
                        <label for="" class="text-primary-400 font-medium text-lg">Mã thẻ</label>
                        <InputGroup>
                            <InputGroupAddon>
                                <i class="pi pi-pen-to-square"></i>
                            </InputGroupAddon>
                            <InputText placeholder="Mã thẻ" v-model="card" />
                        </InputGroup>
                        <p class="text-red-500 font-bold mt-1">{{ cardError }}</p>
                    </div>
                    <div class="w-full text-center">
                        <Button label="Yêu cầu nạp" class="text-center xl:w-1/2" severity="info" type="submit"></Button>
                    </div>
                </Form>

                <div class="xl:w-1/2 flex flex-col gap-3 items-center shrink-0 my-6 xl:my-0 px-0 xl:px-20">
                    <p class="text-primary-400 text-3xl font-bold text-center">Hướng dẫn</p> 
                    <div>
                        <p class="text-red-600 text-center">Lưu ý!!! Vui lòng chọn đúng mệnh giá, sai là mất thẻ.</p>
                        <p class="text-red-600 text-center">
                            Ưu tiên nạp Thẻ <strong>VINAPHONE + ZING</strong> ít lỗi và xử lí nhanh
                        </p>
                    </div>
                    <p class="text-primary-400 text-center">
                        Hiện tại quý khách nạp vào 100.000 tiền thẻ cào sẽ được 80.000 tiền shop do quy đổi
                        từ
                        thẻ cào ra tiền mặt tốn phí ạ !
                    </p>
                </div>
            </div>


            <div class="flex flex-col gap-2 mt-0 xl:mt-10">
                <Toast position="top-left" />
                <div class="">
                    <Button label="Sao chép" class="text-nowrap mr-2" severity="info" @click="copy"></Button>
                    <Button label="Xuất excel" class="text-nowrap mr-2" severity="info" @click="download"></Button>
                    <Button label="In" class="text-nowrap mt-1" severity="info" @click="print"></Button>
                </div>
                <DataTable :value="history" paginator :rows="4" tableStyle="min-width: 50rem"
                    paginatorTemplate="RowsPerPageDropdown PrevPageLink CurrentPageReport NextPageLink"
                    currentPageReportTemplate="Dòng {first} tới {last} trong tổng {totalRecords}">
                    <Column field="id" header="Id" sortable></Column>
                    <Column field="status" header="Trạng thái" sortable class="text-nowrap"></Column>
                    <Column field="mobileCarries" header="Nhà mạng" sortable class="text-nowrap"></Column>
                    <Column field="parValue" header="Mệnh giá" sortable class="text-nowrap"></Column>
                    <Column field="serial" header="Seri/Mã" sortable class="text-nowrap"></Column>
                    <Column field="receipt" header="Tiền nhận" sortable class="text-nowrap"></Column>
                    <Column field="time" header="Thời gian" sortable class="text-nowrap"></Column>
                </DataTable>
            </div>

        </div>
    </div>

</template>
<script setup>
import { ref, defineAsyncComponent } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import { convertToCSV, downloadCSV, copyToClipboard, printTable } from '@/helper/helper.js';
import { Form, useForm, useField } from 'vee-validate';
import * as yup from 'yup';

const Select = defineAsyncComponent(() => import('primevue/select'));
const InputGroup = defineAsyncComponent(() => import('primevue/inputgroup'));
const InputGroupAddon = defineAsyncComponent(() => import('primevue/inputgroupaddon'));
const InputText = defineAsyncComponent(() => import('primevue/inputtext'));
const Button = defineAsyncComponent(() => import('primevue/button'));

const toast = useToast();
const { validate } = useForm();

const mobileCarriers = [
    { label: 'Viettel - Khuyên', value: 'viettel' },
    { label: 'Vinaphone', value: 'vinaphone' },
    { label: 'Mobifone', value: 'mobifone' },
    { label: 'Vietnamobile', value: 'vietnamobile' },
    { label: 'Zing - Hạn chế', value: 'zing' },
    { label: 'Gate - Hạn chế', value: 'gate' }
];
const cardValues = [
    { label: '10,000đ', value: '10000' },
    { label: '20,000đ', value: '20000' },
    { label: '30,000đ', value: '30000' },
    { label: '50,000đ', value: '50000' },
    { label: '100,000đ', value: '100000' },
    { label: '200,000đ', value: '200000' },
    { label: '300,000đ', value: '300000' },
    { label: '500,000đ', value: '500000' },
    { label: '1,000,000đ', value: '1000000' }
];
const history = ref([
    {
        id: 1,
        status: 'Đang xử lý',
        mobileCarries: 'Viettel',
        parValue: '100.000đ',
        serial: '123456789',
        receipt: '80.000đ',
        time: '2021-10-10 10:10:10'
    },
    {
        id: 2,
        status: 'Đã xử lý',
        mobileCarries: 'Vinaphone',
        parValue: '50.000đ',
        serial: '987654321',
        receipt: '40.000đ',
        time: '2021-10-10 10:10:10'
    },
    {
        id: 2,
        status: 'Đã xử lý',
        mobileCarries: 'Vinaphone',
        parValue: '50.000đ',
        serial: '987654321',
        receipt: '40.000đ',
        time: '2021-10-10 10:10:10'
    }
]);

const mobileCarrierRule = yup.object().typeError('Mobile Carrier bị sai định dạng (nếu bạn thấy thông báo này hãy báo với dev)').required('Nhà mạng là bắt buộc');
const cardValueRule = yup.object().typeError('Mobile Carrier bị sai định dạng (nếu bạn thấy thông báo này hãy báo với dev)').required('Mệnh giá là bắt buộc');
const serialRule = yup.number().typeError('Seri phải là số').required('Seri thẻ là bắt buộc');
const cardRule = yup.number().typeError('Mã thẻ phải là số').required('Mã thẻ là bắt buộc');

const { value: selectedMobileCarrier, errorMessage: mobileCarrierError } = useField('mobileCarrier', mobileCarrierRule);
const { value: selectedCardValue, errorMessage: cardValueError } = useField('cardValue', cardValueRule);
const { value: serial, errorMessage: serialError } = useField('serial', serialRule);
const { value: card, errorMessage: cardError } = useField('card', cardRule);

async function onSubmit() {
    const { valid, errors } = await validate();
    if (!valid) {
        return;
    }
    // console.log(selectedMobileCarrier.value.value);
}

const copy = () => {
    const csv = convertToCSV(history.value);
    copyToClipboard(csv);
    toast.add({ severity: 'info', summary: 'Thông báo', detail: 'Copy thành công', life: 3000 });
};

const download = () => {
    downloadCSV(history.value, 'history.csv');
    toast.add({ severity: 'info', summary: 'Thông báo', detail: 'Download thành công', life: 3000 });
};

const print = () => {
    const table = JSON.parse(JSON.stringify(history.value));
    console.log(printTable(table));
};
</script>