<template>
    <div class="h-fit relative z-10 flex flex-col items-center pt-1 pb-10">
        <img src="/title.png" alt="title" width="100">
        <Form @submit="onSubmit"
            class="w-11/12 md:w-3/5 xl:w-1/5 h-fit mt-1 bg-white border border-black border-1 rounded-lg flex flex-col gap-7 items-center">
            <p class="mt-8 mb-3 text-3xl md:text-4xl md:font-medium text-primary-50 text-shadow-custom">Đăng Ký</p>
            <div class="flex flex-col items-center px-4">
                <FloatLabel>
                    <InputText v-model="name" />
                    <label for="name">Họ và tên</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ nameError }}</small>
            </div>
            <div class="flex flex-col items-center px-4">
                <FloatLabel>
                    <InputText v-model="username" />
                    <label for="username">Tên đăng nhập</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ usernameError }}</small>
            </div>
            <div class="flex flex-col items-center px-4">
                <FloatLabel>
                    <InputText v-model="phone" />
                    <label for="username">Số điện thoại</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ phoneError }}</small>
            </div>
            <div class="flex flex-col items-center px-4">
                <FloatLabel>
                    <InputText v-model="email" />
                    <label for="email">Địa chỉ email</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ emailError }}</small>
            </div>
            <div class="mt-1 flex flex-col items-center">
                <FloatLabel>
                    <InputText v-model="password" type="password" />
                    <label for="password">Mật khẩu</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ passwordError }}</small>
            </div>
            <div class="mt-1 flex flex-col items-center">
                <FloatLabel>
                    <InputText v-model="confirmPassword" type="password" />
                    <label for="confirmPassword">Xác nhận mật khẩu</label>
                </FloatLabel>
                <small class="text-red-700 text-center mt-1">{{ confirmPasswordError }}</small>
                <small class="text-red-700 text-center mt-1">{{ passwordNotMatching }}</small>
            </div>
            <div class="flex flex-col items-center">
                <Checkbox v-model="captcha" />
                <p class="text-red-700 text-center mt-1 px-3">{{ captchaError }}</p>
            </div>
            <div class="flex gap-5 mb-5">
                <Button label="Đăng ký" type="submit" severity="info"></Button>
                <Button label="Đăng nhập" severity="info" as="router-link" to="/login"></Button>
            </div>
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
const passwordNotMatching = ref('');

const { validate } = useForm();

const nameRule = yup.string().required('Họ và tên là bắt buộc');
const usernameRule = yup.string().required('Tên Đăng Nhập là bắt buộc');
const phoneRule = yup.string().required('Số điện thoại là bắt buộc').matches(/^\d{10}$/, 'Số điện thoại phải là số và có đúng 10 ký tự');
const emailRule = yup.string().required('Email là bắt buộc').email('Email không hợp lệ');
const passwordRule = yup.string().required('Mật khẩu là bắt buộc').min(4, 'Mật khẩu yêu cầu ít nhất 4 ký tự');
const confirmPasswordRule = yup.string().required('Mật khẩu không khớp');
const captchaRule = yup.string().required('Vui lòng xác nhận bạn không phải là robot');

const { value: name, errorMessage: nameError } = useField('name', nameRule);
const { value: username, errorMessage: usernameError } = useField('username', usernameRule);
const { value: phone, errorMessage: phoneError } = useField('phone', phoneRule);
const { value: email, errorMessage: emailError } = useField('email', emailRule);
const { value: password, errorMessage: passwordError } = useField('password', passwordRule);
const { value: confirmPassword, errorMessage: confirmPasswordError } = useField('confirmPassword', confirmPasswordRule);
const { value: captcha, errorMessage: captchaError } = useField('captcha', captchaRule);

async function onSubmit() {
    const { valid, errors } = await validate();
    if (password.value !== confirmPassword.value) {
        passwordNotMatching.value = 'Mật khẩu không khớp';
    } else {
        passwordNotMatching.value = '';
    }
}
</script>