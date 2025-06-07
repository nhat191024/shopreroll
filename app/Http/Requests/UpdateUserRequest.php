<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password' => 'nullable|string',
            'role' => 'integer',
            'balance' => 'numeric|digits_between:1,10',
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
            'password.string' => 'Mật khẩu phải là chuỗi',
            'role.required' => 'Vai trò là bắt buộc',
            'role.integer' => 'Vai trò phải là số nguyên',
            'balance.numeric' => 'Số dư phải là số',
            'balance.digits_between' => 'Số dư phải có từ 1 đến 10 chữ số',
        ];
    }
}
