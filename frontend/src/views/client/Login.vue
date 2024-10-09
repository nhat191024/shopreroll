<template>
    <div class="h-dvh relative z-10 flex flex-col items-center py-1">
        <img src="/title.png" alt="title" width="100">
        <Form @submit="onSubmit"
            class="relative w-11/12 md:w-3/5 xl:w-1/5 h-fit mt-2 rounded-xl flex flex-col gap-5 items-center">
            <div class="absolute z-0 w-full h-full bg-white opacity-85 rounded-xl"></div>
            <p class="z-10 mt-6 mb-3 text-3xl md:text-4xl md:font-medium text-primary-50 text-shadow-custom">Đăng Nhập</p>
            <div>
                <FloatLabel>
                    <InputText v-model="username"/>
                    <label for="username">Tên đăng nhập</label>
                </FloatLabel>
                <p class="text-red-700 text-center mt-1 z-10">{{ usernameError }}</p>
            </div>
            <div class="mt-1 flex flex-col items-center">
                <FloatLabel>
                    <InputText id="password" v-model="password" type="password"/>
                    <label for="password">Mật khẩu</label>
                </FloatLabel>
                <p class="text-red-700 text-center mt-1 z-10">{{ passwordError }}</p>
            </div>
            <div class="flex flex-col items-center">
                <Checkbox v-model="captcha" class="z-10"/>
                <p class="text-red-700 text-center mt-1 px-3 z-10">{{ captchaError }}</p>
            </div>
            <div class="flex gap-5">
                <Button label="Đăng nhập" severity="info" type="submit"></Button>
                <Button label="Đăng ký" severity="info" as="router-link" to="/register"></Button>
            </div>
            <a href="" class="mb-3 z-10">Quên mật khẩu? Lấy lại</a>
        </Form>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { Checkbox } from 'vue-recaptcha';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import { Form, useForm, useField } from 'vee-validate';
import * as yup from 'yup';

const auth = ref('none');

const { validate } = useForm();

const usernameRule = yup.string().required('Tên Đăng Nhập là bắt buộc');
const passwordRule = yup.string().required('Mật khẩu là bắt buộc').min(4, 'Mật khẩu yêu cầu ít nhất 4 ký tự');
const captchaRule = yup.string().required('Vui lòng xác nhận bạn không phải là robot');

const { value: username, errorMessage: usernameError } = useField('username', usernameRule);
const { value: password, errorMessage: passwordError } = useField('password', passwordRule);
const { value: captcha, errorMessage: captchaError } = useField('captcha', captchaRule);

const recaptchaResponse = ref('');

function onVerify(response) {
    recaptchaResponse.value = response;
}

function onExpired() {
    recaptchaResponse.value = '';
}

async function onSubmit() {
    const { valid, errors } = await validate();
    if (!valid) {
        console.log('Validation errors:', errors);
        return;
    }

    if (!recaptchaResponse.value) {
        console.log('reCAPTCHA validation failed');
        return;
    }

    console.log('Username:', username.value);
    console.log('Password:', password.value);
    console.log('reCAPTCHA response:', recaptchaResponse.value);
}
</script>