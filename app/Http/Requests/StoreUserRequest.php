<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string',
            'name' => 'required|string',
            'role' => 'required|integer',
            'balance' => 'required|numeric|digits_between:1,10',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone|digits:10',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Tên người dùng là bắt buộc',
            'username.unique' => 'Tên người dùng đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.digits' => 'Số điện thoại phải có 10 chữ số',
            'password.required' => 'Mật khẩu là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'name.required' => 'Tên là bắt buộc',
            'role.required' => 'Vai trò là bắt buộc',
            'balance.required' => 'Số dư là bắt buộc',
            'balance.numeric' => 'Số dư phải là số',
            'balance.digits_between' => 'Số dư phải có từ 1 đến 10 chữ số',
        ];
    }
}
